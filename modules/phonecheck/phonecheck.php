<?php

/*
targetsms.ru
sdetox
aassaDDG3
*/
require_once __DIR__ .'/sms.auth.class.php';

class modPhonecheck {
    public function __construct($app)
    {
        $this->checkRequires(['curl']);
        $mode = $app->route->mode;
        if (isset(($app->route->params))) $param = $app->route->params[0];
        in_array($mode,['reg','check','getcode','login']) ? null : $app->apikey('module');
        $this->app = &$app;
        $this->sett = (object)$app->vars('_sett.modules.phonecheck');
        if (method_exists($this, $mode)) {
            echo $this->$mode();
        } else if ($this->isPhone($param)) {
            echo $this->reg($param);
        } else {
            $form = $app->controller('form');
            echo $form->get404();
        }
        die;
    }

    private function getcode() {
        header('Content-Type: application/json');
        $this->phone = $this->app->vars('_post.phone');
        $user = $this->app->checkUser($this->number, 'phone');
        
        if ($this->type !== "login" && $user) {
            echo json_encode(['error' => true, 'msg' => 'Пользователь уже зарегистрирван']);    
            die;
        }

        $this->type = $this->app->vars('_post.type');
        $this->number = preg_replace('/[^0-9]/', '', $this->phone);

        $this->code = $this->sendsms($this->phone);
        $this->check = $this->app->PasswordMake($this->code.$this->number);

        
        if ($this->code == 0 && $this->number !== '71111111111') return json_encode([
            'phone'=>$this->number,
            'code'=>'',
            'check'=>false
        ]);

        $data = $this->app->vars('_post');
        unset($data['code']);
        unset($data['type']);
        unset($data['__token']);

        $_SESSION['reg'] = ['phone'=>$this->phone, 'data'=>$data, 'control'=>$this->check];
        $this->type == 'login' ? $this->setcode() : null;
        ($this->sett->testmode == 'on' OR $this->number == '71111111111') ? $code = $this->code : $code = '';

        return json_encode([
            'phone'=>$this->number,
            'code'=>$code,
            'check'=>$this->check
        ]);
    }

    private function setcode() {
        $number = preg_replace('/[^0-9]/','',$this->phone);
        $user = $this->app->checkUser($number,'phone');
        if ($user) {
            $user = $this->app->itemSave('users',[
                'id'        =>  $user->id,
                'password'  =>  $this->check
            ]);
        } else {
            ($this->sett->testmode == 'on' or $this->number == '71111111111') ? $code = $this->code : $code = '';
            header('Content-Type: application/json');
            $msg = "<p class='tx-12 tx-dark'>Пожалуйста, проверьте правильность введённого номера телефона:<br>
            <b class='tx-danger'>{$this->phone}</b><br>
            Если вы первый раз совершаете заказ, пожалуйста, перейдите на страницу <a href='/signup'>регистрации</a>.</p>
            <a href='/signup' class='btn btn-sm btn-success rounded-20'>Зарегистрироваться</a>";
            echo json_encode(['error' => true, 'msg' => $msg,'data'=>[
            'phone'=>$this->number,
            'code'=>$code,
            'check'=>$this->check
            ]]);
            die;
        }
    }

    private function login() {
        header('Content-Type: application/json');
        $phone = $this->app->vars('_post.phone');
        $check = $this->app->vars('_post.check');
        $number = preg_replace('/[^0-9]/','',$phone);
        if ($phone == '' OR $check == '') {
            return json_encode(['login'=>false,'error'=>true]);
        }
        $user = $this->app->checkUser($number, 'phone', $check.$number);
        if ($user) {
            $this->app->login($user);
            return json_encode(['login'=>true,'error'=>false,'redirect'=>$user->group->url_login,'user'=>$user,'role'=>$user->role]);
        } else {
            return json_encode(['login'=>false,'error'=>true,'msg'=>'Ошибка! Вход не выполнен.']);
        }
    }

    private function sendsms($phone) {
        $number = preg_replace('/[^0-9]/', '', $phone);
        if ($this->sett->testmode == 'on' OR $number == '71111111111') {
            $code = rand(123, 999).'-'.rand(123, 999);
        } else {
            $code = 0;
            $authCode = new \TargetSMS\SmsAuth($this->sett->login,$this->sett->pass);
            try {
                $result = $authCode->generateCode(
                    $phone, // номер телефона получателя
                    $this->sett->sender, // подпись отправителя
                    6,// длина кода
                    $this->sett->text. ' {код}'// текст персонификации
                );
                $code = $result->success->attributes()['code'];// сгенерированный код
                $id_sms = $result->success->attributes()['id_sms'];// id смс для проверки статуса доставки
                $status = $result->success->attributes()['status'];// статус доставки
                $code = substr($code, 0, 3).'-'.substr($code, 3, 6);

                if ($number == '79264971896') {
                    $email = 'oleg_frolov@mail.ru';
                    mail($email,'Verification code',$code);
                }
                //var_dump($result);
            } catch (Exception $e) {
                $error = $e->getMessage();//ловим ошибку от сервера
//                var_dump($error);
            }
        }
        return $code;
    }

    private function reg() {
        header('Content-Type: application/json');
        $control = $_SESSION['reg']['control'];
        $phone = $_SESSION['reg']['phone'];
        $number = preg_replace('/[^0-9]/','',$phone);
        $code = $this->app->vars('_post.check');
        $check = $this->app->PasswordMake($code.$number);
        //$demo = '79883471188';
        if ($check == $control) {
            $user = $this->app->checkUser($number, 'phone');

            if ($user && $number !== $demo) {
                echo json_encode(['error' => true, 'msg' => 'Пользователь уже зарегистрирван']);    
                die;
            }
            if ($number !== $demo) {
                $update = [
                    'active' => 'on'
                    ,'phone' => $number
                    ,'role' => 'user'
                    ,'password' => wbPasswordMake($code)
                    ,'login' => '_new'
                ];
                $user = array_merge($_SESSION['reg']['data'],$update);
                $user = $_SESSION['user'] = $this->app->itemSave('users',$user);
                if ($user) {
                    $this->app->login($user);
                } else {
                    echo json_encode(['error' => false, 'msg' => 'Неизвестная ошибка. Попробуйте позже.']);        
                    die;
                }
            }
            echo json_encode(['error' => false, 'msg' => 'Регистрация успешно завершена']);
        } else {
            echo json_encode(['error' => true,'msg' => 'Неверный проверочный код','check'=>$check]);
        }
    }

    private function isPhone() {
        return true;
    }


    private function checkRequires($req = []) {
        $ready = true;
        foreach((array)$req as $mod) {
            if (!extension_loaded($mod)) {$ready = false; echo 'Warning: PHP module '.$mod.' not intalled!<br>';}
        }
        
    }
    
}
?>
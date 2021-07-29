<?php
class ordersClass extends cmsFormsClass {
    function checkout() {
        /* тут нужно 
        1. верифицировать оплату
        2. создать пользователя, если нужно
        3. сформировать запись заказа
        */

        $app = $this->app;
        $order = json_decode($_POST['data'],true);
        $order['id'] = wbNewId('','z');
        $user = $order['user'];
        $order['date']  = $user['date'];
        unset($user['date']);
        if ($user['id'] !== '' && $user['phone'] > '') {
            $phone =  preg_replace('/[^0-9]/','',$user['phone']);
            $filter = ['filter' => [
                'role' => 'user'
                ,'phone' => preg_replace('/[^0-9]/','',$user['phone'])
            ]];
            $list = $app->itemList('users',$filter);
            if ($list['count'] > 0) {
                $user = array_shift($list['list']);
            } else {
                // если нет в системе, то создаём пользователя
            }
        }
        $uid = $user['id'];
        $token = md5($_POST['data'].$uid);
        
        if ($_COOKIE['carttoken'] !== $_POST['token']) {
            echo "Что-то пошло не так.";
            die;
        }

        $days = 1;
        foreach($order['list'] as $item) {
            $item['days'] > $days ? $days = $item['days'] : null;
        }
        $order['delivery'] = [];
        for ($i=1;$i<=$days;$i++) {
            date('Y-m-d',strtotime($order['date'])) > date('Y-m-d') ? $j = $i-1 : $j = $i;
            $idx = date('Y-m-d',strtotime($order['date']. '+' . $j . "days"));
            $order['delivery'][$idx] = ['date'=>$idx,'status'=>''];
        }
        $order['expired'] = $idx;
        $order['user'] = $user['id'];
        $app->itemSave('orders',$order);
        header('Location: /checkout?order='.$order['id']);
        die;
    }

    function rep_cook() {
        $app = &$this->app;
        $dom = $app->fromFile(__DIR__ . '/rep_cook.php');
        $result = [];
        if ($app->vars('_post.formdata.date') > '') {
            $date = date('Y-m-d',strtotime($app->vars('_post.formdata.date')));    
        } else {
            $date = date('Y-m-d',strtotime('now'));
        }
        $list = $app->itemList('orders',['filter'=>[
            'date'=>['$lte'=>$date]
            ,'expired'=>['$gte'=>$date]
        ]]);
        foreach($list['list'] as $order) {
            $this->beforeItemShow($order);
            $delivery = &$order['delivery'][$date];
            $start = date('Y-m-d',strtotime($order['date']));
            if ($delivery['status'] !== 'deny' ) {
                foreach($order['list'] as $line) $result[] = $line;
            }
        }
        $list = $app->json($result)->groupBy('id')->get();
        $result = [];
        foreach($list as $grp) {
            $line = $grp;
            $line = array_pop($line);
            $line['qty'] = $app->json($grp)->sum('qty');
            $result[] = $line;
        }


        $dom->fetch(['date'=>$date,'result'=>$result]);
        echo $dom->outer();
    }

    function rep_orders() {
        $app = &$this->app;
        $dom = $app->fromFile(__DIR__ . '/rep_orders.php');
        $result = [];
        if ($app->vars('_post.formdata.date') > '') {
            $date = date('Y-m-d',strtotime($app->vars('_post.formdata.date')));    
        } else {
            $date = date('Y-m-d',strtotime('now'));
        }
        $list = $app->itemList('orders',['filter'=>[
            'date'=>['$lte'=>$date]
            ,'expired'=>['$gte'=>$date]
        ]]);
        foreach($list['list'] as $order) {
            $this->beforeItemShow($order);
            $delivery = &$order['delivery'][$date];
            $start = date('Y-m-d',strtotime($order['date']));
            if ($delivery['status'] !== 'deny' ) {
                $result[] = $order;
            }
        }
        $dom->fetch(['date'=>$date,'result'=>$result]);
        echo $dom->outer();
    }

    function rep_clients() {
        $app = &$this->app;
        $dom = $app->fromFile(__DIR__ . '/rep_clients.php');
        $result = [];
        if ($app->vars('_post.formdata.date') > '') {
            $date = date('Y-m-d',strtotime($app->vars('_post.formdata.date')));    
        } else {
            $date = date('Y-m-d',strtotime('now'));
        }
        $list = $app->itemList('orders',['filter'=>[
            '$and'=>[
                'expired'=>['$gte'=>$date],
                'date' => ['$lte'=>$date]
            ]
        ]]);

        foreach($list['list'] as $order) {
                $this->beforeItemShow($order);
                $delivery = &$order['delivery'][$date];
                $start = date('Y-m-d', strtotime($order['date']));
                if ($delivery['status'] !== 'deny') {
                    foreach ($order['list'] as $line) {
                        $line['user'] = $order['user'];
                        $line['order'] = $order['id'];
                        $result[] = $line;
                    }
                }
        }
        $list = $app->json($result)->groupBy('user')->get(); // группировка по клиенту
        $result = [];
        foreach($list as $uid => $grp) {
            if (!isset($result[$uid])) {
                $result[$uid] = [
                    'user' => $app->itemRead('users',$uid)
                    ,'list' => []
                ];
            }
            $grp = $app->json($grp)->groupBy('id')->get(); // группировка по товару
            $qty = 0;
            foreach($grp as $g => $gr) {
                $line = array_pop($gr);
                foreach($gr as $gl) {
                    $line['qty'] += $gl['qty']; 
                }
                $result[$uid]['list'][$g] = $line;
               
            }
        }
        $dom->fetch(['date'=>$date,'result'=>$result]);
        echo $dom->outer();
    }

    function afterItemRead(&$item) {
        $item['expired'] >= date('Y-m-d') ? $item['active'] = 'on' : $item['active'] = '';
    }

    function beforeItemShow(&$item) {
        setlocale(LC_ALL, 'ru_RU.utf8');
        foreach ($item['delivery'] as $date => &$d) {
            $time = strtotime($date);
            $d['date'] = $date;
            $d['d'] = strftime('%d', $time);
            $d['m'] = strftime('%b', $time);
            $d['y'] = strftime('%Y', $time);
            $d['n'] = strftime('%a', $time);
            $d['status'] == '' ? $d['status'] = 'empty' : null;
            if ($date <= date('Y-m-d')) $d['status'] = 'past';
        }

    }
}
?>
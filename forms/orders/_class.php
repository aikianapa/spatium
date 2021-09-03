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
        
        if ($_COOKIE['carttoken'] !== $_POST['token']) {
            echo "Что-то пошло не так.";
            die;
        }

        $app->vars('_post.token') == 'courier' ? $order['payed'] = '' : $order['payed'] = 'on';
        $order['user'] = $user['id'];
        $ai = $app->module('autoinc');
        $order['number'] = $ai->inc('orders','number',1245);
        $this->createDelivery($order);
        $app->itemSave('orders',$order);
        //header('Location: /checkout?order='.$order['id']);
        header('Location: /cabinet#orders');
        die;
    }

    private function createDelivery(&$order) {
        $app = &$this->app;
        $list = $app->json($order['list']);
        $days = intval($list->max('days'));
        $oid = $order['id'];
        $user = $app->itemRead('users',$app->vars('_sess.user.id'));
        $deny = (array)$user['deny'];
        for ($i=1;$i<=$days;$i++) {
            date('Y-m-d',strtotime($order['date'])) > date('Y-m-d') ? $j = $i-1 : $j = $i;
            if (in_array(date('Y-m-d',strtotime($order['date'])),$deny)) {
                $days++;
            } else {
                $date = date('Y-m-d', strtotime($order['date']. '+' . $j . "days"));
                foreach ($order['list'] as $prod) {
                    for ($j=1; $j<=$prod['qty'];$j++) {
                        $item = [
                            'id' => $app->newId(),
                            'date' => $date,
                            'order' => $oid,
                            'product' => $prod['id'],
                            'user' => $order['user'],
                            'qty' => 1,
                            'status' => 'empty'
                        ];
                        $app->itemSave('delivery', $item, false);
                    }
                }
            }
        }
        $app->tableFlush('delivery');
        $order['days'] = $days;
        $order['expired'] = $date;
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
            $this->beforeItemShow($order,$date);
            $delivery = &$order['delivery'][$date];
            $start = date('Y-m-d',strtotime($order['date']));
            if ($delivery['status'] !== 'deny' ) {
                foreach($order['list'] as $line) {
                    if ($line['active'] == 'on') $result[] = $line;
                }
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
            $date = date('Y-m-d', strtotime($app->vars('_post.formdata.date')));
        } else {
            $date = date('Y-m-d',strtotime('now'));
        }
        $list = $app->itemList('orders',['filter'=>[
            'date'=>['$lte'=>$date]
            ,'expired'=>['$gte'=>$date]
        ]]);
        foreach($list['list'] as $order) {
            $this->beforeItemShow($order,$date);
            $delivery = &$order['delivery'][$date];
            $start = date('Y-m-d',strtotime($order['date']));
            $delivery['status'] !== 'deny' ? $result[] = $order : null;
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
                $this->beforeItemShow($order,$date);
                $delist = $order['delivery'];
                $delivery = $delist[$date];
                //$start = date('Y-m-d', strtotime($order['date']));
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
                if ($line['active'] == 'on') {
                    foreach ($gr as $gl) {
                        $line['qty'] += $gl['qty'];
                    }
                    $result[$uid]['list'][$g] = $line;
                }
            }
        }
        $dom->fetch(['date'=>$date,'result'=>$result]);
        echo $dom->outer();
    }


    function set_status() {
        $app = &$this->app;
        header('Content-Type: application/json');
        $order = $app->itemRead('orders',$app->vars('_post.oid'));
        if ($order && isset($order['delivery'][$app->vars('_post.date')])) {
            $order['delivery'][$app->vars('_post.date')]['status'] = $app->vars('_post.type');
            $res = $app->itemSave('orders',$order);
            echo json_encode(['error'=>false,'order'=>$res]);
        } else {
            echo json_encode(['error'=>true]);
        }
        die;
    }

    function get_date_dlvrs() {
        header('Content-Type: application/json');
        $app = &$this->app;
        $date = date('Y-m-d',strtotime($app->vars('_post.date')));
        if (!$app->checkToken()) {
            echo json_encode(null);
            die;
        } else {

        $result = [];

        $list = $app->itemList('orders',['filter'=>[
            'date'=>['$lte'=>$date]
            ,'expired'=>['$gte'=>$date]
            ,'_creator'=>$app->vars('_sess.user.id')
        ]]);

        foreach($list['list'] as $order) {
            $this->beforeItemShow($order,$date);
            $delivery = &$order['delivery'][$date];
            $start = date('Y-m-d',strtotime($order['date']));
            $result[] = $order;
        }
        $res = ['date'=>$date,'result'=>$result];
        
            $res['freedate'] = null;
            if (count($res['result'])) {
                foreach($res['result'] as &$line) {
                    $line['expired'] > $res['freedate'] ? $res['freedate'] = $line['expired'] : null;
                    $line['date'] = date('d.m.Y',strtotime($line['date']));
                    $line['expired'] = date('d.m.Y',strtotime($line['expired']));
                }
                $res['freedate'] = date('d.m.Y',strtotime($res['freedate'] . ' +1day'));
            }
            echo json_encode($res);
        }
    }

    function afterItemRead(&$item) {
        $item['expired'] >= date('Y-m-d') ? $item['active'] = 'on' : $item['active'] = '';
        $user = $this->app->itemRead('users',$item['_creator']);
        $item['name'] = $user['first_name'] . ' ' . $user['last_name'];
        $item['phone'] = wbPhoneFormat($user['phone']);
        $item['address'] = $user['delivery_address'];
    }

    function beforeItemEdit(&$item)
    {
        $this->beforeItemShow($item);
    }

    function beforeItemShow(&$item, $date_report = null) {
        $date_report == null ? $date_report = date('Y-m-d') : null;
        setlocale(LC_ALL, 'ru_RU.utf8');
        isset($item['number']) ? null : $item['number'] = $item['id'];
        foreach ($item['delivery'] as $date => $d) {
            $time = strtotime($date);
            $d['date'] = $date;
            $d['d'] = strftime('%d', $time);
            $d['m'] = strftime('%b', $time);
            $d['y'] = strftime('%Y', $time);
            $d['n'] = strftime('%a', $time);
            $d['status'] == '' ? $d['status'] = 'empty' : null;
            $d['status'] == 'deny' ? $d['deny'] = 'deny' : $d['deny'] = '';
            if ($this->app->vars('_sess.user.role') > '' && $this->app->vars('_sess.user.role')!== 'user')  {
                if ($date < date('Y-m-d')) $d['status'] = 'past';
            } else {
                if ($date <= date('Y-m-d')) $d['status'] = 'past';
            }
            
            $item['delivery'][$date] = $d;
        }
        foreach($item['list'] as &$line) {
            if (!isset($line['dlvrs'])) {
                $count = 0;
                foreach ($item['delivery'] as $date => $d) {
                    if ($date_report >= $date && $d['deny'] !== 'deny') {
                        $count++;
                    }
                }
                $line['dlvrs'] = $count;
                $count > $line['days'] ? $line['active'] = '' : $line['active'] = 'on';
            }
        }
        return $item;
    }
}
?>
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
        header('Location: /cabinet#orders?cartclear');
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
        $dlvrs = $app->itemList('delivery',['filter'=>['date'=>$date]]);
        $dlvrs = $app->json($dlvrs['list'])->groupBy('product')->get();
        $result = [];
        foreach($dlvrs as $pid => $product) {
            $qty = count($product);
            $product = $app->itemRead('products',$pid);
            $product['qty'] = $qty;
            $result[] = $product;
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
        $dlvrs = $app->itemList('delivery',['filter'=>['date'=>$date]]);
        $dlvrs = $app->json($dlvrs['list'])->groupBy('order')->get();
        foreach($dlvrs as $oid => $delivery) {
            if (!isset($result[$oid])) {
                $order = $app->itemRead('orders',$oid);
                $order['list'] = [];
                $result[$oid] = $order;
            }
            $list = $app->json($delivery)->groupBy('product')->get();
            foreach($list as $pid => $product) {
                $qty = count($product);
                $product = $app->itemRead('products',$pid);
                $product['qty'] = $qty;
                $result[$order['id']]['list'][] = $product;
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

        $dlvrs = $app->itemList('delivery',['filter'=>['date'=>$date]]);
        $dlvrs = $app->json($dlvrs['list'])->groupBy('user')->get();

        $result = [];
        foreach($dlvrs as $uid => $grp) {
            if (!isset($result[$uid])) {
                $result[$uid] = [
                    'user' => $app->itemRead('users',$uid)
                    ,'list' => []
                ];
            }
            $list = $app->json($grp)->groupBy('product')->get();
            foreach($list as $pid => $product) {
                $qty = count($product);
                $product = $app->itemRead('products',$pid);
                $product['qty'] = $qty;
                $result[$uid]['list'][] = $product;
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
        if ($app->checkToken()) {
            echo json_encode(null);
            die;
        } else {
            $result = [];

            $list = $app->itemList('delivery', ['filter'=>[
            'date'=>['$gte'=>$date]
            ,'user'=>$app->vars('_sess.user.id')
        ],'sort'=>'date']);
            $orders = $app->json($list['list'])->sort('date')->groupBy('order')->get();
            $freedate = '';
            foreach ($orders as $oid => $item) {
                $max = $app->json($item)->max('date');
                $min = $app->json($item)->min('date');
                $max > $freedate ? $freedate = $max : null;
                $order = $app->itemRead('orders', $oid);
                $order['expired'] = date('d.m.Y',strtotime($max));
                $order['date'] = date('d.m.Y',strtotime($date));
                $result[] = $order;
            }
            $freedate = date('d.m.Y',strtotime($freedate.' +1 day'));
            $res = ['date'=>$date,'freedate'=>$freedate,'result'=>$result];
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
        /*
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
        */
        return $item;
    }
}
?>
<?php
/* 
Статусы заказа

1. Нулевой (null) - статус для только что поступивших заказов. Они нигде не отображаются, кроме как в кабинете менеджера.
2. Активный (active) - менеджер подтверждает актуальность заказа.
3. Оплачен (payed) - если заказ уже оплачен, то статус сразу меняется с Активного на Оплачен
4. Отменён (cancel) - заказ отменяется, если менеджер не смог связаться с клиентом или если клиент сам отказался
5. Ожидание (wait) - не смогли связаться с клиентом
6. Завершен - (done)  успешно
7. Завершен - (fail) неуспешно
*/

class ordersClass extends cmsFormsClass
{
    public function checkout()
    {
        header('Content-Type: application/json');

        /* тут нужно
        1. верифицировать оплату
        2. создать пользователя, если нужно
        3. сформировать запись заказа
        */
        $app = $this->app;
        $order = json_decode($_POST['data'], true);
        @$sum = intval($order['total']['sum']);
        if ($sum == 0) {
            echo json_encode(['error'=>true,'msg'=>'Что-то пошло не так.']);
            die;
        }
        $ai = $app->module('autoinc');
        $order['number'] = $ai->inc('orders', 'number', 1500);
        $order['id'] = 'z'.$order['number'];
        $user = $order['user'];
        $order['date']  = $user['date'];
        unset($user['date']);
        if ($user['id'] !== '' && $user['phone'] > '') {
            $phone =  preg_replace('/[^0-9]/', '', $user['phone']);
            $filter = ['filter' => [
                'role' => 'user'
                ,'phone' => preg_replace('/[^0-9]/', '', $user['phone'])
            ]];
            $list = $app->itemList('users', $filter);
            if ($list['count'] > 0) {
                $user = array_shift($list['list']);
            } else {
                // если нет в системе, то создаём пользователя
            }
        }
        $uid = $user['id'];
/*
        if ($app->vars('_post.token') !== 'courier' && $_COOKIE['carttoken'] !== $app->vars('_post.token')) {
            echo json_encode(['error'=>true,'msg'=>'Что-то пошло не так.']);
            die;
        }
*/

        // ======= Проверка промо-заказов и цен
        $products = $app->itemList('products', ['active'=>'on']);
        $products = $products['list'];
        isset($user['promo']) && is_array($user['promo']) ? null : $user['promo'] = [];
        $promo = (array)$user['promo'];
        foreach ($order['list'] as $prod) {
            $prod = (object)$prod;
            $product = (object)$products[$prod->id];
            $flag = isset($prod->promo) && intval($prod->promo) == 1 ? true : false;
            $flag && !in_array($prod->id, $promo) ? $promo[] = $prod->id : null;
            // здесь сверка проверка цены в заказе и цены в товаре
            /*
            if (($flag && intval($prod->price) !== intval($product->promoprice)) OR (!$flag && intval($prod->price) !== intval($product->price)))
            {
                echo json_encode(['error'=>true,'msg'=>'Что-то пошло не так.','note'=>'Invalid price']);
                die;
            }
            */
        }

        if ($user['promo'] !== $promo) {
            $user['promo'] = $promo;
            $app->itemSave('users', $user, true);
            $_SESSION['user'] = $user;
        }
        // =======
        $app->vars('_post.token') == 'courier' ? $order['payed'] = '' : $order['payed'] = 'on';
        $order['user'] = $user['id'];
        //$order['number'] = $_POST['number'];
        $this->createDelivery($order);
        if ($app->itemSave('orders', $order)) {
            wbAuthGetContents($app->route->host.'/module/phonecheck/orderAlert/'.$order['number']);
        }
        if ($app->vars('_post.token') !== 'courier') {
            $cloudpay = $app->module('cloudpaywidget');
            $cloudpay->kassa($order, $user);
        }
        session_write_close();
        echo json_encode(['error'=>false,'msg'=>'Оплата завершена','url'=>'/cabinet?cartclear#orders']);
        die;
    }

    public function checkToken()
    {
        if ($this->app->vars('_route.action') == 'checkout') {
            return true;
        }
        return $this->app->checkToken();
    }

    private function createDelivery(&$order)
    {
        $app = &$this->app;
        $list = $app->json($order['list']);
        $days = intval($list->max('days'));
        $oid = $order['id'];
        $user = $app->itemRead('users', $app->vars('_sess.user.id'));
        $deny = (array)$user['deny'];

        for ($i=1;$i<=$days;$i++) {
            date('Y-m-d', strtotime($order['date'])) > date('Y-m-d') ? $j = $i-1 : $j = $i;
            $date = date('Y-m-d', strtotime($order['date']. '+' . $j . "days"));
            if (in_array($date, $deny)) {
                $days++;
            } else {
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
            if ($days>1000) {
				echo "Кажется, мы зациклились!\n";
				echo basename(__FILE__, '.php'); 
				die;
			}

        }
        $app->tableFlush('delivery');
        $order['days'] = $days;
        $order['expired'] = $date;
    }

    public function rep_cook()
    {
        $app = &$this->app;
        $dom = $app->fromFile(__DIR__ . '/rep_cook.php');
        $result = [];
        $dlvrs = $this->repDeliveryActiveList();
        $date = $dlvrs['date'];
        $dlvrs = $app->json($dlvrs['list'])->groupBy('product')->get();
        $result = [];
        foreach ($dlvrs as $pid => $product) {
            $qty = count($product);
                $product = $app->itemRead('products', $pid);
                $product['qty'] = $qty;
                $result[] = $product;
        }
        $dom->fetch(['date'=>$date,'result'=>$result]);
        echo $dom->outer();
    }

    public function rep_orders()
    {
        $app = &$this->app;
        $dom = $app->fromFile(__DIR__ . '/rep_orders.php');
        $result = [];
        $dlvrs = $this->repDeliveryActiveList();
        $date = $dlvrs['date'];
        $dlvrs = $app->json($dlvrs['list'])->groupBy('order')->get();
        $status = [];
        foreach ($dlvrs as $oid => $delivery) {
            if (!isset($result[$oid])) {
                $order = $app->itemRead('orders', $oid);
                $order['list'] = [];
                $status[$oid] = $order['active'];
                if ($status[$oid] == 'active') $result[$oid] = $order;
            }

            if ($status[$oid] == 'active') {
                $list = $app->json($delivery)->groupBy('product')->get();
                foreach ($list as $pid => $product) {
                    $qty = count($product);
                    $product = $app->itemRead('products', $pid);
                    $product['qty'] = $qty;
                    $result[$order['id']]['list'][] = $product;
                }
            }
        }
        $dom->fetch(['date'=>$date,'result'=>$result]);
        echo $dom->outer();
    }

    public function rep_clients()
    {
        $app = &$this->app;
        $dom = $app->fromFile(__DIR__ . '/rep_clients.php');
        $result = [];
        $dlvrs = $this->repDeliveryActiveList();
        $date = $dlvrs['date'];
        $dlvrs = $app->json($dlvrs['list'])->groupBy('user')->get();
        $result = [];
        foreach ($dlvrs as $uid => $grp) {
            if (!isset($result[$uid])) {
                $result[$uid] = [
                    'user' => $app->itemRead('users', $uid)
                    ,'list' => []
                ];
            }
            $list = $app->json($grp)->groupBy('product')->get();
            foreach ($list as $pid => $product) {
                $qty = count($product);
                $product = $app->itemRead('products', $pid);
                $product['qty'] = $qty;
                $result[$uid]['list'][] = $product;
            }
        }
        $dom->fetch(['date'=>$date,'result'=>$result]);
        echo $dom->outer();
    }

    function repDeliveryActiveList($date = null) {
        $app = $this->app;
        if ($date == null) {
            if ($app->vars('_post.formdata.date') > '') {
                $date = date('Y-m-d', strtotime($app->vars('_post.formdata.date')));
            } else {
                $date = date('Y-m-d', strtotime('now'));
            }
        }
        $dlvrs = $app->itemList('delivery', ['filter'=>['date'=>$date]]);
        $status = [];
        foreach ($dlvrs['list'] as $k => $dlvr) {
            $oid = $dlvr['order'];
            if (!isset($status[$oid])) {
                $order = $app->itemRead('orders', $oid);
                $status[$oid] = $order['active'];
            }
            if ($status[$oid] !== 'active') {
                unset($dlvrs['list'][$k]);
            }
        }
        $dlvrs['date'] = $date;
        return $dlvrs;
    }

    public function set_status()
    {
        $app = &$this->app;
        header('Content-Type: application/json');
        $order = $app->itemRead('orders', $app->vars('_post.oid'));
        if ($order && isset($order['delivery'][$app->vars('_post.date')])) {
            $order['delivery'][$app->vars('_post.date')]['status'] = $app->vars('_post.type');
            $res = $app->itemSave('orders', $order);
            echo json_encode(['error'=>false,'order'=>$res]);
        } else {
            echo json_encode(['error'=>true]);
        }
        die;
    }

    public function get_date_dlvrs()
    {
        header('Content-Type: application/json');
        $app = &$this->app;
        $date = date('Y-m-d', strtotime($app->vars('_post.date')));
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
                $order['expired'] = date('d.m.Y', strtotime($max));
                $order['date'] = date('d.m.Y', strtotime($date));
                $result[] = $order;
            }
            $freedate = date('d.m.Y', strtotime($freedate.' +1 day'));
            $res = ['date'=>$date,'freedate'=>$freedate,'result'=>$result];
            echo json_encode($res);
        }
    }

    public function afterItemRead(&$item)
    {
        $item['active'] == 'on' ? $item['active'] = 'active' : null;
        $item['active'] == '' ? $item['active'] = 'null' : null;

//        $item['expired'] >= date('Y-m-d') && $item['active'] == 'active' ? null : $item['active'] = 'wait';

        $item['expired'] < date('Y-m-d')  && in_array($item['active'],['active']) ? $item['active'] = 'done' : null;
        $user = $this->app->itemRead('users', $item['_creator']);
        $item['name'] = $user['first_name'] . ' ' . $user['last_name'];
        $item['phone'] = wbPhoneFormat($user['phone']);
        $item['address'] = $user['delivery_address'];
    }

    public function beforeItemEdit(&$item)
    {
        $this->beforeItemShow($item);
    }

    public function afterItemRemove(&$item) {
        if (!isset($item['id'])) return $item;
        $app = &$this->app;
        $list = $app->ItemList("delivery", ['filter'=>['order'=>$item['id']]]);
        foreach($list['list'] as $key => $item) {
            $app->itemRemove('delivery', $item['id'], false);
        }
        $app->tableFlush('delivery');
    }

    public function beforeItemShow(&$item, $date_report = null)
    {
        $date_report == null ? $date_report = date('Y-m-d') : null;
        setlocale(LC_ALL, 'ru_RU.utf8');
        isset($item['number']) ? null : $item['number'] = $item['id'];
        $item['number'] = wbDigitsOnly($item['number']);
        return $item;
    }
}

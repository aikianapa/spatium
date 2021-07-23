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
        $days = 1;
        foreach($order['list'] as $item) {
            $item['days'] > $days ? $days = $item['days'] : null;
        }
        $order['delivery'] = [];
        for ($i=1;$i<=$days;$i++) {
            $idx = date('Y-m-d',strtotime($i . "days"));
            $order['delivery'][$idx] = ['date'=>$idx,'status'=>''];
        }
        $order['expired'] = $idx;
        $order['user'] = $user['id'];
        $app->itemSave('orders',$order);
        header('Location: /checkout?order='.$order['id']);
        die;
    }

    function deliveryChange() {
        header('Content-Type: application/json');
        $app = &$this->app;
        if (!$app->checkToken($app->vars('_post.__token'))) echo '{"error":true}';
        $oid = $app->vars('_post.order');
        $date = $app->vars('_post.date');
        $order = $app->itemRead('orders',$oid);
        $delivery = &$order['delivery'];
        switch ($app->vars('_post.type')) {
            case 'empty':
                $delivery[$date]['status'] = 'deny';
                $lastdate = array_pop(array_keys($delivery));
                $newdate = date('Y-m-d',strtotime($lastdate." +1day"));
                $delivery[$newdate] = ['date'=>$newdate,'status'=>'empty'];
                break;
            case 'deny':
                $delivery[$date]['status'] = 'empty';
                array_pop($delivery);
                while($delivery[array_pop(array_keys($delivery))]['status'] == 'deny' && count($delivery) > $order['days']) {
                    array_pop($delivery);
                }
                break;
        }
        $order['expired'] = array_pop(array_keys($delivery));
        $app->itemSave('orders',$order);
        $this->beforeItemShow($order);
        $result = ["error"=>false,"delivery"=>$order['delivery'],'days'=>$order['days']];
        echo json_encode($result);
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
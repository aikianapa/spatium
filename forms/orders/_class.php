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

    function afterItemRead(&$item) {
        $item['expired'] >= date('Y-m-d') ? $item['active'] = 'on' : $item['active'] = '';
    }
}
?>
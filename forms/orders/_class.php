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
            $created = date('Y-m-d',strtotime($order['_created']));
            if ($created < $date && $delivery['status'] !== 'deny' ) {
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

    function afterItemRead(&$item) {
        $item['expired'] >= date('Y-m-d') ? $item['active'] = 'on' : $item['active'] = '';
        $item['date'] = date('Y-m-d',strtotime($item['_created']));
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
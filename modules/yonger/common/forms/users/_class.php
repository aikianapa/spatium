<?php
use Nahid\JsonQ\Jsonq;

class usersClass extends cmsFormsClass {

    function delivery_list() {
        // формируем список доставок текущего пользователя
        $app = &$this->app;
        header('Content-Type: application/json');
        if (!$app->checkToken($app->vars('_post.__token'))) {
            echo '{"error":true}';
            die;
        }
        $orders = $app->itemList('orders',['filter'=>[
            '_creator' => $app->vars('_sess.user.id'),
            'expired' => ['$gte'=>date('Y-m-d')],
            'date' => ['$gte'=>date('Y-m-d')]
        ]]);
        $dlvrs = [];
        foreach($orders['list'] as $order) {
            foreach($order['delivery'] as $date => &$d) {
                $d['date'] = $date;
                if ($date >= date('Y-m-d')) {
                    !isset($dlvrs[$date]['orders']) ?  $dlvrs[$date]['orders'] = [] : null;
                    !isset($dlvrs[$date]['products']) ?  $dlvrs[$date]['products'] = [] : null;
                    $this->delivery_prep($d);
                    $dlvrs[$date] = array_merge($dlvrs[$date],$d);
                    if (in_array($d['status'],['past','empty'])) {
                        isset($dlvrs[$date]) ? $dlvrs[$date]['orders'][] = $order['id']  : null;
                        foreach($order['list'] as $p) {
                            $dlvrs[$date]['products'][] = $p;
                        }
                    }
                }
            }
        }
        $dlvrs = $app->arraySort($dlvrs, "date");
        echo json_encode($dlvrs);
    }

    function delivery_decline() {
        // отмена доставки в указаный день
        header('Content-Type: application/json');
        $app = &$this->app;
        if (!$app->checkToken($app->vars('_post.__token'))) echo '{"error":true}';
        $orders = $app->itemList('orders',['filter'=>[
            '_creator' => $app->vars('_sess.user.id'),
            'expired' => ['$gte'=>date('Y-m-d')],
            'date' => ['$gte'=>date('Y-m-d')]
        ]]);
        foreach($orders['list'] as $order) {
            $this->delivery_order_decline($order['id'], $app->vars('_post.date'));
        }
        $app->tableFlush('orders');
        echo $this->delivery_list();
    }

    function delivery_order_decline($oid = null, $date = null) {
        if ($oid == null) return;
        $app = &$this->app;
        $order = $app->itemRead('orders',$oid);
        $delivery = &$order['delivery'];
        if (!isset($delivery[$date])) return;
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
        $app->itemSave('orders',$order,false);
    }

    function delivery_prep(&$d) {
        setlocale(LC_ALL, 'ru_RU.utf8');
            $time = strtotime($d['date']);
            $d['d'] = strftime('%d', $time);
            $d['m'] = strftime('%b', $time);
            $d['y'] = strftime('%Y', $time);
            $d['n'] = strftime('%a', $time);
            $d['status'] == '' ? $d['status'] = 'empty' : null;
            if ($d['date'] <= date('Y-m-d')) $d['status'] = 'past';
    }

}
?>

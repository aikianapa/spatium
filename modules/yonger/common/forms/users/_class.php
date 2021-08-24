<?php
use Nahid\JsonQ\Jsonq;

class usersClass extends cmsFormsClass
{
    public function delivery_list()
    {
        // формируем список доставок текущего пользователя
        $app = &$this->app;
        header('Content-Type: application/json');
        in_array($app->vars('_sess.user.role'),['admin','manager']) ? $uid = $app->vars('_post.uid') : $uid = $app->vars('_sess.user.id');

        $filter = [
            '_creator' => $uid,
            'expired' => ['$gte'=>date('Y-m-d')]
        ];
        
        //$app->vars('_sess.user.role') == 'user' ? $filter['date'] = ['$gte'=>date('Y-m-d')] : null;


        $orders = $app->itemList('orders', ['filter'=>$filter]);
        $dlvrs = [];
        foreach ($orders['list'] as $order) {
            $count = 0;
            foreach ($order['delivery'] as $date => $d) {
                $date = date('Y-m-d',strtotime($date));
                $d['date'] = $date;
                if ($app->vars('_sess.user.role') !== 'user' OR 
                    ($app->vars('_sess.user.role') == 'user' && strtotime($date) >= strtotime(date('Y-m-d')))
                    ) {
                    !isset($dlvrs[$date]['orders']) ?  $dlvrs[$date]['orders'] = [] : null;
                    !isset($dlvrs[$date]['products']) ?  $dlvrs[$date]['products'] = [] : null;
                    $this->delivery_prep($d);
                    $dlvrs[$date] = array_merge($dlvrs[$date], $d);
                    if (in_array($d['status'], ['past','empty'])) {
                        $count++;
                        isset($dlvrs[$date]) ? $dlvrs[$date]['orders'][] = $order  : null;
                        foreach ($order['list'] as $p) {
                            if ($count <= $p['days']) {
                                $p['active'] = 'on';
                            }
                            if (isset($dlvrs[$date]['products'][$p['id']])) {
                                $p['qty'] += $dlvrs[$date]['products'][$p['id']]['qty']*1;
                            }
                            $dlvrs[$date]['products'][$p['id']] = $p;
                        }
                    }
                }
            }
        }
        $dlvrs = $app->arraySort($dlvrs, "date");
        echo json_encode($dlvrs);
    }

    public function delivery_decline()
    {
        // отмена доставки в указаный день
        header('Content-Type: application/json');
        $app = &$this->app;
            in_array($app->vars('_sess.user.role'),['admin','manager']) ? $uid = $app->vars('_post.uid') : $uid = $app->vars('_sess.user.id');
            $orders = $app->itemList('orders', ['filter'=>[
            '_creator' => $uid,
            'expired' => ['$gte'=>date('Y-m-d')]
            ]]);
            foreach ($orders['list'] as $order) {
                $this->delivery_order_decline($order['id'], $app->vars('_post.date'));
            }
            $app->tableFlush('orders');
            echo $this->delivery_list();

    }

    public function delivery_order_decline($oid = null, $date = null)
    {
        if ($oid == null) {
            return;
        }
        $app = &$this->app;
        $order = $app->itemRead('orders', $oid);
        $delivery = $order['delivery'];
        if (!isset($delivery[$date])) {
            return;
        }
        switch ($app->vars('_post.type')) {
            case 'empty':
                $delivery[$date]['status'] = 'deny';
                $lastdate = array_pop(array_keys($delivery));
                $newdate = date('Y-m-d', strtotime($lastdate." +1day"));
                $delivery[$newdate] = ['date'=>$newdate,'status'=>'empty'];
                break;
            case 'deny':
                $delivery[$date]['status'] = 'empty';
                array_pop($delivery);
                while ($delivery[array_pop(array_keys($delivery))]['status'] == 'deny' && count($delivery) > $order['days']) {
                    array_pop($delivery);
                }
                break;
        }

                // если вдруг в результате ошибки количество доставок меньше, чем дней

                $nodeny =  $app->json($delivery)->where('status','!=','deny')->count();
                
                for($i=$nodeny;$i<=$order['days'];$i++) {
                    $newdate = date('Y-m-d', strtotime($newdate." +1day"));
                    $delivery[$newdate] = ['date'=>$newdate,'status'=>'empty'];
                }
        $order['expired'] = array_pop(array_keys($delivery));
        $order['delivery'] = $delivery;
        $app->itemSave('orders', $order, true);
    }

    public function delivery_prep(&$d)
    {
        setlocale(LC_ALL, 'ru_RU.utf8');
        $time = strtotime($d['date']);
        $d['d'] = strftime('%d', $time);
        $d['m'] = strftime('%b', $time);
        $d['y'] = strftime('%Y', $time);
        $d['n'] = strftime('%a', $time);
        $d['status'] == '' ? $d['status'] = 'empty' : null;
        $d['status'] == 'deny' ? $d['deny'] = 'deny' : $d['deny'] = '';
        if ($d['date'] <= date('Y-m-d')) {
            $d['status'] = 'past';
        }
    }

    public function profile()
    {
        $out = $this->app->getForm('users', 'profile');
        $out->find('[name=phone]')->attr('disabled', true);
        $out->fetch();
        $out->find('[name=phone]')->removeAttr('name');
        echo $out;
    }

    public function beforeItemShow(&$item)
    {
        $item['phone'] = $this->app->phoneFormat($item['phone']);
    }

    public function afterItemRead(&$item)
    {
        isset($item['phone']) ? null : $item['phone'] = '';
        $item['phone'] = preg_replace('/[^0-9]/', '', $item['phone']);
        return $item;
    }
}

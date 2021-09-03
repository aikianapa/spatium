<?php
use Nahid\JsonQ\Jsonq;

class usersClass extends cmsFormsClass
{
    public function delivery_list($deny = null)
    {
        // формируем список доставок текущего пользователя
        $app = &$this->app;
        header('Content-Type: application/json');
        in_array($app->vars('_sess.user.role'),['admin','manager']) ? $uid = $app->vars('_post.uid') : $uid = $app->vars('_sess.user.id');
        if ($deny === null) {
            $user = $app->itemRead('users',$uid);
            $deny = (array)$user['deny'];
        }
        $filter = [
            'date' => ['$gte'=>date('Y-m-d')],
            'user' => $uid
        ];

        $dlvrs = $app->itemList('delivery', ['filter'=>$filter,'group'=>'date','sort'=>'date']);
        $dlvrs = $app->json($dlvrs['list'])->groupBy('date')->get();
        $maxdate = array_pop(array_keys($dlvrs));
        $days = abs(strtotime(date('Y-m-d'))-strtotime($maxdate)) / 86400;

        $list = [];
        for($d=1; $d<=$days; $d++) {
            $did = 'd'.date('Ymd',strtotime('now +'.$d.' days'));
            $list[$did] = [
                'date' => date('Y-m-d',strtotime('now +'.$d.' days')),
                'products' => [],
                'orders' => [],
                'status' => ''
            ];
            $this->delivery_prep($list[$did],$deny);
        }
        
        $pClass = $app->formClass('products');
        foreach($dlvrs as $date => $day) {
            $did = 'd'.date('Ymd',strtotime($date));
            $list[$did]['date'] = $date;
            $list[$did]['products'] = $app->json($day)->groupBy('date')->get();
            $list[$did]['orders'] = $app->json($day)->groupBy('order')->get();
            $prds = [];
            foreach($list[$did]['products'] as $k => &$dp) {
                foreach($dp as $p) {
                    $p = array_merge($app->itemRead('products',$p['product']),$p);
                    $pClass->beforeItemShow($p);
                    if (isset($prds[$p['product']])) {
                        $prds[$p['product']]['qty'] += $p['qty'];
                    } else {
                        $prds[$p['product']] = $p;
                    }
                    isset($prds[$p['product']]['orders']) ? null : $prds[$p['product']]['orders'] = [];
                    $prds[$p['product']]['orders'][$p['order']] = $p['qty'];
                }
            }
            $list[$did]['products'] = $prds;
            foreach($list[$did]['orders'] as $k => &$o) {
                $o = $app->itemRead('orders',$k);
            }
            $this->delivery_prep($list[$did],$deny);
        }
        echo json_encode($list);
    }

    public function delivery_change() {
        $app = &$this->app;
        $item = $app->itemRead('delivery',$this->app->vars('_post.prod'));
        $item['date'] = $this->app->vars('_post.to');
        $app->itemSave('delivery',$item);
        $this->delivery_list();
    }

    public function delivery_decline()
    {
        // отмена доставки в указаный день
        header('Content-Type: application/json');
        $app = &$this->app;
        in_array($app->vars('_sess.user.role'),['admin','manager']) ? $uid = $app->vars('_post.uid') : $uid = $app->vars('_sess.user.id');
        $type = $app->vars('_post.type');
        $user = $app->itemRead('users',$uid);
        $deny = (array)$user['deny'];
        if ($type == 'empty') array_push($deny,$app->vars('_post.date'));
        if ($type == 'deny') unset($deny[array_search($app->vars('_post.date'),$deny)]);
        $deny = array_values($deny);
        $filter = [
            'date' => ['$gte'=>$app->vars('_post.date')],
            'user' => $uid
        ];
        $dlvrs = $app->itemList('delivery', ['filter'=>$filter,'group'=>'date','sort'=>'date:d']);
        foreach($dlvrs['list'] as $id => &$item) {
            $i=0;
            if ($type == 'empty') {
                $date = date('Y-m-d', strtotime($item['date'].' +1 day'));
                while (in_array($date, $deny)) {
                    $date = date('Y-m-d', strtotime($date.' +1 day'));
                    $i++; if ($i>9999) {echo "Ошибка !!!";die;}
                }
            } else if ($type == 'deny') {
                $date = date('Y-m-d',strtotime($item['date'].' -1 day'));
                while (in_array($date, $deny)) {
                    $date = date('Y-m-d',strtotime($date.' -1 day'));
                    $i++; if ($i>9999) {echo "Ошибка !!!";die;}
                }
            }
            $item['date'] = $date;
            $app->itemSave('delivery', $item, false);
        }
        $user['deny'] = $deny;
        $app->itemSave('users',$user);
        $app->tableFlush('delivery');
        $this->delivery_list($deny);
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

    public function delivery_prep(&$d,$deny)
    {
        setlocale(LC_ALL, 'ru_RU.utf8');
        $time = strtotime($d['date']);
        $d['d'] = strftime('%d', $time);
        $d['m'] = strftime('%b', $time);
        $d['y'] = strftime('%Y', $time);
        $d['n'] = strftime('%a', $time);

        in_array($d['date'],(array)$deny) ? $d['status'] = 'deny' : null;
        $d['status'] == '' ? $d['status'] = 'empty' : null;
        $d['status'] == 'deny' ? $d['deny'] = 'deny' : $d['deny'] = '';
        $d['date'] <= date('Y-m-d') ? $d['status'] = 'past' : null;
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

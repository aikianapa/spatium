<?php
class deliveryClass extends cmsFormsClass {
    function list() {
        $app = &$this->app;
        $dom = $app->fromFile(__DIR__ . '/list.php');
        $uid = $app->vars('_post.formdata.uid');
        $date = date('Y-m-d');
        $filter = ['date'=>['$gte'=>$date]];
        $dlvrs = $app->itemList('delivery',['filter'=>$filter]);
        $usrs = $app->json($dlvrs['list'])->groupBy('user')->get();
        $result = [];
        $users = [];
        foreach($usrs as $uid => $item) {
            $users[] = $app->itemRead('users',$uid);
        }
        if ($uid > '') {
            $dlvrs = $app->json($dlvrs['list'])->where('user','=',$uid)->groupBy('product')->get();
            foreach($dlvrs as $pid => $product) {
                $qty = count($product);
                $product = $app->itemRead('products',$pid);
                $product['qty'] = $qty;
                $result[] = $product;
            }
        }
        $dom->fetch(['users'=>$users]);
        echo $dom->outer();
    }


}
?>
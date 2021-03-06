<?php

class modCloudpaywidget
{
    public function __construct($obj)
    {
        if (get_class($obj) == 'wbDom') {
            $this->dom = &$obj;
            $this->app = &$obj->app;
            $this->init();
        } else {
            $this->app = &$obj;
        }
    }

    public function init() {
        $app = &$this->app;
        $obj = &$this->dom;
        $out = $app->fromFile(__DIR__.'/cloudpaywidget_ui.php');
        $data = $app->vars('_sett.modules.cloudpaywidget');

        $out->fetch($data);
        $obj->after($out);
        $obj->remove();
    }

    public function kassa($order, $user)
    {
        $app = &$this->app;
        $set = $app->vars('_sett.modules.cloudpaywidget');
        if ($set['kassa'] !== 'on') return false;
        $items = [];
        foreach($order['list'] as $item) {
            $items[] = [
                'label' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['qty'] * $item['days'],
                'amount' => $item['sum'],
                'vat' => null
            ];
        }
        isset($user['email']) ? $email = $user['email'] : $email = '';
        $phone = $user['phone'];
        $orderId = $app->digitsOnly($order['number']);
//        $url = 'https://api.cloudpayments.ru/test';
        $url = 'https://api.cloudpayments.ru/kkt/receipt';
        $post = [
            'Inn' => $set['inn'],
            'Type' => 'Income',
            'CustomerReceipt' => [
                'Items'  => $items,
                'TaxationSystem' => $set['taxation'],
                'Amounts' => ['electronic' => $order['total']['sum']],
                'Phone' => $phone,
            ],
            'InvoiceId' => $orderId,
            'AccountId' => $set['acc_id']
        ];

        $res = $app->authPostContents($url, $post, $set['api_key'], $set['prv_key']);
        error_log(date('Y-m-d H:i:s').': '.json_encode($res)."\n", 3, __DIR__.'/kassa.log');
    }

}
?>
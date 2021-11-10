<?php

class modCloudpaywidget
{
    public function __construct($obj)
    {
        $app = &$obj->app;
        $ai = $app->module('autoinc');

        $out = $app->fromFile(__DIR__.'/cloudpaywidget_ui.php');
        $data = $app->vars('_sett.modules.cloudpaywidget');
        $data['number'] = $ai->inc('orders','number',1245);
        $out->fetch($data);
        $obj->after($out);
        $obj->remove();
    }
}
?>
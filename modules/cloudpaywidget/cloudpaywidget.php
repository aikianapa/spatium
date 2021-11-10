<?php

class modCloudpaywidget
{
    public function __construct($obj)
    {
        $app = &$obj->app;
        $out = $app->fromFile(__DIR__.'/cloudpaywidget_ui.php');
        $out->fetch($app->vars('_sett.modules.cloudpaywidget'));
        $obj->after($out);
        $obj->remove();
    }
}
?>
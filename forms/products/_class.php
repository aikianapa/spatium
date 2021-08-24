<?php
class productsClass extends cmsFormsClass
{
    function afterItemSave($item) {
        $this->app->shadow("/");
        $this->app->shadow('/shop');
        $this->app->shadow("/products/{$item['id']}/".wbTranslit($item['name']));
    }
}
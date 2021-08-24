<?php
class productsClass extends cmsFormsClass
{
    function afterItemSave($item) {
        $this->app->shadow("/");
        $this->app->shadow('/shop');
        $this->app->shadow("/products/{$item['id']}/".wbTranslit($item['name']));
    }

    function afterItemRead(&$item) {
        $item['discounts'] = $this->getDiscounts();
        return $item;
    }

    function getDiscounts() {
        if (isset($_ENV['tmp']['discount'])) {
            $discount = $_ENV['tmp']['discount'];
        } else {
            $app = &$this->app;
            $tree = $app->treeRead('discount');
            $tree = $tree['tree']['data'];
            $discount = [];
            foreach ($tree as $d) {
                $discount[$d['id'].''] = 1 - $d['data']['percent']/100;
            }
            $_ENV['tmp']['discount'] = $discount;
        }
        return $discount;
    }
}
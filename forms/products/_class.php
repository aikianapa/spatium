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
        if ($item['category'] !== 'main') {
            unset($item['pn']);
            unset($item['vt']);
            unset($item['sr']);
            unset($item['cht']);
            unset($item['pt']);
            unset($item['sb']);
            unset($item['vs']);
        }
        return $item;
    }

    function getDiscounts() {
        if (isset($_ENV['tmp']['discount'])) {
            $discount = $_ENV['tmp']['discount'];
        } else {
            $app = &$this->app;
            $tree = $app->treeRead('discount');
            $discount = [];
            if ($tree['active'] == 'on') {
                $tree = $tree['tree']['data'];
                foreach ($tree as $d) {
                    $d['active'] == 'on' ? $discount[$d['id'].''] = 1 - $d['data']['percent']/100 : null;
                }
            }
            $_ENV['tmp']['discount'] = $discount;
        }
        return $discount;
    }
}
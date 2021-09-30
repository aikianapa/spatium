<?php
class productsClass extends cmsFormsClass
{
    function afterItemSave($item) {
        $this->app->shadow("/");
        $this->app->shadow('/shop');
        $this->app->shadow('/desserts');
        $this->app->shadow("/products/{$item['id']}/".wbTranslit($item['name']));
    }

    function beforeItemShow(&$item) {
        isset($item['images']) && count((array)$item['images']) ? $item['image'] = $item['images'][0]['img'] : $item['image'] = '';
        return $item;
    }

    function afterItemRead(&$item) {
        $app = &$this->app;
        $item = (array)$item;
        $item['discounts'] = $this->getDiscounts();
        isset($item['category']) ? null : $item['category'] = '';
        if ($item['category'] !== 'main') {
            unset($item['pn']);
            unset($item['vt']);
            unset($item['sr']);
            unset($item['cht']);
            unset($item['pt']);
            unset($item['sb']);
            unset($item['vs']);
        }
        
        $tree = $this->app->treeRead('menu-categories');
        $catname = $app->vars('_env.tmp.catname.'.$item['category']);
        if ($catname > '') {
            $item['catname'] = $catname;    
        } else {
            $catname = $this->app->treeFindBranchById($tree['tree']['data'],$item['category']);
            isset($catname['name']) ?  $item['catname'] = $catname['name'] : null;
            $app->vars('_env.tmp.catname.'.$item['category'],$item['catname']);
        }
        return $item;
    }

    function checkToken() {
        if ($this->app->vars('_route.action') == 'info') return true;
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
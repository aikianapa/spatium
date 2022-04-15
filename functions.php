<?php

    @include_once(__DIR__ . '/engine/modules/yonger/common/scripts/functions.php');


    function getMeals() {
        $meals = wbItemRead('catalogs','meals');
        $meals = $meals['tree']['data'];
        $res = [];
        foreach($meals as $item) {
            $item['active'] == 'on' ? $res[] = $item['name'] : null;
        }
        $res = implode(',',$res);
        $res = str_replace(' ','_',$res);
        return $res;
    }


    function getMealsJson()
    {
        $meals = wbItemRead('catalogs', 'meals');
        $meals = $meals['tree']['data'];
        $res = [];
        foreach ($meals as $item) {
            $item['active'] == 'on' ? $res[$item['id']] = $item['name'] : null;
        }
        return json_encode($res,JSON_UNESCAPED_UNICODE);
    }


    function getDiscounts() {
        $tree = wbTreeread('discount');
        $tree = $tree['tree']['data'];
        $discounts = [];
        foreach($tree as $key => $d) {
            if ($d['active'] == 'on') {
                $discounts[$key] = [
                    'name' => $d['name'],
                    'percent' => (1 - $d['data']['percent'] / 100).''
                ];
            }
        }
        return json_encode($discounts);
    }  

    function siteMenu($path = '') {
        $app = &$_ENV['app'];
        $list = $app->itemList('pages',['filter'=>[
            'active'=>'on'
            ,'path' => $path
            ,'_site'=>$app->vars('_sett.site')
            ,'_login'=>$app->vars('_sett.login')
        ]]);
        $list = $list['list'];
        foreach($list as &$item) {
            $path = $item['path'];
            $name = $item['name'];
            $path.'/'.$name == '/' ? $path = '/home' : $path .= '/'.$name;
            $item['children'] = siteMenu($path);
            $path == '/home' ? $path =  '/' : null;
            $item['path'] = $path;
            if (count($item['children'])) {
                $self = $item;
                $self['divider'] = 'divider-after';
                unset($self['children']);
                array_unshift($item['children'],$self);
            }
        }
        return $list;
    }
?>
<?php

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

    function customRoute(&$route = [])
    {
        $app = &$_ENV['app'];
        $map = $app->vars('_env.dba').'/_yonmap.json';
        $app->route->uri == '/' ? $uri = '/home' : $uri = $app->route->uri;
        if (is_file($map)) {
            $map = (array)json_decode(file_get_contents($map), true);
            $idx = md5($uri);
            if (isset($map[$idx])) {
                $app->route->controller = 'form';
                $app->route->mode = 'show';
                $app->route->table = $map[$idx]['f'];
                $app->route->item = $map[$idx]['i'];
                isset($app->route->tpl) ? null : $app->route->tpl = $map[$idx]['f'].".php";
                $app->vars('_route', $app->objToArray($app->route));
                $route = $app->route;
                return $route;
            }
        }

        if ($app->vars('_route.controller') == 'form' && $app->vars('_route.mode') == 'show') {
            $path = explode('/', $uri);
            $name = array_pop($path);
            $path = implode('/', $path);

            $uri == '/' && $name == '' ? $name = 'home' : null;
            if (isset($app->route->item) && $app->route->item !== $name) {
                $app->route->alias = $name;
                $name = $app->route->item;
                $uri = $path.'/'.$name;
            };
            $uri == '/home' ? $uri = '/' : null;

            $pages = $app->itemList('pages', ['filter'=>[
            '_site' => [
                '$in'=> [null,'{{_sett.site}}']
            ],
            'name'=>$name,
            'active'=>'on',
            'path' => $path
        ]]);
            foreach ($pages['list'] as $page) {
                if ($page['url'] == $uri) {
                    $app->route->controller = 'form';
                    $app->route->mode = 'show';
                    $app->route->table = 'pages';
                    $app->route->item = $page['_id'];
                    isset($app->route->tpl) ? null : $app->route->tpl = "page.php";
                    $app->vars('_route', $app->objToArray($app->route));
                    $route = $app->route;
                    return $route;
                    break;
                }
            }
        }
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

    function _beforeItemSave(&$item) {
        $app = &$_ENV['app'];
        $item['_site'] = $app->vars('_sett.site');
        $item['_login'] = $app->vars('_sett.login');
        return $item;
    }
?>
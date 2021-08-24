<?php
use Nahid\JsonQ\Jsonq;

class pagesClass extends cmsFormsClass {

function beforeItemShow(&$item) {
    isset($item['lang']) ? $lang = $item['lang'][$this->app->vars('_sess.lang')] : $lang = [];
    $item = (array)$lang + (array)$item;
    isset($item['header']) ? $item['header'] = $item['header'][$_SESSION['lang']] : null;
}

function afterItemRead(&$item) {
    isset($item['blocks']) ? null : $item['blocks'] = [];
    isset($item['container']) ? null : $item['container'] = '';
    if (in_array($item['id'],['_header','_footer'])) return;
    if ($item['path'] == '/') $item['path'] = '';
    $item['url'] = $item['path'] . '/' .$item['name'];
    $item['url'] == '/home' ? $item['url'] = '/' : null;
}

function afterItemSave($item) {
    $this->app->shadow($item['url']);
}

function list() {
    $app = &$this->app;
    $this->jq = new Jsonq();
    $this->count = 0;
    $out = $app->fromFile(__DIR__ . '/list.php');
    $this->tpl = $out->find('#pagesList');
    $res = $this->listNested();
    $out->find('#pagesList')->replaceWith($res);
    echo $out->fetch();
}

function listNested($path = '') {
    $this->count++;
    $level = $this->app->itemList('pages',['filter'=>['path'=>$path]]);
    $count = $level['count'];
    $level = $level['list'];
    if (!count($level)) return $this->app->fromString("");
    if ($path == '')     {
        unset($level['_header']);
        unset($level['_footer']);
    }
    $out = $this->tpl->clone();
    $out->fetch(['list'=>$level]);
    foreach($level as $item) {
            $path = $item['path'].'/'.$item['name'];
            $res = $this->listNested($path);
            if ($path == '/home' && $item['name'] == 'home') $path = '/';
            $li = $out->find('[data-path="'.$path.'"]')->parent()->parent()->parent();
            $li->append($res);

    }
    return $out;
}

function path() {
    $app = &$this->app;
    $data = $app->vars('_post.data');
    foreach(array_keys($data) as $id) {
        $app->itemSave('pages',['_id'=>$id,'path'=>$data[$id]],false);
    }
    $app->tableFlush('pages');
}

}
?>

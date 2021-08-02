<?php
require_once __DIR__."/engine/functions.php";

$app = new wbApp();
wbInitFunctions($app);
$ai = $app->module('autoinc');
echo $ai->inc('users','inc',160);

?>
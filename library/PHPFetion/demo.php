<?php
set_time_limit(0);
header("content-type:text/html; charset=utf-8");
include 'class.fetion.php';
new Fetion ('15951188888', '88888');
echo Fetion::sendMsg('15951188888', '测试');
?>
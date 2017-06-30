<?php
set_time_limit(0);
header("content-type:text/html; charset=utf-8");
include 'class.fetion.php';
$mobile = htmlspecialchars(trim($_POST['mobile']));
$password = htmlspecialchars(trim($_POST['pwd']));
$fid = htmlspecialchars(trim($_POST['fid']));
$msgContent = htmlspecialchars(trim($_POST['msgContent']));
new Fetion ($mobile, $password);
Fetion::sendMsg($fid, $msgContent);
?>
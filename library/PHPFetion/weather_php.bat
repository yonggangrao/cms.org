@echo off
:切换到php所在盘符的根目录
d:
:进入php根目录
cd D:\AppServ\php5
:执行php脚本，URL请自行修改
php -r "file_get_contents('http://127.0.0.1/test/feixin/cron.php');"
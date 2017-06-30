ÏîÄ¿ËµÃ÷£º
index.php		=>	ÔÚÏß·¢ËÍ·ÉÐÅµÄÈë¿ÚÒ³
demo.php		=>	ÏîÄ¿ÑÝÊŸÒ³£¬³õŽÎÊ¹ÓÃœšÒéÊ¹ÓÃdemo.php²âÊÔÏÂ³ÌÐòÊÇ·ñÔËÐÐÕý³£
cron.php		=>	ÓÃÓÚ¶šÊ±·¢ËÍÒ»Ð©ÐÅÏ¢žø·ÉÐÅºÃÓÑµÄœÅ±Ÿ
weather_php.bat		=>	×ÔŒºÓÃŒÇÊÂ±ŸŽò¿ª¿ŽÏÂÀïÃæµÄ×¢ÊÍ°É£¬ÅäºÏcron.phpÊ¹ÓÃ
weather_php.vbs		=>	vbsœÅ±Ÿ£¬ÅäºÏÉÏÃæµÄweather_php.batÅúŽŠÀíÊ¹ÓÃ£¬Ö÷Òª×÷ÓÃÊÇÈÃÅúŽŠÀíÖŽÐÐµÄÊ±ºòÒþ²ØcommandŽ°¿Ú
class.fetion.php	=>	ÕâžöŸÍ²»¶àËµÁË£¬ºËÐÄÎÄŒþ£¬ŸÍ¿¿ËûÁË¡£

ÆäËû£º
ÒªÈÃcron.php¶šÊ±ÖŽÐÐµÄ»°WindowsÓÃ»§µ±È»ÒªÊ¹ÓÃ¡°ŒÆ»®ÈÎÎñ¡±À²£¬×ÔŒºÌíŒÓÒ»žöÈÎÎñŒŽ¿É£¬¶šÆÚÔËÐÐweather_php.vbs

Èç¹ûÊÇLinuxÓÃ»§£¬¿ÉÒÔÊ¹ÓÃ/etc/crontab	È»ºó×ÔŒºÐŽžöshellœÅ±ŸŸÍÐÐÀ²£¬ÕâžöŽóŒÒ×ÔŒºÈ¥ÑÐŸ¿°É~




ÆäËûÎÊÌâ¿ÉÒÔÁªÏµÎÒ: cpcw@vip.qq.com



项目说明如下： 
index.php        =>    在线发送飞信的入口页 
demo.php        =>    项目演示页，初次使用建议使用demo.php测试下程序是否运行正常 
cron.php        =>    用于定时发送一些信息给飞信好友的脚本 
weather_php.bat        =>    自己用记事本打开看下里面的注释吧，配合cron.php使用 
weather_php.vbs        =>    vbs脚本，配合上面的weather_php.bat批处理使用，主要作用是让批处理执行的时候隐藏command窗口 
class.fetion.php    =>    这个就不多说了，核心文件，就靠他了。 

其他： 
要让cron.php定时执行的话Windows用户当然要使用“计划任务”啦，自己添加一个任务即可，定期运行weather_php.vbs 

如果是Linux用户，可以使用/etc/crontab    然后自己写个shell脚本就行啦，这个大家自己去研究吧~ 


相关东东都在压缩包里面了，readme.txt里我也备注了使用说明~ 

================================================================ 
在线演示地址:  http://feixin.cxxmv.com:81 

sendmsg.php页面最后第二行修改成：echo Fetion::sendMsg($fid, $msgContent); 前面少了个echo，否则看不到发送结果。 感谢“ 黄勃SEEVIA”反馈

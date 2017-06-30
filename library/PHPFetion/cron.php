<?php
set_time_limit(0);
date_default_timezone_set('PRC');
include 'class.fetion.php';

#============= CURL获取第三方数据，请自行修改[说白了，就是采集数据，小偷程序啦~！] =============
$ch = curl_init('http://www.weather.com');
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, 0);
$result = curl_exec($ch);
curl_close($ch);
if(!$result) {
	exit;
}
preg_match('/<a href="tqyb.html"  target="_blank">(.*)<\/a><\/div><script/is', $result, $todayWeather);
$weatherReport = trim($todayWeather[1]);
$weatherReport = 'xxx天气预报：'.$weatherReport;
unset($todayWeather, $result);


#============= 账号变量相关配置 =============
$fetion_account = '15951112345';//飞信帐号
$fetion_password = '123456';	//飞信密码
$mobileArr = array('15951112345', '13773212345', '13962212345');	//收件人


#============= 以下内容无需需改，如有需要，请根据实际情况进行修改 =============
$str = '';
foreach($mobileArr as $k => $v) {
	$retryInit = 1;
	//重试三次
	while($retryInit <= 3) {
		new Fetion ($fetion_account, $fetion_password);
		$sendStatus = Fetion::sendMsg($v, $weatherReport);
		if(strrpos($sendStatus, '失败') === false) {
			break;	
		}
		$retryInit++;
	} 

	$str .= '发送号码：'.$v."\n"; 
	$str .= '重试次数：'.$retryInit."\n"; 
	$str .= '发送状态：'.strip_tags($sendStatus)."\n"; 
	$str .= '发送时间：'.date('Y-m-d H:i:s')."\n\n"; 
	
}
$str .= $weatherReport."\n";
$str .= "===================================== ".date('Y-m-d')." =====================================\n\n\n";
$fp = fopen('send_log.txt', 'a+');
fwrite($fp, $str);
fclose($fp);
//echo $sendStatus;
unset($str, $weatherReport);
?>
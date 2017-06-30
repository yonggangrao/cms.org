<?php
class Fetion {
	private static $mobile;
	private static $password;
	private static $post_data;
	private static $flag = false;
	
	/*
	* 构造函数
	* @param string $mobile 	用户飞信号
	* @param string $password 	飞信号密码
	*/
	public function __construct($mobile, $password) {
		self::$mobile = $mobile;
		self::$password = $password;
	}
	
	/*
	* 登录
	* @return string
	*/
	protected static function login() {
		self::$post_data = 'pass='.self::$password.'&loginstatus=1&m='.self::$mobile;
		$result = self::curl_post('/im/login/inputpasssubmit1.action', self::$post_data);
		return $result;
	}
	
	/**
	 * 给自己发送飞信
	 * @param string $message 	飞信内容
	 * @return string
	 */
	protected static function messageToSelf( $message ) {
		$result = self::curl_post('/im/user/sendMsgToMyselfs.action', 'msg='.$message);
		return $result;
	}
	
	/**
	 * 向好友发送飞信
	 * @param string $uid 		飞信ID
	 * @param string $message 	飞信内容
	 * @return string
	 */
	protected static function messageToFriend($fid, $message) {
		$result = self::curl_post('/im/chat/sendMsg.action?touserid='.$fid, 'msg='.urlencode($message));
		return $result;
	}
	
	/**
	* 获取飞信ID
	* @param string $mobile		手机或飞信号
	* @return string
	*/
	protected static function searchFid($mobile) {
		$result = self::curl_post('/im/index/searchOtherInfoList.action', 'searchType=stranger&searchText='.$mobile);
		//已经是您的好友
		if( strpos($result, '已经是') !== false ) {
			preg_match('/touserid=([0-9]+)/is', $result, $match);
			$result = $match[1];
		} else {
			$result = false;
		}
		return $result;
	}
	
	/*
	* 退出登录
	* @return string
	*/
	protected static function logout() {
		//self::$post_data = $t;
		$result = self::curl_post('/im/index/logoutsubmit.action', '');
		return $result;
	}
	
	/*
	* 提示信息
	* @param string $message 	提示内容
	* @param string $color   	字体颜色
	*/
	protected static function show ( $message, $color ) {
		return '<font color="'.$color.'">'.$message.'</font>';
	}
	
	/*
	* CURL
	* @param string $post_url 	请求地址
	* @param string $data   	请求数据
	* @return string
	*/
	protected static function curl_post($post_url, $data) {
		$host = 'http://f.10086.cn';
		// 创建一个新cURL资源
		$ch = curl_init($host.$post_url);
		if(!self::$flag) {
			curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');	
			self::$flag = true;
		}
		curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		// 抓取URL并把它传递给浏览器
		$result = curl_exec($ch);
		// 关闭cURL资源，并且释放系统资源
		curl_close($ch);
		return $result;
	}
	
	/*
	* 发送飞信内容
	* @param string $mobile 	手机或飞信号
	* @param string $message   	飞信内容
	* @return string
	*/
	public static function sendMsg ($mobile, $message) {
		$mobile = trim($mobile);
		$result = self::login();
		if(strpos($result, '密码输入错误') !== false) {
			return self::show('对不起，您的密码输入错误！', 'red');
			exit;
		}
		if($mobile == self::$mobile) {
			$result = self::messageToSelf($message);	//短信发送成功
			if(strpos($result, '成功') !== false) {
				return self::show('短信发送成功', 'green');
			} else {
				return self::show('短信发送失败，请重试！', 'red');
			}
		} else {
			$fid = self::searchFid($mobile);
			if($fid !== false) {
				$result = self::messageToFriend($fid, $message);
				if(strpos($result, '成功') !== false) {
					return self::show('短信发送成功', 'green');
				} else {
					return self::show('短信发送失败，请重试！', 'red');
				}
			} else {
				return self::show('发送失败，超时或者您跟对方不是好友关系。', 'red');
			}
		}
		self::logout();
	}
}
?>
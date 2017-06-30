<?php


function print_varable($varable)
{
	echo "<pre>";
		print_r($varable);
	echo "</pre>";
}

function get_file($filename)
{
	return $_FILES[$filename];
}




function check_img_format($format)
{
	$img_format = img_format();
	if(empty($img_format[$format]))
	{
		return false;
	}
	return true;
}




function manage_page_is_login($is_login, $URI)
{
	$login_page = login_page();
	if(!empty($login_page[$URI]) && empty($is_login))
	{
		return false;
	}
	return true;
}


function logout()
{
	session_destroy();
}

function is_login()
{
	$user_id = get_session('user_name');
	if(empty($user_id))
	{
		return false;
	}
	return true;
}


function unique_id()
{
	$ip = get_server('REMOTE_ADDR');
	return md5(uniqid() . $ip);
}

function curl_post($url,$data)
{
	$ch = curl_init ();
	curl_setopt ( $ch, CURLOPT_URL, $url );
	curl_setopt ( $ch, CURLOPT_POST, 1 );
	curl_setopt ( $ch, CURLOPT_HEADER, 0 );
	//curl_setopt($ch,CURLOPT_BINARYTRANSFER,true);
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data );
	$ret = curl_exec ( $ch );
	curl_close ( $ch );
	
	return $ret;
}

// 还原文本中的空格、tab和换行符
function show_blank_enter($s)
{
	$s=str_replace(" ","&nbsp;",$s);
	$s=str_replace("\t","&nbsp;&nbsp;&nbsp;&nbsp;",$s);
	$s=str_replace("\n","<br/>",$s);
	return $s;
}


function set_login($user_id, $name)
{
	set_session('user_id', $user_id);
	set_session('user_name', $name);
}

function get_session($param='')
{
	//$param = CONSTVAR::DOMAIN . ':' . $param;
	return $_SESSION[$param];
}
function set_session($key, $value)
{
	//$key = CONSTVAR::DOMAIN . ':' . $key;
	$_SESSION[$key ] = $value;
}

function del_session($param)
{
	//$key = CONSTVAR::DOMAIN . ':' . $key;
	unset($_SESSION[$param]);
}
function get_server($param='')
{
	return $_SERVER[$param];
}


function get_response($param='',$method='POST')
{
	switch ($method)
	{
		case 'POST':
			return $_POST[$param];
		case 'GET':
			return $_GET[$param];
		default:
			return '';
	}
}

function get_time($time)
{
	return date('Y-m-d H:i', $time);
}
?>
<?php
	session_start();
	ini_set('date.timezone','Asia/Shanghai');
?>
<!DOCTYPE html>
<html>
<head>
	<title>重庆大学会议纪要管理系统</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=3.0, user-scalable=yes" />
	<?php 
		include_icon();
		include_head_css($_controller, $_action);  //$controller和$action都在core.php的render函数里
		include_head_js($_controller, $_action);
	?>
</head>
<body>

<div class="head" id="head">
	<div class="head-inner">
		<ul>
			<li class="left li-main-title">会议纪要管理系统</li>
			<li class="left"><a href="<?php echo HOST . 'user/home';?>" >个人中心</a></li>
			<li class="left"><a href="<?php echo HOST . 'conference/search';?>" >搜索</a></li>
			
			
			<li class="right"><a href="<?php echo HOST . 'user/sign';?>" >注册</a></li>
			<?php 
				if(!is_login())
				{
					echo '<li class="right"><a href="'. HOST . 'user/login" >登录</a></li>';
				}
			
				if(is_login())
				{
					echo '<li class="right" ><a href="/user/logout" >退出</a></li>';
					$name = get_session('user_name');
					echo '<li class="right" ><a href="" >' . $name . '</a></li>';
					
				}
			?>
			
	
		</ul>
	</div>
</div>

<div class="body">
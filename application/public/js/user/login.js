$(document).ready(function(){
	$('#submit').bind('click',function(){
		
		var $email = $('#input_email').val();
		var $password = $('#input_password').val();
		

		
		//alert($password + $email)
		if($email == '')
		{
			var html = '<li>';
			html += '<span class="tips">请填写邮箱!</span>';
			html += '</li>';
			$('.ul-sign').append(html);
			return false;
		}
		if($password =='')
		{
			var html = '<li>';
			html += '<span class="tips">请填写密码!</span>';
			html += '</li>';
			$('.ul-sign').append(html);
			//$('#password_span').text('请填写密码!');
			return false;
		}
		
		
		$password = $.md5($password);
		var url = '/user/login';
		$.post(
				url,
				{
					action:'login', 
					name:$email, 
					password:$password
				},
				function(data){
					$data = eval('(' + data + ')');
					
					if($data.ret == true)
					{
						//alert('登录成功');
						//window.location.href='/';
						redirect('/user/home')
					}
					else
					{
						alert('登录失败..');
					}
		  });
		
		
		
		
	});
});









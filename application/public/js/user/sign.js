$(document).ready(function(){
	
	//$('#submit').bind('click',function(){
		$('.ul-sign').on('click', '#submit', function(){
			
			
		//});
		
		// var $email = $('#input_email').val();
		var $name = $('#input_name').val();
		var $title = $('#input_title').val();
		var $profile = $('#textarea_profile').val();
		var $password = $('#input_password').val();
		var $repassword = $('#input_repassword').val();
		

		if(!verify_name($name))
		{
			return false;
		}
		if(!verify_title($title))
		{
			return false;
		}

		if(!verify_password($password, $repassword))
		{
			return false;
		}
		
		$password = $.md5($password);
		$.post(
				"/user/sign",
				{
					action:'sign', 
					name:$name,
					title:$title,
					profile:$profile,
					password:$password
				},
				function(data){
					//alert(3444);
					data = json_decode(data);
					if(data.ret == true)
					{
						alert('注册成功');
						redirect('/user/login');
					}
					else
					{
						alert('注册失败');
					}
		  });
		
		
		
		
	});
});

function warn($warn)
{
	var html = '<li class="li-tips">';
	html += '<span class="tips">' + $warn + '</span>';
	html += '</li>';
	$('.li-tips').remove();
	$('.ul-sign').append(html);
}
function verify_mail($email)
{
	if($email == '')
	{
		warn('请填写邮箱！')
		//$('#tips').text('请填写邮箱！');
		return false;
	}

	if(!verify_email($email))
	{
		warn('邮箱格式不对！')
		return false;
	}
	return true;
}

function verify_name($name)
{
	if($name == '')
	{
		warn('请填写用户名!')
		return false;
	}
	if($name.length < 2)
	{
		warn('用户名太短！')
		return false;
	}
	return true;
}
function verify_title($title)
{
	if($title == '')
	{
		warn('请填写用职位!')
		//$('#tips').text('请填写用职位!');
		return false;
	}
	if($title.length < 2)
	{
		warn('职位名太短！')
		return false;
	}
	return true;
}
function verify_password($password, $repassword)
{
	if($password =='' || $repassword=='')
	{
		warn('请填写密码！')
		return false;
	}
	if($password.length < 6)
	{
		warn('密码太短！')
		return false;
	}
	if($password != $repassword)
	{
		warn('密码不匹配！')
		return false;
	}
	return true;
}


function verify_phone($phone)
{
	if($phone == '')
	{
		$('#tips').text('请填写电话！');
		return false;
	}
	
	$regexp = /^1\d{10}$/g;
	if(!$regexp.exec($phone))
	{
		$('#tips').text('电话格式不对！');
		return false;
	}
	
	return true;
}

function verify_section($section)
{
	if($section == 'unselected')
	{
		$('#tips').text('请填写校区！');
		return false;
	}
	
	return true;
}



$(document).ready(function(){
	
	$('#submit').bind('click',function(){
		
		// var $email = $('#input_email').val();
		var $name = $('#input_name').val();
		var $introduction = $('#textarea_profile').val();
		

		if(!verify_name($name))
		{
			return false;
		}
		if(!verify_profile($introduction))
		{
			return false;
		}

		$.post(
				"/organization/create",
				{
					action:'create', 
					name:$name,
					introduction:$introduction
				},
				function(data){
					data = json_decode(data);
					if(data.ret == true)
					{
						alert('创建成功');
						redirect('/user/home');
					}
					else
					{
						alert('创建失败');
					}
		  });
		
		
		
		
	});
});

 

function verify_name($name)
{
	if($name == '')
	{
		$('#tips').text('请填写用户名!');
		return false;
	}
	if($name.length < 2)
	{
		$('#tips').text('用户名太短！');
		return false;
	}
	return true;
}
function verify_profile($profile)
{
	if($profile.length==0)
	{
		$('#tips').text('请填写组织简介!');
		return false;
	}
	return true;
}
function verify_password($password, $repassword)
{
	if($password =='' || $repassword=='')
	{
		$('#tips').text('请填写密码！');
		return false;
	}
	if($password.length < 6)
	{
		$('#tips').text('密码太短！');
		return false;
	}
	if($password != $repassword)
	{
		$('#tips').text('密码不匹配！');
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



$(document).ready(function(){
	
	$('#submit').bind('click',function(){
		
		// var $email = $('#input_email').val();
		var $title = $('#input_title').val();
		var $arrange = $('#textarea_arrange').val();
		var $mainbody = $('#textarea_mainbody').val();
		var $orgi = $('#orgi').val();
		
		
		if(!verify_arrange($arrange))
		{
			return false;
		}
		if(!verify_title($title))
		{
			return false;
		}

		if(!verify_mainbody($mainbody))
		{
			return false;
		}
		
		$.post(
				"/conference/create/" + $orgi,
				{
					action:'create', 
					title:$title,
					arrange:$arrange,
					mainbody:$mainbody
				},
				function(data){
					//alert(3444);
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



function verify_title($title)
{
	if($title == '')
	{
		$('#tips').text('请填写会议标题!');
		return false;
	}
	if($title.length < 2)
	{
		$('#tips').text('会议标题名太短！');
		return false;
	}
	return true;
}

function verify_arrange($arrange)
{
	if($arrange.length==0)
	{
		$('#tips').text('请填写会议部署!');
		return false;
	}
	return true;
}
function verify_mainbody($mainbody)
{
	if($mainbody.length==0)
	{
		$('#tips').text('请填写会议主体!');
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



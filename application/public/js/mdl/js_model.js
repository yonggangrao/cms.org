
//post提交数据
function js_post(url, data, tips)
{
	$.post(url, data, function(ret){
		
		data = json_decode(ret);
		
		//判断是否登录
		/////////////////////////////////////////////////////
		uri = get_uri();
		page = login_page();
		if(page[uri] && data.is_login != CONSTVAR.LOGIN)
		{
			redirect('/user/login');
			return false;
		}
		/////////////////////////////////////////////////////
		
		//一些要特别验证的页面
		/////////////////////////////////////////////////////
		
		
		
		
		//成功后的操作
		//////////////////////////////////////////////////////
		if(data.ret == CONSTVAR.SUCCESS)
		{
			var action = data.ctrl_action;
			switch(action)
			{
				case 'shop/create/create':
					
					alert('创建成功');
					redirect('/shop/home');
					break;
				
				default:
					
			}
			
			
		}
		/////////////////////////////////////////////////////
		
		
		//失败后的操作
		/////////////////////////////////////////////////////
		else
		{
			alert('修改失败');
		}
			
	});
	
}



function verify_desc($info, warn)
{
	if(!$info)
	{
		$confirm = confirm(warn);
		if($confirm)
		{
			return true;
		}
		return false;
	}
	return true;
}



function get_imgs()
{
	var imgs = '';
	for(var i in arr_img)
	{
		if(arr_img[i] != '')
		{
			imgs += arr_img[i] + ',';
		}
	}
	return imgs;
}


function get_max_upload_img_nu()
{
	var img_nu;
	var uri = get_uri();
	
	switch(uri)
	{
		case '/goods/upload':
			img_nu = 3;
			break;
			
		case '/shop/create':
			img_nu = 1;
			break;
		default:
			img_nu = 0;
			
	}
	
	return img_nu;
}
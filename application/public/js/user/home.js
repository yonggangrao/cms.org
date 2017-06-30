$(document).ready(function(){
	
	$('.ul-profile').on('click', '.a-save-modify-profile', function(){
		
		var $lis = $(this).parent().siblings();
		var $name = $('#input-info-name').val();
		var $title = $('#input-info-title').val();
		var $profile = $('#input-info-profile').val();
		
		var $ul_profile = $('.ul-profile');
		var $li_profile_head = $(this).parent().siblings('.li-profile-head').clone();
		
		$ul_profile.empty();
		$ul_profile.append($li_profile_head);
	//	alert($name + " " + $title + ' ' + $profile)
	//	return;
		
		$.post(
				"/user/home",
				{
					action:'modifyProfile',
					name: $name, 
					title: $title,
					profile: $profile
				},
				function(data){
					//alert(3444);
					data = json_decode(data);
					if(data.ret !== false)
					{
						//alert('success')
						//$li.remove();
						var html = '<li>';
						html += '<span class="span-info-title">姓名：</span>';
						html += '<span class="span-info-value name" >' + $name + '</span>';
						html += '</li>';
						html += '<li>';
						html += '<span class="span-info-title">职位：</span>';
						html += '<span class="span-info-value title">' + $title +  '</span>';
						html += '</li>';
						html += '<li>';
						html += '<span class="span-info-title">简介：</span>';
						html += '<span class="span-info-value profile">' + $profile +  '</span>';
						html += '</li>';
						
						$ul_profile.append(html);
					}
					else
					{
						alert('修改失败。。');
					}
		  });
		
		
		
	});
	/**
	 * 修改个人简介
	 */
	$('.ul-profile').on('click', '#a-modify-profile', function(){
	//$('#a-modify-profile').bind('click', function(){
		//$conf_id = $("#input_confi").val();
		var $ul_profile = $('.ul-profile');
		var $li_profile_head = $('.li-profile-head').clone();
		//var $li = $(this).parent().clone();
		
		var $lis = $(this).parent().siblings();
		var $name = $lis.find('.name').text();
		var $title = $lis.find('.title').text();
		var $profile = $lis.find('.profile').text();
			
			//alert($name + " " + $title + ' ' + $profile)
			//return;
		$ul_profile.empty();
		$ul_profile.append($li_profile_head);
		
		
		var html = '<li>';
		html += '<span class="span-info-title">姓名：</span>';
		html += '<input class="input-info-value" id="input-info-name" value="'+ $name +'">';
		html += '</li>';
		
		html += '<li>';
		html += '<span class="span-info-title">职位：</span>';
		html += '<input class="input-info-value" id="input-info-title" value="'+ $title +'">';
		html += '</li>';
		
		html += '<li>';
		html += '<span class="span-info-title">简介：</span>';
		html += '<textarea class="input-info-value" id="input-info-profile" >' + $profile + '</textarea>';
		html += '</li>';
		html += '<li>';
			html += '<a class="a-save-modify-profile button-grey" href="javascript:void(0);">保存</a>';
		html += '</li>';
		
		$ul_profile.append(html);
		
	});
	
	
	
	/**
	 * 删除组织
	 */
	$('.a-delete-organization').bind('click', function(){
		
		var $organization_id = $(this).attr('organization_id');
		//alert($organization_id)
		var $li = $(this).parent();
		
		$.post(
				"/user/home",
				{
					action:'delete_organization',
					organization_id: $organization_id
				},
				function(data){
					//alert(3444);
					data = json_decode(data);
					if(data.ret !== false)
					{

						$li.remove();
					}
					else
					{
						alert('删除失败。。');
					}
		  });
		
	});
 
	
});









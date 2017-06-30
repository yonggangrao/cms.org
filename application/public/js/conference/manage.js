$(document).ready(function(){
	
	
	/**
	 *删除议程
	 */
	$('#ul_conf_item').on('click', '.a_delete_item', function(){
		

		var $li = $(this).parents('.li-conf-item');
		var $conference_item_id = $li.attr('conference_item_id');
		
		//alert($conference_item_id)
		//return;
		$.post(
				"/conference/deleteitem/",
				{
					action:'deleteitem',
					conference_item_id: $conference_item_id
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
						alert('删除失败..');
					}
		  });
	});
	/**
	 * 添加发言，显示成员2
	 */
	$('.ul_conf_item').on('click', '.a-delete-record', function(){
		
		//$conf_id = $("#input_confi").val();
		var $li = $(this).parent();
		var $record_id = $li.attr('conference_item_details_id');

		$.post(
				"/conference/deleteRecord/",
				{
					action:'deleteRecord',
					record_id: $record_id
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
						alert('删除失败..');
					}
		  });
		//用于防止多次请求，移除绑定
		$('#div-add-member').off('click', '#a_add_member');
		
	});
	
	/**
	 *签署认可 
	 */
	$('.a_record_comfirm').bind('click',function(){
		

		$conference_user_id = $(this).attr('conference_user_id');
		//alert($conference_user_id);
		//return;
		 var a_record_comfirm = $(this);
		//return;
		$.post(
				"/conference/recordcomfirm/",
				{
					action:'comfirm',
					conference_user_id: $conference_user_id
				},
				function(data){
					//alert(3444);
					data = json_decode(data);
					if(data.ret !== false)
					{
						var html = '<span class="a-button" >已签署认可</span>';
						var $parent = a_record_comfirm.parent();
						a_record_comfirm.remove();
						$parent.append(html);
					}
					else
					{
						alert('操作失败。。');
					}
		  });
	  });
		
	/**
	 * 添加发言，保存
	 */
	$('.ul_conf_item').on('click', '.a_add_record_sumbit', function(){
		
		//$conf_id = $("#input_confi").val();
		
		
		
		var $ul = $(this).parents('.ul-record-item');
		//alert($ul.attr('class'));
		var $li_new = $ul.children('.li-new');
		var $select = $('.select-speaker');
		
		var $user_id = $select.val();
		
		var $user_name = $('.select-speaker option:selected').text()
		
		
		var $record = $li_new.find('.textarea_modify_conf_item_record').val();
		//alert($user_name);return;
		$record = $.trim($record);
		if($record == '') return;
		var $conference_item_id = $(this).parents('.li-conf-item').attr('conference_item_id');
			
		$.post(
				"/conference/addrecord/" + $conf_id,
				{
					action:'addrecord',
					conference_item_id: $conference_item_id,
					record: $record, 
					user_id: $user_id
				},
				function(data){
					//alert(3444);
					data = json_decode(data);
					if(data.ret !== false)
					{
						var conference_item_details_id = data.ret; 
						$li_new.remove();
						html = '<li conference_item_details_id="' + conference_item_details_id + '">';
						html += '<span class="span-conf-item-title" speaker_id="' + $user_id + '">'+ $user_name + '：</span>';
						html += '<div class="div-conf-item-record">'+ $record + '</div> ';
						html += '<a class="a_modify_record a-button" href="javascript:void(0);">修改发言</a>';
						html += '<a class="a-delete-record a-button" href="javascript:void(0);">删除发言</a>';
						html += '</li>';
						
						$ul.prepend(html);
					}
					else
					{
						alert('添加失败..');
					}
		  });
		//用于防止多次请求，移除绑定
		$('#div-add-member').off('click', '#a_add_member');
		
	});
	/**
	 *添加发言，显示成员
	 */
	$('#ul_conf_item').on('click', '.a_add_record', function(){

		
		$ul = $(this).parent('.div-conf-item-title-wraper').siblings(".div-conf-item-record-wraper").children('.ul-record-item');
		//alert($ul.attr('class'));
		$ul.children('.li-new').remove();
		$conference_item_id = $(this).parents('.li-conf-item').attr('conference_item_id');
		html = '<li class="li-new" conference_item_detail_id="">';
			html += '<div class="div-choose-speaker">'
				
			html += '</div> ';
			html += '<div>'
				html += '<textarea class="textarea_modify_conf_item_record"></textarea>';
			html += '</div> ';
			html += ' <a class="a_add_record_sumbit button-grey" href="javascript:void(0);">保存</a>';

		html += '</li>';
		$ul.prepend(html);
		$li = $ul.children('.li-new');

		$div_choose_speaker = $li.children('.div-choose-speaker');
		//alert($div_choose_speaker.attr('class'))
		//return;
		$conf_id = $("#input_confi").val();
		$div_choose_speaker.empty();
		//$('#div-all-member').show();
		//alert($conf_id)
		//return;
		$.post(
				"/conference/getOrgMember/",
				{
					action:'getOrgMember',
					conf_id: $conf_id
				},
				function(data){
					//alert(3444);
					data = json_decode(data);
					if(data.ret != false)
					{
						
						members = data.ret;
						count = members.length;
						html = '<span class="span-choose-speaker">选择发言人：</span>';
						html += '<select class="select-speaker">';
						 
						for(i = 0; i < count; i++)
						{
							item = members[i];
							html +=  '<option value ="' + item['user_id'] + '">' +item['user_name'] + '</option>';
							//html = '<a class="a_all_member" href="javascript:void(0);" user_id="' + item['user_id'] + '">' + item['user_name'] + '</a>';
							
						}
						html += '</select>';
						$div_choose_speaker.append(html);
					}
					else
					{
						alert('添加失败');
					}
		  });
		
		
		

	});
	
	
	
	/**
	 * 删除会议成员
	 */
	
	$('.ul-conference-member').on('click', '.a-delete-user', function(){
	//$('.a-delete-user').bind('click',function(){
		
		$conference_user_id = $(this).attr('conference_user_id');
		$a_delete_user = $(this);
		if(!confirm('确定要删除该用户吗？'))
		{
			return false;
		}
		
		$.post(
				"/conference/deleteuser",
				{
					action:'delete',
					conference_user_id: $conference_user_id
				},
				function(data){
					//alert(3444);
					data = json_decode(data);
					if(data.ret !== false)
					{
						$div = $a_delete_user.parent('div');
						$div.remove();
					}
					else
					{
						alert('删除失败..');
					}
		  });
		
	});
	
	/**
	 * 签到
	 */
	$('.a-qiandao').bind('click',function(){
		

		$conference_user_id = $(this).attr('conference_user_id');
		//alert($conference_user_id);
		//return;
		 var qiandao = $(this);

		$.post(
				"/conference/qiandao/",
				{
					action:'qiandao',
					conference_user_id: $conference_user_id
				},
				function(data){
					//alert(3444);
					data = json_decode(data);
					if(data.ret !== false)
					{
						var html = '<span class="span-qiandao">已签到</span>';
						var $span_name = qiandao.siblings('.span-name');
						var $span_un_qiandao = qiandao.siblings('.span-un-qiandao');
						
						qiandao.remove();
						$span_un_qiandao.remove();
						$span_name.after(html);
					}
					else
					{
						alert('操作失败。。');
					}
		  });
		
	});
	
	/**
	 *添加议程,显示输入框
	 */
	$('#a_add_conf_item').bind('click',function(){
		
		$li = $(this).parent();
		html = '<li>';
			html += '标题： <input type="text" class="input-title">';
			html += '<a class="a_save_conf_item button-grey" href="javascript:void(0);">保存</a>';
		html += '</li>';
		//alert($li.attr('class'))
		$li.after(html);
	});
	/**
	 *添加议程，保存
	 */
	$('#ul_conf_item').on('click', '.a_save_conf_item', function(){
		
		$title = $(this).siblings(".input-title").val();
		$title = $.trim($title);
		if($title == '') return false;
		$conf_id = $("#input_confi").val();
		//alert($conf_id);
		$li = $(this).parent('li');
		$.post(
				"/conference/createitem/" + $conf_id,
				{
					action:'createitem',
					title: $title,
					conf_id: $conf_id
				},
				function(data){
					//alert(3444);
					data = json_decode(data);
					if(data.ret !== false)
					{
						html = '<li class="li-conf-item" conference_item_id="' + data.conference_item_id + '">';
						html += '<div class="div-conf-item-title-wraper" >';
							html += '<span class="blue">- </span><span class="span-conf-item-title blue">' + $title + '</span>';
						html += ' <a class="a_modify_conf_item_title a-button" href="javascript:void(0);">修改</a>';
						html += '<a class="a_add_record a-button" href="javascript:void(0);">添加发言</a>';
						html += '</div>';
						html += '<div class="div-conf-item-record-wraper" >';
							html += '<ul class="ul-record-item">';
							html += '</ul>';
						html += '</div>';
						html += '</li>';

						$li.before(html);
						$li.remove();
					}
					else
					{
						alert('添加失败..');
					}
		  });
	});
	
 
	/**
	 *修改议程标题 
	 */
	$('#ul_conf_item').on('click', '.a_modify_conf_item_title', function(){
		
		$span = $(this).siblings('.span-conf-item-title');
		$title = $span.text();
		$div_wraper = $(this).parents('.div-conf-item-title-wraper');
		$div_wraper.empty();
		html = '<input class="input-title" value="' + $title +'">';
		html += '<input class="input-title-hidden" type="hidden" value="' + $title +'">';
		html += ' <a class="a_save_conf_item_title" href="javascript:void(0);">保存</a>';
		html += ' <a class="a_cancel_conf_item_title" href="javascript:void(0);">取消</a>';
		$div_wraper.append(html);
	});
	/**
	 *修改议程标题 
	 */
	$('#ul_conf_item').on('click', '.a_save_conf_item_title', function(){
		
		$conf_id = $("#input_confi").val();
		$input = $(this).siblings('.input-title');
		$title = $input.val();
		$div_wraper = $(this).parents('.div-conf-item-title-wraper');
		$li = $div_wraper.parents('li');
		$conference_item_id = $li.attr('conference_item_id');

		$.post(
				"/conference/modifyItemTitle/",
				{
					action:'modifyTitle',
					title: $title,
					conference_item_id: $conference_item_id
				},
				function(data){
					//alert(data);
					data = json_decode(data);
					//return;
					if(data.ret !== false)
					{
						$div_wraper.empty();
						html = '<span class="blue">- </span><span class="span-conf-item-title blue">' + $title + '</span>';
						html += ' <a class="a_modify_conf_item_title a-button" href="javascript:void(0);"> 修改</a>';
						html += '<a class="a_add_record a-button" href="javascript:void(0);">添加发言</a>';
						$div_wraper.append(html);
					}
					else
					{
						alert('修改失败。。');
					}
		  });
	});
	
	/**
	 *取消修改议程标题 
	 */
	$('#ul_conf_item').on('click', '.a_cancel_conf_item_title', function(){
		
		$input = $(this).siblings('.input-title-hidden');
		$title = $input.val();
		$div_wraper = $(this).parents('.div-conf-item-title-wraper');
		$div_wraper.empty();
		
		html = '<span class="blue">- </span><span class="span-conf-item-title blue">' + $title + '</span>';
		html += ' <a class="a_modify_conf_item_title a-button" href="javascript:void(0);">修改</a>';
		html += ' <a class="a_modify_conf_item_title a-button" href="javascript:void(0);">添加发言</a>';
		$div_wraper.append(html);
	});
	
	/**
	 *修改会议记录 
	 */
	$('#ul_conf_item').on('click', '.a_modify_record', function(){
		/*
		echo '<li conference_item_details_id="' . $item['conference_item_details_id'] . '">';
		echo '<span class="span-conf-item-title" speaker_id="'.$item['speaker_id'] .'">'. $item['speaker_name'] . '：</span>';
		echo '<div class="div-conf-item-record">'. $item['contents'] . '</div> ';
		echo '<a class="a_modify_record" href="javascript:void(0);">修改发言</a>';
		echo '</li>';
		*/
		$div = $(this).siblings('.div-conf-item-record');
		
		$record = $div.text();
		$span_name = $(this).siblings('.span-conf-item-title').clone();
		//alert($contents);return;;
		$li_wraper = $(this).parent('li');
		//$conference_item_details_id = $div_wraper.attr('conference_item_details_id');
		//alert($conference_item_details_id);return;;		
		$li_wraper.empty();
		$li_wraper.append($span_name);
		html = '';
		html += '<div class="div-conf-item-record">';
		html += '<textarea class="textarea_modify_conf_item_record">' + $record + '</textarea>';
		html += '<textarea class="textarea_hidden">' + $record + '</textarea>';
		html += '</div> ';
		html += ' <a class="a_save_conf_item_record button-grey" href="javascript:void(0);">保存</a>';
		html += ' <a class="a_cancel_conf_item_record button-grey" href="javascript:void(0);">取消</a>';
		$li_wraper.append(html);
	});
	/**
	 *修改议程记录 
	 */
	$('#ul_conf_item').on('click', '.a_save_conf_item_record', function(){
		
		//$conf_id = $("#input_confi").val();
		var $li_wraper = $(this).parent('li');
		var $span_name = $(this).siblings('.span-conf-item-title').clone();
		var $record = $li_wraper.find('.textarea_modify_conf_item_record').val();
		//alert($text);return;
		//$li = $li_wraper.parents('li');
		$conference_item_details_id = $li_wraper.attr('conference_item_details_id');
		//alert($record);
		//return;

		$.post(
				"/conference/modifyItemRecord/",
				{
					action:'modifyRecord',
					record: $record,
					conference_item_details_id: $conference_item_details_id
				},
				function(data){
					//alert(data);
					data = json_decode(data);
					//return;
					if(data.ret !== false)
					{
						$li_wraper.empty();
						$li_wraper.append($span_name);
						
						html = '<div class="div-conf-item-record">' + $record + '</div> ';
						html += '<a class="a_modify_record a-button" href="javascript:void(0);">修改发言</a>';
						html += '<a class="a-delete-record a-button" href="javascript:void(0);">删除发言</a>';
						$li_wraper.append(html);
					}
					else
					{
						alert('修改失败。。');
					}
		  });
	});
	
	/**
	 *取消修改议程记录 
	 */
	$('#ul_conf_item').on('click', '.a_cancel_conf_item_record', function(){
		
		$record = $(this).siblings('.div-conf-item-record').children('.textarea_hidden').val();
		//alert($record);return;
		//$record = $div.text();
		$span_name = $(this).siblings('.span-conf-item-title').clone();
		//alert($contents);return;;
		$li_wraper = $(this).parent('li');
		$li_wraper.empty();
		$li_wraper.append($span_name);
		html = '<div class="div-conf-item-record">' + $record + '</div> ';
		html += '<a class="a_modify_record a-button" href="javascript:void(0);">修改发言</a>';
		html += '<a class="a-delete-record a-button" href="javascript:void(0);">删除发言</a>';
		$li_wraper.append(html);
	});
	
	/**
	 * 添加会议成员：获取组织成员
	 */
	$('#a_add_conf_member').bind('click',function(){
		
		$conf_id = $("#input_confi").val();
		$('#div-all-member').empty();
		$('#div-all-member').show();
		
		$.post(
				"/conference/getOrgMember/",
				{
					action:'getOrgMember',
					conf_id: $conf_id
				},
				function(data){
					//alert(3444);
					data = json_decode(data);
					if(data.ret != false)
					{
						
						members = data.ret;
						count = members.length;
						for(i = 0; i < count; i++)
						{
							item = members[i];
							html = '<a class="a_all_member" href="javascript:void(0);" user_id="' + item['user_id'] + '">' + item['user_name'] + '</a>';
							$('#div-all-member').append(html);
						}
						
					}
					else
					{
						alert('创建失败');
					}
		  });
		
	});
	
	/**
	 * 添加会议成员
	 */
	$('#div-all-member').on('click', '.a_all_member', function(){
		
		$conf_id = $("#input_confi").val();
		$user_id = $(this).attr('user_id');
		
		$user_name = $(this).text();
		//alert($user_id + $user_name);return;
	/*	$('#div-add-member').show();
		$('#div-add-member').empty(); //先清空
*/
		
		$.post(
				"/conference/addMember/" + $conf_id,
				{
					action:'addMember',
					user_id: $user_id,
					conf_id: $conf_id
				},
				function(data){
					//alert(3444);
					data = json_decode(data);
					if(data.ret !== false)
					{
						//alert(data.ret);
						$id = data.ret;
						$('#div-add-member').empty().hide();
						html = '<div>';
						html += '<span class="span-name" >' + $user_name + '</span>';
						html += '<span >未签到</span>';
						html += '<span >未签署认可</span>';
						html += '<a class="a-delete-user a-button" href="javascript:void(0);" conference_user_id="' + $id + '">删除用户</a>';
						html += '</div>';
						$('#li_member').append(html);
					}
					else
					{
						alert('添加失败');
					}
		  });
		//用于防止多次请求，移除绑定
		$('#div-add-member').off('click', '#a_add_member');
		
	});
	
});









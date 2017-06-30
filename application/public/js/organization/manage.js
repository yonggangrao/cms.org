$(document).ready(function(){
	$('#a_add_member').bind('click',function(){
		
		$orgi = $('#input_orgi').val();
		$('#div-all-member').empty();
		$('#div-all-member').show();
		//alert($orgi);
		
		$.post(
				"/organization/manage/" + $orgi,
				{
					action:'get_member'
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
							html = '<a class="a_all_member a-title" href="javascript:void(0);" user_id="' + item['id'] + '">' + item['name'] + '</a>';
							$('#div-all-member').append(html);
						}
					}
					else
					{
						alert('创建失败');
					}
		  });
		
	});

	$('#div-all-member').on('click', '.a_all_member', function(){
		
		$orgi = $('#input_orgi').val();
		$user_id = $(this).attr('user_id');
		
		$user_name = $(this).text();
		//alert($user_name);
		$('#div-add-member').show();
		$('#div-add-member').empty(); //先清空
		html = '<ul>';
			html += '<li class="li-head">添加成员：' + $user_name +'</li>';
			html += '<li><span class="span-title">选择权限：</span>';
			html += '<select id="select_member_authority" name="class">';
				html += '<option value="3">参会人员</option>';
				html += '<option value="2">记录员</option>';
				html += '<option value="1">秘书</option>';
				html += '<option value="0">主席</option>';
				html += '</select>';
				html += '<li class="li-tips">提示：管理员和秘书都具有创建会议的权力，记录员负责记录会议，参会人员只能查看。</li>'
			html += '</li>';
			html += '<li><a id="a_add_member" class="button-grey" href="javascript:void(0);"> 添加</a></li>';
		html += '</ul>';
		$('#div-add-member').append(html);
		
		//alert($('#a_add_member').text());
		$('#div-add-member').on('click', '#a_add_member', function(event){
			//alert($user_id);
			$level = $('#select_member_authority').val();
			//alert($level);return;
			$.post(
					"/organization/manage/" + $orgi,
					{
						action:'addmember',
						user_id: $user_id,
						level: $level,
						orgi: $orgi
					},
					function(data){
						//alert(3444);
						data = json_decode(data);
						if(data.ret !== false)
						{
							//alert(data.ret);
							$('#div-add-member').empty().hide();
							html = '<a class="a_all_member" href="javascript:void(0);" user_id="' + $user_id + '">' + $user_name + '</a>';
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
	return false;
});









$(document).ready(function(){
	

	/**
	 * 搜索
	 */
	$('#a-search').bind('click', function(){
		
		
		var $search = $.trim($('#input-search').val());
		if($search == '')
		{
			return false;
		}
		
		var $div_search_result  = $("#div-search-result");
		$div_search_result.empty();
		//alert($div_search_result.attr('class'))
		
		//return;

		$.post(
				"/conference/search",
				{
					action:'search',
					search: $search
				},
				function(data){
					//alert(3444);
					data = json_decode(data);
					if(data.ret !== false)
					{
						conf = data.ret;
						var html = '<ul>';
						for (index in conf)
						{
							item = conf[index];
							html += '<li>';
								html += '<a href="'+ CONSTVAR.DOMAIN + 'conference/manage/' + item['id'] + '">' + item['title'] + '</a>';
							html += '</li>';
						}
						
						html += '</ul>';
						$div_search_result.append(html)
					}
					else
					{
						alert('操作失败。。');
					}
		  });
		
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
		html += '<input class="input-info-value" id="input-info-profile" value="'+ $profile +'">';
		html += '</li>';
		html += '<li>';
			html += '<a class="a-save-modify-profile" href="javascript:void(0);">保存</a>';
		html += '</li>';
		
		$ul_profile.append(html);
		
	});
	
	
});









$(document).ready(function(){
	
	
		$('.body').on('click', '#a_next_page,#a_pre_page', function(){
			
		var $this = $(this);
		var $id = $this.attr('id');
		//alert($id);
		var $div_page = $this.parent();
		var $ul_article_list = $('#ul-article-list');
		var $start = $ul_article_list.attr('start');
		var $limit = $ul_article_list.attr('limit');
		$start = parseInt($start);
		//$limit = parseInt($limit);
		$limit = CONSTVAR.ARTICLE_LIST_NO;
		
		//var pre_page, next_page;
		if($id == 'a_next_page')
		{
			$start += $limit;
		}
		else if($id == 'a_pre_page')
		{
			$start -= $limit;
		}
		
		$.post(
				"/index/index",
				{
					action : 'list',
					start : $start
					//limit : $limit
				},
				function(data){
					
					var $data = json_decode(data);
					
					if ($data.errno == 0 ) {
						
						$ul_article_list.empty();
						var article_list = $data.ret;
						
						var HOST = 'http://' + window.location.host;
						var $count = article_list.length;
						for (var i = 0; i < $count; i++) {
							$row = article_list[i];
							
							if (!$row) {
								continue;
							}
							var html = '<li>';
							html += '<div class="div-head">';
							html += '<a href="' + HOST + "/article/display/" + $row['id'] + '">' + $row['title'] + '</a>';
							html +='</div>';
							
							html += '<div class="div-body">';
							html += $row['contents'];
							html +='</div>';

							html += '</li>';
							
							$ul_article_list.append(html)
							
						}
						
						$div_page.empty();
						if($start > 0)
						{
							var html = '<a href="javascript:void(0);" id="a_pre_page">上一页</a>';
							$div_page.append(html);
						}
						if($count == $limit)
						{
							var html = '<a href="javascript:void(0);" id="a_next_page">下一页</a>';
							$div_page.append(html);
						}
						
					$ul_article_list.attr('start', $start);
					
					}
					else {
						alert('加载失败');
					}
				
				});
		
		
	});
	

});


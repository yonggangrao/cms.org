$(document).ready(function(){
	
	$('#a_article_delete').bind('click',function(){
		var $id = $(this).attr('article_id');
		$confirm = confirm('真的要删除吗？');
		if(!$confirm)
		{
			return false;
		}
		$.post(
				"/article/delete/"+$id,
				{
					action:'delete', 
					id:$id
				},
				function(data){
					$ret = eval('(' + data + ')');
					if($ret.errno == '0')
					{
						alert('删除成功!');
						var URL = 'http://' + window.location.host;
						window.location.href = URL;
					}
					else
					{
						alert('删除失败');
					}
		  });
		
		
		
		
	});
});









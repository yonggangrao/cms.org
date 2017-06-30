$(document).ready(function(){
	
	$('#input_submit').bind('click',function(){
		var $id = $('#input_blog_id').val();
		var $title = $('#input_article_title').val();
		var $contents = $('#textarea_contents').val();
		var $class = $('#select_article_class').val();
		var $class_input = $('#input_article_class').val();
		
		$.post(
				'/article/update/' + $id,
				{
					action:'update',
					//id:$id,
					title:$title, 
					contents:$contents, 
					class_select:$class, 
					class_input:$class_input
				},
				function(data){
					$ret = eval('(' + data + ')');
					
					if($ret.errno == '0')
					{
						alert('修改成功!');
						window.location.href='/article/display/' + $ret.article_id;
					}
					else
					{
						alert('提交失败');
					}
		  });
		
		
		
		
	});
});









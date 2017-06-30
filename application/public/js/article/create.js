$(document).ready(function(){
	
	$('#input_submit').bind('click',function(){
		var $title = $('#input_article_title').val();
		var $contents = $('#textarea_contents').val();
		var $class = $('#select_article_class').val();
		var $class_input = $('#input_article_class').val();
		
		if($title=='')
		{
			alert('请填写标题');
			return false;
		}
		if($contents=='')
		{
			alert('请填写内容');
			return false;
		}
		$.post(
				"/article/create",
				{
					action:'create', 
					title:$title, 
					contents:$contents, 
					class: $class, 
					class_input: $class_input
					
				},
				function(data){
					$ret = eval('(' + data + ')');
					//alert(data);
					if($ret.errno == 0)
					{
						alert("提交成功");
						//window.location.href='/';
					}
					else
					{
						alert('提交失败');
					}
		  });
		
		
		
		
	});
});









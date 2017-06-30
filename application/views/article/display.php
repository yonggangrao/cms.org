	
	<?php 
		
		$article = $data['ret'];
		//var_dump($article);
		if(empty($article)) die();
	?>
	<div class="div_article_title">
		<?php 
		echo $article['title'];
		?>
	</div>
	
	<div class="div_article_contents">
		<?php 
			$contents = show_blank_enter($article['contents']);
			echo $contents;
		?>
	</div>

	<div class="div_article_class">
		<?php
			if(!empty($article['class']))
				echo '分类：'  . $article['class'];
			
			echo ' ' .$article['time'];
		
		if(1)
		{
			//echo '<div class="">';
			
				echo '<a href="'. HOST .'article/update/'. $article['id']. '">修改</a>';
				echo '<a href="javascript:void(0);" id="a_article_delete" article_id="'. $article['id']. '">删除</a>';
			//echo '</div>';
		}
	
	
	?>
	</div>

	
	

















<?php
	require_once '../../lib/footer.php';
?>
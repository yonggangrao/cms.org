
	<?php 
		$article = $data[0]['ret'];
	?>
	<div class="div_article_title">
		<input id="input_article_title" class="input_article_title" type="text" name="title" placeholder="标题…" value="<?php echo $article['title'];?>">
	</div>
	<div class="div_article_contents">
		<textarea id="textarea_contents" class="textarea_contents" name="contents">
		<?php echo $article['contents'];?>
		</textarea>
	</div>
	
	<div class="div_article_class">

		
		<?php
			$class = $article['class'];
			$class_list = $data[1]['ret'];
		
			$list = array();
			if(is_array($class_list)) //去掉重复的，如果有的话
			{
				foreach($class_list as $key=>$val)
				{
					$list[$val['class']]=$val['class'];
				}
			}
			?>
		<select id="select_article_class" name="class">
			<?php 
			if(is_array($list))
			{
				foreach($list as $key=>$val)
				{
					if(empty($val))continue;
					if($class == $val)
					{
						echo '<option value="'. $val . '" selected="selected">'. $val .'</option>';
					}
					else
					{
						echo '<option value="'. $val . '">'. $val .'</option>';
					}
				}
			}
			
		
		?>
		</select>
		修改标签：<input id="input_article_class" class="input_article_class" type="text" class='new_class'name='new_class'><br/>
		
	</div>
	<div class="div_button_container">
		<input id="input_submit" class="input_submit" type="button" value="提交">
	</div>
	<input id="input_blog_id" type="hidden" value="<?php echo $article['id'];?>">





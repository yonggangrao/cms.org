
	<div class="div_article_title">
		<input id="input_article_title" class="input_article_title" type="text" name="title" placeholder="标题…">
	</div>
	<?php 
	/*
		echo '<pre>';
			print_r($data);
		echo '</pre>';
		*/
	?>
	<div class="div_article_contents">
		<textarea id="textarea_contents" class="textarea_contents" name="contents"></textarea>
	</div>
	<div class="div_article_class">
		<select id="select_article_class" name="class">
			<option value="">未选择</option>
			<?php
			$class_list = $data['ret'];
			if(is_array($class_list))
			{
				foreach($class_list as $key=>$val)
				{
					if(!empty($val['class']))
					{
						echo '<option value="'. $val['class'] . '">'. $val['class'] .'</option>';
					}
						
				}
			}
			?>
		</select>
		添加分类：<input id="input_article_class" type="text" name='new_class'><br/>
	</div>
	
	<div class="div_button_container">
		<input id="input_submit" class="input_submit" type="button" value="提交">
	</div>

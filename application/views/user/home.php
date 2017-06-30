
<div class="left">

	<div class="div-item">
		<ul>
			<li class="li-head">我创建过的会议组织</li>
			
			
			<?php 
			
				//print_varable($_data);
				//print_varable($_SESSION);
				//if(is_array($var))
				$myorg = $_data['myorg'];
				//print_varable($myorg);
				foreach ($myorg as $key=>$val)
				{
					echo '<li >';
						echo '<a class="a-title" href="' . HOST. 'organization/manage/orgi/'. $val['id'] . '">' . $val['name'] . '</a>';
						//echo '<span class="span-time">' . get_time($val['create_time']) . '</span>';
						echo '<a href="javascript:void(0);" class="a-delete-organization a-button" organization_id="' . $val['id'] .'">删除</a>';
					echo '</li>';
				}
			?>

		</ul>
	</div>
	<div class="div-item">
		<ul>
			<li class="li-head">
				我所在的会议组织
			</li>
			<?php 
			
				//print_varable($_data);
				//print_varable($_SESSION);
				//if(is_array($var))
				$myorg = $_data['org'];
				//print_varable($myorg);
				foreach ($myorg as $key=>$val)
				{
					echo '<li>';
					echo '<a class="a-title" href="' . HOST. 'organization/manage/orgi/'. $val['id'] . '" >' . $val['name'] . '</a>';
					echo '</li>';
				}
			?>
			
		</ul>
		
		
		
	</div>
	
	
</div>

<div class="right">
	<div class="div-item">
	<ul class="ul-profile">	
		<li class="li-head li-profile-head">
			个人信息
			<a href="javascript:void(0);" class="a-modify-profile a-button" id="a-modify-profile">修改</a>
		</li>
		<?php 
		$myinfo = $_data['myinfo'];
		//print_varable($myinfo);
		echo '<li>';
			echo '<span class="span-info-title">姓名：</span>';
			echo '<span class="span-info-value name" >' . $myinfo['name'] . '</span>';
		echo '</li>';
		echo '<li>';
			echo '<span class="span-info-title">职位：</span>';
			echo '<span class="span-info-value title">' . $myinfo['title'] . '</span>';
		echo '</li>';
		echo '<li>';
			echo '<span class="span-info-title">简介：</span>';
			echo '<span class="span-info-value profile">' . $myinfo['profile'] . '</span>';
		echo '</li>';
		?>
			
	</ul>
	</div>
	<div class="div-item">
		<a class="a-link" href="<?php echo HOST;?>organization/create" >+ 创建会议组织</a>
	</div>
</div>



	
	

















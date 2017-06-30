
<div class="left">
	<div class="div-item">
		<ul>
			<li class="li-head">会议列表</li>
			<?php 
			//$data['conf_list']
			$conf_list = $_data['conf_list'];
			//print_varable($conf_list);
			foreach($conf_list as $key=>$val)
			{
				echo '<li >';
					echo '<a class="a-title" href="' . HOST. 'conference/manage/' . $val['id'] . '" >' . $val['title'] . '</a> ';
					//echo get_time($val['create_time']);
				echo '</li>';
			}
			
			?>
		</ul>
	</div>
	<div class="div-item">
		<ul>
			<li class="li-head">组织成员</li>
			<li id="li_member">
				<?php 
				
				$org_menber = $_data['org_member'];
				///print_varable($org_menber);
				//print_varable($_SESSION);
				$user_id = get_session('user_id');
				$admin = 0;
				foreach($org_menber as $key=>$val)
				{
					//echo '<a class="a_all_member" href="' . $val['user_id'] . '" >' . $val['user_name'] . '</a> ';
					echo '<span class="span_org_member" >' . $val['user_name'] . '</span> ';

					if(($val['user_id'] == $user_id) && ($val['level'] === '0' || $val['level'] === '1')) {$admin = 1;}
				}
				
				?>
			</li>
			<li >
				<?php 
					//主席和秘书才可以添加成员，创建会议。
					if($admin  === 1)
					{
						echo '<a id="a_add_member" class="button-grey" href="javascript:void(0);" >添加成员</a>';
						//echo '<a class="a_hide_member" id="a_hide_member" href="javascript:void(0);" >收起成员列表</a>';
					}
				
				?>
				
			</li>
		</ul>
	</div>
	<div id="div-all-member" class="div-item div-all-member">
	</div>
	<div id="div-add-member" class="div-item div-add-member">

	</div>
</div>
<input id="input_orgi" type="hidden" value="<?=$_data['orgi']?>">
<div class="right">
	<div class="div-item">
		<ul class="ul-organization-info">
			<?php 
				$org = $_data['myorg'];
				//print_varable($org);
			?>
			<li class="li-head"><?=$org['name'];?></li>
			<li class="text-content">
				<span class="span-title">简介：</span>
				<?=$org['introduction'];?>
			</li>
			<li><span class="span-time">创建时间：<?=get_time($org['create_time']);?></span></li>
			
			
		</ul>
	</div>


	<div class="div-item">
		<ul>
			<li>
				<a class="a-link" href="<?php echo HOST;?>organization/create">+ 创建会议组织</a>
			</li>
			<?php 
			
				//主席和秘书才可以添加成员，创建会议。
				if($admin  === 1)
				{
					echo '<li>';
					echo '<a class="a-link" href="'. HOST. 'conference/create/' . $_data['orgi'] . '">+ 创建会议</a>';
					echo '</li>';
					//echo '<a id="a_add_member" class="button-grey" href="javascript:void(0);" >添加成员</a>';
					//echo '<a class="a_hide_member" id="a_hide_member" href="javascript:void(0);" >收起成员列表</a>';
				}
			
			?>
			
		</ul>
	</div>
	

</div>



	
	

















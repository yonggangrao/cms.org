
<div class="left">
	<div class="div-item">
		<ul>
			<?php 
			//$data['conf_list']
			$conf = $_data['conference'];
			//print_varable($_data['user_level']);
			echo '<li class="li-head">' . $conf['title'] . '</li>';
			echo '<li class="bottom-zero">';
				echo '<span class="span-title">会议部署： </span>';
				echo '<span class="span-value">'. $conf['arrange'] . '</span>' ;
			echo '</li>';
			echo '<li class="bottom-zero">';
				echo '<span class="span-title">会议主题： </span>';
				echo '<span class="span-value">'. $conf['mainbody'] . '</span>' ;
			echo '</li>';
			?>
		</ul>

	</div>

	<div id="div_conf_item" class="div-item">
		<ul id="ul_conf_item" class="ul_conf_item">
			<li class="li-head">会议议程
				<a id="a_add_conf_item" class="a-button" href="javascript:void(0);">添加议程</a>
			</li>
			<?php 
			
				$conf_items = $_data['conf_items'];
				//print_varable($conf_items);
				//$user_id = get_session('user_id');
				//echo 'user_id ' . $user_id;
				
				//echo " &&" . $_data['org_id'];
				foreach($conf_items as $key=>$val)
				{
					echo '<li class="li-conf-item" conference_item_id="' . $key . '">';
						echo '<div class="div-conf-item-title-wraper" >';

							echo '<span class="blue">- </span><span class="span-conf-item-title blue">' . $val['title'] . '</span>';
							echo '<a class="a_modify_conf_item_title a-button" href="javascript:void(0);">修改</a>';
							echo '<a class="a_add_record a-button" href="javascript:void(0);">添加发言</a>';
							echo '<a class="a_delete_item a-button" href="javascript:void(0);">删除议程</a>';
						echo '</div>';
						$record = $val['detail'];
						echo '<div class="div-conf-item-record-wraper" >';
							echo '<ul class="ul-record-item">';
							foreach ($record as $index=>$item)
							{
								if(empty($item['conference_item_details_id'])) continue;
								echo '<li conference_item_details_id="' . $item['conference_item_details_id'] . '">';
								echo '<span class="span-conf-item-title" speaker_id="'.$item['speaker_id'] .'">'. $item['speaker_name'] . '</span>：';
								echo '<div class="div-conf-item-record">'. $item['contents'] . '</div> ';
								if($_data['user_level'] !== '3' )
								echo '<a class="a_modify_record a-button" href="javascript:void(0);">修改发言</a>';
								$user_id = get_session('user_id');
								//$level = get_session('user_level');
								//print_varable($level);
								if($item['speaker_id'] == $user_id)
								{
									$conf_member = $_data['conf_member'];
									foreach($conf_member as $key=>$val)
									{
										if($val['user_id'] == $user_id)
										{
											$conf_user_id = $val['id']; 
											$is_agree = $val['is_agree'];
											break;
										}
									}
									if($is_agree === '0')
									echo '<a class="a_record_comfirm a-button" href="javascript:void(0);" conference_user_id="' . $conf_user_id . '"> 签署认可</a>';
									
								}
								//print_varable($_data['user_level']);
								if($_data['user_level'] !== '3' )
								{
									echo '<a class="a-delete-record a-button" href="javascript:void(0);">删除发言</a>';
								}
								echo '</li>';
							}
							//
							echo '</ul>';
						echo '</div>';
						///echo '<input id="conference_item_details_flag" type="hidden" value="1">';
					echo '</li>';
				}
			?>
			
		</ul>
	
	</div>
</div>
 
<div class="right">

	<div class="div-item">
		<ul class="ul-conference-member">
			<li class="li-head">会议成员</li>
			<li id="li_member" class="li_member">
				<?php 
				
				$conf_member = $_data['conf_member'];
				//print_varable($conf_member);
				foreach($conf_member as $key=>$val)
				{
					echo '<div class="hehe">';
					echo '<span class="span-title" >' . $val['user_name'] . '</span>';
					if(!empty($val['is_qiandao']))
					{
						echo '<span class="span-qiandao">已签到</span>';
					}
					else 
					{
						echo '<span class="span-un-qiandao">未签到</span>';
						$user_id = get_session('user_id');
						if($val['user_id'] == $user_id )
						{
							echo '<a id="a-qiandao" class="a-qiandao a-button" href="javascript:void(0);" conference_user_id="' . $val['id'] . '">签到</a>';
						}
					}
					if(!empty($val['is_agree']))
					{
						echo '<span class="">已签署认可</span>';
					}
					else
					{
						echo '<span class="">未签署认可</span>';
					}
					
					$level = $_data['user_level'];
					//print_varable($level);
					if($level === '0')
					{
						echo '<a class="a-delete-user a-button" href="javascript:void(0);" conference_user_id="' . $val['id'] . '">删除用户</a>';
					}
					//else echo 'sdsdfsd';
					echo '</div>';
				}
				?>
			</li>
			<li >
				 <a id="a_add_conf_member" class="a_add_conf_member button-grey" href="javascript:void(0);" >添加成员</a>
				<!-- <a class="a_hide_conf_member" id="a_hide_conf_member" href="javascript:void(0);" >收起成员列表</a>  -->
			</li>
		</ul>
		
	</div>
	
	<!-- display:none; 用来显示组织成员列表 -->
	<div id="div-all-member" class="div-item div-all-member">
	</div>
	
</div>


<input id="input_confi" type="hidden" value="<?=$_data['conf_id']?>">
<input id="input_orgi" type="hidden" value="<?=$_data['org_id']?>">
	
	

















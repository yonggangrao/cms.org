<?php 

	require_once  MODEL_PATH . 'conferenceModel.php';
	require_once  MODEL_PATH . 'conferenceItemModel.php';
	require_once  MODEL_PATH . 'conferenceItemDetailsModel.php';
	require_once  MODEL_PATH . 'conferenceUserModel.php';
	require_once  MODEL_PATH . 'organizationUserModel.php';
	
	class conferenceController extends controller
	{
		
		public function deleteitemAction()
		{
		
			//$_param = $this->fc->getParams();
		
			$action = get_response('action');
			switch ($action)
			{
				case 'deleteitem':
					$conference_item_id = get_response('conference_item_id');
		
					$o_conf = new conference_item_model();
					$ret = $o_conf->delete_item($conference_item_id);
		
					$data['ret'] = $ret;
					$data['errno'] = $o_conf->get_errno();
					$data['msg'] = $o_conf->get_msg();
					//$data['search'] = $search;
					echo json_encode($data);
		
					break;
		
				default:
			}
		}
		public function deleteRecordAction()
		{
		
			//$_param = $this->fc->getParams();
		
			$action = get_response('action');
			switch ($action)
			{
				case 'deleteRecord':
					$record_id = get_response('record_id');
		
					$o_conf = new conference_item_details_model();
					$ret = $o_conf->delete_record($record_id);
		
					$data['ret'] = $ret;
					$data['errno'] = $o_conf->get_errno();
					$data['msg'] = $o_conf->get_msg();
					//$data['search'] = $search;
					echo json_encode($data);
		
					break;
		
				default:
			}
		}
		public function searchAction()
		{
				
			//$_param = $this->fc->getParams();
				
			$action = get_response('action');
			switch ($action)
			{
				case 'search':
					$search = get_response('search');
						
					$o_conf = new conference_model();
					$ret = $o_conf->search_conference($search);

					$data['ret'] = $ret;
					$data['errno'] = $o_conf->get_errno();
					$data['msg'] = $o_conf->get_msg();
					//$data['search'] = $search;
					echo json_encode($data);
		
					break;
		
				default:

					
				$this->render('conference', 'search');
			}
		}
		
		
		public function recordcomfirmAction()
		{
			$action = get_response('action');
		
			switch ($action)
			{
				case 'comfirm':
		
					$conference_user_id = get_response('conference_user_id');
					$o_conf = new conference_user_model();
					$ret = $o_conf->record_comfirm($conference_user_id);
						
					$data['ret'] = $ret;
					$data['errno'] = $o_conf->get_errno();
					$data['msg'] = $o_conf->get_msg();
		
					echo json_encode($data);
					break;
		
				default:
			}
		}
		
		public function addrecordAction()
		{
			$action = get_response('action');
		
			switch ($action)
			{
				case 'addrecord':
		
					$conference_item_id = get_response('conference_item_id');
					$user_id = get_response('user_id');
					$contents = get_response('record');
					$o_conf = new conference_item_details_model();
					$ret = $o_conf->add_record($conference_item_id, $user_id, $contents);
		
					$data['ret'] = $ret;
					$data['errno'] = $o_conf->get_errno();
					$data['msg'] = $o_conf->get_msg();
		
					echo json_encode($data);
					break;
		
				default:
			}
		}
		
		public function deleteuserAction()
		{
			$action = get_response('action');
		
			switch ($action)
			{
				case 'delete':
		
					$conference_user_id = get_response('conference_user_id');
					$o_conf = new conference_user_model();
					$ret = $o_conf->delete_user($conference_user_id);
						
					$data['ret'] = $ret;
					$data['errno'] = $o_conf->get_errno();
					$data['msg'] = $o_conf->get_msg();
		
					echo json_encode($data);
					break;
		
				default:
			}
		}
		
		public function qiandaoAction()
		{
			$action = get_response('action');
		
			switch ($action)
			{
				case 'qiandao':
		
					$conference_user_id = get_response('conference_user_id');
					$o_conf = new conference_user_model();
					$ret = $o_conf->qiandao($conference_user_id);
			
					$data['ret'] = $ret;
					$data['errno'] = $o_conf->get_errno();
					$data['msg'] = $o_conf->get_msg();
		
					echo json_encode($data);
					break;
		
				default:
			}
		}
		
		public function addMemberAction()
		{
			$action = get_response('action');
				
			switch ($action)
			{
				case 'addMember':
		
					$conf_id = get_response('conf_id');
					$user_id = get_response('user_id');
					$o_conf = new conference_user_model();
					$ret = $o_conf->add_member($conf_id, $user_id);
		
					$data['ret'] = $ret;
					$data['errno'] = $o_conf->get_errno();
					$data['msg'] = $o_conf->get_msg();
		
					echo json_encode($data);
					break;
		
				default:
			}
		}
		
		public function getOrgMemberAction()
		{
			$action = get_response('action');
			
			switch ($action)
			{
				case 'getOrgMember':
		
					$conf_id = get_response('conf_id');
					$o_conf = new conference_model();
					$ret = $o_conf->get_organization_member_confi($conf_id);
		
					$data['ret'] = $ret;
					$data['errno'] = $o_conf->get_errno();
					$data['msg'] = $o_conf->get_msg();
		
					echo json_encode($data);
					break;
		
				default:
			}
		}
		
		public function modifyItemRecordAction()
		{
			$action = get_response('action');
			switch ($action)
			{
				case 'modifyRecord':
						
					$record = get_response('record');
					$conference_item_details_id = get_response('conference_item_details_id');
					$o_conf_item = new conference_item_details_model();
					$ret = $o_conf_item->update_record($record, $conference_item_details_id);
						
					$data['ret'] = $ret;
					$data['errno'] = $o_conf_item->get_errno();
					$data['msg'] = $o_conf_item->get_msg();
						
					echo json_encode($data);
					break;
		
				default:
			}
		}
		public function modifyItemTitleAction()
		{
			$action = get_response('action');
			switch ($action)
			{
				case 'modifyTitle':
					
					$title = get_response('title');
					$conference_item_id = get_response('conference_item_id');
					$o_conf_item = new conference_item_model();
					$ret = $o_conf_item->update_conference_item_title($title, $conference_item_id);
					
					$data['ret'] = $ret;
					$data['errno'] = $o_conf_item->get_errno();
					$data['msg'] = $o_conf_item->get_msg();
					
					echo json_encode($data);
					break;
				
				default:
			}
		}
		
		
		public function createitemAction()
		{
			//$_param = $this->fc->getParams();
			
			$action = get_response('action');
			switch ($action)
			{
				case 'createitem':
					$title = get_response('title');
					$conf_id = get_response('conf_id');
					
					$o_conf = new conference_item_model();
					$ret = $o_conf->add_item($title, $conf_id);
					if($ret !== false)
					{
						$data['conference_item_id'] = $ret;
						$data['ret'] = true;
					}
					else
					{
						$data['ret'] = false;
					}
					
					$data['errno'] = $o_conf->get_errno();
					$data['msg'] = $o_conf->get_msg();
					echo json_encode($data);
		
					break;
		
				default:
 
			}
		}
		
		
		public function manageAction()
		{
			$_param = $this->fc->getParams();
			$conf_id = $_param[0];
			$action = get_response('action');
			switch ($action)
			{
				case 'modifyItem':
					
					
					$title = get_response('title');
					$conf_id = get_response('conf_id');
					$conference_item_id = get_response('conference_item_id');
					$detail = get_response('detail');
					$tag = get_response('tag');
					$o_conf_item = new conference_item_model();
					$ret = $o_conf_item->update_conference_item_itemi($conference_item_id, $title);
					
					
					if($ret !== false)
					{
						//$data['ret'] = true;
						$o_conf_item_detail = new conference_item_details_model();
						if($tag == 0)
						{
							$ret = $o_conf_item_detail->add_item($conference_item_id, $detail);
							if($ret !== false)
							{
								$data['conf_item_detail_id'] = $ret;
								$data['ret'] = true;
							}
							else 
							{
								$data['ret'] = false;
							}
							$data['errno'] = $o_conf_item_detail->get_errno();
							$data['msg'] = $o_conf_item_detail->get_msg();
						}
						else 
						{
							$data['ret'] = true;
						}
					}
					else
					{
						$data['ret'] = false;
						$data['errno'] = $o_conf_item->get_errno();
						$data['msg'] = $o_conf_item->get_msg();
					}
					
					echo json_encode($data);
					break;
				
				default:
					if(!is_login())
					{
						$this->render('user', 'login');
						return false;
					}
					if(empty($conf_id))
					{
						$this->render('error', 'error');
						return false;
					}
					
					$data['conf_id'] = $conf_id;
					$o_conf = new conference_model();
					$ret = $o_conf->get_conference_confi($conf_id);
					
					
					$data['conference'] = $ret;
					$org_id = $ret['organization_id'];
					
					if($ret === false)
					{
						$this->render('error', 'error');
						$data['errno'] = $o_conf->get_errno();
						$data['msg'] = $o_conf->get_msg();
						exit;
					}
					$o_conf_item = new conference_item_model();
					$ret = $o_conf_item->get_conference_item_confi($conf_id);
					
					$data['errno'] = $o_conf_item->get_errno();
					$data['msg'] = $o_conf_item->get_msg();
					if($ret === false)
					{
						$this->render('error', 'error');
						exit;
					}
					$data['conf_items'] = $ret;
					
					
					
					/**
					 *	获取会议成员
					 */
					$o_conf_user = new conference_user_model();
					$ret = $o_conf_user->get_conference_member($conf_id);
					$data['errno'] = $o_conf_user->get_errno();
					$data['msg'] = $o_conf_user->get_msg();
					if($ret === false)
					{
						$this->render('error', 'error');
						exit;
					}
					$data['conf_member'] = $ret;
					
					/**
					 *获取当前用户的权限
					 */
					$org_user = new organization_user_model();
					$ret = $org_user->get_organization_user_level($org_id);
					$data['user_level'] = $ret['level'];
					
					
					$data['org_id'] = $org_id;
					$data['conf_id'] = $conf_id;
					$this->render('conference', 'manage', $data);
						
			}
		}
		
		public function createAction()
		{
			
			$_param = $this->fc->getParams();
			
			$action = get_response('action');
			switch ($action)
			{
				case 'create':
					$title = get_response('title');
					$arrange = get_response('arrange');
					$mainbody = get_response('mainbody');
					$organization_id = $_param[0];
					
					
					$o_conf = new conference_model();
					$ret = $o_conf->create($title, $arrange, $mainbody, $organization_id);
					if($ret !== false)
					{
						$data['conference_id'] = $ret;
						$data['ret'] = true;
					}
					else
					{
						$data['ret'] = false;
					}
					
					$data['errno'] = $o_conf->get_errno();
					$data['msg'] = $o_conf->get_msg();
					
					$data['org_id'] = $_param;
					echo json_encode($data);
		
					break;
		
				default:
					if(!is_login())
					{
						$this->render('user', 'login');
						return false;
					}
					if(empty($_param[0]))
					{
						$this->render('error', 'error');
					}
					else 
					{
						$this->render('conference', 'create', $_param);
					}
			}
		}
	}
?>
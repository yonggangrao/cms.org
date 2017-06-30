<?php 

	require_once  MODEL_PATH . 'organizationModel.php';
	require_once  MODEL_PATH . 'organizationUserModel.php';
	require_once  MODEL_PATH . 'userModel.php';
	require_once  MODEL_PATH . 'conferenceModel.php';

	class organizationController extends controller
	{
		public function manageAction()
		{
			$_param = $this->fc->getParams();
			$orgi = $_param[1];
			$action = get_response('action');
			switch ($action)
			{
				case 'get_member':
					
					$o_user = new user_model();
					$ret = $o_user->get_all_user();
					
					$data['ret'] = $ret;
					$data['errno'] = $o_user->get_errno();
					$data['msg'] = $o_user->get_msg();
					
					echo json_encode($data);
					break;
					
				case 'addmember':
					$orgi = get_response('orgi');
					$user_id = get_response('user_id');
					$level = get_response('level');
					$o_org_user = new organization_user_model();
					$org_user_id = $o_org_user->add_one($orgi, $user_id, $level);
					if($org_user_id !== false)
					{
						$data['organization_user_id'] = $org_user_id;
						$data['ret'] = true;
					}
					else
					{
						$data['ret'] = false;
					}
					$data['errno'] = $o_org_user->get_errno();
					$data['msg'] = $o_org_user->get_msg();
					//$data['ret'] = $user_id;
					echo json_encode($data);
				
					break;
					
				default:
					if(!is_login())
					{
						$this->render('user', 'login');
						return false;
					}
					$o_conf = new conference_model();
					$ret = $o_conf->get_conference_orgi($orgi);
					if($ret !== false)
					{
						$data['conf_list'] = $ret;
						$data['ret'] = true;
					}
					else 
					{
						$data['errno'] = $o_conf->get_errno();
						$data['msg'] = $o_conf->get_msg();
					}
					
					$o_org = new organization_model();
					$ret = $o_org->get_organization_orgi($orgi);
					$data['myorg'] = $ret;
					if($ret !== false)
					{
						$o_org_user = new organization_user_model();
						$ret = $o_org_user->get_organization_member_orgi($orgi);
						if($ret !== false)
						{
							$data['org_member'] = $ret;
							$data['ret'] = true;
						}
						else 
						{
							$data['ret'] = false;
						}
						$data['errno'] = $o_org_user->get_errno();
						$data['msg'] = $o_org_user->get_msg();
					}
					else 
					{
						$data['ret'] = false;
						$data['errno'] = $o_org->get_errno();
						$data['msg'] = $o_org->get_msg();
					}
					$data['orgi'] = $orgi;
					$this->render('organization', 'manage', $data);
			}
		}
		public function createAction()
		{
			$action = get_response('action');
			switch ($action)
			{
				case 'create':
					$name = get_response('name');
					$introduction = get_response('introduction');
					
					$o_org = new organization_model();
					$ret = $o_org->create($name, $introduction);
					if(ret !== false)
					{
						$data['organization_id'] = $ret;
						$o_org_user = new organization_user_model();
						$organization_id = $ret;
						$level = 0;
						$user_id = get_session('user_id');
						$org_user_id = $o_org_user->add_one($organization_id, $user_id, $level);
						if($org_user_id !== false)
						{
							$data['organization_user_id'] = $org_user_id;
							$data['ret'] = true;
						}
						else 
						{
							$data['ret'] = false;
						}
						$data['errno'] = $o_org_user->get_errno();
						$data['msg'] = $o_org_user->get_msg();
					}
					else
					{
						$data['ret'] = false;
						$data['errno'] = $o_org->get_errno();
						$data['msg'] = $o_org->get_msg();
					}

		
					echo json_encode($data);
		
					break;
		
				default:
					if(!is_login())
					{
						$this->render('user', 'login');
						return false;
					}
					$this->render('organization', 'create');
		
			}
		}
	}
?>
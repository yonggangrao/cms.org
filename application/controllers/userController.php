<?php 

	require_once  MODEL_PATH . 'userModel.php';
	require_once  MODEL_PATH . 'organizationModel.php';

	class userController extends controller
	{
		public function homeAction()
		{
			$action = get_response('action');
			switch ($action)
			{
				
				case 'modifyProfile':
						
					$name = get_response('name');
					$title = get_response('title');
					$profile = get_response('profile');
						
					$user = new user_model();
					$ret = $user->modify_profile($name, $title, $profile);
				
					$data['ret'] = $ret;
					$data['errno'] = $user->get_errno();
					$data['msg'] = $user->get_msg();
				
					echo json_encode($data);
						
					break;
				case 'delete_organization':
					
					$organization_id = get_response('organization_id');
					
					$organization = new organization_model();
					$ret = $organization->delete_organization($organization_id);
						
					$data['ret'] = $ret;
					$data['errno'] = $organization->get_errno();
					$data['msg'] = $organization->get_msg();
						
					echo json_encode($data);
					
					break;
				
				default:
					if(!is_login())
					{
						$this->render('user', 'login');
						return false;
					}
					//获取我创建过都组织
					$o_org = new organization_model();
					$ret = $o_org->get_organization_userid();
					$data['myorg'] = $ret;
					$data['errno'] = $o_org->get_errno();
					$data['msg'] = $o_org->get_msg();
					
					//获取我的个人信息
					$o_user = new user_model();
					$ret = $o_user->get_user_info();
					$data['myinfo'] = $ret;
					$data['errno'] = $o_user->get_errno();
					$data['msg'] = $o_user->get_msg();
					
					//获取我所在都组织
					$o_user = new user_model();
					$ret = $o_user->get_my_organization();
					$data['org'] = $ret;
					$data['errno'] = $o_user->get_errno();
					$data['msg'] = $o_user->get_msg();
					
					
					$this->render('user', 'home', $data);
						
			}
		}
		
		public function logoutAction()
		{
			$action = get_response('action');
			switch ($action)
			{
				default:
					
					logout();
						
					$this->render('user', 'login');
			}
		}
		
		public function loginAction()
		{	
			$action = get_response('action');
			switch ($action)
			{
				case 'login':
					$name = get_response('name');
					$password = get_response('password');
					$o_user = new user_model();
					$ret = $o_user->login($name, $password);
					
					$data['ret'] = $ret;
					$data['errno'] = $o_user->get_errno();
					$data['msg'] = $o_user->get_msg();
					
					echo json_encode($data);
					
					break;
					
				default:
					
					$this->render('user', 'login');
			}
		}
		
		public function signAction()
		{
			$action = get_response('action');
			switch ($action)
			{
				case 'sign':
					$name = get_response('name');
					$title = get_response('title');
					$profile = get_response('profile');
					$password = get_response('password');
					$o_user = new user_model();
					$ret = $o_user->sign($name, $password, $title, $profile);
					if(ret !== false)
					{
						$data['user_id'] = $ret;
						$data['ret'] = true;
					}
					else 
					{
						$data['ret'] = false;
					}
					
					$data['errno'] = $o_user->get_errno();
					$data['msg'] = $o_user->get_msg();
						
					echo json_encode($data);
						
					break;
						
				default:
						
					$this->render('user', 'sign');
						
			}
		}
	}
?>
<?php
	require_once MODEL_PATH . 'model_base.php';

	class user_model extends model_base
	{
		private $db = 'cms';
		private $tb = 'user';
		
		public function __construct()
		{
			parent::__construct($this->db, $this->tb);
		}
		
		public function modify_profile($name, $title, $profile)
		{
			$user_id = get_session('user_id');
			if(empty($user_id))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$msg = CONFIGURE::PARAM_ILLEGAL . ', Method: '  . __METHOD__;
				$this->set_msg($msg);
				return false;
			}
			$set = array('name', 'title', 'profile');
			$values = array($name, $title, $profile);
			$where = array('id');
			$where_value = array($user_id);
			
			return $this->update($set, $values, $where, $where_value);
		}
		
		public function get_my_organization()
		{
			$user_id = get_session('user_id');
			if(empty($user_id))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$msg = CONFIGURE::PARAM_ILLEGAL . ', Method: '  . __METHOD__;
				$this->set_msg($msg);
				return false;
			}
			$sql = 'select organization.id,organization.name from organization, organization_user ';
			$sql .= 'where organization.id=organization_user.organization_id and organization_user.user_id=? and is_deleted="0";';
			$values = array($user_id);
			$type = CONFIGURE::SQL_QUERY_LIST;
			return $this->execute($sql, $values, $type);
		}
		
		 //获取用户信息
		public function get_user_info()
		{
			$user_id = get_session('user_id');
			if(empty($user_id))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$msg = CONFIGURE::PARAM_ILLEGAL . ', Method: '  . __METHOD__;
				$this->set_msg($msg);
				return false;
			}
			$select = array("*");
			$where = array('id');
			$where_value = array($user_id);
		
			return $this->get_one($select, $where, $where_value);
		}
		
		public function get_all_user()
		{
			$select = array("id","name");
			$where = array();
			$where_value = array();
				
			return $this->get_list($select, $where, $where_value);
		}
		
		public function login($name, $password)
		{
			$select = array("*");
			$where = array("name");
			$where_value = array($name);
			
			$ret = $this->get_one($select, $where, $where_value);
			$pass = $ret['password'];
			$user_id = $ret['id'];
			//$user_level = $ret['lev'];
			if($pass === $password)
			{
				set_login($user_id, $name);
				return true;
			}
			else 
			{
				return false;
			}
		}
		
		public function sign($name, $password, $title, $profile)
		{
			$insert = array("name", "password", "title", "profile");
			$values = array($name, $password, $title, $profile);
			
			return $this->insert($insert, $values);
		}
	}


?>

<?php
	require_once MODEL_PATH . 'model_base.php';

	class organization_user_model extends model_base
	{
		private $db = 'cms';
		private $tb = 'organization_user';
		
		public function __construct()
		{
			
			parent::__construct($this->db, $this->tb);
		}
		
		public function get_organization_user_level($organization_id)
		{
			$user_id = get_session('user_id');
			if(empty($user_id))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$msg = CONFIGURE::PARAM_ILLEGAL . ', Method: '  . __METHOD__;
				$this->set_msg($msg);
				return false;
			}
			$select = array('level');
			$where = array('organization_id', 'user_id');
			$where_value = array($organization_id, $user_id);
			return $this->get_one($select, $where, $where_value);
		}
		
		public function get_organization_member_orgi($orgi)
		{
			$sql = 'select user.id as user_id, user.name as user_name, level from user, organization_user ';
			$sql .= 'where user.id=organization_user.user_id and organization_id=?;';
			$values = array($orgi);
			$type = CONFIGURE::SQL_QUERY_LIST;
			return $this->execute($sql, $values, $type);
		}
		public function add_one($organization_id, $user_id, $level)
		{
			//$user_id = get_session('user_id');
			if(empty($user_id))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$msg = CONFIGURE::PARAM_ILLEGAL . ', Method: '  . __METHOD__;
				$this->set_msg($msg);
				return false;
			}
			$insert = array("organization_id", 'user_id', "level");
			$values = array($organization_id, $user_id, $level);
			
			return $this->insert($insert, $values);
		}
	}
?>

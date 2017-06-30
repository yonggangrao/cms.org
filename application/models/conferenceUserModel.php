<?php
	require_once MODEL_PATH . 'model_base.php';

	class conference_user_model extends model_base
	{
		private $db = 'cms';
		private $tb = 'conference_user';
		
		public function __construct()
		{
			
			parent::__construct($this->db, $this->tb);
		}
		

		
		public function record_comfirm($conference_user_id)
		{
			$user_id = get_session('user_id');
			if(empty($user_id))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$msg = CONFIGURE::PARAM_ILLEGAL . ', Method: '  . __METHOD__;
				$this->set_msg($msg);
				return false;
			}
			$set = array('is_agree');
			$values = array('1');
			$where = array('id', 'user_id');
			$where_value = array($conference_user_id, $user_id);
				
			return $this->update($set, $values, $where, $where_value);
		}
		
		
		public function delete_user($conference_user_id)
		{
			$where = array('id');
			$where_value = array($conference_user_id);
				
			return $this->delete($where, $where_value);
		}
		
		public function qiandao($conference_user_id)
		{
			$user_id = get_session('user_id');
			if(empty($user_id))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$msg = CONFIGURE::PARAM_ILLEGAL . ', Method: '  . __METHOD__;
				$this->set_msg($msg);
				return false;
			}
			$set = array('is_qiandao');
			$values = array('1');
			$where = array('id', 'user_id');
			$where_value = array($conference_user_id, $user_id);
			
			return $this->update($set, $values, $where, $where_value);
		}
		
		public function add_member($conf_id, $user_id)
		{
			$insert = array("conference_id", 'user_id');
			$values = array($conf_id, $user_id);
		
			return $this->insert($insert, $values);
		}
		
		public function get_conference_member($conf_id)
		{
			$sql = 'select user.name as user_name, conference_user.* from user, conference_user ';
			$sql .= 'where user.id=conference_user.user_id and conference_id=?;';
			$values = array($conf_id);
			$type = CONFIGURE::SQL_QUERY_LIST;
			return $this->execute($sql, $values, $type);
		}

	}
?>

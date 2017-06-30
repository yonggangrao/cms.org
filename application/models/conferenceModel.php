<?php
	require_once MODEL_PATH . 'model_base.php';

	class conference_model extends model_base
	{
		private $db = 'cms';
		private $tb = 'conference';
		
		public function __construct()
		{
			
			parent::__construct($this->db, $this->tb);
		}
		
		public function search_conference($search)
		{
			$sql = 'select id, title from conference where title like "%' . $search;
					
			$sql .= '%";';
			
			$values = array();
			$type = CONFIGURE::SQL_QUERY_LIST;
			return $this->execute($sql, $values, $type);
		}
		
		
		public function get_organization_member_confi($conf_id)
		{
			$sql = 'select user.id as user_id, user.name as user_name from user, organization_user, conference ';
			$sql .= 'where user.id=organization_user.user_id and conference.organization_id=organization_user.organization_id and conference.id=?;';
			$values = array($conf_id);
			$type = CONFIGURE::SQL_QUERY_LIST;
			return $this->execute($sql, $values, $type);
		}
		
		public function get_conference_confi($conf_id)
		{
			$select = array('*');
			$where = array('id');
			$where_value = array($conf_id);
			return $this->get_one($select, $where, $where_value);
		}
		
		public function get_conference_orgi($organization_id)
		{
			$select = array('*');
			$where = array('organization_id');
			$where_value = array($organization_id);
			return $this->get_list($select, $where, $where_value);
		}
		
		public function create($title, $arrange, $mainbody, $organization_id)
		{
			$creater_id = get_session('user_id');
			if(empty($creater_id))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$msg = CONFIGURE::PARAM_ILLEGAL . ', Method: '  . __METHOD__;
				$this->set_msg($msg);
				return false;
			}

			$create_time = time();
			$insert = array("title", "arrange", "mainbody", 'organization_id', 'creater_id', 'create_time');
			$values = array($title, $arrange, $mainbody, $organization_id, $creater_id, $create_time);
			return $this->insert($insert, $values);
		}
	}
?>

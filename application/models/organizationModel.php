<?php
	require_once MODEL_PATH . 'model_base.php';

	class organization_model extends model_base
	{
		private $db = 'cms';
		private $tb = 'organization';
		
		public function __construct()
		{
			
			parent::__construct($this->db, $this->tb);
		}
		
		
		public function delete_organization($organization_id)
		{

			$set = array("is_deleted");
			$values = array("1");
			$where = array('id');
			$where_value = array($organization_id);
		
			return $this->update($set, $values, $where, $where_value);
		}
		
		public function get_organization_orgi($orgi)
		{
			if(empty($orgi))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$msg = CONFIGURE::PARAM_ILLEGAL . ', Method: '  . __METHOD__;
				$this->set_msg($msg);
				return false;
			}
			$select = array("*");
			$where = array('id');
			$where_value = array($orgi);
		
			return $this->get_one($select, $where, $where_value);
		}
		public function get_organization_userid()
		{
			$creater_id = get_session('user_id');
			if(empty($creater_id))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$msg = CONFIGURE::PARAM_ILLEGAL . ', Method: '  . __METHOD__;
				$this->set_msg($msg);
				return false;
			}
			$select = array("id, name, create_time");
			$where = array('creater_id', 'is_deleted');
			$where_value = array($creater_id, '0');
				
			return $this->get_list($select, $where, $where_value);
		}
		public function create($name, $introduction)
		{
			$creater_id = get_session('user_id');
			if(empty($creater_id))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$msg = CONFIGURE::PARAM_ILLEGAL . ', Method: '  . __METHOD__;
				$this->set_msg($msg);
				return false;
			}
			$time = time();
			$insert = array("name", "creater_id", "introduction", "create_time");
			$values = array($name, $creater_id, $introduction, $time);
			
			return $this->insert($insert, $values);
		}
	}
?>

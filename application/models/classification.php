<?php
	require_once MODEL_PATH . 'sql_base.php';

	class classification_model extends sql_base
	{
		private $db = 'suineg';
		private $tb = 'classification';
		
		public function __construct()
		{
			
			parent::__construct($this->db, $this->tb);
		}
		
		public function add($name)
		{
			if(empty($name))
			{
				//$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				//$this->set_msg(CONFIGURE::PARAM_ILLEGAL);
				return false;
			}
			$insert = array('name');
			$values = array($name);
			
			return $this->insert($values, $insert);
			
		}
		public function get_classification_list()
		{
			$select = array('name');
			$where = array();
			$where_value = array();
			$others = array();
			return $this->get_list($select);
		}
		
	}


?>

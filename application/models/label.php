<?php
	require_once MODEL_PATH . 'model_base.php';

	class label_model extends model_base
	{
		private $db = 'suineg';
		private $tb = 'label';
		
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
			
			return $this->insert($insert, $values);
			
		}
		public function get_label_list()
		{
			$select = array('name');
			$where = array();
			$where_value = array();
			$others = array();
			return $this->get_list($select);
		}
	}


?>

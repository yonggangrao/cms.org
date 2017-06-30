<?php
	require_once MODEL_PATH . 'model_base.php';

	class conference_item_details_model extends model_base
	{
		private $db = 'cms';
		private $tb = 'conference_item_details';
		
		public function __construct()
		{
			
			parent::__construct($this->db, $this->tb);
		}
		
		public function delete_record($record_id)
		{
			$where = array('id');
			$where_value = array($record_id);
		
			return $this->delete($where, $where_value);
		}
		
		public function update_record($record, $conference_item_details_id)
		{
			$set = array('contents');
			$values = array($record);
			$where = array('id');
			$where_value = array($conference_item_details_id);
			return $this->update($set, $values, $where, $where_value);
		}
		public function add_record($conference_item_id, $speaker_id, $contents)
		{
			$create_time = time();
			$insert = array("conference_item_id", 'speaker_id', "contents", "create_time");
			$values = array($conference_item_id, $speaker_id, $contents, $create_time);
			
			return $this->insert($insert, $values);
		}
	}
?>

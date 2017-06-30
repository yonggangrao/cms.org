<?php
	require_once MODEL_PATH . 'model_base.php';

	class conference_item_model extends model_base
	{
		private $db = 'cms';
		private $tb = 'conference_items';
		
		public function __construct()
		{
			
			parent::__construct($this->db, $this->tb);
		}
		
		
		public function delete_item($conference_item_id)
		{
			$set = array('is_deleted');
			$values = array('1');
			$where = array('id');
			$where_value = array($conference_item_id);
			return $this->update($set, $values, $where, $where_value);
		}
		
		
		public function get_conference_item_confi($conf_id)
		{

			$sql = 'select conference_items.id as conference_items_id, is_deleted, title, temp_table.id as conference_item_details_id, contents, temp_table.name, temp_table.speaker_id ';
			$sql .= 'from conference_items left join (select user.name, conference_item_details.* from user,conference_item_details where user.id= conference_item_details.speaker_id) temp_table ';
			$sql .= ' on conference_items.id = temp_table.conference_item_id  where is_deleted="0" and conference_items.conference_id=?;';
			//$sql .= 'where conference_item_details.speaker_id = ;';
			$values = array($conf_id);
			$type = CONFIGURE::SQL_QUERY_LIST;
			$ret = $this->execute($sql, $values, $type);
			if($ret === false)
			{
				return false;
			}
			
			$conf_item = array();
			foreach ($ret as $item)
			{
				$id = $item['conference_items_id'];
				$conf_item[$id]['title'] = $item['title'];
				$count = count($conf_item[$id]['detail']);
				$conf_item[$id]['detail'][$count] = array('conference_item_details_id'=>$item['conference_item_details_id'], 'contents'=>$item['contents'],
														'speaker_name'=>$item['name'], 'speaker_id'=>$item['speaker_id']);
			}
		
			return $conf_item;
		}
		
		public function update_conference_item_title($title, $conference_item_id)
		{
			$set = array('title');
			$values = array($title);
			$where = array('id');
			$where_value = array($conference_item_id);
			return $this->update($set, $values, $where, $where_value);
		}
		
		public function add_item($title, $conference_id)
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
			$insert = array("title", "conference_id", "creater_id", "create_time");
			$values = array($title, $conference_id, $creater_id, $create_time);
			
			return $this->insert($insert, $values);
		}
	}
?>

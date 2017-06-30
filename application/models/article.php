<?php
	require_once /* MODEL_PATH . */ 'model_base.php';

	class article_model extends model_base
	{
		private $db = 'suineg';
		private $tb = 'article';
		
		public function __construct()
		{
			parent::__construct($this->db, $this->tb);
		}
		
		public function create($title, $contents, $class, $class_input)
		{
			if(empty($title) || empty($contents) 
				|| (empty($class) && empty($class_input)))
				{
					$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
					$msg = CONFIGURE::PARAM_ILLEGAL . ', Method: '  . __METHOD__;
					$this->set_msg($msg);
					return false;
				}

			if(!empty($class_input))
			{
				$class = $class_input;
			}
			$time=time();
			$insert = array("title", "contents", "class","time");
			$values = array($title, $contents, $class, $time);
			
			return $this->insert($insert, $values);
		}
		
		
		public function get_article_class_list()
		{
			$select = array("class");
			$where = array();
			$where_value = array();
			
			$others['group_by'] = "class";
			
			$res = $this->get_list($select, $where, $where_value, $others);
			
			return $res;
		}
		
		
		public function display($id)
		{
			if(!is_numeric($id))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$msg = CONFIGURE::PARAM_ILLEGAL . ', Method: '  . __METHOD__;
				$this->set_msg($msg);
				return false;
			}
			$where = array('id');
			$where_value = array($id);
			$select = array('*');
			$res = $this->get_one($select, $where, $where_value);
			$res['contents'] = show_blank_enter($res['contents']);
			return $res;
		}

		public function get_article($id)
		{
			if(!is_numeric($id))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$msg = CONFIGURE::PARAM_ILLEGAL . ', Method: '  . __METHOD__;
				$this->set_msg($msg);
				return false;
			}
			$where = array('id');
			$where_value = array($id);
			$select = array('*');
			$res = $this->get_one($select, $where, $where_value);
				
			return $res;
		}
		
		public function update($id, $title, $class, $contents)
		{
			if(empty($title) || empty($contents)
				|| (empty($class) && empty($id)))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$msg = CONFIGURE::PARAM_ILLEGAL . ', Method: '  . __METHOD__;
				$this->set_msg($msg);
				return false;
			}
			
			$set = array('title', 'class', 'contents');
			$values = array($title, $class, $contents);
			$where = array('id');
			$where_value = array($id);
			
			$res = parent::update($set, $values, $where, $where_value);
			return $res;
		}
		
		public function delete($id)
		{
			if(!is_numeric($id))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$msg = CONFIGURE::PARAM_ILLEGAL . ', Method: '  . __METHOD__;
				$this->set_msg($msg);
				return false;
			}
			$where = array('id');
			$where_value = array($id);
			$res = parent::delete($where, $where_value);
			return $res;
		}
		
		
		
		
		public function get_all_list($start, $limit)
		{
			if(!is_numeric($start) || !is_numeric($limit))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$msg = CONFIGURE::PARAM_ILLEGAL . ', Method: '  . __METHOD__;
				$this->set_msg($msg);
				return false;
			}
			$select = array('*');
			$where = array();
			$where_value = array();
			$others['order_by'] = 'time';
			$others['order'] = 'DESC';
			$others['start'] = $start   ;
			$others['limit']  = $limit;

			$article = parent::get_list($select, $where, $where_value, $others);
			if($article == false)
			{
				return $article;
			}
			
			$count = count($article);
			for($i = 0; $i < $count; $i++)
			{
				$row = $article[$i];
		
				$article[$i]['contents'] = mb_substr($row['contents'],0,160,'utf-8');
		
			}
			return $article;
		}
		

		
		
		
	}


















?>
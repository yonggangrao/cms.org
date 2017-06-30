<?php

	require_once 'sql_base.php';
	
	class model_base extends sql_base
	{
		
		protected function __construct($database, $table)
		{
			parent::__construct($database, $table);
		}
		
		public function get_one($select, $where, $where_value)
		{
			$count = count($where_value);
			for($i=0; $i<$count; $i++)
			{
				$values[$i] = addslashes($values[$i]);
			}
			 
			$ret = parent::get_one($select, $where, $where_value);
			
			$ret = $ret[0];
			foreach($ret as $key=>$val)
			{
				$ret[$key] = stripslashes($val);
				
				if(is_numeric($ret['time']))
				{
					$ret['time'] = get_time($ret['time']);
				}
			}
			return $ret;
		}
		
		
		public function get_list($select, $where, $where_value, $others)
		{

			$count = count($where_value);
			for($i=0; $i<$count; $i++)
			{
				$values[$i] = addslashes($values[$i]);
			}
			 
			$ret = parent::get_list($select, $where, $where_value, $others);
			
			$count = count($ret);
			for($i=0;$i<$count;$i++)
			{
				foreach($ret[$i] as $key=>$val)
				{
					$ret[$i][$key] = stripslashes($val);
					//$ret[$i][$key] = show_blank_enter($val);
				}
				if(is_numeric($ret[$i]['time']))
				{
					$ret[$i]['time'] = get_time($ret[$i]['time']);
				}
			}
			return $ret;
		}
		


		public function insert($insert, $values)
		{
			$count = count($values);
			for($i=0; $i<$count; $i++)
			{
				$values[$i] = addslashes($values[$i]);
				$values[$i] = strip_tags($values[$i]);
			}
			return parent::insert($insert, $values);
		}
		
		

		public function delete($where, $where_value)
		{
			$count = count($where_value);
			for($i=0; $i<$count; $i++)
			{
				$where_value[$i] = addslashes($where_value[$i]);
			}
			return parent::delete($where, $where_value);
		}

		
		
		public function update($set, $values, $where, $where_value)
		{
			$count = count($values);
			for($i=0; $i<$count; $i++)
			{
				$values[$i] = addslashes($values[$i]);
				$values[$i] = strip_tags($values[$i]);
			}
			$count = count($where_value);
			for($i=0; $i<$count; $i++)
			{
				$where_value[$i] = addslashes($where_value[$i]);
			}
			return parent::update($set, $values, $where, $where_value);
		}
	}
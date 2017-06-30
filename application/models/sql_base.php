<?php
	class sql_base
	{
		private $host;
		private $database;
		private $table;
		private $user;
		private $password;
		private $pdo;
		private $errno;
		private $msg;
		
		protected function __construct($database, $table)
		{
			
			self::db_config($database, $table);
			try
			{
				$host = "mysql:host=$this->host;dbname=$this->database";
				$this->pdo = new PDO($host, $this->user, $this->password);
				$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				$this->pdo->exec("SET NAMES UTF8");
			}
			catch(PDOException $e)
			{
				$this->set_errno(CONFIGURE::DB_OPERATION_ERRNO);
				$msg = $e->getMessage() . ', Method: '  . __METHOD__;
				$this->set_msg($msg);
				return false;
			}
			
		}
		
		
		public function get_one($select, $where, $where_value)
		{
			if(!is_array($where) || !is_array($where_value)
				|| !is_array($select) || empty($select))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$msg = CONFIGURE::PARAM_ILLEGAL . ', Method: '  . __METHOD__;
				$this->set_msg($msg);
				return false;
			}
		
			$count = count($select);
			$sql = "SELECT ";
			$flag = 0;
			for($i=0; $i<$count; $i++)
			{
				$item = $select[$i];
				if($flag)
				{
					$sql .= ", ";
				}
				else
				{
					$flag = 1;
				}
				$sql .= $item;
			}
		
			$sql .= " FROM $this->database" . "." .  "$this->table ";
			if(!empty($where))
			{
				$sql .= " WHERE ";
			}
			$flag = 0;
			foreach($where as $key=>$val)
			{
				if($flag)
				{
					$sql .= " AND ";
				}
				else
				{
					$flag = 1;
				}
				$sql .= $val . "=? ";
			}
			$type = CONFIGURE::SQL_QUERY_ONE;
			return self::execute($sql, $where_value, $type);
		}
		
		public function get_list($select, $where, $where_value, $others)
		{
			if(!is_array($select) || empty($select) 
				|| !is_array($where_value)
				|| !is_array($where) )
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$msg = CONFIGURE::PARAM_ILLEGAL . ', Method: '  . __METHOD__;
				$this->set_msg($msg);
				return false;
			}

			$group_by = $others['group_by'];
			$order_by = $others['order_by'];
			$order    = $others['order'];
			$start    = $others['start'];
			$limit    = $others['limit'];
			
			$count = count($select);
			$sql = "SELECT ";
			$flag = 0;
			for($i=0; $i<$count; $i++)
			{
				$item = $select[$i];
				if($flag)
				{
					$sql .= ", ";
				}
				else
				{
					$flag = 1;
				}
				$sql .= $item;
			}
		
			$sql .= " FROM $this->database" . "." .  "$this->table ";
			if(!empty($where))
			{
				$sql .= " WHERE ";
			}
			$flag = 0;
			foreach($where as $key=>$val)
			{
				if($flag)
				{
					$sql .= " AND ";
				}
				else
				{
					$flag = 1;
				}
				$sql .= $val . "=? ";
			}
		
			if($group_by)
			{
				$sql .= "GROUP BY " .$group_by;
			}
			if($order_by)
			{
				if(empty($order))
				{
					$order = 'ASC';
				}
				$sql .= "ORDER BY " .$order_by . " " . $order;
			}
			
			if($limit > 1)
			{
				$sql .= " LIMIT $start,$limit;";
			}
			
			$type = CONFIGURE::SQL_QUERY_LIST;
			
			//return $sql;
			return self::execute($sql, $where_value, $type);
		}
		
		
		public function insert($insert, $values)
		{
			if(!is_array($insert) || empty($insert)
				|| !is_array($values) || empty($values))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$msg = CONFIGURE::PARAM_ILLEGAL . ', Method: '  . __METHOD__;
				$this->set_msg($msg);
				return false;
			}
			$sql = "INSERT INTO $this->database" . "." . $this->table;
			$sql .= " (";
			$count = count($insert);
			for($i=0; $i<$count; $i++)
			{
				if($i>0)
				{
					$sql .= ", ";
				}
				$sql .= $insert[$i];
				
			}
			$sql .= ")";
			$sql .= " VALUES (";
		
			$count = count($values);
			for($i=0; $i<$count; $i++)
			{
				if($i>0)
				{
					$sql .= ", ";
				}
				$sql .= "?";
			}
			$sql .= ")";
					
			$type = CONFIGURE::SQL_INSERT;
			return self::execute($sql, $values, $type);
		}
		
		

		public function delete($where, $where_value)
		{
			if(!is_array($where) || empty($where)
				|| !is_array($where_value) || empty($where_value))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$msg = CONFIGURE::PARAM_ILLEGAL . ', Method: '  . __METHOD__;
				$this->set_msg($msg);
				return false;
			}
	
			$sql = "DELETE FROM $this->database" . "." .  "$this->table WHERE ";
			$count = count($where);
			for($i=0; $i<$count; $i++)
			{
				if($i>0)
				{
					$sql .= " AND ";
				}
				$sql .= $where[$i] . "=?";
			}
			$type = CONFIGURE::SQL_DELETE;
			return self::execute($sql, $where_value, $type);
		}

		
		
		public function update($set, $values, $where, $where_value)
		{
			if(!is_array($set) || empty($set)  
				|| !is_array($values) || empty($values)
				|| !is_array($where) || !is_array($where_value))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$msg = CONFIGURE::PARAM_ILLEGAL . ', Method: '  . __METHOD__;
				$this->set_msg($msg);
				return false;
			}
	
			$sql = "UPDATE $this->database" . "." .  "$this->table SET ";
			$count = count($set);
			for($i=0; $i<$count; $i++)
			{
				if($i>0)
				{
					$sql .= ",";
				}
				$sql .= $set[$i] . "=?";
			}
	
			if(!empty($where) && !empty($where_value))
			{
				$sql .= " WHERE ";
			}
				
			$count = count($where);
			for($i=0; $i<$count; $i++)
			{
				if($i>0)
				{
					$sql .= " AND ";
				}
				$sql .= $where[$i] . "=?";
			}
			$merge_value = array_merge($values, $where_value);
			$type = CONFIGURE::SQL_UPDATE;
			return self::execute($sql, $merge_value, $type);
		}
		
		protected function execute($sql, $values, $type)
		{
			if(empty($sql) || !is_array($values) || empty($type))
			{
				$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
				$msg = CONFIGURE::PARAM_ILLEGAL . ', Method: '  . __METHOD__;
				$this->set_msg($msg);
				return false;
			}
			try
			{
				$stmt = $this->pdo->prepare($sql);
				$ret = $stmt->execute($values);
		
				switch($type)
				{
					case CONFIGURE::SQL_QUERY_ONE:
					case CONFIGURE::SQL_QUERY_LIST:
						$stmt->setFetchMode(PDO::FETCH_ASSOC);
						$ret = $stmt->fetchAll();
						break;
		
					case CONFIGURE::SQL_INSERT:
		
						$ret = $this->pdo->lastInsertId();
						break;
		
					case CONFIGURE::SQL_UPDATE:
					case CONFIGURE::SQL_DELETE:
		
						break;
							
					default:
		
						$this->set_errno(CONFIGURE::PARAM_ILLEGAL_ERRNO);
						$msg = CONFIGURE::PARAM_ILLEGAL . ', Method: '  . __METHOD__;
						$msg .= ' $type is illegal.';
						$this->set_msg($msg);
						return false;
				}
				$this->set_errno(CONFIGURE::SUCCESS_ERRNO);
				$this->set_msg(CONFIGURE::SUCCESS);
				return $ret;
			}
			catch(PDOException $e)
			{
				$this->set_errno(CONFIGURE::DB_OPERATION_ERRNO);
				$msg = $e->getMessage() . ': ['  . $sql . ']';
				$this->set_msg($msg);
				return false;
			}
		}
		
		public function set_errno($errno)
		{
			$this->errno = $errno;
			return true;
		}
		public function get_errno()
		{
			return $this->errno;
		}
		
		public function set_msg($msg)
		{
			$this->msg = $msg;
			return true;
		}
		public function get_msg()
		{
			return $this->msg;
		}
		
		public function __destruct()
		{
			$this->pdo = null;
		}
		
		private function db_config($database, $table)
		{
			$host_ip = get_server('SERVER_ADDR');
			if($host_ip == '127.0.0.1')
			{
				$host = '127.0.0.1';
				$user = 'rao';
				$password = 'raoyg980';
			}
			else
			{
				$host = 'mysql1215.ixwebhosting.com';
				$database = 'A970321_' . $database;
				$user = 'A970321_' . 'rao';
				$password = $user;
			}
			$this->table = $table;
			$this->host = $host;
			$this->database = $database;
			$this->user = $user;
			$this->password = $password;
			return true;
		}
	}
	
?>





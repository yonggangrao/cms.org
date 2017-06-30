<?php
	session_start();
	
	interface IController {}
	
	class FrontController
	{
		protected $_controller,
		$_action,
		$_params,
		$_body;
		static $_instance;
	
		public static function getInstance()
		{
			if(!(self::$_instance instanceof self) )
			{
				self::$_instance = new self();
			}
			return self::$_instance;
		}
	
		private function __construct()
		{
			$request = $_SERVER['REQUEST_URI'];
			$splits = explode('/', trim($request,'/'));
			$this->_controller = !empty($splits[0])?$splits[0]:'index';
			$this->_controller .= 'Controller';
			$this->_action = !empty($splits[1])?$splits[1]:'index';
			$this->_action .= 'Action';
			
			if(!empty($splits[2])) 
			{
				$params = array();
				for($idx=2, $cnt = count($splits); $idx<$cnt; $idx++)
				{
					$params[$idx - 2] = $splits[$idx];
				}
				$this->_params = $params;
				
			}
		}
	
		public function route() 
		{
			$file = 'application/controllers/' . $this->_controller . '.php';
			$file_exit_flag = 1;
			$class_exit_flag = 1;
			$hasMethod_flag = 1;
		
			if(file_exists($file))
			{
				include $file;
				
				if(class_exists($this->getController()))
				{
					$rc = new ReflectionClass($this->getController());
					if($rc->hasMethod($this->getAction()))
					{
					
						$method = $rc->getMethod($this->getAction());
						
						$controller = $rc->newInstance();

						$method->invoke($controller);
		
					}
					else
					{
						$hasMethod_flag = 0;
					}
					
				}
				else
				{
					$class_exit_flag = 0;
				}
				
			
			}
			else 
			{
				$file_exit_flag = 0;
			}
			
			//出了差错
			if($file_exit_flag == 0
				|| $class_exit_flag == 0
				|| $hasMethod_flag == 0)
			{
				include 'application/controllers/errorController.php';
				$this->setController('errorController');
				$this->setAction('errorAction');
				$rc = new ReflectionClass($this->getController());
				$_controller = $rc->newInstance();
				$method = $rc->getMethod($this->getAction());
				$method->invoke($_controller);
				
			}
		}
	
		
		public function getParams()
		{
			return $this->_params;
		}
	
		public function getController()
		{
			return $this->_controller;
		}
	
		public function getAction()
		{
			return $this->_action;
		}
	
		public function getBody()
		{
			return $this->_body;
		}
	
		public function setBody($body)
		{
			$this->_body = $body;
		}
		public function setController($_controller)
		{
			$this->_controller = $_controller;
		}
		public function setAction($_action)
		{
			$this->_action = $_action;
		}
	}

	
	
	class controller
	{
		protected $fc;
		public function __construct() {$this->fc = FrontController::getInstance();}
		
		public function render($_controller, $_action, $_data=array())
		{
			
			//$fc = FrontController::getInstance();
			//$_controller = $fc->getController();
			//$_action = $fc->getAction();
			
			//$_param = $fc->getParams();
			ob_start();
			
			$filename = 'application/views/'  . $_controller . '/' . $_action . '.php';
			include 'core/head.php';
			if(file_exists($filename))
			{
				include $filename;
			}
			else 
			{
				include 'application/views/error/error.php';
			}
			include 'core/foot.php';
			$result= ob_get_clean();
			$this->fc->setBody($result);
			return true;
		}
	}


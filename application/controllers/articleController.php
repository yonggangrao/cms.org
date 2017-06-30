<?php 

	require_once  MODEL_PATH . 'article.php';

	class articleController extends controller
	{
		public function ls()
		{
			$fc = FrontController::getInstance();
			$_param = $fc->getParams();
		}
		
		
		public function createAction()
		{
			$action = get_response('action');
			switch ($action)
			{
				case 'create':
					
					$title = get_response('title');
					$contents = get_response('contents');
					$class = get_response('class');
					$class_input = get_response('class_input');
					
					$article = new article_model();
					$ret = $article->create($title, $contents, $class, $class_input);
					
					$data['ret'] = $ret;
					$data['errno'] = $article->get_errno();
					$data['msg'] = $article->get_msg();
					
					echo json_encode($data);
					
					break;
					
				default:
					$article_model = new article_model();
					$class_list = $article_model->get_article_class_list();
					$data['ret'] = $class_list;
					$data['errno'] = $article_model->get_errno();
					$data['msg'] = $article_model->get_msg();
					$this->render('article', 'create', $data);
			}
		}
		
		public function displayAction()
		{
			$fc = FrontController::getInstance();
			$_param = $fc->getParams();
			
			$id = $_param[0];
			if(!is_numeric($id))
			{
				$this->render('error','error');
			}
			else
			{
				
				$article_model = new article_model();
				$article = $article_model->display($id);
				$data['ret'] = $article;
				$data['errno'] = $article_model->get_errno();
				$data['msg'] = $article_model->get_msg();
				
				
				$this->render('article','display', $data);
			} 
		}
		
		public function updateAction()
		{
			
			$fc = FrontController::getInstance();
			$_param = $fc->getParams();
			$id = $_param[0];
			
			$action = get_response('action');
			switch ($action)
			{
				case 'update':
					
					if(!is_numeric($id))
					{
						$this->render('error','error');
					}
					else
					{
						$title = get_response('title');
						$contents = get_response('contents');
						$class = get_response('class');
						$class_input = get_response('class_input');
						if(!empty($class_input))
						{
							$class = $class_input;
						}
						$article_model = new article_model();
						$article = $article_model->update($id, $title, $class, $contents);
						$data['ret'] = $article;
						$data['errno'] = $article_model->get_errno();
						$data['msg'] = $article_model->get_msg();
						$data['article_id'] = $id;
					}
					echo json_encode($data);
					break;
					
				default:
					
					if(!is_numeric($id))
					{
						$this->render('error','error');
					}
					else
					{
						$article_model = new article_model();
						$article = $article_model->get_article($id);
						$data[0]['ret'] = $article;
						$data[0]['errno'] = $article_model->get_errno();
						$data[0]['msg'] = $article_model->get_msg();
						
						//获取文章分类
						$class_list = $article_model->get_article_class_list();
						$data[1]['ret'] = $class_list;
						$data[1]['errno'] = $article_model->get_errno();
						$data[1]['msg'] = $article_model->get_msg();
						
						$this->render('article','update', $data);
					}
			}
		}
		
		
		public function deleteAction()
		{
			$action = get_response('action');
			$id = get_response('id');
			if($action == 'delete' && is_numeric($id))
			{
				
				$article_model = new article_model();
				$article = $article_model->delete($id);
				$data['ret'] = $article;
				$data['errno'] = $article_model->get_errno();
				$data['msg'] = $article_model->get_msg();
			}
			else 
			{
				$data['ret'] = false;
				$data['errno'] = CONFIGURE::PARAM_ILLEGAL_ERRNO;
				$data['msg'] = CONFIGURE::PARAM_ILLEGAL;
			}
			
			echo json_encode($data);
		}
	}
?>
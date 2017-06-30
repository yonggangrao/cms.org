<?php

	class errorController extends controller //implements IController
	{
		public function errorAction()
		{
			$this->render('error', 'error');
		}
	}
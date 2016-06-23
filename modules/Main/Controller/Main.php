<?php
namespace Main\Controller{
	
	class Main extends \JFrame\Controller{
		public function __construct(){
			parent::__construct();
			$this->view->config('templateEngine', 'jframe');
			
		}
		public function index(){
			
			echo $this->view->render('index.phtml');
		}
	}
}
?>
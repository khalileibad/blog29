<?php
	/**
	* blog Controller, 
	* This Called after staff Loggin
	*/
	class blog extends controller
	{
		/**
		* The Default Method
		* No return (void)
		*/
		function __construct()
		{
			parent::__construct();
			$this->view->CSS = array();
			$this->view->JS = array('views/blog/JS/dash.js');
			
		}
		
		//Display blog window
		function index($category=0)
		{
			$this->view->menu 			= $this->model->menu();
			$this->view->last_blog 		= $this->model->blog('last');
			$this->view->most_read_blog = $this->model->blog('most_read');
			$this->view->most_like_blog = $this->model->blog('most_like');
			$this->view->render(array('blog/index'),'home');
		}
		
		//Display blog details
		function details($blog=0)
		{
			$this->view->menu = $this->model->menu();
			$this->view->render(array('blog/about'),'home');
		}
		
		//Display blog owner
		function user($user=0)
		{
			$this->view->menu = $this->model->menu();
			$this->view->render(array('blog/contact'),'home');
		}
		
		//likes
		function like()
		{
			echo json_encode($this->model->new_cont());
		}
		
		//comment
		function comment()
		{
			echo json_encode($this->model->new_cont());
		}
		
	}
?>
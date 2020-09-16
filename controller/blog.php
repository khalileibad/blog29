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
			$this->view->JS = array('views/blog/JS/blog.js');
			
		}
		
		//Display blog window
		function index($category=0)
		{
			$this->view->menu 			= $this->model->menu();
			$this->view->category 		= $this->model->category($category);
			$this->view->render(array('blog/index'),'home');
		}
		
		//Display blog window
		function blog_list($category=0,$page_no=1)
		{
			$this->view->blog_list 		= $this->model->blog_list($category,$page_no);
			$this->view->js_render('blog/AJAX/blog');
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
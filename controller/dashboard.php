<?php
	/**
	* dashboard Controller, 
	* This Called after staff Loggin
	*/
	class dashboard extends controller
	{
		/**
		* The Default Method
		* No return (void)
		*/
		function __construct()
		{
			parent::__construct();
			$this->view->CSS = array();
			$this->view->JS = array('views/dashboard/JS/dash.js');
			$this->view->curr_page = "dashboard";
			
		}
		
		//Display dashboard window
		function index()
		{
			$this->view->menu 			= $this->model->menu();
			$this->view->last_blog 		= $this->model->blog('last');
			$this->view->most_read_blog = $this->model->blog('most_read');
			$this->view->most_like_blog = $this->model->blog('most_like');
			$this->view->render(array('dashboard/index'),'home');
		}
		
		//Display about window
		function about()
		{
			$this->view->curr_page = "about";
			$this->view->menu = $this->model->menu();
			$this->view->staff = $this->model->staff();
			$this->view->render(array('dashboard/about'),'home');
		}
		
		//Display contact
		function contact()
		{
			$this->view->curr_page = "contact";
			$this->view->menu = $this->model->menu();
			$this->view->render(array('dashboard/contact'),'home');
		}
		
		//Display terms
		function terms()
		{
			$this->view->menu = $this->model->menu();
			$this->view->render(array('dashboard/terms'),'home');
		}
		
		//Display privacy
		function privacy()
		{
			$this->view->menu = $this->model->menu();
			$this->view->render(array('dashboard/privacy'),'home');
		}
		
		//save contact data
		function new_cont()
		{
			echo json_encode($this->model->new_cont());
		}
		
		//save mail_list data
		function mail_list()
		{
			echo json_encode($this->model->mail_list());
		}
		
	}
?>
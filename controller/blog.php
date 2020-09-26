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
			$this->view->JS = array('public/JS/paging.js','views/blog/JS/blog.js');
			$this->view->curr_page = "blog";
		}
		
		//Display blog window
		function index($category=0)
		{
			$this->view->menu 			= $this->model->menu();
			$this->view->category 		= $this->model->category($category);
			if(!empty($this->view->category))
			{
				$this->view->curr_page = "blog_".$this->view->category['cat_id'];
			}
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
			$this->view->blog = $this->model->blog($blog);
			if(empty($this->view->blog))
			{
				$this->index();
				return;
			}
			$this->view->curr_title 	= $this->view->blog['title'];
			$this->view->keywords 		= $this->view->blog['keywords'];
			$this->view->render(array('blog/details'),'home');
		}
		
		//blog_likes
		function blog_like($blog=0)
		{
			echo json_encode($this->model->blog_like($blog));
		}
		
		//comment
		function comment()
		{
			echo json_encode($this->model->comment());
		}

		//Display blog owner
		function user($user=0)
		{
			$this->view->menu = $this->model->menu();
			$this->view->user = $this->model->user($user);
			if(empty($this->view->user))
			{
				$this->index();
				return;
			}
			$this->view->render(array('blog/user'),'home');
		}
		
		
	}
?>
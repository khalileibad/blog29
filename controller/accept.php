<?php
	/**
	* accept Controller, 
	* This Called after staff Loggin
	*/
	class accept extends controller
	{
		/**
		* The Default Method
		* No return (void)
		*/
		function __construct()
		{
			parent::__construct();
			$this->view->curr_page = "accept";
			$this->view->CSS = array();
			$this->view->JS = array('views/accept/JS/accept.js');
		}
		
		//Display accept window
		function index()
		{
			$this->view->CSS = array("public/vendor/simditor/assets/styles/simditor.css");
			$this->view->JS = array('public/vendor/simditor/assets/scripts/module.js'
									,'public/vendor/simditor/assets/scripts/hotkeys.js'
									,'public/vendor/simditor/assets/scripts/uploader.js'
									,'public/vendor/simditor/assets/scripts/simditor.js'
									,'public/JS/paging.js'
									,'public/JS/img.js'
									,'views/accept/JS/accept.js'
									);
			$this->view->menu 		= $this->model->menu();
			$this->view->info 		= $this->model->info();
			$this->view->render(array('accept/index'));
		}
		
		
		//Display blog window
		function blog_list($page_no=1)
		{
			$this->view->blog_list 		= $this->model->blog_list($page_no);
			$this->view->js_render('accept/AJAX/blog');
		}
		
		/**
		* profile
		* update profile data
		* AJAX
		*/
		function profile()
		{
			$data = $this->model->profile();
			if(!empty($data['Error']))
			{
				echo json_encode($data);
				return;
			}
			
			session::set('user_name'	,$data['staff_name']);
			session::set('user_email'	,$data['staff_email']);
			if(!empty($data['staff_img']))
			{
				session::set('user_img'		,$data['staff_img']);
			}
			echo json_encode(array('id'=>1));
		}
		
		//Display upd blog window
		function blog_edit($id=0)
		{
			$this->view->blog 		= $this->model->blog($id);
			if(empty($this->view->blog))
			{
				$this->index();
				return;
			}
			$this->view->menu 		= $this->model->menu();
			
			$this->view->CSS = array("public/vendor/simditor/assets/styles/simditor.css");
			$this->view->JS = array('public/vendor/simditor/assets/scripts/module.js'
									,'public/vendor/simditor/assets/scripts/hotkeys.js'
									,'public/vendor/simditor/assets/scripts/uploader.js'
									,'public/vendor/simditor/assets/scripts/simditor.js'
									,'public/JS/paging.js'
									,'public/JS/img.js'
									,'views/accept/JS/accept.js'
									);
			$this->view->render(array('accept/details'));
			
		}
		
		/**
		* upd_blog
		* update blog
		* AJAX
		*/
		function upd_blog()
		{
			echo json_encode($this->model->upd_blog());
		}
		
		
	}
?>
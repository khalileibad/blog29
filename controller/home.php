<?php
	/**
	* home Controller, 
	* This Called after staff Loggin
	*/
	class home extends controller
	{
		/**
		* The Default Method
		* No return (void)
		*/
		function __construct()
		{
			parent::__construct();
		}
		
		//Display home window
		function index()
		{
			$this->view->CSS = array("public/vendor/simditor/assets/styles/simditor.css");
			$this->view->JS = array('public/vendor/simditor/assets/scripts/module.js'
									,'public/vendor/simditor/assets/scripts/hotkeys.js'
									,'public/vendor/simditor/assets/scripts/uploader.js'
									,'public/vendor/simditor/assets/scripts/simditor.js'
									,'public/JS/paging.js'
									,'public/JS/img.js'
									,'views/home/JS/home.js'
									);
			$this->view->menu 		= $this->model->menu();
			$this->view->info 		= $this->model->info();
			$this->view->render(array('home/index'));
			
			/*
			<script type="text/javascript" src="site/assets/scripts/jquery.min.js"></script>
		
			*/
		}
		
		//Display blog window
		function blog_list($page_no=1)
		{
			$this->view->blog_list 		= $this->model->blog_list($page_no);
			$this->view->js_render('home/AJAX/blog');
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
		
		/**
		* new_blog
		* add new blog
		* AJAX
		*/
		function new_blog()
		{
			echo json_encode($this->model->new_blog());
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		//Display home details window
		function peo_info()
		{
			$this->view->peo_info 	= $this->model->peo_info();
			if(is_array($this->view->peo_info))
			{
				$this->view->js_render('home/AJAX/peo_info');
			}else
			{// if There Is Error!
				echo $this->view->peo_info;
			}
		}
		
		//Display home details window
		function work_info()
		{
			$this->view->work_info 	= $this->model->work_info();
			if(is_array($this->view->work_info))
			{
				$this->view->js_render('home/AJAX/work_info');
			}else
			{// if There Is Error!
				echo $this->view->peo_info;
			}
		}
		
		/**
		* upd_land
		* update Land info
		* AJAX
		*/
		function upd_land()
		{
			echo json_encode($this->model->upd_land());
		}
		
		/**
		* upd_house
		* update House info
		* AJAX
		*/
		function upd_house()
		{
			echo json_encode($this->model->upd_house());
		}
		
		/**
		* upd_home
		* update home info
		* AJAX
		*/
		function upd_people()
		{
			echo json_encode($this->model->upd_people());
		}
		
		/**
		* upd_worker
		* update worker info
		* AJAX
		*/
		function upd_worker()
		{
			echo json_encode($this->model->upd_worker());
		}
		
		/**
		* del_home
		* delete home info
		* AJAX
		*/
		function del_people($id=0)
		{
			echo json_encode($this->model->del_people($id));
		}
		
		/**
		* del_worker
		* delete worker info
		* AJAX
		*/
		function del_worker($id=0)
		{
			echo json_encode($this->model->del_worker($id));
		}
		
		
	}
?>
<?php
	/**
	* people Controller, 
	* This Called after staff Loggin
	*/
	class people extends controller
	{
		/**
		* The Default Method
		* No return (void)
		*/
		function __construct()
		{
			parent::__construct();
			$this->view->languages();
			$this->view->CSS = array();
			$this->view->JS = array('views/people/JS/people.js');
		}
		
		//Display people window
		function index()
		{
			//$this->view->info 	= $this->model->info();
			$this->view->render(array('people/index'));
		}
		
		//Display people window
		function request()
		{
			$this->view->render(array('people/req'));
		}
		
		/**
		* people_list
		* AJAX fun
		* get people house
		*/
		function people_list()
		{
			$this->view->people_list	= $this->model->people_list();
			if(is_array($this->view->people_list))
			{
				$this->view->js_render('people/AJAX/people');
			}else
			{// if There Is Error!
				echo $this->view->people_list;
			}
		}
		
		/**
		* req_people_list
		* AJAX fun
		* get requested people
		*/
		function req_people_list()
		{
			$this->view->req_people_list	= $this->model->req_people_list();
			if(is_array($this->view->req_people_list))
			{
				$this->view->js_render('people/AJAX/req_people');
			}else
			{// if There Is Error!
				echo $this->view->req_people_list;
			}
		}
		
		/**
		* accept_req
		* accept reg request
		* AJAX
		*/
		function accept_req($id=0)
		{
			echo json_encode($this->model->accept_req($id));
		}
		
		/**
		* del_req
		* delete reg request
		* AJAX
		*/
		function del_req()
		{
			echo json_encode($this->model->del_req());
		}
		
		/**
		* new_land
		* add new land
		* AJAX
		*/
		function new_land()
		{
			echo json_encode($this->model->new_land());
		}
		
		/**
		* new_house
		* add new house
		* AJAX
		*/
		function new_house()
		{
			echo json_encode($this->model->new_house());
		}
		
		/**
		* new_people
		* add new people to house
		* AJAX
		*/
		function new_people()
		{
			echo json_encode($this->model->new_people());
		}
		
		/**
		* new_worker
		* add new worker to house
		* AJAX
		*/
		function new_worker()
		{
			echo json_encode($this->model->new_worker());
		}
		
		//Display Upload window
		function new_upload()
		{
			array_push($this->view->JS,"views/people/JS/upload.js");
			array_push($this->view->JS,"public/JS/files.js");
			array_push($this->view->JS,"public/JS/xls.core.min.js");
			array_push($this->view->JS,"public/JS/xlsx.core.min.js");
			
			$this->view->render(array('people/upload'));
		}
		
		//Display people details window
		function info($id=0)
		{
			$this->view->info 	= $this->model->info($id);
			if(empty($id) || empty($this->view->info))
			{
				$this->index();
				return;
			}
			
			$this->view->render(array('people/info'));
		}
		
		//Display people details window
		function peo_info($id=0)
		{
			$this->view->peo_info 	= $this->model->peo_info($id);
			if(is_array($this->view->peo_info))
			{
				$this->view->js_render('people/AJAX/peo_info');
			}else
			{// if There Is Error!
				echo $this->view->peo_info;
			}
		}
		
		//Display people details window
		function work_info($id=0)
		{
			$this->view->work_info 	= $this->model->work_info($id);
			if(is_array($this->view->work_info))
			{
				$this->view->js_render('people/AJAX/work_info');
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
		* upd_people
		* update people info
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
		* del_people
		* delete people info
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
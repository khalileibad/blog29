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
			$this->view->CSS = array();
			$this->view->JS = array('views/accept/JS/accept.js');
		}
		
		//Display accept window
		function index()
		{
			die('Accept ... <a href="'.URL.'login/logout">logout</a> ' );
			$this->view->info 	= $this->model->info();
			$this->view->render(array('accept/index'));
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
		
		//Display accept details window
		function peo_info()
		{
			$this->view->peo_info 	= $this->model->peo_info();
			if(is_array($this->view->peo_info))
			{
				$this->view->js_render('accept/AJAX/peo_info');
			}else
			{// if There Is Error!
				echo $this->view->peo_info;
			}
		}
		
		//Display accept details window
		function work_info()
		{
			$this->view->work_info 	= $this->model->work_info();
			if(is_array($this->view->work_info))
			{
				$this->view->js_render('accept/AJAX/work_info');
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
		* upd_accept
		* update accept info
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
		* del_accept
		* delete accept info
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
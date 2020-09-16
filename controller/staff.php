<?php
	/**
	* staff Controller, 
	* This Called after admin
	*/
	class staff extends controller
	{
		/**
		* The Default Method
		* No return (void)
		*/
		function __construct()
		{
			parent::__construct();
			$this->view->CSS = array();
			$this->view->JS = array('views/staff/JS/staff.js');
		}
		
		//Display user window
		function index()
		{
			$this->view->render(array('staff/index'));
		}
		
		/**
		* user_list
		* AJAX fun
		* get users list
		*/
		function user_list()
		{
			$this->view->user_list	= $this->model->user_list();
			if(is_array($this->view->user_list))
			{
				$this->view->js_render('staff/AJAX/staff_list');
			}else
			{// if There Is Error!
				echo $this->view->user_list;
			}
		}
		
		/**
		* new_Staff
		* create New Staff
		* AJAX
		*/
		function new_Staff()
		{
			echo json_encode($this->model->new_Staff());
		}
		
		/**
		* upd_Staff
		* update Staff
		* AJAX
		*/
		function upd_Staff()
		{
			echo json_encode($this->model->upd_Staff());
		}
		
		/**
		* del_Staff
		* del Staff
		* AJAX
		*/
		function del_Staff()
		{
			echo json_encode($this->model->del_Staff());
		}
		
		/**
		* trans_Staff
		* AJAX fun
		* transfire staff to next year
		*/
		function active()
		{
			echo json_encode($this->model->active());
		}
		
		/**
		* msg_staff
		* AJAX fun
		* send msg to staff
		*/
		function msg_staff()
		{
			echo json_encode($this->model->msg_staff());
		}
		
	}
?>

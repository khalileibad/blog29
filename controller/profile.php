<?php
	/**
	* profile Controller, 
	* This Called after staff Loggin
	*/
	class profile extends controller
	{
		/**
		* The Default Method
		* No return (void)
		*/
		function __construct()
		{
			parent::__construct();
			$this->view->CSS = array();
			$this->view->JS = array('views/profile/JS/profile.js');
		}
		
		//Display profile window
		function index()
		{
			
			$this->view->languages();
			$this->view->info 	= $this->model->info();
			
			$this->view->render(array('profile/index'));
			
		}
		
		//Update User info
		function upd_info()
		{
			if(session::get('user_type') == "pa")
			{
				$data = $this->model->upd_pa_info();
			}else{
				$data = $this->model->upd_staff_info();
			}
			
			
			if(!empty($data['ok']))
			{
				session::set('user_name'	,$data['name']);
				session::set('user_name_EN'	,$data['name_en']);
				session::set('user_email'	,$data['email']);
				if(!empty($data['user_img']))
				{
					session::set('user_img'		,$data['user_img']);
				}
			}
			echo json_encode($data);
		}
		
		/**
		* Update password 
		* if Update complected successfully will print 1 or Error message
		*/
		public function update_password()
		{
			echo json_encode($this->model->update_password());
		}
		
	}
?>
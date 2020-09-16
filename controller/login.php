<?php
	// Controller For LOGIN
	class login extends controller
	{
		function __construct()
		{
			parent::__construct();
			$this->view->MSG = '';
			//$this->view->CSS = array('views/login/CSS/login.css');
			$this->view->JS = array('views/login/JS/login.js');
		}
		
		public function index()
		{
			if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']))
			{
				echo "Your session Expired, please LOGIN again";
			}elseif(session::get('user_id'))
			{
				$default_page = staff_settings::default_page(session::get('user_type'));
				header('location:'.URL.$default_page);
			}else
			{
				$this->view->render(array('login/index'),'login');
			}
		}
		
		public function login()
		{
			$data = $this->model->login();
			
			if($data != null && is_array($data))
			{
				$ok = false;
				if(isset($data['h_id']))
				{
					//home
					session::set('user_id'		,$data['h_id']);
					session::set('user_name'	,$data['peo_name']);
					session::set('user_name_EN'	,$data['peo_name_EN']);
					session::set('user_email'	,$data['h_email']);
					session::set('user_type'	,'home');
					
					$data['staff_type'] = 'home';
					$ok = true;
				}elseif(!empty($data['staID']))
				{
					session::set('user_id'		,$data['staID']);
					session::set('user_name'	,$data['staff_full_name']);
					session::set('user_name_EN'	,$data['staff_full_name_en']);
					session::set('user_email'	,$data['staff_email']);
					session::set('user_type'	,$data['staff_type']);
					session::set('user_img'		,$data['staff_img']);
					
					$ok = true;
				}
				if($ok)
				{
					$e = staff_settings::generateRandomString();
					session::set('csrf'	,Hash::create(HASH_FUN,$e,HASH_PASSWORD_KEY));
					session::set('CREATED'		,time());
					$default_page = staff_settings::default_page($data['staff_type']);
					header('location:'.URL.$default_page);
					die();
				}
			}
			$this->view->no = (!empty($_POST['MSG']))?intval($_POST['MSG'])+1:1;
			$this->view->languages(array('login'));
			$this->view->MSG = $data;
			$this->view->render(array('login/index'),'login');
			
		}
		
		public function logout()
		{
			session::destroy();
			header('location:'.URL.'');
		}
		
		
		/**
		* Forget Password request #1  
		* Open Forget Password Window
		*/
		public function forget()
		{
			if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']))
			{
				echo "Your session Expired, please LOGIN again";
			}elseif(session::get('user_id'))
			{
				$default_page = staff_settings::default_page(session::get('user_type'));
				header('location:'.URL.$default_page);
			}else
			{
				$this->view->languages(array('login'));
				$this->view->render(array('login/forget'),'login');
			}
			
		}
		
		/**
		* Forget Password request #2 
		* if Email sent successfully will print 1 or Error message
		*/
		public function forget_request()
		{
			echo json_encode($this->model->forget_request());
		}
		
		/**
		* Forget Password request #3 
		* Open reset Password Window if request is true
		*/
		public function resetpassword($id)
		{
			$x = $this->model->resetpassword($id);
			
			if(!is_array($x))
			{
				echo $x;
			}else
			{
				$this->view->id = $x['for_id'];
				$this->view->languages(array('login'));
				$this->view->render(array('login/reset'),'login');
			}
		}
		
		/**
		* Forget Password request #4 
		* Update Password
		* if Update complected successfully will print 1 or Error message
		*/
		public function update_res_password()
		{
			echo json_encode($this->model->update_res_password());
		}
		
		/**
		* Registration
		* Request Registration From Home Page
		*/
		public function reg()
		{
			echo json_encode($this->model->reg());
		}
	}
?>
<?php
	/**
	* Model LOGIN, 
	*/
	class login_model extends model
	{
		/** The Default Method Like Main in java*/
		function __construct()
		{
			parent::__construct();
		}
		
		/**
		* function menu
		* get menu
		*/
		public function menu()
		{
			return $this->db->get_menu();
		}
		
		/**
		* function login
		* get login user date
		*/
		public function login()
		{
			$form = new form();
			
			$form	->post('usrname')
					->valid('Min_Length',1)
					->valid('Max_Length',90)
					
					->post('psw')
					->valid('Min_Length',2)
					->valid('Max_Length',90)
					
					->submit();
						
			$req = $form->fetch();
			
			if($req['MSG']!= '')
			{
				die($req['MSG']);
				return "INPUT_ERROR";
			}
			
			$data = $this->db->select("SELECT 
									staff_id, staff_name 
									,staff_type, staff_img
									,staff_email, staff_pass, staff_active
									FROM ".DB_PREFEX."staff 
									WHERE 
									staff_email = :login" ,
									array(':login'=>$req['usrname'])
								);
			
			
			if(count($data) != 1 || $data[0]['staff_pass'] != Hash::create(HASH_FUN,$req['psw'],HASH_PASSWORD_KEY))
			{
				return "INPUT_ERROR";
			}
			if($data[0]['staff_active'] != 1)
			{
				return "UNACTIVE";
			}
			
			return $data[0];
		}
		
		
		/**
		* function forget_request
		* create Forget Password reset link
		*/
		public function forget_request()
		{
			$time	= dates::convert_to_date('now');
			$time	= dates::convert_to_string($time);
			
			$form = new form();
			
			$form	->post('usrname')
					->valid('Min_Length',2)
					->valid('Max_Length',90)
					
					->submit();
						
			$req = $form->fetch();
			
			if($req['MSG']!= '')
			{
				return array('Error'=>$req['MSG']);
			}
			//
			$data = $this->db->select("SELECT 
									staID, staff_full_name
									, staff_email
									FROM ".DB_PREFEX."staff 
									WHERE 
									staff_email = :login and staff_active = 1" ,
									array(':login'=>$req['usrname'])
								);
			
			if(count($data) != 1)
			{
				return array('Error'=>"In Field usrname: Not Found");
			}
			$data = $data[0];
			
			//insert
			$user_array = array('for_user'		=>$data['staID']
								,'create_at'	=>$time
								);
			$this->db->insert(DB_PREFEX.'forget',$user_array);
			$id = $this->db->LastInsertedId();
			
			//send Email:
			Email::forget($data['staff_full_name'],$data['staff_email'],$id,$time);
			return array('ok'=>1);
		}
		
		/**
		* function resetpassword
		* check reset request
		*/
		public function resetpassword($id)
		{
			
			if(is_nan($id))
			{
				return "Error ID";
			}
			
			$data = $this->db->select("SELECT for_id, create_at, HOUR(TIMEDIFF(NOW(),create_at)) AS h
									FROM ".DB_PREFEX."forget 
									WHERE 
									for_id = :login " ,
									array(':login'=>$id)
								);
			
			if(count($data) != 1)
			{
				return "Your request Not Founded, Please Try again ".count($data);
			}
			if($data[0]['h'] > 24)
			{
				return "Your request expered, Please Try again";
			}
			return $data[0];
		}
				
		/**
		* update_res_password
		* to update password
		*/
		public function update_res_password()
		{
			$time	= dates::convert_to_date('now');
			$time	= dates::convert_to_string($time);
			
			$form = new form();
			
			$form	->post('id')
					->valid('Integer')
						
					->post('psw')
					->valid('Min_Length',2)
					->valid('Max_Length',90)
						
					->post('psw2')
					->valid('Min_Length',2)
					->valid('Max_Length',90)
						
					->submit();
			$d = $form->fetch();
			
			if(!empty($d['MSG']))
			{
				return array('Error'=>$d['MSG']);
			}
			if($d['psw'] != $d['psw2'])
			{
				return array('Error'=>"In Field psw2 : Not match .. \n");
			}
			
			$data = $this->db->select("SELECT for_id, for_user,for_house, create_at, HOUR(TIMEDIFF(NOW(),create_at)) AS h
									FROM ".DB_PREFEX."forget 
									WHERE 
									for_id = :login " ,
									array(':login'=>$d['id'])
								);
			if(count($data) != 1)
			{
				return array('Error'=>"لم يتم العثور على الطلب الرجاء المحاولة مرة اخرى");
			}
			if($data[0]['h'] > 24)
			{
				return array('Error'=>"لقد انتهت صلاحية رابط اعادة ضبط كلمة المرور, الرجاء المحاولة مرة اخرى");
			}
			
			if(!empty($data[0]['for_user']))
			{
				$this->db->update(DB_PREFEX.'staff',
									array('staff_pass'=>Hash::create(HASH_FUN,$d['psw'],HASH_PASSWORD_KEY)
									,'update_at'=>$time),
								'staff_id ='.$data[0]['for_user']);
			}elseif(!empty($data[0]['for_house']))
			{
				$this->db->update(DB_PREFEX.'house',
									array('h_pass'=>Hash::create(HASH_FUN,$d['psw'],HASH_PASSWORD_KEY)),
								'h_id ='.$data[0]['for_house']);
			}
			session::destroy();
			return array("ok"=>1);
		}
		
		/**
		* function reg
		* reg user date
		*/
		public function reg()
		{
			$time	= dates::convert_to_date('now');
			$time	= dates::convert_to_string($time);
			
			$form = new form();
			$form	->post('name')
					->valid('Min_Length',2)
					->valid('Max_Length',90)
					
					->post('phone')
					->valid('Phone')
					
					->post('email')
					->valid('Email')
					
					->post('pwd')
					->valid('Min_Length',2)
					->valid('Max_Length',90)
					
					->post('pwd2')
					->valid('Min_Length',2)
					->valid('Max_Length',90)
					
					->post('accept')
					->valid('Integer')
					
					->submit();
						
			$req = $form->fetch();
			
			if($req['MSG']!= '')
			{
				return array("Error"=>$req['MSG']);
			}
			
			//check Accept
			if($req['accept']!= 1)
			{
				return array('Error'=>"In Field accept : not match .. \n");
			}
			
			//check password
			if($req['pwd']!= $req['pwd2'])
			{
				return array('Error'=>"In Field pwd2 : not match .. \n");
			}
			
			//check EMAIL ,phone ,card in reqest table
			$em = $this->db->select("SELECT staff_id ,staff_phone,staff_email
									FROM ".DB_PREFEX."staff 
									WHERE staff_email = :EMAIL 
										OR staff_phone = :PHONE"
									,array(':EMAIL'=>$req['email']
											,':PHONE'=>$req['phone']));
			if(count($em) != 0)
			{
				$err = "";
				foreach($em as $val)
				{
					if($val['staff_email'] == $req['email'])
					{
						$err .= "In Field email : Duplicate .. \n";
					}
					if($val['staff_phone'] == $req['phone'])
					{
						$err .= "In Field phone : Duplicate .. \n";
					}
				}
				return array('Error'=>$err);
			}
			
			//insert
			$user_array = array('staff_name'		=>$req['name']
								,'staff_email'		=>$req['email']
								,'staff_phone'		=>$req['phone']
								,'staff_type'		=>"bloger"
								,'staff_pass'		=>Hash::create(HASH_FUN,$req['pwd'],HASH_PASSWORD_KEY)
								,'create_at'		=>$time
								);
				
			$this->db->insert(DB_PREFEX.'staff',$user_array);
			
			// 	
			$id = $this->db->LastInsertedId();
			unset($user_array['req_pass']);
			$user_array['staff_img'] = "user.jpg";
			$user_array['staff_id'] = $id;
			Email::welcome_reg($req['name'],$req['email']);
			return $user_array;
		}
		
		
	}
?>
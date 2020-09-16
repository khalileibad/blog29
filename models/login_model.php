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
									staID, staff_full_name, staff_full_name_en
									,staff_type, staff_img
									,staff_email, staff_pass, staff_active
									FROM ".DB_PREFEX."staff 
									WHERE 
									staff_email = :login" ,
									array(':login'=>$req['usrname'])
								);
			
			
			if(count($data) != 1 || $data[0]['staff_pass'] != Hash::create(HASH_FUN,$req['psw'],HASH_PASSWORD_KEY))
			{
				return $this->home_login($req['usrname'],$req['psw']);
			}
			if($data[0]['staff_active'] != 1)
			{
				return "UNACTIVE";
			}
			
			return $data[0];
		}
		
		public function home_login($uname,$pass)
		{
			$data = $this->db->select("SELECT 
									h_id, h_email, h_pass
									,peo_name, peo_name_EN
									FROM ".DB_PREFEX."house 
									JOIN ".DB_PREFEX."people ON peo_house = h_id AND peo_main = 1
									WHERE 
									h_email = :login" ,
									array(':login'=>$uname)
								);
			if(count($data) != 1 || $data[0]['h_pass'] != Hash::create(HASH_FUN,$pass,HASH_PASSWORD_KEY))
			{
				return "INPUT_ERROR";
			}
			$data = $data[0];
			
			return $data;
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
				return $this->forget_house_req($req);
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
		* function forget_request
		* create Forget Password reset link
		*/
		public function forget_house_req($req)
		{
			$time	= dates::convert_to_date('now');
			$time	= dates::convert_to_string($time);
			
			//SELECT`, `create_by`, `update_at`, `update_by` FROM `kb9_` WHERE 1
			$data = $this->db->select("SELECT 
									h_id, h_email
									,peo_name, peo_name_EN
									FROM ".DB_PREFEX."house 
									JOIN ".DB_PREFEX."people ON peo_house = h_id AND peo_main = 1
									WHERE 
									h_email = :login " ,
									array(':login'=>$req['usrname'])
								);
			
			if(count($data) != 1)
			{
				return array('Error'=>"In Field usrname: Not Found");
			}
			$data = $data[0];
			
			//insert
			$user_array = array('for_house'	=>$data['pa_id']
								,'create_at'=>$time
								);
			$this->db->insert(DB_PREFEX.'forget',$user_array);
			$id = $this->db->LastInsertedId();
			
			//send Email:
			Email::forget($data['peo_name'],$data['h_email'],$id,$time);
			return array("ok"=>1);
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
			$form	->post('reg_name')
					->valid('Min_Length',2)
					->valid('Max_Length',90)
					
					->post('reg_land')
					->valid('Int_max',MAX_HOME_NO)
					->valid('Int_min',MIN_HOME_NO)
					
					->post('reg_card',false,true)
					->valid('Integer')
					
					->post('reg_status')
					->valid('In_Array',array_keys(kb9::$house_live_type))
					
					->post('reg_email')
					->valid('Email')
					
					->post('reg_phone')
					->valid('Phone')
					
					->post('reg_pass')
					->valid('Min_Length',2)
					->valid('Max_Length',90)
					
					->post('reg_conf_pass')
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
			if($req['reg_pass']!= $req['reg_conf_pass'])
			{
				return array('Error'=>"In Field reg_conf_pass : not match .. \n");
			}
			
			//check EMAIL ,phone ,card in reqest table
			$em = $this->db->select("SELECT req_id ,req_land,req_card ,req_email ,req_phone
									FROM ".DB_PREFEX."reg_request 
									WHERE req_email = :EMAIL 
										OR req_phone = :PHONE
										OR req_card = :CARD"
									,array(':EMAIL'=>$req['reg_email']
											,':CARD'=>$req['reg_card']
											,':PHONE'=>$req['reg_phone']));
			if(count($em) != 0)
			{
				$err = "";
				foreach($em as $val)
				{
					if($val['req_email'] == $req['reg_email'])
					{
						$err .= "In Field reg_email : Duplicate .. \n";
					}
					if($val['req_phone'] == $req['reg_phone'])
					{
						$err .= "In Field reg_phone : Duplicate .. \n";
					}
					if($val['req_card'] == $req['reg_card'])
					{
						$err .= "In Field reg_card : Duplicate .. \n";
					}
				}
				return array('Error'=>$err);
			}
			
			//check EMAIL , CARD in House
			$em = $this->db->select("SELECT h_id, h_card , h_email
										FROM ".DB_PREFEX."house
										WHERE h_card = :CARD OR h_email = :EMAIL" ,
									array(':EMAIL'=>$req['reg_email']
											,':CARD'=>$req['reg_card']));
			if(count($em)!= 0)
			{
				$err = "";
				foreach($em as $val)
				{
					if($val['h_email'] == $req['reg_email'])
					{
						$err .= "In Field reg_email : Duplicate .. \n";
					}
					if($val['h_card'] == $req['reg_card'])
					{
						$err .= "In Field reg_card : Duplicate .. \n";
					}
				}
				return array('Error'=>$err);
			}
			
			//check EMAIL , phone in people
			$em = $this->db->select("SELECT peo_id, peo_phone , peo_email
										FROM ".DB_PREFEX."people
										WHERE peo_phone = :PHONE OR peo_email = :EMAIL" ,
									array(':EMAIL'=>$req['reg_email']
											,':PHONE'=>$req['reg_phone']));
			if(count($em)!= 0)
			{
				$err = "";
				foreach($em as $val)
				{
					if($val['peo_email'] == $req['reg_email'])
					{
						$err .= "In Field reg_email : Duplicate .. \n";
					}
					if($val['peo_phone'] == $req['reg_phone'])
					{
						$err .= "In Field reg_phone : Duplicate .. \n";
					}
				}
				return array('Error'=>$err);
			}
			
			//insert
			$user_array = array('req_name'			=>$req['reg_name']
								,'req_land'			=>$req['reg_land']
								,'req_card'			=>$req['reg_card']
								,'req_home_status'	=>$req['reg_status']
								,'req_email'		=>$req['reg_email']
								,'req_phone'		=>$req['reg_phone']
								,'req_pass'			=>Hash::create(HASH_FUN,$req['reg_pass'],HASH_PASSWORD_KEY)
								,'create_at'		=>$time
								);
				
			$this->db->insert(DB_PREFEX.'reg_request',$user_array);
				
			$id = $this->db->LastInsertedId();
			unset($user_array['req_pass']);
			$user_array['id'] = $id;
			kb9::save_notification($this->db, $user_array,2);
			Email::welcome_reg($req['reg_name'],$req['reg_email']);
			return array('ok'=>$id);
		}
		
		
	}
?>
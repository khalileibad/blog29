<?php
	/**
	* profile MODEL, 
	*/
	class profile_model extends model
	{
		/** The Default Method Like Main in java*/
		function __construct()
		{
			parent::__construct();
		}
		
		/**
		* function totals
		* get total data
		*/
		public function info()
		{
			if(session::get('user_type') == "pa")
			{
				$x = $this->db->select("SELECT * FROM ".DB_PREFEX."patient
										WHERE pa_id = :ID"
										,array(":ID"=>session::get('user_id')));
				return $x[0];
			}else
			{
				$x = $this->db->select("SELECT * FROM ".DB_PREFEX."staff
										WHERE staff_id = :ID"
										,array(":ID"=>session::get('user_id')));
				return $x[0];
			}
		}
		
		/**
		* function upd_info
		* update user info
		* AJAX
		*/
		public function upd_staff_info()
		{
			$form	= new form();
			$time	= dates::convert_to_date('now');
			$time	= dates::convert_to_string($time);
			
			$form	->post('name')
					->valid('Min_Length',2)
					->valid('Max_Length',90)
					
					->post('name_en')
					->valid('Min_Length',2)
					->valid('Max_Length',90)
					
					->post('phone')
					->valid('Phone')
					
					->post('email')
					->valid('Email')
					
					->post('speci',true,true)//Specializ
					->valid('In_Array',array_keys(clinic::$dr_types))
					
					->post('address')
					->valid('Min_Length',2)
					->valid('Max_Length',90)
					
					->submit();
			$fdata	= $form->fetch();
			
			if(!empty($fdata['MSG']))
			{
				return array('Error'=>$fdata['MSG']);
			}
			
			//update info
			
			$user_array = array('staff_name'		=>$fdata['name']
								,'staff_name_EN'	=>$fdata['name_en']
								,'staff_phone'		=>$fdata['phone']
								,'staff_email'		=>$fdata['email']
								,'staff_address'	=>$fdata['address']
								,'update_at'		=>$time
								);
			if(session::get('user_type')!='admin')
			{
				if(empty($fdata['speci']))
				{
					return array('Error'=>"In Field speci: Error data");
				}
				$user_array['staff_special'] = $fdata['speci'];
			}
				
			//update image
			if(!empty($_FILES['user_img']))
			{
				$files	= new files(); 
				if($files->check_file($_FILES['user_img'],'img'))
				{
					$fdata['user_img'] = $files->up_file($_FILES['user_img'],URL_PATH.'public/IMG/user/'.session::get('user_id'));
					$user_array['staff_img'] = $fdata['user_img'];
				}else
				{
					return array('Error'=>"In Field user_img: Error data");
				}
			}
			$this->db->update(DB_PREFEX.'staff',$user_array,"staff_id = ".session::get('user_id'));
			
			$fdata['ok'] = 1;
			
			return $fdata;
			
		}
		
		/**
		* update_password
		* to update password
		*/
		public function update_password()
		{
			$time	= dates::convert_to_date('now');
			$time	= dates::convert_to_string($time);
			
			$form = new form();
			
			$form		->post('old_password')
						->valid('Min_Length',2)
						->valid('Max_Length',90)
						
						->post('new_password')
						->valid('Min_Length',2)
						->valid('Max_Length',90)
						
						->post('conf_password')
						->valid('Min_Length',2)
						->valid('Max_Length',90)
						
						->submit();
			$d = $form->fetch();
			
			if(!empty($d['MSG']))
			{
				return array('Error'=>$d['MSG']);
			}
			if($d['new_password'] != $d['conf_password'])
			{
				return array('Error'=>"In Field conf_password: Error not match");
			}
			
			if(session::get('user_type')!='pa')
			{
				$user = $this->db->select("SELECT staff_id FROM ".DB_PREFEX."staff 
										WHERE 
										staff_id = :ID AND staff_pass = :PASS AND staff_active = 1" ,
										array(':ID'=>session::get('user_id'),':PASS'=>Hash::create(HASH_FUN,$d['old_password'],HASH_PASSWORD_KEY))
									);
				if(count($user)!= 1)
				{
					return array('Error'=>"In Field old_password: Error not match");
				}
				
				$this->db->update(DB_PREFEX.'staff',
								array('staff_pass'=>Hash::create(HASH_FUN,$d['new_password'],HASH_PASSWORD_KEY)
								,'update_at'=>$time,'update_by'=>session::get('user_id')),
								'staff_id ='.session::get('user_id'));
				
			}else
			{
				//SELECT ``, `pa_name`, `pa_phone`, `pa_email`, `pa_birthdate`, `pa_uname`, `` FROM `cli_` WHERE 1
				$user = $this->db->select("SELECT pa_id FROM ".DB_PREFEX."patient 
										WHERE 
										pa_id = :ID AND pa_pass = :PASS " ,
										array(':ID'=>session::get('user_id')
											,':PASS'=>Hash::create(HASH_FUN,$d['old_password'],HASH_PASSWORD_KEY))
									);
				if(count($user)!= 1)
				{
					return array('Error'=>"In Field old_password: Error not match");
				}
				
				$this->db->update(DB_PREFEX.'patient',
								array('pa_pass'=>Hash::create(HASH_FUN,$d['new_password'],HASH_PASSWORD_KEY)
								,'update_at'=>$time,'update_by'=>session::get('user_id')),
								'pa_id ='.session::get('user_id'));
				
			}
			
			session::destroy();
			return array('ok'=>1);
		}
		
		
	
	}
?>
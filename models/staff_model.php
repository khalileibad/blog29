<?php
	/**
	* staff MODEL, 
	*/
	class staff_model extends model
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
		* function user_list
		* get users list
		*/
		public function user_list()
		{
			$form	= new form();
			
			$form	->post('name',false,true) // Name
					->valid('Min_Length',3)
					
					->post('type',false,true) // القسم
					->valid('In_Array',array_keys(staff_settings::$staf_asso_type))
					
					->post('email',false,true) // email
					->valid('Email')
					
					->submit();
			$fdata	= $form->fetch();
			
			if(!empty($fdata['MSG']))
			{
				return 'Error: '.$fdata['MSG'];
			}
			
			$sea_arr = array();
			$sea_txt = '';
			
			if(!empty($fdata['name']))
			{
				$sea_arr[':NAME'] = "%".$fdata['name']."%";
				$sea_txt .= 'staff_name like :NAME AND ';
			}
			if(!empty($fdata['type']))
			{
				$sea_arr[':GR'] = $fdata['type'];
				$sea_txt .= 'staff_type = :GR AND ';
			}
			if(!empty($fdata['email']))
			{
				$sea_arr[':ACA'] = $fdata['email'];
				$sea_txt .= 'staff_email = :ACA AND ';
			}
			$sea_txt .= ' staff_type != "admin" ';
			
			return $this->db->select("SELECT staff_id, staff_name, staff_phone
										,staff_email , staff_type, staff_active
										,staff_img
										FROM ".DB_PREFEX."staff
										WHERE $sea_txt
										ORDER BY staff_name ASC
										" ,$sea_arr
								);
		}
		
		/**
		* function new_Staff
		* create new staff
		*/
		public function new_Staff()
		{
			$time	= dates::convert_to_date('now');
			$time	= dates::convert_to_string($time);
			
			$form	= new form();
			
			$form	->post('name') // Name
					->valid('Min_Length',3)
					
					->post('type') 
					->valid('In_Array',array_keys(staff_settings::$staf_asso_type))
					
					->post('phone')
					->valid('Phone')
					
					->post('email')
					->valid('Email')
					
					->post('pass') // pass
					->valid('Min_Length',3)
					
					->submit();
			$fdata	= $form->fetch();
			
			if(!empty($fdata['MSG']))
			{
				return array('Error'=>$fdata['MSG']);
			}
			
			//check Email:
			$em = $this->db->select("SELECT staff_email, staff_phone FROM ".DB_PREFEX."staff 
									WHERE staff_email = :AD OR staff_phone = :PH"
									,array(":AD"=>$fdata['email'],":PH"=>$fdata['phone']));
			if(count($em) != 0)
			{
				$err = "";
				foreach($em as $val)
				{
					if($val['staff_phone'] == $fdata['phone'])
					{
						$em .= "In Field phone : Duplicate .. \n";
					}
					if($val['staff_email'] == $fdata['email'])
					{
						$em .= "In Field email : Duplicate .. \n";
					}
				}
				if(!empty($err))
				{
					return array('Error'=>$err);
				}
			}
			
			//insert
			$user_array = array('staff_full_name'		=> $fdata['name']
								,'staff_full_name_en'	=> $fdata['name']
								,'staff_type'			=> $fdata['type']
								,'staff_phone'			=> $fdata['phone']
								,'staff_email'			=> $fdata['email']
								,'staff_pass'			=> Hash::create(HASH_FUN,$fdata['pass'],HASH_PASSWORD_KEY)
								,'create_at'			=> $time
								,'create_by'			=> session::get('user_id')
								);
			$this->db->insert(DB_PREFEX.'staff',$user_array);
			
			return array('id'=>$this->db->LastInsertedId());
		}
		
		/**
		* function upd_Staff
		* update staff
		*/
		public function upd_Staff()
		{
			$time	= dates::convert_to_date('now');
			$time	= dates::convert_to_string($time);
			
			$form	= new form();
			
			$form	->post('upd_id') // id
					->valid('Integer')
					
					->post('upd_type') 
					->valid('In_Array',array_keys(staff_settings::$staf_asso_type))
					
					->post('upd_name') // Name
					->valid('Min_Length',3)
					
					->post('upd_pass',false,true) // pass
					->valid('Min_Length',3)
					
					->post('upd_email') // Email
					->valid('Min_Length',3)
					
					->post('upd_phone') // phone
					->valid('Min_Length',3)
					
					/*->post('upd_dep')
					->valid('Integer')
					*/
					->submit();
			$fdata	= $form->fetch();
			
			if(!empty($fdata['MSG']))
			{
				return array('Error'=>$fdata['MSG']);
			}
			
			//check NO:
			$em = $this->db->select("SELECT staID FROM ".DB_PREFEX."staff 
									WHERE staID = :ID"
									,array(":ID"=>$fdata['upd_id']));
			if(count($em) != 1)
			{
				return array('Error'=>"لم يتم العثور على الموظف");
			}
			
			//check Email:
			$em = $this->db->select("SELECT staID FROM ".DB_PREFEX."staff 
									WHERE (staff_email = :AD OR staff_phone = :PH) AND staID != :ID"
									,array(":AD"=>$fdata['upd_email'],":PH"=>$fdata['upd_phone'],":ID"=>$fdata['upd_id']));
			if(count($em) != 0)
			{
				$err = "";
				foreach($em as $val)
				{
					if($val['staff_phone'] == $fdata['upd_phone'])
					{
						$em .= "In Field upd_phone : Duplicate .. \n";
					}
					if($val['staff_email'] == $fdata['upd_email'])
					{
						$em .= "In Field upd_email : Duplicate .. \n";
					}
				}
				if(!empty($err))
				{
					return array('Error'=>$err);
				}
			}
			
			/*/check DEP
			$em = $this->db->select("SELECT dep_id FROM ".DB_PREFEX."department 
									WHERE dep_id = :AD"
									,array(":AD"=>$fdata['upd_dep']));
			if(count($em) != 1)
			{
				return array('Error'=>"In Field upd_dep : Not Found .. \n");
			}*/
			
			//Update
			$user_array = array('staff_full_name'		=> $fdata['upd_name']
								,'staff_full_name_en'	=> $fdata['upd_name']
								,'staff_type'			=> $fdata['upd_type']
								,'staff_email'			=> $fdata['upd_email']
								,'staff_phone'			=> $fdata['upd_phone']
								);
			if(!empty($fdata['upd_pass']))
			{
				$user_array['staff_pass'] = Hash::create(HASH_FUN,$fdata['upd_pass'],HASH_PASSWORD_KEY);
			}
			$this->db->update(DB_PREFEX.'staff',$user_array,'staID = '.$fdata['upd_id']);
			
			return array('id'=>$fdata['upd_id']);
		}
		
		/**
		* function del_Staff
		* delete staff
		*/
		public function del_Staff()
		{
			$time	= dates::convert_to_date('now');
			$time	= dates::convert_to_string($time);
			
			$form	= new form();
			
			$form	->post('upd_id') // Admission
					->valid('Integer')
					
					->submit();
			$fdata	= $form->fetch();
			
			if(!empty($fdata['MSG']))
			{
				return array('Error'=>$fdata['MSG']);
			}
			
			//check NO:
			$em = $this->db->select("SELECT staID FROM ".DB_PREFEX."staff 
									WHERE staID = :ID"
									,array(":ID"=>$fdata['upd_id']));
			if(count($em) != 1)
			{
				return array('Error'=>"لم يتم العثور على الموظف");
			}
			
			$this->db->delete(DB_PREFEX.'staff','staID = '.$fdata['upd_id']);
			
			return array('id'=>$fdata['upd_id']);
		}
		
		/**
		* function active
		* active / freez agent
		* AJAX
		*/
		public function active()
		{
			$form	= new form();
			
			$form	->post('id') // ID
					->valid('Integer')
					
					->post('current',false,true) // Name
					->valid('In_Array',array('true','false'))
					
					->submit();
			$fdata	= $form->fetch();
			
			if(!empty($fdata['MSG']))
			{
				return array('Error'=>"err_id");
			}
			
			//check NO:
			$data = $this->db->select("SELECT staff_active FROM ".DB_PREFEX."staff 
									WHERE staID = :ID"
									,array(":ID"=>$fdata['id']));
			if(count($data) != 1)
			{
				return array('Error'=>"لم يتم العثور على الموظف");
			}
			
			$curr = ($data[0]['staff_active']==1)?true:false;
			
			if(($fdata['current'] == "true" && !$curr)||($fdata['current']== "false" && $curr))
			{
				return array('Error'=>'حالة الموظف الحالية هي  '.$curr.' - '.$fdata['current']);
			}	
			$time	= dates::convert_to_date('now');
			$time	= dates::convert_to_string($time);
			
			$this->db->update(DB_PREFEX.'staff',array('staff_active'=>($curr)?0:1),'staID = '.$fdata['id']);
			return array('ok'=>'1');
		}
			
		/**
		* function msg_staff
		* msg_staff
		* AJAX
		*/
		public function msg_staff()
		{
			$form	= new form();
			
			$form	->post('id') // ID
					->valid('Integer')
					
					->post('msg_comm') // MSG
					->valid('Min_Length',5)
					
					->post('sms_msg',false,true) // SMS
					->valid('Integer')
					
					->post('email_msg',false,true) // Email
					->valid('Integer')
					
					->submit();
			$fdata	= $form->fetch();
			
			if(!empty($fdata['MSG']))
			{
				return array('Error'=>$fdata['MSG']);
			}
			
			//check NO:
			$data = $this->db->select("SELECT staff_phone, staff_email FROM ".DB_PREFEX."staff 
									WHERE staID = :ID"
									,array(":ID"=>$fdata['id']));
			if(count($data) != 1)
			{
				return array('Error'=>"لم يتم العثور على الموظف");
			}
			
			$data = $data[0];
			
			$email = new Email();
			
			if(!empty($fdata['email_msg']))
			{
				$email->send_email($data['staff_email'],"MSG",$fdata['msg_comm']);
			}
			if(!empty($fdata['sms_msg']))
			{
				$email->send_SMS($data['staff_phone'],$fdata['msg_comm']);
			}
			
			
			
			return array('id'=>'1');
		}
			
		
	}
?>
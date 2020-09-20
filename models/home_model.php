<?php
	/**
	* home MODEL, 
	*/
	class home_model extends model
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
		* function info
		* get current user info and blogs
		*/
		public function info()
		{
			//get user data
			$b = $this->db->select("SELECT staff_id, staff_name, staff_phone, staff_email, staff_img, staff_address
									,staff_about, staff_face, staff_twitter, staff_linked, staff_instagram 
									FROM ".DB_PREFEX."staff
									WHERE staff_id = :ID AND staff_type = 'bloger'
									",array(":ID"=>session::get('user_id')));
			if(count($b)!= 1)
			{
				return array();
			}
			$blog_user = array('id'				=>$b[0]['staff_id'],
								'name'			=>$b[0]['staff_name'],
								'phone'			=>$b[0]['staff_phone'],
								'email'			=>$b[0]['staff_email'],
								'address'		=>$b[0]['staff_address'],
								'about'			=>$b[0]['staff_about'],
								'user_img'		=>$b[0]['staff_img'],
								'user_face'		=>$b[0]['staff_face'],
								'user_twitter'	=>$b[0]['staff_twitter'],
								'user_instegram'=>$b[0]['staff_instagram'],
								'user_linked'	=>$b[0]['staff_linked'],
								'blogs'			=>array(),
								);
			
			//get blog data
			$b = $this->db->select("SELECT b_id, b_title, b_desc, b_img, b_likes, b_see, b_accept_date
									FROM ".DB_PREFEX."blog 
									WHERE b_user = :ID AND b_accept_date IS NOT NULL
									ORDER BY b_accept_date DESC
									",array(":ID"=>session::get('user_id')));
			
			foreach($b as $val)
			{
				$x = array('id'			=>$val['b_id'],
							'title'		=>$val['b_title'],
							'desc'		=>$val['b_desc'],
							'img'		=>$val['b_img'],
							'likes'		=>$val['b_likes'],
							'b_see'		=>$val['b_see'],
							'publish'	=>$val['b_accept_date'],
							'cat'		=>array()
							);
				//get blog category
				$cat = $this->db->select('SELECT cat_id, cat_name,comment,cat_class
										FROM '.DB_PREFEX.'blog_category 
										JOIN '.DB_PREFEX.'category ON category = cat_id
										WHERE blog_id = :ID 
										',array(':ID'=>$val['b_id']));
				foreach($cat as $value)
				{
					array_push($x['cat'],array('id'=>$value['cat_id']
											,'name'=>$value['cat_name']
											,'class'=>$value['cat_class']
											,'comm'=>$value['comment']));
				}
				array_push($blog_user['blogs'],$x);
			}
			return $blog_user;
		}
		
		
		
		
		/**
		* function new_people
		* create new people
		*/
		public function new_people()
		{
			$time	= dates::convert_to_date('now');
			$time	= dates::convert_to_string($time);
			
			$form	= new form();
			
			$form	->post('name') // Name
					->valid('Min_Length',3)
					->valid('Max_Length',100)
					
					->post('name_en',false,true) // Name
					->valid('Min_Length',3)
					->valid('Max_Length',100)
					
					->post('id_type') // ID Type
					->valid('In_array',array_keys(kb9::$id_type))
					
					->post('id_no') // ID Number
					->valid('Min_Length',7)
					
					->post('phone') // phone
					->valid('Phone')
					
					->post('email') // email
					->valid('Email')
					
					->post('gender',false,true) // gender
					->valid('In_array',array_keys(kb9::$gender))
					
					->post('birth',false,true) // birth date
					->valid('Date')
					
					->post('nat',false,true) // nationality
					->valid('In_array',array_keys(kb9::$countries))
					
					->post('social',false,true) // social
					->valid('In_array',array_keys(kb9::$Social))
					
					->post('acadimic',false,true) // acadimaic
					->valid('In_array',array_keys(kb9::$Acadimic))
					
					->post('job',false,true) // job
					->valid('Min_Length',3)
					
					->submit();
			$fdata	= $form->fetch();
			
			if(!empty($fdata['MSG']))
			{
				return array('Error'=>$fdata['MSG']);
			}
			
			//check email & phone in people, staff and house
			$err = "";
			$sea_arr = array(':EMAIL'=>$fdata['email']);
			
			//house
			$em = $this->db->select("SELECT h_email 
									FROM ".DB_PREFEX."house 
									WHERE h_email = :EMAIL" 
										,$sea_arr);
			if(count($em) != 0)
			{
				foreach($em as $val)
				{
					if($val['h_email'] == $fdata['email'] )
					{
						$err .= "In Field email : Duplicate .. \n";
					}
				}
			}
			
			//staff
			$em = $this->db->select("SELECT staff_email 
									FROM ".DB_PREFEX."staff 
									WHERE staff_email = :EMAIL" 
										,$sea_arr);
			if(count($em) != 0)
			{
				foreach($em as $val)
				{
					if($val['staff_email'] == $fdata['email'] )
					{
						$err .= "In Field email : Duplicate .. \n";
					}
				}
			}
			
			//people
			$sea_arr[':PHONE'] 	= $fdata['phone'];
			$sea_arr[':ID'] 	= (!empty($fdata['id_no']))?$fdata['id_no']:"0";
			$sea_arr[':ID_TY'] 	= (!empty($fdata['id_type']))?$fdata['id_type']:"0";
			$em = $this->db->select("SELECT peo_phone, peo_email, peo_id_no, peo_id_type
									FROM ".DB_PREFEX."people 
									WHERE peo_email = :EMAIL 
										OR peo_phone = :PHONE
										OR (peo_id_no = :ID AND peo_id_type = :ID_TY)" 
										,$sea_arr);
			if(count($em) != 0)
			{
				foreach($em as $val)
				{
					if($val['peo_email'] == $fdata['email'] )
					{
						$err .= "In Field email : Duplicate .. \n";
					}
					if($val['peo_phone'] == $fdata['phone'])
					{
						$err .= "In Field phone : Duplicate .. \n";
					}
					if($val['peo_id_no'] == $fdata['id_no'] && $val['peo_id_type'] == $fdata['id_type'] )
					{
						$err .= "In Field id_no : Duplicate .. \n";
					}
				}
			}
			
			if(!empty($err))
			{
				return array('Error'=>$err);
			}
			
			//create people
			$people_array = array('peo_name'	=> $fdata['name']
								,'peo_house'	=> session::get('user_id')
								,'peo_main'		=> 0
								,'create_at'	=> $time
								);
							
			if(!empty($fdata['name_en']))
			{
				$people_array['peo_name_EN'] = $fdata['name_en'];
			}
			if(!empty($fdata['id_type']))
			{
				$people_array['peo_id_type'] = $fdata['id_type'];
			}
			if(!empty($fdata['id_no']))
			{
				$people_array['peo_id_no'] = $fdata['id_no'];
			}
			if(!empty($fdata['phone']))
			{
				$people_array['peo_phone'] = $fdata['phone'];
			}
			if(!empty($fdata['email']))
			{
				$people_array['peo_email'] = $fdata['email'];
			}
			if(!empty($fdata['gender']))
			{
				$people_array['peo_gender'] = $fdata['gender'];
			}
			if(!empty($fdata['birth']))
			{
				$people_array['peo_birth'] = $fdata['birth'];
			}
			if(!empty($fdata['nat']))
			{
				$people_array['peo_nationality'] = $fdata['nat'];
			}
			if(!empty($fdata['social']))
			{
				$people_array['peo_social'] = $fdata['social'];
			}
			if(!empty($fdata['acadimic']))
			{
				$people_array['peo_acadimic'] = $fdata['acadimic'];
			}
			if(!empty($fdata['job']))
			{
				$people_array['peo_job'] = $fdata['job'];
			}
			
			$this->db->insert(DB_PREFEX.'people',$people_array);
			$id = $this->db->LastInsertedId();
			
			return array('id'=> $id);
		}
		
		/**
		* function new_people
		* create new people
		*/
		public function new_worker()
		{
			$time	= dates::convert_to_date('now');
			$time	= dates::convert_to_string($time);
			
			$form	= new form();
			
			$form	->post('work_name') // Name
					->valid('Min_Length',3)
					->valid('Max_Length',100)
					
					->post('work_name_en',false,true) // Name
					->valid('Min_Length',3)
					->valid('Max_Length',100)
					
					->post('work_phone') // phone
					->valid('Phone')
					
					->post('work_job',false,true) // job
					->valid('Min_Length',3)
					
					->post('work_gender',false,true) // gender
					->valid('In_array',array_keys(kb9::$gender))
					
					->post('work_nat',false,true) // nationality
					->valid('In_array',array_keys(kb9::$countries))
					
					->post('work_soc',false,true) // social
					->valid('In_array',array_keys(kb9::$Social))
					
					->submit();
			$fdata	= $form->fetch();
			
			if(!empty($fdata['MSG']))
			{
				return array('Error'=>$fdata['MSG']);
			}
			
			//create people
			$people_array = array('work_name'	=> $fdata['work_name']
								,'work_house'	=> session::get('user_id')
								,'create_at'	=> $time
								);
							
			if(!empty($fdata['work_name_en']))
			{
				$people_array['work_name_EN'] = $fdata['work_name_en'];
			}
			if(!empty($fdata['work_phone']))
			{
				$people_array['work_phone'] = $fdata['work_phone'];
			}
			if(!empty($fdata['work_job']))
			{
				$people_array['work_job'] = $fdata['work_job'];
			}
			if(!empty($fdata['work_gender']))
			{
				$people_array['work_gender'] = $fdata['work_gender'];
			}
			if(!empty($fdata['work_nat']))
			{
				$people_array['work_nationality'] = $fdata['work_nat'];
			}
			if(!empty($fdata['work_soc']))
			{
				$people_array['work_social'] = $fdata['work_soc'];
			}
			
			$this->db->insert(DB_PREFEX.'worker',$people_array);
			$id = $this->db->LastInsertedId();
			return array('id'=> $id);
		}
		
		/**
		* function peo_info
		* get people Home Details info
		*/
		public function peo_info()
		{
			$ret = array();
			
			//get People
			$ret = $this->db->select("SELECT peo_id, peo_name, peo_name_EN
										,peo_id_type, peo_id_no, peo_birth
										,peo_gender, peo_nationality, peo_social, peo_acadimic
										,peo_job, peo_phone, peo_email, peo_main
										FROM ".DB_PREFEX."people WHERE peo_house = :ID"
										,array(":ID"=>session::get('user_id')));
			//Get Deseases
			foreach($ret AS $key => $val)
			{
				$ret[$key]['deseases'] = $this->db->select("SELECT des_id, des_desease
															,des_start, des_end, des_comment
															FROM ".DB_PREFEX."disease 
															WHERE des_people = :ID"
															,array(":ID"=>$val['peo_id']));
			}
			
			return $ret;
		}
		
		/**
		* function peo_info
		* get people Home Details info
		*/
		public function work_info()
		{
			//get workers
			return $this->db->select("SELECT work_id, work_name, work_name_EN, work_phone
												,work_nationality, work_social, work_gender, work_job
												FROM ".DB_PREFEX."worker WHERE work_house = :ID"
												,array(":ID"=>session::get('user_id')));
			
		}
		
		/**
		* function upd_land
		* update land info
		*/
		public function upd_land()
		{
			$time	= dates::convert_to_date('now');
			$time	= dates::convert_to_string($time);
			
			$form	= new form();
			
			$form	->post('l_id') // ID
					->valid('Integer')
					
					->post('land_no') // No
					->valid('Integer')
					
					->post('land_sub_no') // sub No
					->valid('Integer')
					
					->post('land_owner') // Owner Name
					->valid('Min_Length',2)
					
					->post('land_owner_en') // Owner Name EN
					->valid('Min_Length',2)
					
					->post('land_phone') // phone
					->valid('Phone')
					
					->post('land_email') // Email
					
					->post('land_status') // STATUS
					->valid('In_array',array_keys(kb9::$land_type))
					
					->post('land_units') // Units
					->valid('Integer')
					
					->post('land_floor') // Floors
					->valid('Integer')
					
					->submit();
			$fdata	= $form->fetch();
			
			if(!empty($fdata['MSG']))
			{
				return array('Error'=>$fdata['MSG']);
			}
			
			//check ID:
			$em = $this->db->select("SELECT l_id FROM ".DB_PREFEX."land 
									WHERE l_id = :ID  "
									,array(":ID"=>$fdata['l_id']));
			if(count($em) != 1)
			{
				return array('Error'=>"لم يتم العثور على بيانات الارض");
			}
			
			//sub no
			if(empty($fdata['land_sub_no']) && $fdata['land_sub_no'] !== 0)
			{
				$fdata['land_sub_no'] = 0;
			}
			//check no:
			$em = $this->db->select("SELECT l_id FROM ".DB_PREFEX."land 
									WHERE l_no = :NO AND l_sub_no = :SUB AND l_id != :ID  "
									,array(":NO"=>$fdata['land_no'],":SUB"=>$fdata['land_sub_no'],":ID"=>$fdata['l_id']));
			if(count($em) != 0)
			{
				return array('Error'=>"In Field land_no : Duplicate .. \n In Field land_sub_no : Duplicate .. \n");
			}
			
			//Update
			$land_array = array('l_no'				=> $fdata['land_no']
								,'l_sub_no'			=> $fdata['land_sub_no']
								,'l_owner_name'		=> $fdata['land_owner']
								,'l_owner_name_EN'	=> $fdata['land_owner_en']
								,'l_owner_phone'	=> $fdata['land_phone']
								,'l_owner_email'	=> $fdata['land_email']
								,'l_type'			=> $fdata['land_status']
								,'l_house'			=> $fdata['land_units']
								,'l_floor'			=> $fdata['land_floor']
								,'update_by'		=> session::get('user_id')
								,'update_at'		=> $time
								);
			
			$this->db->update(DB_PREFEX.'land',$land_array,'l_id = '.$fdata['l_id']);
			
			return array('id'=>$fdata['l_id']);
		}
		
		/**
		* function upd_house
		* update House info
		*/
		public function upd_house()
		{
			$time	= dates::convert_to_date('now');
			$time	= dates::convert_to_string($time);
			
			$form	= new form();
			
			$form	->post('house_floor') // Floor
					->valid('Integer')
					
					->post('house_status') // status
					->valid('In_array',array_keys(kb9::$house_live_type))
					
					->post('house_card') // card
					->valid('Integer')
					
					->post('house_desc',false,true) // Description
					->valid('Min_Length',2)
					
					->submit();
			$fdata	= $form->fetch();
			
			if(!empty($fdata['MSG']))
			{
				return array('Error'=>$fdata['MSG']);
			}
			
			//check card no:
			$em = $this->db->select("SELECT h_id FROM ".DB_PREFEX."house 
									WHERE h_card = :NO AND h_id != :ID  "
									,array(":NO"=>$fdata['house_card'],":ID"=>session::get('user_id')));
			if(count($em) != 0)
			{
				return array('Error'=>"In Field house_card : Duplicate .. \n");
			}
			
			//Update
			$house_array = array('h_floor'	=> $fdata['house_floor']
								,'h_type'	=> $fdata['house_status']
								,'h_card'	=> $fdata['house_card']
								,'h_desc'	=> $fdata['house_desc']
								,'update_by'=> null
								,'update_at'=> $time
								);
			
			$this->db->update(DB_PREFEX.'house',$house_array,'h_id = '.session::get('user_id'));
			
			return array('id'=>session::get('user_id'));
		}
		
		/**
		* function upd_people
		* update people data
		*/
		public function upd_people()
		{
			$time	= dates::convert_to_date('now');
			$time	= dates::convert_to_string($time);
			
			$form	= new form();
			
			$form	->post('id') //people ID
					->valid('Integer')
					
					->post('upd_name') // Name
					->valid('Min_Length',3)
					->valid('Max_Length',100)
					
					->post('upd_name_en',false,true) // Name
					->valid('Min_Length',3)
					->valid('Max_Length',100)
					
					->post('upd_id_type') // ID Type
					->valid('In_array',array_keys(kb9::$id_type))
					
					->post('upd_id_no') // ID Number
					->valid('Min_Length',7)
					
					->post('upd_phone') // phone
					->valid('Phone')
					
					->post('upd_email') // email
					->valid('Email')
					
					->post('upd_gender',false,true) // gender
					->valid('In_array',array_keys(kb9::$gender))
					
					->post('upd_birth',false,true) // birth date
					->valid('Date')
					
					->post('upd_nat',false,true) // nationality
					->valid('In_array',array_keys(kb9::$countries))
					
					->post('upd_soc',false,true) // social
					->valid('In_array',array_keys(kb9::$Social))
					
					->post('upd_aca',false,true) // acadimaic
					->valid('In_array',array_keys(kb9::$Acadimic))
					
					->post('upd_job',false,true) // job
					->valid('Min_Length',3)
					
					->submit();
			$fdata	= $form->fetch();
			
			if(!empty($fdata['MSG']))
			{
				return array('Error'=>$fdata['MSG']);
			}
			
			
			//check email & phone in people
			$err = "";
			$sea_arr = array(':EMAIL'	=>$fdata['upd_email']
							,':PHONE'	=>$fdata['upd_phone']
							,':ID'		=>(!empty($fdata['upd_id_no']))?$fdata['upd_id_no']:"0"
							,':ID_TY'	=>(!empty($fdata['upd_id_type']))?$fdata['upd_id_type']:"0"
							,':ID_NO'	=>$fdata['id']
							);
			
			$em = $this->db->select("SELECT peo_phone, peo_email, peo_id_no, peo_id_type
									FROM ".DB_PREFEX."people 
									WHERE peo_id != :ID_NO AND (peo_email = :EMAIL 
										OR peo_phone = :PHONE
										OR (peo_id_no = :ID AND peo_id_type = :ID_TY))" 
										,$sea_arr);
			if(count($em) != 0)
			{
				foreach($em as $val)
				{
					if($val['peo_email'] == $fdata['upd_email'] )
					{
						$err .= "In Field upd_email : Duplicate .. \n";
					}
					if($val['peo_phone'] == $fdata['upd_phone'])
					{
						$err .= "In Field ne_house_phone : Duplicate .. \n";
					}
					if($val['peo_id_no'] == $fdata['upd_id_no'] && $val['peo_id_type'] == $fdata['upd_id_type'] )
					{
						$err .= "In Field upd_id_no : Duplicate .. \n";
					}
				}
			}
			
			if(!empty($err))
			{
				return array('Error'=>$err);
			}
			
			//update people
			$people_array = array('peo_name'	=> $fdata['upd_name']
								,'update_at'	=> $time
								,'update_by'	=> null
								);
							
			if(!empty($fdata['upd_name_en']))
			{
				$people_array['peo_name_EN'] = $fdata['upd_name_en'];
			}
			if(!empty($fdata['upd_id_type']))
			{
				$people_array['peo_id_type'] = $fdata['upd_id_type'];
			}
			if(!empty($fdata['upd_id_no']))
			{
				$people_array['peo_id_no'] = $fdata['upd_id_no'];
			}
			if(!empty($fdata['upd_phone']))
			{
				$people_array['peo_phone'] = $fdata['upd_phone'];
			}
			if(!empty($fdata['upd_email']))
			{
				$people_array['peo_email'] = $fdata['upd_email'];
			}
			if(!empty($fdata['upd_gender']))
			{
				$people_array['peo_gender'] = $fdata['upd_gender'];
			}
			if(!empty($fdata['upd_birth']))
			{
				$people_array['peo_birth'] = $fdata['upd_birth'];
			}
			if(!empty($fdata['upd_nat']))
			{
				$people_array['peo_nationality'] = $fdata['upd_nat'];
			}
			if(!empty($fdata['upd_soc']))
			{
				$people_array['peo_social'] = $fdata['upd_soc'];
			}
			if(!empty($fdata['upd_aca']))
			{
				$people_array['peo_acadimic'] = $fdata['upd_aca'];
			}
			if(!empty($fdata['upd_job']))
			{
				$people_array['peo_job'] = $fdata['upd_job'];
			}
			
			$this->db->update(DB_PREFEX.'people',$people_array,'peo_id = '.$fdata['id']);
			
			return array('id'=> $fdata['id']);
		}
		
		/**
		* function upd_worker
		* update worker data
		*/
		public function upd_worker()
		{
			$time	= dates::convert_to_date('now');
			$time	= dates::convert_to_string($time);
			
			$form	= new form();
			
			$form	->post('id') //Worker ID
					->valid('Integer')
					
					->post('upd_work_name') // Name
					->valid('Min_Length',3)
					->valid('Max_Length',100)
					
					->post('upd_work_name_en',false,true) // Name
					->valid('Min_Length',3)
					->valid('Max_Length',100)
					
					->post('upd_work_phone') // phone
					->valid('Phone')
					
					->post('upd_work_job',false,true) // job
					->valid('Min_Length',3)
					
					->post('upd_work_gender',false,true) // gender
					->valid('In_array',array_keys(kb9::$gender))
					
					->post('upd_work_nat',false,true) // nationality
					->valid('In_array',array_keys(kb9::$countries))
					
					->post('upd_work_soc',false,true) // social
					->valid('In_array',array_keys(kb9::$Social))
					
					->submit();
			$fdata	= $form->fetch();
			
			if(!empty($fdata['MSG']))
			{
				return array('Error'=>$fdata['MSG']);
			}
			
			//create people
			$people_array = array('work_name'	=> $fdata['upd_work_name']
								,'update_at'	=> $time
								,'update_by'	=> null
								);
							
			if(!empty($fdata['upd_work_name_en']))
			{
				$people_array['work_name_EN'] = $fdata['upd_work_name_en'];
			}
			if(!empty($fdata['upd_work_phone']))
			{
				$people_array['work_phone'] = $fdata['upd_work_phone'];
			}
			if(!empty($fdata['upd_work_job']))
			{
				$people_array['work_job'] = $fdata['upd_work_job'];
			}
			if(!empty($fdata['upd_work_gender']))
			{
				$people_array['work_gender'] = $fdata['upd_work_gender'];
			}
			if(!empty($fdata['upd_work_nat']))
			{
				$people_array['work_nationality'] = $fdata['upd_work_nat'];
			}
			if(!empty($fdata['upd_work_soc']))
			{
				$people_array['work_social'] = $fdata['upd_work_soc'];
			}
			
			$this->db->update(DB_PREFEX.'worker',$people_array,'work_id = '.$fdata['id']);
			
			return array('id'=> $fdata['id']);
		}
		
		/**
		* function del_people
		* delete people
		*/
		public function del_people($id)
		{
			$form	= new form();
			
			if(empty($id) || !$form->single_valid($id,'Integer'))
			{
				return array();
			}
			//
			
			//check ID:
			$em = $this->db->select("SELECT peo_id FROM ".DB_PREFEX."people 
									WHERE peo_id = :ID  "
									,array(":ID"=>$id));
			if(count($em) != 1)
			{
				return array('Error'=>"لم يتم العثور على المواطن");
			}
			
			
			$this->db->delete(DB_PREFEX.'people','peo_id = '.$id);
			
			return array('id'=>$id);
		}
		
		/**
		* function del_worker
		* delete worker
		*/
		public function del_worker($id)
		{
			$form	= new form();
			
			if(empty($id) || !$form->single_valid($id,'Integer'))
			{
				return array();
			}
			
			//check ID:
			$em = $this->db->select("SELECT work_id FROM ".DB_PREFEX."worker 
									WHERE work_id = :ID  "
									,array(":ID"=>$id));
			if(count($em) != 1)
			{
				return array('Error'=>"لم يتم العثور على المواطن");
			}
			
			
			$this->db->delete(DB_PREFEX.'worker','work_id = '.$id);
			
			return array('id'=>$id);
		}
		
	}
?>
<?php
	/**
	* people MODEL, 
	*/
	class people_model extends model
	{
		/** The Default Method Like Main in java*/
		function __construct()
		{
			parent::__construct();
		}
		
		/**
		* function people_list
		* get peoples
		*/
		public function people_list()
		{
			$form	= new form();
			
			$form	->post('no',false,true) // رقم الأرض
					->valid('Integer')
					
					->post('card',false,true) // رقم البطاقة الخدمية
					->valid('Integer')
					
					->post('status',false,true) // الحالة السكنية
					->valid('In_array',array_keys(kb9::$house_live_type))
					
					->submit();
			$fdata	= $form->fetch();
			
			if(!empty($fdata['MSG']))
			{
				return 'Error: '.$fdata['MSG'];
			}
			
			$sea_arr = array();
			$sea_txt = '';
			
			if(!empty($fdata['no']))
			{
				$sea_arr[':NO'] = $fdata['no'];
				$sea_txt .= 'req_land = :NO  AND ';
			}
			if(!empty($fdata['card']))
			{
				$sea_arr[':CARD'] = $fdata['card'];
				$sea_txt .= 'req_card  = :CARD AND ';
			}
			if(!empty($fdata['status']))
			{
				$sea_arr[':STATUS'] = $fdata['status'];
				$sea_txt .= 'req_home_status = :STATUS AND ';
			}
			
			$sea_txt .= ' 1 = 1 ';
			
			$ret = $this->db->select("SELECT l_no, l_sub_no, l_owner_name
										,l_owner_name_EN , l_owner_phone ,l_owner_email
										,h_id ,h_floor ,h_type, h_card, h_contract, h_desc, h_email
										,main.peo_name , main.peo_name_EN , main.peo_phone, main.peo_email
										,count(totals.peo_id) AS people
										,count(work_id) AS workers
										FROM ".DB_PREFEX."house 
										JOIN ".DB_PREFEX."land ON l_id = h_land
										JOIN ".DB_PREFEX."people AS totals ON totals.peo_house = h_id
										JOIN ".DB_PREFEX."people AS main
													ON main.peo_house = h_id 
													AND main.peo_main = 1
										LEFT JOIN ".DB_PREFEX."worker ON work_house = h_id
										WHERE $sea_txt
										GROUP BY h_id
										ORDER BY h_land
										" ,$sea_arr
								);
			foreach($ret as $key=>$val)
			{
				$w = $this->db->select("SELECT count(peo_id) AS people
										FROM ".DB_PREFEX."people
										WHERE peo_house = :ID
										" ,array(':ID'=>$val['h_id'])
								);
				$ret[$key]['people'] = $w[0]['people'];
				
				$w = $this->db->select("SELECT count(work_id) AS workers
										FROM ".DB_PREFEX."worker
										WHERE work_house = :ID
										" ,array(':ID'=>$val['h_id'])
								);
				$ret[$key]['workers'] = $w[0]['workers'];
				
			}
			return $ret;
		}
		
		/**
		* function req_people_list
		* get requests
		*/
		public function req_people_list()
		{
			$form	= new form();
			
			$form	->post('no',false,true) // رقم الأرض
					->valid('Integer')
					
					->post('card',false,true) // رقم البطاقة الخدمية
					->valid('Integer')
					
					->post('status',false,true) // الحالة السكنية
					->valid('In_array',array_keys(kb9::$house_live_type))
					
					->submit();
			$fdata	= $form->fetch();
			
			if(!empty($fdata['MSG']))
			{
				return 'Error: '.$fdata['MSG'];
			}
			
			$sea_arr = array();
			$sea_txt = '';
			
			if(!empty($fdata['no']))
			{
				$sea_arr[':NO'] = $fdata['no'];
				$sea_txt .= 'req_land = :NO  AND ';
			}
			if(!empty($fdata['card']))
			{
				$sea_arr[':CARD'] = $fdata['card'];
				$sea_txt .= 'req_card  = :CARD AND ';
			}
			if(!empty($fdata['status']))
			{
				$sea_arr[':STATUS'] = $fdata['status'];
				$sea_txt .= 'req_home_status = :STATUS AND ';
			}
			
			$sea_txt .= ' 1 = 1 ';
			
			return $this->db->select("SELECT req_id, req_name, req_land
										,req_card , req_home_status ,req_email
										,req_phone ,DATE(".DB_PREFEX."reg_request.create_at) AS create_at
										,l_id , l_owner_name, l_owner_name_EN
										,l_owner_phone, l_owner_email
										FROM ".DB_PREFEX."reg_request 
										LEFT JOIN ".DB_PREFEX."land ON l_no = req_land
										WHERE $sea_txt
										GROUP BY req_id
										ORDER BY req_id
										" ,$sea_arr
								);
		}
		
		/**
		* function accept_req
		* accept reg request
		*/
		public function accept_req($id)
		{
			$form	= new form();
			
			if(!$form->single_valid($id,"Integer"))
			{
				return array('Error'=>"Error In Request NO");
			}
			
			$req = $this->db->select("SELECT * FROM ".DB_PREFEX."reg_request 
										WHERE req_id = :ID
										" ,array(':ID'=>$id)
								);
			if(count($req) != 1)
			{
				return array('Error'=>"Error In Request NO");
			}
			
			$req = $req[0];
			
			$time	= dates::convert_to_date('now');
			$time	= dates::convert_to_string($time);
			
			//check Land ID
			$land = $this->db->select("SELECT * FROM ".DB_PREFEX."land WHERE l_no = :ID" 
										,array(':ID'=>$req['req_land'])
								);
			if(count($land) == 0)
			{
				//new Land
				if($req['req_home_status'] != "OWNER")
				{
					return array('Error'=>"Land OWNER Not Registered");
				}
				
				$land_array = array('l_no'				=> $req['req_land']
									,'l_owner_name'		=> $req['req_name']
									,'l_owner_name_EN'	=> $req['req_name']
									,'l_owner_phone'	=> $req['req_phone']
									,'l_owner_email'	=> $req['req_email']
									,'create_at'		=> $time
									,'create_by'		=> session::get('user_id')
									);
				$this->db->insert(DB_PREFEX.'land',$land_array);
				$req['land_id'] = $this->db->LastInsertedId();
			}elseif(count($land) != 1)
			{
				return array('Error'=>"This Land has Multiple Parts, register this people manual");
			}else
			{
				$req['land_id'] = $land[0]['l_id'];
			}
			
			//check card
			$card = $this->db->select("SELECT h_card FROM ".DB_PREFEX."house WHERE h_card = :ID" 
										,array(':ID'=>$req['req_card'])
								);
			if(count($card)!= 0)
			{
				return array('Error'=>"The CARD No is registered in other house");
			}
			
			//create Home
			$house_array = array('h_land'		=> $req['land_id']
								,'h_type'		=> $req['req_home_status']
								,'h_card'		=> $req['req_card']
								,'h_email'		=> $req['req_email']
								,'h_pass'		=> $req['req_pass']
								,'create_at'	=> $time
								,'create_by'	=> session::get('user_id')
								);
			
			$this->db->insert(DB_PREFEX.'house',$house_array);
			$req['house_id'] = $this->db->LastInsertedId();
			
			//create people
			$people_array = array('peo_name'	=> $req['req_name']
								,'peo_house'	=> $req['house_id']
								,'peo_phone'	=> $req['req_phone']
								,'peo_main'		=> 1
								,'peo_email'	=> $req['req_email']
								,'create_at'	=> $time
								,'create_by'	=> session::get('user_id')
								);
			$this->db->insert(DB_PREFEX.'people',$people_array);
			$id = $this->db->LastInsertedId();
			
			//delete Request
			if(!empty($id))
			{
				$this->db->delete(DB_PREFEX.'reg_request','req_id = '.$req['req_id']);
				Email::welcome_people($req['req_name'],$req['req_email']);
			}
			
			return array('id'=>$id);
		}
		
		/**
		* function del_req
		* delete req
		*/
		public function del_req()
		{
			$time	= dates::convert_to_date('now');
			$time	= dates::convert_to_string($time);
			
			$form	= new form();
			
			$form	->post('upd_id') // id
					->valid('Integer')
					
					->post('upd_phone') // phone
					->valid('Phone')
					
					->post('upd_pass') // password
					->valid('Min_Length',3)
					->valid('Max_Length',200)
					
					->submit();
			$fdata	= $form->fetch();
			
			if(!empty($fdata['MSG']))
			{
				return array('Error'=>$fdata['MSG']);
			}
			
			//check Password
			$data = $this->db->select("SELECT staID FROM ".DB_PREFEX."staff 
									WHERE 
									staID = :ID AND staff_pass = :PASS" ,
									array(':ID'=>session::get('user_id')
										,':PASS'=>Hash::create(HASH_FUN,$fdata['upd_pass'],HASH_PASSWORD_KEY))
								);
			
			if(count($data) != 1)
			{
				return array('Error'=>"In Field upd_pass: Error data");
			}
			
			//check phone
			$req = $this->db->select("SELECT req_id, req_email, req_name FROM ".DB_PREFEX."reg_request 
										WHERE req_id = :ID AND req_phone = :PHONE
										" ,array(':ID'=>$fdata['upd_id'],':PHONE'=>$fdata['upd_phone'])
								);
			if(count($req) != 1)
			{
				return array('Error'=>"In Field upd_phone: Error data");
			}
			
			//delete
			$this->db->delete(DB_PREFEX.'reg_request',"req_id = ".$fdata['upd_id']);
			//Email::del_req($req[0]['req_name'],$req[0]['req_email']);
			
			return array('id'=> $fdata['upd_id']);
		}
		
		/**
		* function new_land
		* add new land
		*/
		public function new_land()
		{
			$time	= dates::convert_to_date('now');
			$time	= dates::convert_to_string($time);
			
			$form	= new form();
			
			$form	->post('ne_land_no') // NO
					->valid('Integer')
					
					->post('ne_land_sub_no',false,true) // sub no
					->valid('Integer')
					
					->post('ne_land_owner') // owner name
					->valid('Min_Length',3)
					->valid('Max_Length',50)
					
					->post('ne_land_owner_en') // owner name
					->valid('Min_Length',3)
					->valid('Max_Length',50)
					
					->post('ne_land_phone') // owner phone
					->valid('Phone')
					
					->post('ne_land_email') // owner email
					->valid('Email')
					
					->post('ne_land_status') // land status
					->valid('In_array',array_keys(kb9::$land_type))
					
					->post('ne_land_units') // units
					->valid('Integer')
					
					->post('ne_land_floor') // floors
					->valid('Integer')
					
					->submit();
			$fdata	= $form->fetch();
			
			if(!empty($fdata['MSG']))
			{
				return array('Error'=>$fdata['MSG']);
			}
			
			//check Land ID
			$land = $this->db->select("SELECT * FROM ".DB_PREFEX."land 
										WHERE l_no = :ID AND l_sub_no = :SUB" 
										,array(':ID'=>$fdata['ne_land_no'],':SUB'=>$fdata['ne_land_sub_no'])
								);
			
			if(count($land) != 0)
			{
				return array('Error'=>"In Field ne_land_no : Duplicate .. \n In Field ne_land_sub_no : Duplicate .. \n");
			}
			
			//Insert
			$land_array = array('l_no'				=> $fdata['ne_land_no']
								,'l_sub_no'			=> $fdata['ne_land_sub_no']
								,'l_owner_name'		=> $fdata['ne_land_owner']
								,'l_owner_name_EN'	=> $fdata['ne_land_owner_en']
								,'l_owner_phone'	=> $fdata['ne_land_phone']
								,'l_owner_email'	=> $fdata['ne_land_email']
								,'l_type'			=> $fdata['ne_land_status']
								,'l_house'			=> $fdata['ne_land_units']
								,'l_floor'			=> $fdata['ne_land_floor']
								,'create_at'		=> $time
								,'create_by'		=> session::get('user_id')
								);
			$this->db->insert(DB_PREFEX.'land',$land_array);
			$id = $this->db->LastInsertedId();
			
			return array('id'=>$id);
		}
		
		/**
		* function new_house
		* create new house & people
		*/
		public function new_house()
		{
			$time	= dates::convert_to_date('now');
			$time	= dates::convert_to_string($time);
			
			$form	= new form();
			
			$form	->post('ne_house_no') //land no
					->valid('Integer')
					
					->post('ne_house_sub_no',false,true) //land sub no
					->valid('Integer')
					
					->post('ne_house_floor',false,true) //floor no
					->valid('Integer')
					
					->post('ne_house_status') // house status
					->valid('In_array',array_keys(kb9::$house_live_type))
					
					->post('ne_house_card') //card
					->valid('Integer')
					
					->post('ne_house_desc',false,true) // Description
					->valid('Min_Length',3)
					
					->post('ne_house_name') // Name
					->valid('Min_Length',3)
					->valid('Max_Length',100)
					
					->post('ne_house_name_en',false,true) // Name
					->valid('Min_Length',3)
					->valid('Max_Length',100)
					
					->post('ne_house_id_type') // ID Type
					->valid('In_array',array_keys(kb9::$id_type))
					
					->post('ne_house_id_no') // ID Number
					->valid('Min_Length',7)
					
					->post('ne_house_phone') // phone
					->valid('Phone')
					
					->post('ne_house_email') // email
					->valid('Email')
					
					->post('ne_house_gender',false,true) // gender
					->valid('In_array',array_keys(kb9::$gender))
					->valid('Max_Length',200)
					
					->post('ne_house_birth',false,true) // birth date
					->valid('Date')
					
					->post('ne_house_nat',false,true) // nationality
					->valid('In_array',array_keys(kb9::$countries))
					
					->post('ne_house_social',false,true) // social
					->valid('In_array',array_keys(kb9::$Social))
					
					->post('ne_house_acadimic',false,true) // acadimaic
					->valid('In_array',array_keys(kb9::$Acadimic))
					
					->post('ne_house_job',false,true) // job
					->valid('Min_Length',3)
					
					->submit();
			$fdata	= $form->fetch();
			
			if(!empty($fdata['MSG']))
			{
				return array('Error'=>$fdata['MSG']);
			}
			
			//check Land ID
			$land = $this->db->select("SELECT * FROM ".DB_PREFEX."land 
										WHERE l_no = :ID AND l_sub_no = :SUB" 
										,array(':ID'=>$fdata['ne_house_no'],':SUB'=>$fdata['ne_house_sub_no'])
								);
			
			if(count($land) != 1)
			{
				return array('Error'=>"In Field ne_house_no : Not found .. \n 
										In Field ne_house_sub_no : Not Found .. \n");
			}
			$land = $land[0];
			
			//check card
			$card = $this->db->select("SELECT h_card FROM ".DB_PREFEX."house WHERE h_card = :ID" 
										,array(':ID'=>$fdata['ne_house_card'])
								);
			if(count($card)!= 0)
			{
				return array('Error'=>"In Field ne_house_card : Duplicate .. \n");
			}
			
			//check email & phone & ID number in people, staff and house
			$err = "";
			$sea_arr = array(':EMAIL'=>$fdata['ne_house_email']);
			
			//house
			$em = $this->db->select("SELECT h_email 
									FROM ".DB_PREFEX."house 
									WHERE h_email = :EMAIL" 
										,$sea_arr);
			if(count($em) != 0)
			{
				foreach($em as $val)
				{
					if($val['h_email'] == $fdata['ne_house_email'] )
					{
						$err .= "In Field ne_house_email : Duplicate .. \n";
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
					if($val['staff_email'] == $fdata['ne_house_email'] )
					{
						$err .= "In Field ne_house_email : Duplicate .. \n";
					}
				}
			}
			
			//people
			$sea_arr[':PHONE'] 	= $fdata['ne_house_phone'];
			$sea_arr[':ID'] 	= (!empty($fdata['ne_house_id_no']))?$fdata['ne_house_id_no']:"0";
			$sea_arr[':ID_TY'] 	= (!empty($fdata['ne_house_id_type']))?$fdata['ne_house_id_type']:"0";
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
					if($val['peo_email'] == $fdata['ne_house_email'] )
					{
						$err .= "In Field ne_house_email : Duplicate .. \n";
					}
					if($val['peo_phone'] == $fdata['ne_house_phone'])
					{
						$err .= "In Field ne_house_phone : Duplicate .. \n";
					}
					if($val['peo_id_no'] == $fdata['ne_house_id_no'] && $val['peo_id_type'] == $fdata['ne_house_id_type'] )
					{
						$err .= "In Field ne_house_id_no : Duplicate .. \n";
					}
				}
			}
			
			if(!empty($err))
			{
				return array('Error'=>$err);
			}
			
			$pass = staff_settings::generateRandomString();
			
			//create Home
			$house_array = array('h_land'		=> $land['l_id']
								,'h_type'		=> $fdata['ne_house_status']
								,'h_card'		=> $fdata['ne_house_card']
								,'h_email'		=> $fdata['ne_house_email']
								,'h_pass'		=> Hash::create(HASH_FUN,$pass,HASH_PASSWORD_KEY)
								,'create_at'	=> $time
								,'create_by'	=> session::get('user_id')
								);
			
			if(!empty($fdata['ne_house_floor']))
			{
				$house_array['h_floor'] = $fdata['ne_house_floor'];
			}
			if(!empty($fdata['ne_house_desc']))
			{
				$house_array['h_desc'] = $fdata['ne_house_desc'];
			}
			
			$this->db->insert(DB_PREFEX.'house',$house_array);
			$house_id = $this->db->LastInsertedId();
			
			//create people
			$people_array = array('peo_name'	=> $fdata['ne_house_name']
								,'peo_house'	=> $house_id
								,'peo_phone'	=> $fdata['ne_house_phone']
								,'peo_main'		=> 1
								,'peo_email'	=> $fdata['ne_house_email']
								,'create_at'	=> $time
								,'create_by'	=> session::get('user_id')
								);
			
			if(!empty($fdata['ne_house_name_en']))
			{
				$people_array['peo_name_EN'] = $fdata['ne_house_name_en'];
			}
			if(!empty($fdata['ne_house_id_type']))
			{
				$people_array['peo_id_type'] = $fdata['ne_house_id_type'];
			}
			if(!empty($fdata['ne_house_id_no']))
			{
				$people_array['peo_id_no'] = $fdata['ne_house_id_no'];
			}
			if(!empty($fdata['ne_house_gender']))
			{
				$people_array['peo_gender'] = $fdata['ne_house_gender'];
			}
			if(!empty($fdata['ne_house_birth']))
			{
				$people_array['peo_birth'] = $fdata['ne_house_birth'];
			}
			if(!empty($fdata['ne_house_nat']))
			{
				$people_array['peo_nationality'] = $fdata['ne_house_nat'];
			}
			if(!empty($fdata['ne_house_social']))
			{
				$people_array['peo_social'] = $fdata['ne_house_social'];
			}
			if(!empty($fdata['ne_house_acadimic']))
			{
				$people_array['peo_acadimic'] = $fdata['ne_house_acadimic'];
			}
			if(!empty($fdata['ne_house_job']))
			{
				$people_array['peo_job'] = $fdata['ne_house_job'];
			}
			
			$this->db->insert(DB_PREFEX.'people',$people_array);
			$id = $this->db->LastInsertedId();
			
			Email::welcome_people($fdata['ne_house_name'],$fdata['ne_house_email'],$pass);
			
			return array('id'=> $id);
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
			
			$form	->post('card') //card
					->valid('Integer')
					
					->post('name') // Name
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
			
			//check card
			$card = $this->db->select("SELECT h_id FROM ".DB_PREFEX."house WHERE h_card = :ID" 
										,array(':ID'=>$fdata['card'])
								);
			if(count($card)!= 1)
			{
				return array('Error'=>"In Field card : Not Found .. \n");
			}
			$card = $card[0];
			
			
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
								,'peo_house'	=> $card['h_id']
								,'peo_main'		=> 0
								,'create_at'	=> $time
								,'create_by'	=> session::get('user_id')
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
			
			$form	->post('card') //card
					->valid('Integer')
					
					->post('work_name') // Name
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
			
			//check card
			$card = $this->db->select("SELECT h_id FROM ".DB_PREFEX."house WHERE h_card = :ID" 
										,array(':ID'=>$fdata['card'])
								);
			if(count($card)!= 1)
			{
				return array('Error'=>"In Field card : Not Found .. \n");
			}
			$card = $card[0];
			
			//create people
			$people_array = array('work_name'	=> $fdata['work_name']
								,'work_house'	=> $card['h_id']
								,'create_at'	=> $time
								,'create_by'	=> session::get('user_id')
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
		* function info
		* get Home Details info
		*/
		public function info($id=0)
		{
			$form	= new form();
			
			if(empty($id) || !$form->single_valid($id,'Integer'))
			{
				return array();
			}
			
			$ret = array();
			
			//Get Home Data
			$h = $this->db->select("SELECT h_id, h_land, h_floor, h_type, h_card, h_desc
									FROM ".DB_PREFEX."house WHERE h_id = :ID"
									,array(":ID"=>$id));
			if(count($h)!= 1)
			{
				return array();
			}
			$ret['house'] = $h[0];
			
			//Get Land
			$h = $this->db->select("SELECT l_id, l_no, l_sub_no, l_owner_name, l_owner_name_EN
									,l_owner_phone, l_owner_email, l_type, l_house, l_floor
									FROM ".DB_PREFEX."land WHERE l_id = :ID"
									,array(":ID"=>$ret['house']['h_land']));
			$ret['land'] = $h[0];
			
			return $ret;
		}
		
		/**
		* function peo_info
		* get people Home Details info
		*/
		public function peo_info($id=0)
		{
			$form	= new form();
			
			if(empty($id) || !$form->single_valid($id,'Integer'))
			{
				return array();
			}
			
			$ret = array();
			
			//Get Home Data
			$h = $this->db->select("SELECT h_id, h_land, h_floor, h_type, h_card, h_desc
									FROM ".DB_PREFEX."house WHERE h_id = :ID"
									,array(":ID"=>$id));
			if(count($h)!= 1)
			{
				return array();
			}
			$house = $h[0]['h_id'];
			
			//get People
			$ret = $this->db->select("SELECT peo_id, peo_name, peo_name_EN
										,peo_id_type, peo_id_no, peo_birth
										,peo_gender, peo_nationality, peo_social, peo_acadimic
										,peo_job, peo_phone, peo_email, peo_main
										FROM ".DB_PREFEX."people WHERE peo_house = :ID"
										,array(":ID"=>$house));
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
		public function work_info($id=0)
		{
			$form	= new form();
			
			if(empty($id) || !$form->single_valid($id,'Integer'))
			{
				return array();
			}
			
			$ret = array();
			
			//Get Home Data
			$h = $this->db->select("SELECT h_id, h_land, h_floor, h_type, h_card, h_desc
									FROM ".DB_PREFEX."house WHERE h_id = :ID"
									,array(":ID"=>$id));
			if(count($h)!= 1)
			{
				return array();
			}
			$house = $h[0]['h_id'];
			
			//get workers
			return $this->db->select("SELECT work_id, work_name, work_name_EN, work_phone
												,work_nationality, work_social, work_gender, work_job
												FROM ".DB_PREFEX."worker WHERE work_house = :ID"
												,array(":ID"=>$house));
			
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
			
			$form	->post('h_id') // ID
					->valid('Integer')
					
					->post('house_floor') // Floor
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
			
			//check ID:
			$em = $this->db->select("SELECT h_id FROM ".DB_PREFEX."house 
									WHERE h_id = :ID  "
									,array(":ID"=>$fdata['h_id']));
			if(count($em) != 1)
			{
				return array('Error'=>"لم يتم العثور على بيانات المنزل");
			}
			
			//check card no:
			$em = $this->db->select("SELECT h_id FROM ".DB_PREFEX."house 
									WHERE h_card = :NO AND h_id != :ID  "
									,array(":NO"=>$fdata['house_card'],":ID"=>$fdata['h_id']));
			if(count($em) != 0)
			{
				return array('Error'=>"In Field house_card : Duplicate .. \n");
			}
			
			//Update
			$house_array = array('h_floor'	=> $fdata['house_floor']
								,'h_type'	=> $fdata['house_status']
								,'h_card'	=> $fdata['house_card']
								,'h_desc'	=> $fdata['house_desc']
								,'update_by'=> session::get('user_id')
								,'update_at'=> $time
								);
			
			$this->db->update(DB_PREFEX.'house',$house_array,'h_id = '.$fdata['h_id']);
			
			return array('id'=>$fdata['h_id']);
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
			
			//create people
			$people_array = array('peo_name'	=> $fdata['upd_name']
								,'update_at'	=> $time
								,'update_by'	=> session::get('user_id')
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
								,'update_by'	=> session::get('user_id')
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
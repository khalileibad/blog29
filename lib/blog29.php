<?php
	/**
	* class blog29
	* for contacting blog29
	*/
	class blog29
	{
		/**The Default Method Like Main in java*/
		function __construct()
		{
		}
		
		//save notification
		public static function save_notification($db, $data = array(),$type)
		{
			/*
			Type:
			1: Email (admin)
			2: New Registration
			
			
			
			3: transfire Booking (spec_dr)
			4: New DR (Group Admin)
			5: New Group (admin)
			6: Patient Booking actions
			*/
			
			$time	= dates::convert_to_date('now');
			$time	= dates::convert_to_string($time);
			
			$ans_array = array('noti_user'		=>1
								,'noti_type'	=>$type
								,'noti_title'	=>""
								,'noti_url'		=>""
								,'create_at'	=>$time
								);
			$send_noti = array();
			switch($type)
			{
				case 1:
					/*
					Email
					For Admin
					data: array('con_subject'	=>$fdata['subject'] // MSG subject
								,'con_name'		=>$fdata['name'] 	//Who Send MSG
								,'con_email'	=>$fdata['email']	//Who Send MSG Email
								,'con_msg'		=>$fdata['message'] // MSG
								,'con_date'		=>$time				// MSG Time
								);
					Pages:
					dashboard_model 	-> new_cont
					*/
					
					$ans_array['noti_title'] = "رسالة من ".$data['con_name']." راجع الايميل";
					array_push($send_noti,$ans_array);
				break;
				case 2:
					/*
					New Registration
					For Admin AND Statistics
					data: array('id'		=> ID
								,'req_name'	=> NAME
								,'req_land'	=> LAND NO
								,'req_card'	=> CARD NO
								,'req_email'=> Email
								,'req_phone'=> PHONE
								,'create_at'=> time
								);
					pages:
					login_model		->reg
					*/
					
					$ans_array['noti_title']= "طلب تسجيل جديد من ".$data['req_name']." ";
					$ans_array['noti_url'] 	= "reg/".$data['id'];
					array_push($send_noti,$ans_array);
				break;
				case 3:
					
				break;
				case 4:
					
				break;
				case 5:
					
				break;
				case 6:
					
				break;
				
			}
			
			//send_noti
			foreach($send_noti as $val)
			{
				$db->insert(DB_PREFEX.'notification',$val);
			}
			
		}
		
		//save notification
		public static function notification_read($db, $id ,$type)
		{
			$time	= dates::convert_to_date('now');
			$time	= dates::convert_to_string($time);
			
			$form = new form();
			
			if(empty($id) || empty($type))
			{
				$form	->post('id')
						->valid('Integer')
							
						->post('type')
						->valid('Integer')
							
						->submit();
				$d = $form->fetch();
				
				if(!empty($d['MSG']))
				{
					return array('Error'=>$d['MSG']);
				}
				
				$id = $d['id'];
				$type = $d['type'];
			}
			
			$table_name = "notification";
			$where = "1 != 1";
			switch($type)
			{
				case 1:
					/*
					Admin noti
					id: noti ID
					notificate	->read_noti() 
					*/
					$where = "noti_id = ".$id." AND noti_user = ".session::get('user_id');
				break;
				
				case 2:
				case 3:
					/*
					Booking noti
					New Booking
					transfire Booking
					id: book_id
					//actions		->booking()
					*/
					$where = "noti_book = ".$id;
					
				break;
				case 4:
					/*
					DR noti
					New DR
					id: DR_ID
					//staff		->index()
					*/
					$where = "noti_dr = ".$id;
					
				break;
				case 5:
					/*
					Group noti
					New Group
					id: Group_ID
					//group		->index()
					*/
					$where = "noti_gr = ".$id;
					
				break;
				case 6:
					/*
					Patient noti
					patient		->index()
					ID: Booking no
					*/
					
					$table_name = "pa_notification";
					$where = "noti_book = ".$id." 
							AND noti_book IN (SELECT bo_id FROM ".DB_PREFEX."booking
											WHERE bo_patient = ".session::get('user_id').")";
					
				break;
			}
			$db->update(DB_PREFEX.$table_name,array("noti_status"=>1),$where);
			return array('ok'=>1);
		}
		
	}
?>
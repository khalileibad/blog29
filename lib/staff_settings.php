<?php
	class staff_settings
	{
		public static $staf_asso_type	= array('admin' 	=> array("AR"=>'المدير',"EN"=>"Administrator")
												,'accept'	=> array("AR"=>'المراجع',"EN"=>"Acceptance")
												,'bloger'	=> array("AR"=>'المدون',"EN"=>"Bloger")
												);
		
		private $public_pages 			= array('login'			/*Login */
												,'dashboard'	/*Public Page*/
												,'blog'			/*Blog Pages*/
												);
		private $public_login_pages 	= array('profile'		/*User Profile */
												);
		
		private $admin_pages 			= array('staff'		=> array('index','user_list','dr_request'
																	,'new_active','active','new_dr','dr_type'
																	)
												,'news'		=> array('index','news_list','new_news' 
																	,'active','news_data','upd_news'
																	)
												,'people'	=> array('index','request'
																	,'people_list','req_people_list'
																	,'accept_req','del_req'
																	,'new_land','new_house'
																	,'new_upload','new_people'
																	,'info','upd_land','upd_house'
																	,'peo_info','work_info','new_worker'
																	,'upd_people','upd_worker'
																	,'del_people','del_worker'
																)
												,'notificate'	=> array('index','book','set_book','dr','set_dr'
																		,'get_noti','get_dr_noti','read_noti')
												);
		
		private $accept_pages 			= array('accept'		=> array('index','new_people'
																		,'upd_land','upd_house'
																		,'peo_info','work_info','new_worker'
																		,'upd_people','upd_worker'
																		,'del_people','del_worker'
																	)
												
											);
		
		private $bloger_pages 			= array('home'			=> array('index','new_people'
																		,'upd_land','upd_house'
																		,'peo_info','work_info','new_worker'
																		,'upd_people','upd_worker'
																		,'del_people','del_worker'
																	)
												
											);
		
		private static $default_page 	= array('admin' 	=> 'staff'
												,'accept' 	=> 'accept'
												,'bloger' 	=> 'home'
												
											);
		
		/**The Default Method Like Main in java*/
		function __construct()
		{
			
		}
		
		public function get_acsses($url)
		{
			
			//public Pages
			if(array_search($url[0],$this->public_pages)!== false)
			{
				return true;
			}
			if(!empty(session::get('user_type')))
			{
				//public Pages
				if(array_search($url[0],$this->public_login_pages)!== false)
				{
					return true;
				}
				
				$acc = $this->{session::get('user_type')."_pages"};
				
				if(!empty($acc))
				{
					if(array_key_exists($url[0],$acc)&& (empty($url[1]) ||in_array($url[1],$acc[$url[0]])))
					{
						return true;
					}
				}
			}
			return false;
		}
		
		public static function get_staff_types()
		{
			return array_keys(self::$staf_asso_type);
		}
		
		public static function generateRandomString($length = 10)
		{
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ#@^%()-';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			//return $randomString;
			return "123456";
		}
		
		public static function default_page($staff_type)
		{
			return self::$default_page[$staff_type];
		}
	}
?>
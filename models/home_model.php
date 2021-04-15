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
									,staff_about, staff_face, staff_twitter, staff_linked, staff_instagram ,staff_birth
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
								'birth'			=>$b[0]['staff_birth'],
								'address'		=>$b[0]['staff_address'],
								'about'			=>$b[0]['staff_about'],
								'user_img'		=>$b[0]['staff_img'],
								'user_face'		=>$b[0]['staff_face'],
								'user_twitter'	=>$b[0]['staff_twitter'],
								'user_instegram'=>$b[0]['staff_instagram'],
								'user_linked'	=>$b[0]['staff_linked'],
								'blogs'			=>array(),
								);
			
			return $blog_user;
		}
		
		/**
		* function blog_list
		* get all blogs based on current user
		*/
		public function blog_list($page)
		{
			$ret = array();
			$where = "";
			//get bloger
			
			//PAGING
			if(!empty($page) && ctype_digit($page))
			{
				$c = $this->db->select("SELECT count(b_id) AS a
										FROM ".DB_PREFEX."blog
										WHERE b_user = :USER
										" ,array(':USER'=>session::get('user_id')));
										
				$pages = ceil($c[0]['a'] / PAGING);
			
				$ret = array('total'=> $c[0]['a'],'no_page'=>$pages,'curr'=>$page,'data'=>array());
				
				// Calculate the offset for the query
				$off = ($page - 1)  * PAGING;
			
				$paginglimit = "LIMIT ".PAGING." OFFSET $off";
			}else
			{
				$ret = array('total'=> '','no_page'=>'','curr'=>'','data'=>array());
				$paginglimit = "";
			}
			
			//get blog data
			$b = $this->db->select("SELECT b_id, b_title, b_desc, b_img, b_likes, b_see, b_accept_date
									,b_user, create_at
									FROM ".DB_PREFEX."blog 
									WHERE b_user = :USER
									ORDER BY b_accept_date DESC
									$paginglimit
									",array(':USER'=>session::get('user_id')));
			
			foreach($b as $val)
			{
				$x = array('id'			=>$val['b_id'],
							'title'		=>$val['b_title'],
							'desc'		=>$val['b_desc'],
							'img'		=>$val['b_img'],
							'likes'		=>$val['b_likes'],
							'b_see'		=>$val['b_see'],
							'publish'	=>$val['b_accept_date'],
							'create'	=>$val['create_at'],
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
				array_push($ret['data'],$x);
			}
			return $ret;
		}
		
		/**
		* function profile
		* update profile data
		*/
		public function profile()
		{
			$time	= dates::convert_to_date('now');
			$time	= dates::convert_to_string($time);
			$err 	= "";
			
			$form	= new form();
			
			$form	->post('name') // Name
					->valid('Min_Length',3)
					->valid('Max_Length',100)
					
					->post('email') // email
					->valid('Email')
					
					->post('phone') // phone
					->valid('Phone')
					
					->post('birth')
					->valid('Date')
					
					->post('description') // description
					->valid('Min_Length',3)
					
					->post('address',false,true) // address
					->valid('Min_Length',3)
					
					->post('old_pwd') // password
					->valid('Min_Length',3)
					
					->post('pwd',false,true) // password
					->valid('Min_Length',3)
					
					->post('pwd2',false,true) // address
					->valid('Min_Length',3)
					
					->post('facebook',false,true) // facebook
					->valid('URL')
					
					->post('twitter',false,true) // twitter
					->valid('URL')
					
					->post('linkedin',false,true) // linkedin
					->valid('URL')
					
					->post('instagram',false,true) // instagram
					->valid('URL')
					
					->submit();
			$fdata	= $form->fetch();
			
			if(!empty($fdata['MSG']))
			{
				return array('Error'=>$fdata['MSG']);
			}
			
			//check password
			$em = $this->db->select("SELECT staff_pass 
									FROM ".DB_PREFEX."staff 
									WHERE staff_id = :ID" 
									,array(':ID'=>session::get('user_id')));
			$pwd = $em[0]['staff_pass'];
			if($pwd != Hash::create(HASH_FUN,$fdata['old_pwd'],HASH_PASSWORD_KEY))
			{
				$err .= "In Field old_pwd : not match .. \n";
			}
			
			//check email & phone in staff
			$em = $this->db->select("SELECT staff_email,staff_phone 
									FROM ".DB_PREFEX."staff 
									WHERE (staff_email = :EMAIL OR staff_phone = :PHONE)
										AND staff_id != :ID" 
									,array(':EMAIL'=>$fdata['email']
											,':PHONE'=> $fdata['phone']
											,':ID'=>session::get('user_id')));
			if(count($em) != 0)
			{
				foreach($em as $val)
				{
					if($val['staff_email'] == $fdata['email'] )
					{
						$err .= "In Field email : Duplicate .. \n";
					}
					if($val['staff_phone'] == $fdata['phone'] )
					{
						$err .= "In Field phone : Duplicate .. \n";
					}
				}
			}
			
			//create people
			$people_array = array('staff_name'		=> $fdata['name']
								,'staff_phone'		=> $fdata['phone']
								,'staff_birth'		=> $fdata['birth']
								,'staff_email'		=> $fdata['email']
								,'staff_address'	=> $fdata['address']
								,'staff_about'		=> $fdata['description']
								,'staff_face'		=> $fdata['facebook']
								,'staff_twitter'	=> $fdata['twitter']
								,'staff_linked'		=> $fdata['linkedin']
								,'staff_instagram'	=> $fdata['instagram']
								,'update_at'		=> $time
								,'update_by'		=> session::get('user_id')
								);
							
			//new password				
			if(!empty($fdata['pwd']) || !empty($fdata['pwd2']))
			{				
				if($fdata['pwd'] != $fdata['pwd2'])
				{
					$err .= "In Field pwd2 : not match .. \n";
				}else{
					$people_array['staff_pass'] = Hash::create(HASH_FUN,$fdata['pwd'],HASH_PASSWORD_KEY);
				}
			}
			
			if(!empty($err))
			{
				return array('Error'=>$err);
			}
			
			//update image
			if(!empty($_FILES['user_img']))
			{
				$files	= new files(); 
				if($files->check_file($_FILES['user_img'],'img'))
				{
					$people_array['staff_img'] = $files->up_file($_FILES['user_img'],URL_PATH.'public/IMG/users');
					
				}else
				{
					return array('Error'=>"In Field user_img: Error data");
				}
			}
			
			$this->db->update(DB_PREFEX.'staff',$people_array,"staff_id = ".session::get('user_id'));
			
			return $people_array;
		}
		
		/**
		* function new_blog
		* create new blog
		*/
		public function new_blog()
		{
			$time	= dates::convert_to_date('now');
			$time	= dates::convert_to_string($time);
			
			$form	= new form();
			
			$form	->post('blog_name') // Name
					->valid('Min_Length',3)
					->valid('Max_Length',100)
					
					->post('blog_content') // content
					->valid('Min_Length',20)
					
					->post('blog_desc') // description
					->valid('Min_Length',3)
					->valid('Max_Length',5000)
					
					->post('category') // category
					->valid_array('Integer')
					
					->post('tag',false,true) // tag
					->valid('Min_Length',3)
					
					->submit();
			$fdata	= $form->fetch();
			
			if(!empty($fdata['MSG']))
			{
				return array('Error'=>$fdata['MSG']);
			}
			
			//create blog
			
			$fdata['blog_desc'] = str_replace("&amp;","&",$fdata['blog_desc']);
			
			$blog_array = array('b_user'		=> session::get('user_id')
								,'b_title'		=> $fdata['blog_name']
								,'b_desc'		=> htmlspecialchars_decode($fdata['blog_desc'])
								,'b_keywords'	=> $fdata['tag']
								,'b_blog'		=> htmlspecialchars_decode($fdata['blog_content'])
								,'create_at'	=> $time
								);
			//update image
			if(!empty($_FILES['blog_img']))
			{
				$files	= new files(); 
				if($files->check_file($_FILES['blog_img'],'img'))
				{
					$blog_array['b_img'] = $files->up_file($_FILES['blog_img'],URL_PATH.'public/IMG/blog');
					
				}else
				{
					return array('Error'=>"In Field b_img: Error data");
				}
			}else
			{
				$blog_array['b_img']= "logo.png";
			}
			
			
			$this->db->insert(DB_PREFEX.'blog',$blog_array);
			$id = $this->db->LastInsertedId();
			
			if(!empty($id))
			{
				foreach($fdata['category'] as $val)
				{
					$this->db->insert(DB_PREFEX.'blog_category',array("blog_id"=>$id,"category"=>$val,"comment"=>""));
				}
			}
			return array('id'=> $id);
		}
		
		/**
		* function blog
		* get blogs details
		*/
		public function blog($blog_id)
		{
			$form	= new form();
			if(empty($blog_id) || !$form->single_valid($blog_id,'Integer'))
			{
				return array();
			}

			$blog = array();
			//get blog data
			$b = $this->db->select('SELECT b_id, b_title, b_desc, b_img, b_likes
									,b_see, b_accept_date, b_blog, b_keywords
									FROM '.DB_PREFEX.'blog 
									WHERE b_user = :USER AND b_id = :ID
									',array(':USER'=>session::get('user_id'),':ID'=>$blog_id));
			if(count($b) != 1)
			{
				return array();
			}
			
			$blog = array('id'		=>$b[0]['b_id'],
						'title'		=>$b[0]['b_title'],
						'desc'		=>$b[0]['b_desc'],
						'text'		=>$b[0]['b_blog'],
						'img'		=>$b[0]['b_img'],
						'likes'		=>$b[0]['b_likes'],
						'b_see'		=>$b[0]['b_see'],
						'publish'	=>$b[0]['b_accept_date'],
						'keywords'	=>$b[0]['b_keywords'],
						'cat'		=>array(),
						'comment'	=>array()
						);
			
			//get blog category
			$cat = $this->db->select('SELECT cat_id, cat_name,comment,cat_class
									FROM '.DB_PREFEX.'blog_category 
									JOIN '.DB_PREFEX.'category ON category = cat_id
									WHERE blog_id = :ID 
									',array(':ID'=>$b[0]['b_id']));
			foreach($cat as $value)
			{
				array_push($blog['cat'],$value['cat_id']);
			}
			
			//get blog comments
			$comm = $this->db->select('SELECT com_id, com_aut_name, com_aut_phone,com_aut_email
									,com_likes,com_comment,create_at
									FROM '.DB_PREFEX.'comments 
									WHERE com_blog = :ID AND accept_by IS NOT NULL
									',array(':ID'=>$b[0]['b_id']));
			foreach($comm as $value)
			{
				array_push($blog['comment'],array('id'=>$value['com_id']
											,'name'=>$value['com_aut_name']
											,'phone'=>$value['com_aut_phone']
											,'email'=>$value['com_aut_email']
											,'like'=>$value['com_likes']
											,'date'=>$value['create_at']
											,'comm'=>$value['com_comment']));
			}
			return $blog;
		}
		
		
		/**
		* function upd_blog
		* update blog
		*/
		public function upd_blog()
		{
			$time	= dates::convert_to_date('now');
			$time	= dates::convert_to_string($time);
			
			$form	= new form();
			
			$form	->post('id') // ID
					->valid('numeric')
					
					->post('blog_name') // Name
					->valid('Min_Length',3)
					->valid('Max_Length',100)
					
					->post('blog_content') // content
					->valid('Min_Length',20)
					
					->post('blog_desc') // description
					->valid('Min_Length',3)
					->valid('Max_Length',5000)
					
					->post('category') // category
					->valid_array('Integer')
					
					->post('tag',false,true) // tag
					->valid('Min_Length',3)
					
					->submit();
			$fdata	= $form->fetch();
			
			if(!empty($fdata['MSG']))
			{
				return array('Error'=>$fdata['MSG']);
			}
			
			$b = $this->db->select('SELECT b_id, b_accept_date
									FROM '.DB_PREFEX.'blog 
									WHERE b_id = :ID AND b_user = :USER
									',array(':USER'=>session::get('user_id'),':ID'=>$fdata['id']));
			
			if(count($b) != 1)
			{
				return array('Error'=>"Blog Not Found");
			}
			
			
			//update blog
			
			$fdata['blog_desc'] = str_replace("&amp;","&",$fdata['blog_desc']);
			$fdata['blog_content'] = str_replace("&amp;","&",$fdata['blog_content']);
			
			$blog_array = array('b_title'		=> $fdata['blog_name']
								,'b_desc'		=> htmlspecialchars_decode($fdata['blog_desc'])
								,'b_keywords'	=> $fdata['tag']
								,'b_blog'		=> htmlspecialchars_decode($fdata['blog_content'])
								,'b_accept_by'	=> null
								,'b_accept_date'=> null
								,'update_at'	=> $time
								,'update_by'	=> session::get('user_id')
								);
			
			//update image
			if(!empty($_FILES['blog_img']))
			{
				$files	= new files(); 
				if($files->check_file($_FILES['blog_img'],'img'))
				{
					$blog_array['b_img'] = $files->up_file($_FILES['blog_img'],URL_PATH.'public/IMG/blog');
					
				}else
				{
					return array('Error'=>"In Field b_img: Error data");
				}
			}
			
			$this->db->update(DB_PREFEX.'blog',$blog_array,'b_id = '.$fdata['id']);
			
			//delete old category
			$this->db->delete(DB_PREFEX.'blog_category',"blog_id = ".$fdata['id']);
			
			foreach($fdata['category'] as $val)
			{
				$this->db->insert(DB_PREFEX.'blog_category',array("blog_id"=>$fdata['id'],"category"=>$val,"comment"=>""));
			}
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
		
	}
?>
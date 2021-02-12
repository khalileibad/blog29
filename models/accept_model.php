<?php
	/**
	* accept MODEL, 
	*/
	class accept_model extends model
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
									WHERE staff_id = :ID AND staff_type = 'accept'
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
			
			return $blog_user;
		}
		
		/**
		* function blog_list
		* get all unaccepted blogs
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
										WHERE b_accept_by IS NULL
										" ,array());
										
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
									,b_user, ".DB_PREFEX."blog.create_at
									,staff_name
									FROM ".DB_PREFEX."blog 
									JOIN ".DB_PREFEX."staff ON b_user = staff_id
									WHERE b_accept_by IS NULL
									ORDER BY create_at DESC
									$paginglimit
									",array());
			
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
							'user_id'	=>$val['b_user'],
							'user_name'	=>$val['staff_name'],
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
		* function comm_list
		* get unaccepted comments
		*/
		public function comm_list()
		{
			//get comm data
			return $this->db->select("SELECT com_id, com_aut_name
									,com_aut_phone, com_aut_email
									,com_comment, ".DB_PREFEX."comments.create_at AS com_create
									,b_id, b_title, b_desc, b_img
									,b_user, ".DB_PREFEX."blog.create_at AS b_create
									FROM ".DB_PREFEX."comments 
									JOIN ".DB_PREFEX."blog ON b_id = com_blog 
									WHERE accept_by IS NULL
									ORDER BY ".DB_PREFEX."comments.create_at DESC
									",array());
			
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
								,'b_accept_by'	=> session::get('user_id')
								,'b_accept_date'=> $time
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
									WHERE b_accept_by IS NULL AND b_id = :ID
									',array(':ID'=>$blog_id));
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
									WHERE com_blog = :ID 
									',array(':ID'=>$b[0]['b_id']));
			foreach($comm as $value)
			{
				array_push($blog['comment'],array('id'=>$value['com_id']
											,'name'=>$value['com_aut_name']
											,'phone'=>$value['com_aut_phone']
											,'email'=>$value['com_aut_email']
											,'like'=>$value['com_likes']
											,'date'=>$value['create_at']
											,'accept'=>$value['accept_by']
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
					
					->post('del_blog',false,true) // delete
					->valid('numeric')
					
					->submit();
			$fdata	= $form->fetch();
			
			if(!empty($fdata['MSG']))
			{
				return array('Error'=>$fdata['MSG']);
			}
			
			//update and accept blog
			
			$fdata['blog_desc'] = str_replace("&amp;","&",$fdata['blog_desc']);
			$fdata['blog_content'] = str_replace("&amp;","&",$fdata['blog_content']);
			
			$blog_array = array('b_title'		=> $fdata['blog_name']
								,'b_desc'		=> htmlspecialchars_decode($fdata['blog_desc'])
								,'b_keywords'	=> $fdata['tag']
								,'b_blog'		=> htmlspecialchars_decode($fdata['blog_content'])
								,'b_accept_by'	=> session::get('user_id')
								,'b_accept_date'=> $time
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
		* function del_blog
		* delete blog
		*/
		public function del_blog()
		{
			$time	= dates::convert_to_date('now');
			$time	= dates::convert_to_string($time);
			
			$form	= new form();
			
			$form	->post('id') // ID
					->valid('numeric')
					
					->post('blog_name') // Name
					->valid('Min_Length',3)
					->valid('Max_Length',100)
					
					->submit();
			$fdata	= $form->fetch();
			
			if(!empty($fdata['MSG']))
			{
				return array('Error'=>$fdata['MSG']);
			}
			
			$this->db->delete(DB_PREFEX.'blog_category',"blog_id = ".$fdata['id']);
			$this->db->delete(DB_PREFEX.'blog',"b_id = ".$fdata['id']);
			
			Email::del_blog($name,$email,$fdata['id'],$fdata['blog_name'],$from = EMAIL_ADD)
			return array('id'=> $fdata['id'],'del'=>1);
			
		}
		
		/**
		* function upd_comments
		* accept/deny comments
		*/
		public function upd_comments()
		{
			$time	= dates::convert_to_date('now');
			$time	= dates::convert_to_string($time);
			
			$form	= new form();
			
			$form	->post('accept_type') // accept_type
					->valid('numeric')
					
					->post('accept') // category
					->valid_array('Integer')
					
					->submit();
			$fdata	= $form->fetch();
			
			if(!empty($fdata['MSG']))
			{
				return array('Error'=>$fdata['MSG']);
			}
			if(empty($fdata['accept']))
			{
				return array('Error'=>"لم تختار تعليق");
			}
			
			switch($fdata['accept_type'])
			{
				case 1: //accept
					$time	= dates::convert_to_date('now');
					$time	= dates::convert_to_string($time);
					
					$acc_array = array('accept_by'=>session::get('user_id'),'accept_at'=>$time);
					foreach($fdata['accept'] as $val)
					{
						$this->db->update(DB_PREFEX.'comments',$acc_array,'com_id = '.$val);
					}
				break;
				case 2: //deny
					foreach($fdata['accept'] as $val)
					{
						$this->db->delete(DB_PREFEX.'comments','com_id = '.$val);
					}
				break;
			}
			
			
			return array('id'=> 1);
		}
		
	}
?>
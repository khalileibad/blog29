<?php
	/**
	* blog MODEL, 
	*/
	class blog_model extends model
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
		* function category
		* get category
		*/
		public function category($category)
		{
			//get category
			$form	= new form();
			if(empty($category) || !$form->single_valid($category,'Integer'))
			{
				return array();
			}else
			{
				//get category data
				$x = $this->db->select("SELECT cat_id, cat_name, cat_class, cat_desc
										FROM ".DB_PREFEX."category
										WHERE cat_id = :ID
										",array(":ID"=>$category));
				return $x[0];
			}
		}
		
		/**
		* function blog_list
		* get all blogs based on category:
		* if category not found will get all blogs
		*/
		public function blog_list($category,$page)
		{
			$ret = array();
			$where = "b_accept_date IS NOT NULL ";
			//get bloger
			$form	= new form();
			if(!empty($category) && $form->single_valid($category,'Integer'))
			{
				$where .= "AND b_id IN (SELECT blog_id FROM ".DB_PREFEX."blog_category WHERE category = $category ) ";
			}
			
			//PAGING
			if(!empty($page) && ctype_digit($page))
			{
				$c = $this->db->select("SELECT count(b_id) AS a
										FROM ".DB_PREFEX."blog
										WHERE $where
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
									,b_user, staff_name, staff_phone, staff_email, staff_img
									FROM ".DB_PREFEX."blog 
									JOIN ".DB_PREFEX."staff ON b_user = staff_id
									WHERE $where
									ORDER BY b_accept_date DESC
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
							'user'		=>$val['b_user'],
							'name'		=>$val['staff_name'],
							'phone'		=>$val['staff_phone'],
							'email'		=>$val['staff_email'],
							'user_img'	=>$val['staff_img'],
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
									,b_user, staff_name, staff_phone, staff_email, staff_img
									,staff_twitter, staff_face, staff_instagram,staff_linked
									FROM '.DB_PREFEX.'blog 
									JOIN '.DB_PREFEX.'staff ON b_user = staff_id
									WHERE b_accept_date IS NOT NULL AND b_id = :ID
									',array(':ID'=>$blog_id));
			if(count($b) != 1)
			{
				return array();
			}
			
			//set blog see count
			if(!cookies::get('blog_'.$b[0]['b_id']))
			{
				//first visit
				$b[0]['b_see'] += 1;
				$this->db->update('blog',array('b_see'=>$b[0]['b_see']),'b_id = '.$b[0]['b_id']);
				cookies::set('blog_'.$b[0]['b_id'],time());
			}
			
			$blog = array('id'			=>$b[0]['b_id'],
						'title'			=>$b[0]['b_title'],
						'desc'			=>$b[0]['b_desc'],
						'text'			=>$b[0]['b_blog'],
						'img'			=>$b[0]['b_img'],
						'likes'			=>$b[0]['b_likes'],
						'b_see'			=>$b[0]['b_see'],
						'publish'		=>$b[0]['b_accept_date'],
						'user'			=>$b[0]['b_user'],
						'name'			=>$b[0]['staff_name'],
						'phone'			=>$b[0]['staff_phone'],
						'email'			=>$b[0]['staff_email'],
						'user_img'		=>$b[0]['staff_img'],
						'user_face'		=>$b[0]['staff_face'],
						'user_twitter'	=>$b[0]['staff_twitter'],
						'user_instegram'=>$b[0]['staff_instagram'],
						'user_linked'	=>$b[0]['staff_linked'],
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
				array_push($blog['cat'],array('id'=>$value['cat_id']
											,'name'=>$value['cat_name']
											,'class'=>$value['cat_class']
											,'comm'=>$value['comment']));
			}
			
			//get blog comments
			$comments = $this->db->select('SELECT com_id, com_aut_name, com_aut_phone,com_aut_email
									,com_likes,com_comment,create_at
									FROM '.DB_PREFEX.'comments 
									WHERE com_blog = :ID AND accept_by IS NOT NULL
									',array(':ID'=>$b[0]['b_id']));
			$comm = array();
			foreach($comments as $value)
			{
				$comm = array('id'=>$value['com_id']
							,'name'=>$value['com_aut_name']
							,'phone'=>$value['com_aut_phone']
							,'email'=>$value['com_aut_email']
							,'like'=>$value['com_likes']
							,'date'=>$value['create_at']
							,'comm'=>$value['com_comment']
							,'rep'=>array());
				
				//get comment replay
				$co = $this->db->select('SELECT rep_id, rep_comment, rep_likes, create_at
									FROM '.DB_PREFEX.'com_replay 
									WHERE rep_com = :ID AND rep_accept_by IS NOT NULL
									',array(':ID'=>$value['com_id']));
				foreach($co as $val)
				{
					array_push($comm['rep'],array('id'=>$val['rep_id']
												,'comm'=>$val['rep_comment']
												,'like'=>$val['rep_likes']
												,'date'=>$val['create_at']
												)
								);
				}
				array_push($blog['comment'],$comm);
			}
			return $blog;
		}
		
		/**
		* function blog_like
		* add like to blog
		*/
		public function blog_like($blog_id)
		{
			$form	= new form();
			if(empty($blog_id) || !$form->single_valid($blog_id,'Integer'))
			{
				return array();
			}

			//get blog data
			$b = $this->db->select('SELECT b_id, b_likes ,b_see 
									FROM '.DB_PREFEX.'blog 
									WHERE b_accept_date IS NOT NULL AND b_id = :ID
									',array(':ID'=>$blog_id));
			if(count($b) != 1)
			{
				return array();
			}
			
			if(!cookies::get('blog_like_'.$b[0]['b_id']))
			{
				//first visit
				$b[0]['b_likes'] += 1;
				$this->db->update('blog',array('b_likes'=>$b[0]['b_likes']),'b_id = '.$b[0]['b_id']);
				cookies::set('blog_like_'.$b[0]['b_id'],time());
				
				return array('like'=>$b[0]['b_likes']);
			}
			return array();
		}
		
		/**
		* function comment
		* save blog comment
		* AJAX
		*/
		public function comment()
		{
			$time	= dates::convert_to_date('now');
			$time	= dates::convert_to_string($time);
			$form	= new form();
			
			$form	->post('blog_id')
					->valid('Integer')
					
					->post('name')
					->valid('Min_Length',1)
					
					->post('email')
					->valid('Email')
					
					->post('message')
					->valid('Min_Length',10)
					
					->submit();
			$fdata	= $form->fetch();
			
			if(!empty($fdata['MSG']))
			{
				return array('Error'=>$fdata['MSG']);
			}
			
			//check blog id
			$b = $this->db->select('SELECT b_id, b_likes ,b_see 
									FROM '.DB_PREFEX.'blog 
									WHERE b_accept_date IS NOT NULL AND b_id = :ID
									',array(':ID'=>$fdata['blog_id']));
			if(count($b) != 1)
			{
				return array('Error'=>"Blog Not Found");
			}
			
			//insert
			$user_array = array('com_blog'		=>$fdata['blog_id']
								,'com_aut_name'	=>$fdata['name']
								,'com_aut_email'=>$fdata['email']
								,'com_comment'	=>$fdata['message']
								,'create_at'	=>$time
								);
				
			$this->db->insert(DB_PREFEX.'comments',$user_array);
			$gr_dr = $this->db->LastInsertedId();
				
			return array('ok'=>$gr_dr);
			
		}
		
		/**
		* function user
		* get user info and blogs
		*/
		public function user($id)
		{
			//get bloger
			$form	= new form();
			if(empty($id) || !$form->single_valid($id,'Integer'))
			{
				return array();
			}
			
			//get user data
			$b = $this->db->select("SELECT staff_id, staff_name, staff_phone, staff_email, staff_img, staff_address
									,staff_about, staff_face, staff_twitter, staff_linked, staff_instagram 
									FROM ".DB_PREFEX."staff
									WHERE staff_id = :ID AND staff_type = 'bloger'
									",array(":ID"=>$id));
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
									",array(":ID"=>$id));
			
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
		
		
	}
?>
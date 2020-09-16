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
				$x = $this->db->select("SELECT cat_id, cat_name, cat_class
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
			if(!empty($category) || !$form->single_valid($category,'Integer'))
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
		* function most_read_blog
		* get last 3 blogs
		*/
		public function most_read_blog()
		{
			$blog = array();
			//get blog data
			$b = $this->db->select('SELECT b_id, b_title, b_desc, b_img, b_likes, b_see, b_accept_date
									,b_user, staff_name, staff_phone, staff_email, staff_img
									FROM '.DB_PREFEX.'blog 
									JOIN '.DB_PREFEX.'staff ON b_user = staff_id
									WHERE b_accept_date IS NOT NULL 
									ORDER BY b_see DESC
									LIMIT 3
									',array());
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
				array_push($blog,$x);
			}
			return $blog;
		}
		
		
		
	}
?>
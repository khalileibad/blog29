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
		* function blog
		* get last 3 blogs based on type:
		* "last"
		* "most_read"
		* "most_like"
		*/
		public function blog($type="last",$limit=3)
		{
			$order = "";
			switch($type)
			{
				case "most_read": $order = "b_see"; break;
				case "most_like": $order = "b_likes"; break;
				case "last": default: $order = "b_accept_date";
			}
			$blog = array();
			//get blog data
			$b = $this->db->select("SELECT b_id, b_title, b_desc, b_img, b_likes, b_see, b_accept_date
									,b_user, staff_name, staff_phone, staff_email, staff_img
									FROM ".DB_PREFEX."blog 
									JOIN ".DB_PREFEX."staff ON b_user = staff_id
									WHERE b_accept_date IS NOT NULL 
									ORDER BY $order DESC
									LIMIT $limit
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
				array_push($blog,$x);
			}
			return $blog;
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
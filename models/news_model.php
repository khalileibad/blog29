<?php
	/**
	* news MODEL, 
	*/
	class news_model extends model
	{
		/** The Default Method Like Main in java*/
		function __construct()
		{
			parent::__construct();
		}
		
		/**
		* function user_list
		* get users list
		*/
		public function news_list()
		{
			$form	= new form();
			
			$form	->post('no',false,true) // news no
					->valid('Integer')
					
					->post('date',false,true) // news date
					->valid('Date')
					
					->post('status',false,true) // news status
					->valid('Integer')
					
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
				$sea_txt .= 'n_id = :NO  AND ';
			}
			if(!empty($fdata['date']))
			{
				$sea_arr[':DAT'] = $fdata['date'];
				$sea_txt .= 'DATE(create_at)  = :DAT AND ';
			}
			if(!empty($fdata['status']) || $fdata['status'] ==="0")
			{
				$sea_arr[':STATUS'] = $fdata['status'];
				$sea_txt .= 'n_active = :STATUS AND ';
			}
			
			$sea_txt .= ' 1 = 1 ';
			
			return $this->db->select("SELECT n_id, n_name, n_name_EN
										,n_title , n_title_EN ,n_active ,DATE(create_at) AS create_at
										FROM ".DB_PREFEX."news 
										WHERE $sea_txt
										ORDER BY n_id DESC
										" ,$sea_arr
								);
		}
		
		/**
		* function news_data
		* get news data
		*/
		public function news_data($id)
		{
			$form	= new form();
			if(empty($id) || !$form->single_valid($id,'Integer'))
			{
				return array('Error'=>"ID Not Found");
			}
			
			$x = $this->db->select("SELECT *
									from ".DB_PREFEX."news 
									WHERE n_id = :ID ",array(":ID"=>$id));
			if(count($x)!=1)
			{
				return array('Error'=>"ID Not Found");
			}
			$x = $x[0];
			$ret = array('id'			=>$x['n_id']
						,'name'			=>$x['n_name']
						,'name_en'		=>$x['n_name_EN']
						,'title'		=>$x['n_title']
						,'title_en'		=>$x['n_title_EN']
						,'details'		=>$x['n_details']
						,'details_en'	=>$x['n_details_EN']
						,'img'			=>$x['n_img']
						,'active'		=>$x['n_active']
						);
			
			//get Files:
			
			//////////
			return $ret;
		}
		/**
		* function new_news
		* create new news
		*/
		public function new_news()
		{
			$time	= dates::convert_to_date('now');
			$time	= dates::convert_to_string($time);
			
			$form	= new form();
			
			$form	->post('name') // Name
					->valid('Min_Length',3)
					->valid('Max_Length',100)
					
					->post('name_en') // Name
					->valid('Min_Length',3)
					->valid('Max_Length',100)
					
					->post('title') // title
					->valid('Min_Length',3)
					->valid('Max_Length',200)
					
					->post('title_en') // title
					->valid('Min_Length',3)
					->valid('Max_Length',200)
					
					->post('details') // title
					->valid('Min_Length',3)
					
					->post('details_en') // title
					->valid('Min_Length',3)
					
					->submit();
			$fdata	= $form->fetch();
			
			if(!empty($fdata['MSG']))
			{
				return array('Error'=>$fdata['MSG']);
			}
			
			//insert
			$user_array = array('n_name'		=> $fdata['name']
								,'n_name_EN'	=> $fdata['name_en']
								,'n_title'		=> $fdata['title']
								,'n_title_EN'	=> $fdata['title_en']
								,'n_details'	=> $fdata['details']
								,'n_details_EN'	=> $fdata['details_en']
								,'create_at'	=> $time
								);
			$this->db->insert(DB_PREFEX.'news',$user_array);
			$id = $this->db->LastInsertedId();
			
			//update image
			if(!empty($_FILES['user_img']))
			{
				$files	= new files(); 
				if($files->check_file($_FILES['user_img'],'img'))
				{
					$user_img = $files->up_file($_FILES['user_img'],URL_PATH.'public/IMG/news/'.$id);
					$this->db->update(DB_PREFEX.'news',array('n_img'=>$user_img),'n_id = '.$id);
				}else
				{
					return array('Error'=>"In Field user_img: Error data");
				}
			}else
			{
				echo "uuuuuuuuuuu";
			}
			
			return array('id'=> $id);
		}
		
		/**
		* function upd_news
		* update news
		*/
		public function upd_news()
		{
			$time	= dates::convert_to_date('now');
			$time	= dates::convert_to_string($time);
			
			$form	= new form();
			
			$form	->post('upd_id') // Admission
					->valid('Integer')
					
					->post('upd_name') // Name
					->valid('Min_Length',3)
					->valid('Max_Length',100)
					
					->post('upd_name_en') // Name
					->valid('Min_Length',3)
					->valid('Max_Length',100)
					
					->post('upd_title') // title
					->valid('Min_Length',3)
					->valid('Max_Length',200)
					
					->post('upd_title_en') // title
					->valid('Min_Length',3)
					->valid('Max_Length',200)
					
					->post('upd_details') // title
					->valid('Min_Length',3)
					
					->post('upd_details_en') // title
					->valid('Min_Length',3)
					
					->post('old_img',false,true) // title
					->valid_array('Min_Length',3)
					
					->submit();
			$fdata	= $form->fetch();
			
			if(!empty($fdata['MSG']))
			{
				return array('Error'=>$fdata['MSG']);
			}
			
			//update
			$news_array = array('n_name'		=> $fdata['upd_name']
								,'n_name_EN'	=> $fdata['upd_name_en']
								,'n_title'		=> $fdata['upd_title']
								,'n_title_EN'	=> $fdata['upd_title_en']
								,'n_details'	=> $fdata['upd_details']
								,'n_details_EN'	=> $fdata['upd_details_en']
								,'update_at'	=> $time
								);
			
			if(!empty($_FILES['upd_news_img']))
			{
				$files	= new files(); 
				if($files->check_file($_FILES['upd_news_img'],'img'))
				{
					$news_array['n_img'] = $files->up_file($_FILES['upd_news_img'],URL_PATH.'public/IMG/news/'.$fdata['upd_id']);
					foreach($fdata['old_img'] as $val)
					{
						$files->del_file(URL_PATH.'public/IMG/news/'.$fdata['upd_id'].'/'.$val);
					}
				}
			}
			
			$this->db->update(DB_PREFEX.'news',$news_array,'n_id = '.$fdata['upd_id']);
			
			return array('id'=>$fdata['upd_id']);
		}
		
		/**
		* function del_news
		* delete news
		*/
		public function del_news()
		{
			$time	= dates::convert_to_date('now');
			$time	= dates::convert_to_string($time);
			
			$form	= new form();
			
			$form	->post('id') // Admission
					->valid('Integer')
					
					->submit();
			$fdata	= $form->fetch();
			
			if(!empty($fdata['MSG']))
			{
				return array('Error'=>$fdata['MSG']);
			}
			
			//check ID:
			$em = $this->db->select("SELECT ty_id FROM ".DB_PREFEX."news 
									WHERE ty_id = :ID  "
									,array(":ID"=>$fdata['id']));
			if(count($em) != 1)
			{
				return array('Error'=>"لم يتم العثور على انوع");
			}
			
			
			$this->db->delete(DB_PREFEX.'news','ty_id = '.$fdata['id']);
			
			return array('id'=>$fdata['id']);
		}
		
		/**
		* function active
		* active / freez news
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
			$data = $this->db->select("SELECT n_active FROM ".DB_PREFEX."news 
									WHERE n_id = :ID"
									,array(":ID"=>$fdata['id']));
			if(count($data) != 1)
			{
				return array('Error'=>"لم يتم العثور على الخبر");
			}
			
			$curr = ($data[0]['n_active']==1)?true:false;
			
			if(($fdata['current'] == "true" && !$curr)||($fdata['current']== "false" && $curr))
			{
				return array('Error'=>'حالة الخبر الحالية هي  '.$curr.' - '.$fdata['current']);
			}	
			$time	= dates::convert_to_date('now');
			$time	= dates::convert_to_string($time);
			
			$this->db->update(DB_PREFEX.'news',array('n_active'=>($curr)?0:1),'n_id = '.$fdata['id']);
			return array('ok'=>'1');
		}
		
	}
?>
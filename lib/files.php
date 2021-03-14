<?php
	/**
	* class files
	* for validation and uploading files
	*/
	class files
	{
		private $max_length = 100000000;
		private $img_type	= array("image/gif"
									,"image/jpeg"
									,"image/jpg"
									,"image/pjpeg"
									,"image/x-png"
									,"image/png");
		private $img_Exts	= array("gif", "jpeg", "jpg", "png", "webp");
		private $doc_type	= array("application/pdf"
									,"application/msword"
									,"application/vnd.openxmlformats-officedocument.wordprocessingml.document"
									,'application/vnd.ms-excel'
									,'text/xls'
									,'text/xlsx'
									,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
									,'text/plain'
									,'text/csv'
									,'text/tsv'
									);
		
		private $doc_Exts	= array("pdf","doc","docx","xlsx","xls");
		private $csv_Exts	= array("csv");
		
		private $upl_err 	= array(
								0 => 'There is no error, the file uploaded with success',
								1 => 'The uploaded file exceeds the Max Allowed file Size', //upload_max_filesize directive in php.ini
								2 => 'The uploaded file exceeds the Max Allowed file Size',//MAX_FILE_SIZE directive that was specified in the HTML form
								3 => 'The uploaded file was only partially uploaded',
								4 => 'No file was uploaded',
								6 => 'Missing a temporary folder',
								7 => 'Failed to write file to disk.',
								8 => 'A PHP extension stopped the file upload.',
							);
		/**
		* fun check_file
		* check if the file accepted or not
		* return file name if accepted or false if not accepted
		* @param $file = $_FILE
		* @param $type = the file type
		*/
		function check_file($file,$type="")
		{
			if(empty($file)||!is_array($file))
			{
				return false;
			}
			if($file["error"] != 0)
			{
				//echo $this->upl_err[$file["error"]];
				return false;
			}
			
			$temp		= explode(".",$file["name"]);//
			$extension	= end($temp);
			
			if(empty($type))
			{
				if(in_array($extension,$this->img_Exts))
				{
					$type = 'img';
				}elseif(in_array($extension,$this->doc_Exts))
				{
					$type = 'doc';
				}
			}
			if($type == 'img')
			{
				$ext = $this->img_Exts;
				$ty	 = $this->img_type;
			}else if($type == 'doc')
			{
				$ext = $this->doc_Exts;
				$ty  = $this->doc_type;
			} 
			else if($type == 'csv')
			{
				$ext = $this->csv_Exts;
				$ty  = $this->doc_type;
			} 
			
		
			if(empty($extension) || !in_array($extension,$ext))
			{
				//echo "Error in file EXT".$file["name"]." exension - ".$extension." - ".$type."<br/>";
				return false;
			}
			if(!in_array($file["type"],$ty))
			{
				//echo "Error in file type".$file["name"]." type - ".$file["type"];
				return false;
			}
			
			
			if($file["size"] <= $this->max_length)
			{
				return $file['name'];
			}else
			{
				//echo "Error in file: ".$file['name']." SIZE";
				return false;
			}
		}
		
		/**
		* fun up_file
		* upload the files
		* @param $name = the $_FILE
		* @param $dir = the destination
		*/
		public function up_file($name,$dir)
		{
			if(empty($name))
			{
				return false;
			}
			
			if(!file_exists($dir))
			{
				mkdir($dir);
			}
			$increment = 0;
			$url = $dir.'/'.$name['name'];
			if(file_exists($url))
			{
				list($filename, $ext) = explode('.', $name['name']);
				while(file_exists($url)) 
				{
					$increment++;
					$url = $dir.'/'.$filename.$increment.'.'.$ext;
					//$filename .= $increment;
				}
				$name['name'] = $filename.$increment.'.'.$ext;
			}
			
			move_uploaded_file($name["tmp_name"],$url);
			return $name['name'];
		}
		
		/**
		* fun reArrayFiles
		* this fun used when upload multiple files in same name (post as array)
		* it will resort the posted data
		* @param file_post : the posted files
		* @reurn the posed file data as array
		*/
		function reArrayFiles($file_post)
		{
			if(empty($file_post))
			{
				return array();
			}
			$file_ary = array();
			$file_count = array_keys($file_post['name']);
			$file_keys = array_keys($file_post);

			foreach ($file_count as $i ) 
			{
				foreach ($file_keys as $key) 
				{
					$file_ary[$i][$key] = $file_post[$key][$i];
				}
			}
			return $file_ary;
		}
		
		function del_file($file_path)
		{
			unlink($file_path);
		}
	}
?>

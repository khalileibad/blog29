<?php
	/**
	* Item Validation Lib, 
	*/
	class valid
	{
		
		/**
		* The Default Method Like Main in java
		*/
		function __construct(){}
		
		public function Min_Length($data,$arg)
		{
			if(strlen($data)<$arg)
			{
				return "Your String $data Can Only Be $arg Long";
			}
		}
		
		public function Max_Length($data,$arg)
		{
			if(strlen($data) > $arg)
			{
				return "Your String $data Can Only Be $arg Long";
			}
		}
		
		public function Integer($data)
		{
			if(!ctype_digit($data) && $data != 0)
			{
				return "Your String $data Must Be number ".$data;
			}
		}
		
		public function Int_max($data,$max)
		{
			$x = $this->numeric($data);
			if(!empty($x))
			{
				return $x;
			}
			if($data > $max)
			{
				return "The Number $data Must Be less than or equal $max";
			}
		}
		
		public function Int_min($data,$min)
		{
			$x = $this->numeric($data);
			if(!empty($x))
			{
				return $x;
			}
			if($data < $min)
			{
				return "The Number $data Must Be grater than or equal $min";
			}
		}
		
		/**
		* Numeric
		*
		* @param	string
		* @return	bool
		*/
		public function numeric($str)
		{
			if(!is_numeric($str))
			{
				return "Your String $str Must Be number ";
			}
		}
		
		public function Email($data)
		{
			if(filter_var($data,FILTER_VALIDATE_EMAIL) === false)
			{
				return "Your String $data Must Be a valid Email ";
			}
		}
		
		public function IP($data)
		{
			if(filter_var($data,FILTER_VALIDATE_IP) === false)
			{
				return "Your String $data Must Be a valid IP address ";
			}
		}
		
		public function URL($data)
		{
			if(filter_var($data,FILTER_VALIDATE_URL) === false)
			{
				return "Your String $data Must Be a URL ";
			}
		}
		
		public function Date($date,$format = 'YYYY-MM-DD')
		{
			$d = preg_split( '/[-\.\/ ]/', $date );
			if(count($d)!= 3)
			{
				return "Your String $date Must Be In Same Data Format $format ";
			}
			if(intval($d[0]) > 3000 && intval($d[0]) < 1000)
			{
				return "The Year Must Be between 1000 and 3000 ";
			}
			if(intval($d[1]) > 12 && intval($d[1]) < 1)
			{
				return "The Month Must Be between 1 and 12 ";
			}
			if(intval($d[2]) > 31 && intval($d[2]) < 1)
			{
				return "The Day Must Be between 1 and 31 ";
			}
			
		}
		
		public function Date_Time($date,$format = 'YYYY-MM-DD HH:MM:SS')
		{
			$date = trim($date);
			$date_time = explode(" ",$date);
			if(count($date_time)!= 2)
			{
				return "Your String $date Must Be In Same Data Format $format ";
			}
			$re = Date($date_time[0]);
			if($re && $re!=$date_time[0])
			{
				return $re;
			}
			$d = explode(":",$date_time[1]);
			if(count($d)!= 3 && count($d)!= 2)
			{
				return "Your String $date Must Be In Same Data Format $format ";
			}
			if(intval($d[0]) > 24 && intval($d[0]) < 1)
			{
				return "The Houre Must Be between 1 and 24 ";
			}
			if(intval($d[1]) > 59 && intval($d[1]) < 1)
			{
				return "The Minites Must Be between 1 and 60 ";
			}
			if(!empty($d[2]) && intval($d[2]) > 59 && intval($d[2]) < 1)
			{
				return "The Secounds Must Be between 1 and 59 ";
			}
			
		}
		
		public function Phone($data)
		{
			$this->Min_Length($data,10);
			$this->Max_Length($data,10);
			$this->Integer($data);
		}
		
		public function In_Array($data,$array)
		{
			if(array_search($data,$array) === false)
			{
				return "Your String $data Must Be On of ".implode(' ',$array);
				
			}
		}
		
		/**
		default Call Function When Fun dose not Exsist
		*/
		public function __call($fun,$arg)
		{
			throw new Exception("Function $fun Dosen't Exsist in class: ".__CLASS__);
		}
	}
?>
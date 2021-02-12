<?php

class Email 
{
	function __construct()
	{
	}
	
	public static function send_email($to,$title,$MSG,$from = EMAIL_ADD)
	{
		
		$MSG = wordwrap($MSG,70);
		
		$headers = 'From: <'.$from.'>' . "\r\n";
		mail($to,$title,$MSG,$headers);
	}
	
	//Send msg Notification
	public static function contact($msg_data,$from = EMAIL_ADD)
	{
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        //$headers .= 'From: <'.$from.'>' . "\r\n";
		
		$MSG = "<html><body><div>
					Contact Message:<br/>
					Name: ".$msg_data['con_name']." <br/>
					Email: ".$msg_data['con_name']." <br/>
					Subject: ".$msg_data['con_email']." <br/>
					time: ".$msg_data['con_date']." <br/>
					Message: ".$msg_data['con_msg']." <br/>
					
				</div>
				</body></html>";
		
		return mail($email,"Meeting info",$MSG,$headers);	
	}
	
	public static function welcome_reg($name,$email,$from = EMAIL_ADD)
	{
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $headers .= 'From: <'.$from.'>' . "\r\n";
		
		$MSG = "<html><body>
				<div dir='rtl'>
					<img src='".URL."public/IMG/mail_msg.jpg'/><br/>
					عزيزي $name <br/>
					مرحبا بك في موقع ".TITLE."<br/>
					سيتم التواصل معك لتأكيد عملية التسجيل في اقرب وقت
				</div>
				</body></html>";
		
		return mail($email,"login info",$MSG,$headers);
		
	}
	
	public static function welcome_people($name,$email,$pass="",$from = EMAIL_ADD)
	{
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $headers .= 'From: <'.$from.'>' . "\r\n";
		
		$MSG = "<html><body>
				<div dir='rtl'>
					<img src='".URL."public/IMG/mail_msg.jpg'/><br/>
					عزيزي $name <br/>
					مرحبا بك في موقع ".TITLE."<br/>
					لقد تم تأكيد تسجيلك في النظام <br/>
					قم بتسجيل الدخول واكمال عملية التسجيل <br/>
					بيانات تسجيل الدخول:<br/>
					اسم المستخدم: $email <br/>
					كلمة المرور: ";
		$MSG .= (empty($pass))?"كلمة المرور التي ادخلتها في عملية التسجيل":$pass;
		$MSG .= "<br/>		
				</div>
				</body></html>";
		
		return mail($email,"login info",$MSG,$headers);
		
	}
	
	public static function del_req($name,$email,$from = EMAIL_ADD)
	{
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $headers .= 'From: <'.$from.'>' . "\r\n";
		
		$MSG = "<html><body>
				<div dir='rtl'>
					<img src='".URL."public/IMG/mail_msg.jpg'/><br/>
					عزيزي $name <br/>
					لقد تم الغاء طلبك بالتسجيل <br/>
					الرجاء التواصل مع ادارة اللجنة لمعرفة السبب
				</div>
				</body></html>";
		
		return mail($email,"login info",$MSG,$headers);
		
	}
	
	public static function forget($name,$email,$id,$time,$from = EMAIL_ADD)
	{
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $headers .= 'From: <'.$from.'>' . "\r\n";
		
		$MSG = "<html><body>
				<div dir='rtl'>
					الزميل $name <br/>
					لقد طلبت اعادة ضبط كلمة الدخول الخاصة بك<br/>
					اذا كان هذا الطلب منك, بامكانك اعادة ضبط كلمة المرور خلال 24 ساعة من $time باستخدام الرابط: <a href='".URL."login/resetpassword/".$id."'>".URL."login/resetpassword/".$id."</a><<br/>
					اذا لم تكن انت , تجاهل هذا الايميل <br/>
				</div>
				</body></html>";
		
		return mail($email,"login info",$MSG,$headers);
	}
	
	public static function del_blog($name,$email,$id,$blog,$from = EMAIL_ADD)
	{
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $headers .= 'From: <'.$from.'>' . "\r\n";
		
		$MSG = "<html><body>
				<div dir='rtl'>
					الزميل $name <br/>
					لقد تم مسح مدونتك رقم $no<br/>
					بالعنوان $blog<br/>
				</div>
				</body></html>";
		
		return mail($email,"login info",$MSG,$headers);
	}
	
	
	
	
	
	public static function welcome_dr($name,$gr,$email,$gr_code,$from = EMAIL_ADD)
	{
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $headers .= 'From: <'.$from.'>' . "\r\n";
		
		$MSG = "<html><body>
				<div dir='rtl'>
					<img src='".URL."public/IMG/mail_msg.jpg'/><br/>
					عزيزي $name <br/>
					مرحبا بك في موقع ".TITLE."<br/>
					نشكرك على تقديم المساعدة وندعو الله ان يكون هذا العمل في ميزان حسناتكم
					لقد تمت اضافتك في الفريق الطبي ".$gr."</div>
					رابط المرضى: <a href='".URL."login/register/PA/".$gr_code."'>".URL."/login/register/PA/".$gr_code."</a><br/>
					رابط الدعوة للاطباء: <a href='".URL."login/register/DR/".$gr_code."'>".URL."login/register/DR/".$gr_code."</a><br/>
					من فضلك قم بمشاركة رابط الدعوة على منضات التواصل حتى يتمكن المرضى من التواصل معكم
				
				</body></html>";
		
		return mail($email,"login info",$MSG,$headers);
		
	}
	
	public static function welcome_user($name,$dep,$email,$phone,$pass,$from = EMAIL_ADD)
	{
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $headers .= 'From: <'.$from.'>' . "\r\n";
		
		$MSG = "<html><body>
				<div dir='rtl'>
					<img src='".URL."public/IMG/mail_msg.jpg'/><br/>
					عزيزي $name <br/>
					مرحبا بك في موقع ".TITLE."<br/>
					نشكرك على تقديم المساعدة وندعو الله ان يكون هذا العمل في ميزان حسناتكم
					رابط الدخول: <a href='".URL."login'>".URL."</a><br/>
					اسم المستخدم: $phone <br/>
					كلمة المرور: $pass <br/>
				</div>
				</body></html>";
		
		return mail($email,"login info",$MSG,$headers);
		
	}
	
	
	
}
?>
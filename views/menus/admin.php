<!-- Navbar -->
<div class="w3-top">
	<div class="w3-bar w3-theme w3-left-align w3-large">
		<a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-left w3-padding-large w3-large w3-theme" href="javascript:void(0);" onclick="openNav()">
			<i class="fa fa-bars"></i>
		</a>
		<div href="#" class="w3-bar-item w3-theme w3-right">
			<img src="<?php echo URL?>public/IMG/logo.jpg" width="35" height="35" alt="Avatar" class="w3-circle" /> 
			<span>لجنة التغيير والخدمات</span>
		</div>
		<a href="<?php echo URL?>news" class="w3-bar-item w3-right w3-button w3-hide-small w3-padding-large w3-hover-white" title="المعاملات">
			<i class="fa fa-th"></i> الأخبار
		</a>
		<a href="<?php echo URL?>people" class="w3-bar-item w3-right w3-button w3-hide-small w3-padding-large w3-hover-white" title=" انواع المعاملات">
			<i class="fa fa-home"></i> السكان
		</a>
		<a href="<?php echo URL?>people/request" class="w3-bar-item w3-right w3-button w3-hide-small w3-padding-large w3-hover-white" title="حالات المعاملات">
			<i class="fa fa-users"></i> طلبات السكان
		</a>
		<!--a href="<?php echo URL?>dep" class="w3-bar-item w3-right w3-button w3-hide-small w3-padding-large w3-hover-white" title="dep">
			<i class="fa fa-users"></i> الأقسام
		</a-->
		<a href="<?php echo URL?>staff" class="w3-bar-item w3-right w3-button w3-hide-small w3-padding-large w3-hover-white" title="المستخدمين">
			<i class="fa fa-users"></i> المستخدمين
		</a>
		<a id="change_password" class="w3-bar-item w3-right w3-button w3-hide-small w3-padding-large w3-hover-white change_password" title="تغير كلمة المرور">
			<i class="fa fa-pencil"></i> تغير كلمة المرور
		</a>
		
		<a href="<?php echo URL?>login/logout" class="button w3-bar-item w3-left w3-button w3-hide-small w3-padding-large w3-hover-white" title="خروج">
			<i class="fa fa-sign-out"></i> خروج
		</a>
	</div>
</div>

<!-- Navbar on small screens -->
<div id="navDemo" class="w3-bar-block w3-theme w3-hide w3-hide-large w3-hide-medium w3-center">
	<a href="#" class="w3-bar-item w3-button w3-padding-large">-</a>
	<a href="<?php echo URL?>news" class="w3-bar-item w3-button" title="الاخبار">
		<i class="fa fa-th"></i> الأخبار
	</a>
	<a href="<?php echo URL?>people" class="w3-bar-item w3-button" title="السكان">
		<i class="fa fa-home"></i> السكان
	</a>
	<a href="<?php echo URL?>people/request" class="w3-bar-item w3-button" title="طلبات السكان">
		<i class="fa fa-users"></i> طلبات السكان
	</a>
	<a href="<?php echo URL?>staff" class="w3-bar-item w3-button" title="المستخدمين">
		<i class="fa fa-users"></i> المستخدمين
	</a>
	<a id="change_password" class="w3-bar-item w3-button change_password" title="تغير كلمة المرور">
		<i class="fa fa-pencil"></i> تغير كلمة المرور
	</a>	
	<a href="<?php echo URL?>login/logout" class="w3-bar-item w3-button" title="خروج">
		<i class="fa fa-sign-out"></i> خروج
	</a>
</div>


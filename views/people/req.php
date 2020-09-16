<div class="w3-container" style="max-width:1400px;margin-top:70px">

	<!-- Header -->
	<header class="w3-row w3-white w3-margin-bottom">
		<h3>طلبات التسجيل</h3>
	</header>
	
	<div class="w3-row w3-theme w3-padding">
		<form id="people_search">
			<input type="hidden" name="csrf" id="csrf" class="hid_info" value="<?php echo session::get('csrf'); ?>" />
			<div class="w3-threequarter w3-right w3-row-padding">
				<div class="w3-third w3-right">
					<label>رقم الأرض</label>
					<input name="no" class="w3-input "/>
				</div>
				<div class="w3-third w3-right">
					<label>رقم البطاقة الخدمية</label>
					<input name="card" class="w3-input"/>
				</div>
				<div class="w3-quarter w3-right">		
					<label>الحالة السكنية</label>
					<select name="status" class="w3-select ">
						<option class="w3-hover-theme" value="" selected></option>
					<?php
						foreach(kb9::$house_live_type as $key => $value)
						{
					?>
						<option class="w3-hover-theme" value="<?php echo $key?>" ><?php echo $value[session::get('lang')]?></option>
					<?php
						}
					?>
					</select>
				</div>
			</div>
			<div class="w3-quarter w3-left w3-center w3-padding-16">
				<button id="search_people" type="button" class="w3-button w3-margin-top w3-light-grey">
					بحث <i class="fa fa-search"></i>
				</button>
			</div>
		</form>
	</div>
	<!--people List-->	
	<div class="w3-row w3-responsive" id="req_people_list"></div>
	
</div>

<!-- Remove Request -->
<div id="del_request" class="w3-modal">
	<div class="w3-modal-content w3-animate-zoom w3-card-4" style="width:400px">
		<header class="w3-container w3-theme"> 
			<h3><span class="w3-button w3-display-topleft del_request_close">&times;</span></h3>
			<h3><i class="fa fa-pencil"></i> حذف طلب التسجيل</h3>
		</header>
		<div class="w3-container w3-padding">
			<form class="" id="del_request_form">
				<input type="hidden" class="hid_info" id="csrf" name="csrf" value="<?php echo session::get('csrf'); ?>" />
				<input type="hidden" id="upd_id" name="upd_id" value="" />
				<div class="w3-row">
					<label class="w3-text-theme"><b>رقم هاتف مقدم الطلب</b></label>
					<input name="upd_phone" id="upd_phone" class="w3-input w3-border w3-margin-bottom" type="phone">
				</div>
				<div class="w3-row">
					<label class="w3-text-theme"><b>كلمة المرور الخاصة بك</b></label>
					<input name="upd_pass" id="upd_pass" class="w3-input w3-border w3-margin-bottom" type="password">
				</div>
			</form>
		</div>
		<footer class="w3-container w3-theme">
			<p Class="w3-center">
				<button id="add_del_request" class="w3-btn w3-theme-l5 w3-hover-theme">تعديل بيانات الخبر</button>
				<button type="button" class="w3-btn w3-theme-l5 w3-hover-theme del_request_close">الغاء</button>
			</p>
		</footer>
	</div>
</div>

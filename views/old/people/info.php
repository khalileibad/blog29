<div class="w3-container" style="max-width:1400px;margin-top:70px">
	<!-- Header -->
	<header class="w3-row w3-white w3-margin-bottom">
		<h3>تفاصيل الوحدة السكنية</h3>
	</header>
	<div class="w3-container">
		<!--Land Info-->
		<button class="w3-button w3-theme w3-block w3-hover-light-grey peo_menus" data-id="land_info">بيانات الأرض</button>
		<div id="land_info" class="w3-hide w3-animate-opacity">
			<form class="upd_people_info" method="POST" action="<?php echo URL?>people/upd_land">
				<input type="hidden" class="hid_info" name="csrf" id="csrf" value="<?php echo session::get('csrf'); ?>" />
				<input type="hidden" name="l_id" value="<?php echo $this->info['land']['l_id']?>" />
				<div class="w3-row w3-row-padding">
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>رقم الارض</b></label>
						<input value="<?php echo $this->info['land']['l_no'];?>" name="land_no" id="land_no" type="number" class="w3-input w3-border w3-margin-bottom" />
						<div class=" err_notification " id="valid_land_no">
							هنالك خطأ في هذا الحقل
						</div>
						<div class="err_notification" id="duplicate_land_no">
							<?php echo $this->lang['error_dup']?>
						</div>
					</div>
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>رقم الارض الفرعي</b></label>
						<input value="<?php echo $this->info['land']['l_sub_no'];?>" type="number" name="land_sub_no" id="land_sub_no" class="w3-input w3-border w3-margin-bottom" value="0" />
						<div class="err_notification " id="valid_land_sub_no">
							هنالك خطأ في هذا الحقل
						</div>
						<div class="err_notification" id="duplicate_land_sub_no">
							<?php echo $this->lang['error_dup']?>
						</div>
					</div>
				</div>
				<div class="w3-row w3-row-padding">
					<div class="w3-half w3-right">
						<label class="w3-text-theme "><b>اسم مالك الأرض</b></label>
						<input value="<?php echo $this->info['land']['l_owner_name'];?>" type="text" name="land_owner" id="land_owner" class="w3-input w3-border w3-margin-bottom" />
						<div class="err_notification " id="valid_land_owner">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
					<div class="w3-half">
						<label class="w3-text-theme w3-left"><b>Land Owner Name</b></label>
						<input value="<?php echo $this->info['land']['l_owner_name_EN'];?>" type="text" name="land_owner_en" id="land_owner_en" class="w3-input w3-border w3-margin-bottom" />
						<div class="err_notification " id="valid_land_owner_en">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
				</div>
				<div class="w3-row w3-row-padding">
					<div class="w3-half w3-right">
						<label class="w3-text-theme "><b>رقم الهاتف</b></label>
						<input value="<?php echo $this->info['land']['l_owner_phone'];?>" type="phone" name="land_phone" id="land_phone" class="w3-input w3-border w3-margin-bottom" />
						<div class="err_notification " id="valid_and_phone">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>البريد الالكتروني</b></label>
						<input value="<?php echo $this->info['land']['l_owner_email'];?>" type="email" name="land_email" id="land_email" class="w3-input w3-border w3-margin-bottom" />
						<div class=" err_notification " id="valid_land_email">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
				</div>
				<div class="w3-row w3-row-padding">
					<div class="w3-half w3-right">
						<label class="w3-text-theme "><b>نوع الارض</b></label>
						<select name="land_status" class="w3-select ">
							<option class="w3-hover-theme" value="" selected></option>
						<?php
							foreach(kb9::$land_type as $key => $value)
							{
								$sel = ($key == $this->info['land']['l_type'])?"selected":"";
						?>
							<option class="w3-hover-theme" value="<?php echo $key?>" <?php echo $sel;?> ><?php echo $value[session::get('lang')]?></option>
						<?php
							}
						?>
						</select>
						<div class=" err_notification " id="valid_land_status">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>عدد الوحدات</b></label>
						<input value="<?php echo $this->info['land']['l_house'];?>" type="number" name="land_units" id="land_units" class="w3-input w3-border w3-margin-bottom" />
						<div class="err_notification " id="valid_ne_land_units">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
				</div>
				<div class="w3-row w3-row-padding">
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>عدد الطوابق</b></label>
						<input value="<?php echo $this->info['land']['l_floor'];?>" type="number" name="land_floor" id="land_floor" class="w3-input w3-border w3-margin-bottom" />
						<div class="err_notification " id="valid_land_floor">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
				</div>
				<div class="w3-row w3-row-padding w3-center">
					<button type="submit" class="w3-btn w3-theme-l5 w3-hover-theme">تعديل بيانات الأرض</button>
				</div>
			</form>
		</div>
		<br/>
		
		<!--House Info-->
		<button class="w3-button w3-theme w3-block w3-hover-light-grey peo_menus" data-id="house_info">بيانات الوحدة السكنية</button>
		<div id="house_info" class="w3-hide w3-animate-opacity">
			<form class="upd_people_info" method="POST" action="<?php echo URL?>people/upd_house">
				<input type="hidden" class="hid_info" name="csrf" id="csrf" value="<?php echo session::get('csrf'); ?>" />
				<input type="hidden" name="h_id" id="h_id" value="<?php echo $this->info['house']['h_id']?>" />
				<div class="w3-row w3-row-padding">
					<div class="w3-half w3-right">
						<label class="w3-text-theme "><b>الطابق</b></label>
						<input value="<?php echo $this->info['house']['h_floor'];?>" type="number" name="house_floor" id="house_floor" class="w3-input w3-border w3-margin-bottom" />
						<div class="err_notification " id="valid_house_floor">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>الحالة السكنية <i class="w3-red">*</i></b></label>
						<select name="house_status" class="w3-select ">
							<option class="w3-hover-theme" value="" selected></option>
						<?php
							foreach(kb9::$house_live_type as $key => $value)
							{
								$sel = ($key == $this->info['house']['h_type'])?"selected":"";
						?>
							<option value="<?php echo $key?>" <?php echo $sel;?> ><?php echo $value[session::get('lang')]?></option>
						<?php
							}
						?>
						</select>
						<div class="err_notification " id="valid_house_status">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
				</div>
				<div class="w3-row w3-row-padding">
					<div class="w3-half w3-right">
						<label class="w3-text-theme "><b>رقم البطاقة الخدمية <i class="w3-red">*</i></b></label>
						<input value="<?php echo $this->info['house']['h_card'];?>" type="number" name="house_card" id="house_card" class="w3-input w3-border w3-margin-bottom" />
						<div class="err_notification" id="valid_house_card">
							هنالك خطأ في هذا الحقل
						</div>
						<div class="err_notification" id="duplicate_house_card">
							<?php echo $this->lang['error_dup']?>
						</div>
					</div>
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>وصف الوحدة</b></label>
						<input value="<?php echo $this->info['house']['h_desc'];?>" type="text" name="house_desc" id="house_desc" class="w3-input w3-border w3-margin-bottom" />
						<div class="err_notification" id="valid_house_desc">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
				</div>
				<div class="w3-row w3-row-padding w3-center">
					<button type="submit" class="w3-btn w3-theme-l5 w3-hover-theme">تعديل بيانات الوحدة السكنية</button>
				</div>
			</form>
		</div>
		<br/>
		
		<!--People Info-->
		<button class="w3-button w3-theme w3-block w3-hover-light-grey peo_menus" data-id="people_info">بيانات سكان الوحدة</button>
		<div id="people_info" class="w3-hide w3-animate-opacity">
			<!-- Header -->
			<header class="w3-row w3-white w3-margin-bottom">
				<button id="new_people_button" class="w3-hover-theme w3-button w3-theme w3-card-2 w3-animate-opacity">
					إضافة شخص جديد <i class="fa fa-plus"></i>
				</button>
			</header>
			<div id="people_details_info"></div>
		</div>
		<br/>
		
		<!--workers Info-->
		<button class="w3-button w3-theme w3-block w3-hover-light-grey peo_menus" data-id="worker_info">بيانات العاميلين بالوحدة</button>
		<div id="worker_info" class="w3-hide w3-animate-opacity">
			<!-- Header -->
			<header class="w3-row w3-white w3-margin-bottom">
				<button id="new_worker_button" class="w3-hover-theme w3-button w3-theme w3-card-2 w3-animate-opacity">
					إضافة عامل جديد <i class="fa fa-plus"></i>
				</button>
			</header>
			<div id="worker_details_info"></div>
		</div>
	</div>
</div>

<!-- Add new people -->
<div id="new_people" class="w3-modal">
	<div class="w3-modal-content w3-animate-zoom w3-card-4" style="width:800px">
		<header class="w3-container w3-theme"> 
			<h3><span class="w3-button w3-display-topleft new_people_close">&times;</span></h3>
			<h3><i class="fa fa-plus"></i> إضافة ساكن جديد</h3>
		</header>
		<div class="w3-container w3-padding">
			<form id="new_people_form" method="POST" action="<?php echo URL?>people/new_people">
				<input type="hidden" class="hid_info" name="csrf" value="<?php echo session::get('csrf'); ?>" />
				<input type="hidden" class="hid_info" name="card" id="card" value="<?php echo $this->info['house']['h_card']?>" />
				<div class="w3-row w3-row-padding">
					<div class="w3-half w3-right">
						<label class="w3-text-theme "><b>اسم الساكن <i class="w3-red">*</i></b></label>
						<input type="text" name="name" id="name" class="w3-input w3-border w3-margin-bottom" />
						<div class="err_notification " id="valid_name">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
					<div class="w3-half">
						<label class="w3-text-theme w3-left"><b>Name of inhabitant</b></label>
						<input type="text" name="name_en" id="name_en" class="w3-input w3-border w3-margin-bottom" />
						<div class=" err_notification " id="valid_name_en">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
				</div>
				<div class="w3-row w3-row-padding">
					<div class="w3-half w3-right">
						<label class="w3-text-theme "><b>رقم الهاتف <i class="w3-red">*</i></b></label>
						<input type="phone" name="phone" id="phone" class="w3-input w3-border w3-margin-bottom" />
						<div class=" err_notification " id="valid_phone">
							هنالك خطأ في هذا الحقل
						</div>
						<div class="err_notification" id="duplicate_phone">
							<?php echo $this->lang['error_dup']?>
						</div>
					</div>
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>البريد الالكتروني <i class="w3-red">*</i></b></label>
						<input type="email" name="email" id="email" class="w3-input w3-border w3-margin-bottom" />
						<div class=" err_notification " id="valid_email">
							هنالك خطأ في هذا الحقل
						</div>
						<div class="err_notification" id="duplicate_email">
							<?php echo $this->lang['error_dup']?>
						</div>
					</div>
				</div>
				<div class="w3-row w3-row-padding">
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>نوع الهوية</b></label>
						<select name="id_type" class="w3-select ">
							<option class="w3-hover-theme" value="" selected></option>
						<?php
							foreach(kb9::$id_type as $key => $value)
							{
						?>
							<option value="<?php echo $key?>" ><?php echo $value[session::get('lang')]?></option>
						<?php
							}
						?>
						</select>
						<div class=" err_notification " id="valid_id_type">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>رقم الهوية</b></label>
						<input type="text" name="id_no" id="id_no" class="w3-input w3-border w3-margin-bottom" />
						<div class=" err_notification " id="valid_id_no">
							هنالك خطأ في هذا الحقل
						</div>
						<div class="err_notification" id="duplicate_id_no">
							<?php echo $this->lang['error_dup']?>
						</div>
					</div>
				</div>
				<div class="w3-row w3-row-padding">
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>الجنس</b></label>
						<select name="gender" class="w3-select ">
							<option class="w3-hover-theme" value="" selected></option>
						<?php
							foreach(kb9::$gender as $key => $value)
							{
						?>
							<option value="<?php echo $key?>" ><?php echo $value[session::get('lang')]?></option>
						<?php
							}
						?>
						</select>
						<div class=" err_notification " id="valid_gender">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>تاريخ الميلاد</b></label>
						<input type="text" name="birth" id="birth" class="w3-input w3-border w3-margin-bottom datepicker" />
						<div class=" err_notification " id="valid_birth">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
				</div>
				<div class="w3-row w3-row-padding">
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>الجنسية</b></label>
						<select name="nat" class="w3-select ">
							<option class="w3-hover-theme" value="" selected></option>
						<?php
							foreach(kb9::$countries as $key => $value)
							{
								$sel = ($key == "SD")?" selected":"";
						?>
							<option value="<?php echo $key?>" <?php echo $sel;?> ><?php echo $value[session::get('lang')]?></option>
						<?php
							}
						?>
						</select>
						<div class=" err_notification " id="valid_nat">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>الحالة الإجتماعية</b></label>
						<select name="soc" class="w3-select ">
							<option class="w3-hover-theme" value="" selected></option>
						<?php
							foreach(kb9::$Social as $key => $value)
							{
						?>
							<option value="<?php echo $key?>" ><?php echo $value[session::get('lang')]?></option>
						<?php
							}
						?>
						</select>
						<div class=" err_notification " id="valid_soc">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
				</div>
				<div class="w3-row w3-row-padding">
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>المستوى الأكاديمي</b></label>
						<select name="aca" class="w3-select ">
							<option class="w3-hover-theme" value="" selected></option>
						<?php
							foreach(kb9::$Acadimic as $key => $value)
							{
								$sel = ($key == "SD")?" selected":"";
						?>
							<option value="<?php echo $key?>" <?php echo $sel;?> ><?php echo $value[session::get('lang')]?></option>
						<?php
							}
						?>
						</select>
						<div class="err_notification " id="valid_aca">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>الوظيفة</b></label>
						<input type="text" name="job" id="job" class="w3-input w3-border w3-margin-bottom" />
						<div class=" err_notification " id="valid_job">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
				</div>
			</form>
		</div>
		<footer class="w3-container w3-theme">
			<p class="w3-center">
				<button id="add_new_people" class="w3-btn w3-theme-l5 w3-hover-theme">إضافة شخص</button>
				<button type="button" class="w3-btn w3-theme-l5 w3-hover-theme new_people_close">الغاء</button>
			</p>
		</footer>
	</div>
</div>

<!-- upd people -->
<div id="upd_people" class="w3-modal">
	<div class="w3-modal-content w3-animate-zoom w3-card-4" style="width:800px">
		<header class="w3-container w3-theme"> 
			<h3><span class="w3-button w3-display-topleft upd_people_close">&times;</span></h3>
			<h3><i class="fa fa-plus"></i> تعديل بيانات ساكن</h3>
		</header>
		<div class="w3-container w3-padding">
			<form id="upd_people_form" method="POST" action="<?php echo URL?>people/upd_people">
				<input type="hidden" class="hid_info" name="csrf" value="<?php echo session::get('csrf'); ?>" />
				<input type="hidden" name="id" id="upd_id" value="" />
				<div class="w3-row w3-row-padding">
					<div class="w3-half w3-right">
						<label class="w3-text-theme "><b>اسم الساكن <i class="w3-red">*</i></b></label>
						<input type="text" name="upd_name" id="upd_name" class="w3-input w3-border w3-margin-bottom" />
						<div class="err_notification " id="valid_upd_name">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
					<div class="w3-half">
						<label class="w3-text-theme w3-left"><b>Name of inhabitant</b></label>
						<input type="text" name="upd_name_en" id="upd_name_en" class="w3-input w3-border w3-margin-bottom" />
						<div class=" err_notification " id="valid_upd_name_en">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
				</div>
				<div class="w3-row w3-row-padding">
					<div class="w3-half w3-right">
						<label class="w3-text-theme "><b>رقم الهاتف <i class="w3-red">*</i></b></label>
						<input type="phone" name="upd_phone" id="upd_phone" class="w3-input w3-border w3-margin-bottom" />
						<div class=" err_notification " id="valid_upd_phone">
							هنالك خطأ في هذا الحقل
						</div>
						<div class="err_notification" id="duplicate_upd_phone">
							<?php echo $this->lang['error_dup']?>
						</div>
					</div>
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>البريد الالكتروني <i class="w3-red">*</i></b></label>
						<input type="email" name="upd_email" id="upd_email" class="w3-input w3-border w3-margin-bottom" />
						<div class=" err_notification " id="valid_upd_email">
							هنالك خطأ في هذا الحقل
						</div>
						<div class="err_notification" id="duplicate_upd_email">
							<?php echo $this->lang['error_dup']?>
						</div>
					</div>
				</div>
				<div class="w3-row w3-row-padding">
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>نوع الهوية</b></label>
						<select name="upd_id_type" id="upd_id_type" class="w3-select ">
							<option class="w3-hover-theme" value="" selected></option>
						<?php
							foreach(kb9::$id_type as $key => $value)
							{
						?>
							<option value="<?php echo $key?>" ><?php echo $value[session::get('lang')]?></option>
						<?php
							}
						?>
						</select>
						<div class=" err_notification " id="valid_upd_id_type">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>رقم الهوية</b></label>
						<input type="text" name="upd_id_no" id="upd_id_no" class="w3-input w3-border w3-margin-bottom" />
						<div class=" err_notification " id="valid_upd_id_no">
							هنالك خطأ في هذا الحقل
						</div>
						<div class="err_notification" id="duplicate_upd_id_no">
							<?php echo $this->lang['error_dup']?>
						</div>
					</div>
				</div>
				<div class="w3-row w3-row-padding">
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>الجنس</b></label>
						<select name="upd_gender" id="upd_gender" class="w3-select ">
							<option class="w3-hover-theme" value="" selected></option>
						<?php
							foreach(kb9::$gender as $key => $value)
							{
						?>
							<option value="<?php echo $key?>" ><?php echo $value[session::get('lang')]?></option>
						<?php
							}
						?>
						</select>
						<div class="err_notification " id="valid_upd_gender">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>تاريخ الميلاد</b></label>
						<input type="text" name="upd_birth" id="upd_birth" class="w3-input w3-border w3-margin-bottom datepicker" />
						<div class=" err_notification " id="valid_upd_birth">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
				</div>
				<div class="w3-row w3-row-padding">
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>الجنسية</b></label>
						<select name="upd_nat" id="upd_nat" class="w3-select ">
							<option class="w3-hover-theme" value="" selected></option>
						<?php
							foreach(kb9::$countries as $key => $value)
							{
								$sel = ($key == "SD")?" selected":"";
						?>
							<option value="<?php echo $key?>" <?php echo $sel;?> ><?php echo $value[session::get('lang')]?></option>
						<?php
							}
						?>
						</select>
						<div class=" err_notification " id="valid_upd_nat">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>الحالة الإجتماعية</b></label>
						<select name="upd_soc" id="upd_soc" class="w3-select ">
							<option class="w3-hover-theme" value="" selected></option>
						<?php
							foreach(kb9::$Social as $key => $value)
							{
						?>
							<option value="<?php echo $key?>" ><?php echo $value[session::get('lang')]?></option>
						<?php
							}
						?>
						</select>
						<div class=" err_notification " id="valid_upd_soc">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
				</div>
				<div class="w3-row w3-row-padding">
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>المستوى الأكاديمي</b></label>
						<select name="upd_aca" id="upd_aca" class="w3-select ">
							<option class="w3-hover-theme" value="" selected></option>
						<?php
							foreach(kb9::$Acadimic as $key => $value)
							{
								$sel = ($key == "SD")?" selected":"";
						?>
							<option value="<?php echo $key?>" <?php echo $sel;?> ><?php echo $value[session::get('lang')]?></option>
						<?php
							}
						?>
						</select>
						<div class="err_notification " id="valid_upd_aca">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>الوظيفة</b></label>
						<input type="text" name="upd_job" id="upd_job" class="w3-input w3-border w3-margin-bottom" />
						<div class=" err_notification " id="valid_upd_job">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
				</div>
			</form>
		</div>
		<footer class="w3-container w3-theme">
			<p class="w3-center">
				<button id="add_upd_people" class="w3-btn w3-theme-l5 w3-hover-theme">تعديل بيانات الشخص</button>
				<button type="button" class="w3-btn w3-theme-l5 w3-hover-theme upd_people_close">الغاء</button>
			</p>
		</footer>
	</div>
</div>
	
<!-- Add new Worker -->
<div id="new_worker" class="w3-modal">
	<div class="w3-modal-content w3-animate-zoom w3-card-4" style="width:800px">
		<header class="w3-container w3-theme"> 
			<h3><span class="w3-button w3-display-topleft new_worker_close">&times;</span></h3>
			<h3><i class="fa fa-plus"></i> إضافة عامل جديد</h3>
		</header>
		<div class="w3-container w3-padding">
			<form id="new_worker_form" method="POST" action="<?php echo URL?>people/new_people">
				<input type="hidden" class="hid_info" name="csrf" value="<?php echo session::get('csrf'); ?>" />
				<input type="hidden" class="hid_info" name="card" value="<?php echo $this->info['house']['h_card']?>" />
				<div class="w3-row w3-row-padding">
					<div class="w3-half w3-right">
						<label class="w3-text-theme "><b>اسم العامل <i class="w3-red">*</i></b></label>
						<input type="text" name="work_name" id="work_name" class="w3-input w3-border w3-margin-bottom" />
						<div class="err_notification " id="valid_work_name">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
					<div class="w3-half">
						<label class="w3-text-theme w3-left"><b>Name of Worker</b></label>
						<input type="text" name="work_name_en" id="work_name_en" class="w3-input w3-border w3-margin-bottom" />
						<div class=" err_notification " id="valid_work_name_en">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
				</div>
				<div class="w3-row w3-row-padding">
					<div class="w3-half w3-right">
						<label class="w3-text-theme "><b>رقم الهاتف</b></label>
						<input type="phone" name="work_phone" id="work_phone" class="w3-input w3-border w3-margin-bottom" />
						<div class=" err_notification " id="valid_work_phone">
							هنالك خطأ في هذا الحقل
						</div>
						<div class="err_notification" id="duplicate_work_phone">
							<?php echo $this->lang['error_dup']?>
						</div>
					</div>
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>الوظيفة</b></label>
						<input type="text" name="work_job" id="work_job" class="w3-input w3-border w3-margin-bottom" />
						<div class=" err_notification " id="valid_work_job">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
				</div>
				<div class="w3-row w3-row-padding">
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>الجنس</b></label>
						<select name="work_gender" class="w3-select ">
							<option class="w3-hover-theme" value="" selected></option>
						<?php
							foreach(kb9::$gender as $key => $value)
							{
						?>
							<option value="<?php echo $key?>" ><?php echo $value[session::get('lang')]?></option>
						<?php
							}
						?>
						</select>
						<div class=" err_notification " id="valid_work_gender">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>الجنسية</b></label>
						<select name="work_nat" class="w3-select ">
							<option class="w3-hover-theme" value="" selected></option>
						<?php
							foreach(kb9::$countries as $key => $value)
							{
								$sel = ($key == "SD")?" selected":"";
						?>
							<option value="<?php echo $key?>" <?php echo $sel;?> ><?php echo $value[session::get('lang')]?></option>
						<?php
							}
						?>
						</select>
						<div class=" err_notification " id="valid_work_nat">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
				</div>
				<div class="w3-row w3-row-padding">
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>الحالة الإجتماعية</b></label>
						<select name="work_soc" class="w3-select ">
							<option class="w3-hover-theme" value="" selected></option>
						<?php
							foreach(kb9::$Social as $key => $value)
							{
						?>
							<option value="<?php echo $key?>" ><?php echo $value[session::get('lang')]?></option>
						<?php
							}
						?>
						</select>
						<div class=" err_notification " id="valid_work_soc">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
				</div>
			</form>
		</div>
		<footer class="w3-container w3-theme">
			<p class="w3-center">
				<button id="add_new_worker" class="w3-btn w3-theme-l5 w3-hover-theme">إضافة شخص</button>
				<button type="button" class="w3-btn w3-theme-l5 w3-hover-theme new_worker_close">الغاء</button>
			</p>
		</footer>
	</div>
</div>
	
<!-- upd Worker -->
<div id="upd_worker" class="w3-modal">
	<div class="w3-modal-content w3-animate-zoom w3-card-4" style="width:800px">
		<header class="w3-container w3-theme"> 
			<h3><span class="w3-button w3-display-topleft upd_worker_close">&times;</span></h3>
			<h3><i class="fa fa-plus"></i> تعديل بيانات عامل</h3>
		</header>
		<div class="w3-container w3-padding">
			<form id="upd_worker_form" method="POST" action="<?php echo URL?>people/new_people">
				<input type="hidden" class="hid_info" name="csrf" value="<?php echo session::get('csrf'); ?>" />
				<input type="hidden" name="id" id="work_id" value="" />
				<div class="w3-row w3-row-padding">
					<div class="w3-half w3-right">
						<label class="w3-text-theme "><b>اسم العامل <i class="w3-red">*</i></b></label>
						<input type="text" name="upd_work_name" id="upd_work_name" class="w3-input w3-border w3-margin-bottom" />
						<div class="err_notification " id="valid_upd_work_name">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
					<div class="w3-half">
						<label class="w3-text-theme w3-left"><b>Name of Worker</b></label>
						<input type="text" name="upd_work_name_en" id="upd_work_name_en" class="w3-input w3-border w3-margin-bottom" />
						<div class=" err_notification " id="valid_upd_work_name_en">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
				</div>
				<div class="w3-row w3-row-padding">
					<div class="w3-half w3-right">
						<label class="w3-text-theme "><b>رقم الهاتف</b></label>
						<input type="phone" name="upd_work_phone" id="upd_work_phone" class="w3-input w3-border w3-margin-bottom" />
						<div class=" err_notification " id="valid_upd_work_phone">
							هنالك خطأ في هذا الحقل
						</div>
						<div class="err_notification" id="duplicate_upd_work_phone">
							<?php echo $this->lang['error_dup']?>
						</div>
					</div>
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>الوظيفة</b></label>
						<input type="text" name="upd_work_job" id="upd_work_job" class="w3-input w3-border w3-margin-bottom" />
						<div class=" err_notification " id="valid_work_job">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
				</div>
				<div class="w3-row w3-row-padding">
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>الجنس</b></label>
						<select name="upd_work_gender" id="upd_work_gender" class="w3-select ">
							<option class="w3-hover-theme" value="" selected></option>
						<?php
							foreach(kb9::$gender as $key => $value)
							{
						?>
							<option value="<?php echo $key?>" ><?php echo $value[session::get('lang')]?></option>
						<?php
							}
						?>
						</select>
						<div class=" err_notification " id="valid_upd_work_gender">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>الجنسية</b></label>
						<select name="upd_work_nat" id="upd_work_nat" class="w3-select ">
							<option class="w3-hover-theme" value="" selected></option>
						<?php
							foreach(kb9::$countries as $key => $value)
							{
								$sel = ($key == "SD")?" selected":"";
						?>
							<option value="<?php echo $key?>" <?php echo $sel;?> ><?php echo $value[session::get('lang')]?></option>
						<?php
							}
						?>
						</select>
						<div class=" err_notification " id="valid_upd_work_nat">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
				</div>
				<div class="w3-row w3-row-padding">
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>الحالة الإجتماعية</b></label>
						<select name="upd_work_soc" id="upd_work_soc" class="w3-select ">
							<option class="w3-hover-theme" value="" selected></option>
						<?php
							foreach(kb9::$Social as $key => $value)
							{
						?>
							<option value="<?php echo $key?>" ><?php echo $value[session::get('lang')]?></option>
						<?php
							}
						?>
						</select>
						<div class=" err_notification " id="valid_upd_work_soc">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
				</div>
			</form>
		</div>
		<footer class="w3-container w3-theme">
			<p class="w3-center">
				<button id="add_upd_worker" class="w3-btn w3-theme-l5 w3-hover-theme">تعديل بيانات العامل</button>
				<button type="button" class="w3-btn w3-theme-l5 w3-hover-theme upd_worker_close">الغاء</button>
			</p>
		</footer>
	</div>
</div>
	

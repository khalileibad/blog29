<div class="w3-container" style="max-width:1400px;margin-top:70px">

	<!-- Header -->
	<header class="w3-row w3-white w3-margin-bottom">
		<button id="new_land_button" class="w3-hover-theme w3-button w3-theme w3-card-2 w3-animate-opacity">
			إضافة أرض <i class="fa fa-plus"></i>
		</button>
		<button id="new_house_button" class="w3-hover-theme w3-button w3-theme w3-card-2 w3-animate-opacity">
			إضافة وحدة سكنية <i class="fa fa-plus"></i>
		</button>
		<a href="<?php echo URL?>people/new_upload" class="w3-button w3-hover-theme w3-button w3-theme w3-card-2 w3-animate-opacity" >
			رفع أشخاص عن طريق الملف <i class="fa fa-upload"></i>
		</a>
		
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
	<div class="w3-row w3-responsive" id="people_list"></div>
	
</div>

<!-- Add new land -->
<div id="new_land" class="w3-modal">
	<div class="w3-modal-content w3-animate-zoom w3-card-4" style="width:800px">
		<header class="w3-container w3-theme"> 
			<h3><span class="w3-button w3-display-topleft new_land_close">&times;</span></h3>
			<h3><i class="fa fa-plus"></i> إضافة أرض جديدة</h3>
		</header>
		<div class="w3-container w3-padding">
			<form id="new_land_form">
				<input type="hidden" class="hid_info" name="csrf" value="<?php echo session::get('csrf'); ?>" />
				<div class="w3-row w3-row-padding">
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>رقم الارض</b></label>
						<input type="number" name="ne_land_no" id="ne_land_no" class="w3-input w3-border w3-margin-bottom" />
						<div class=" err_notification " id="valid_ne_land_no">
							هنالك خطأ في هذا الحقل
						</div>
						<div class="err_notification" id="duplicate_ne_land_no">
							<?php echo $this->lang['error_dup']?>
						</div>
					</div>
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>رقم الارض الفرعي</b></label>
						<input type="number" name="ne_land_sub_no" id="ne_land_sub_no" class="w3-input w3-border w3-margin-bottom" value="0" />
						<div class="err_notification " id="valid_ne_land_sub_no">
							هنالك خطأ في هذا الحقل
						</div>
						<div class="err_notification" id="duplicate_ne_land_sub_no">
							<?php echo $this->lang['error_dup']?>
						</div>
					</div>
				</div>
				<div class="w3-row w3-row-padding">
					<div class="w3-half w3-right">
						<label class="w3-text-theme "><b>اسم مالك الأرض</b></label>
						<input type="text" name="ne_land_owner" id="ne_land_owner" class="w3-input w3-border w3-margin-bottom" />
						<div class=" err_notification " id="valid_ne_land_owner">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
					<div class="w3-half">
						<label class="w3-text-theme w3-left"><b>Land Owner Name</b></label>
						<input type="text" name="ne_land_owner_en" id="ne_land_owner_en" class="w3-input w3-border w3-margin-bottom" />
						<div class=" err_notification " id="valid_ne_land_owner_en">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
				</div>
				<div class="w3-row w3-row-padding">
					<div class="w3-half w3-right">
						<label class="w3-text-theme "><b>رقم الهاتف</b></label>
						<input type="phone" name="ne_land_phone" id="ne_land_phone" class="w3-input w3-border w3-margin-bottom" />
						<div class=" err_notification " id="valid_ne_land_phone">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>البريد الالكتروني</b></label>
						<input type="email" name="ne_land_email" id="ne_land_email" class="w3-input w3-border w3-margin-bottom" />
						<div class=" err_notification " id="valid_ne_land_email">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
				</div>
				<div class="w3-row w3-row-padding">
					<div class="w3-half w3-right">
						<label class="w3-text-theme "><b>نوع الارض</b></label>
						<select name="ne_land_status" class="w3-select ">
							<option class="w3-hover-theme" value="" selected></option>
						<?php
							foreach(kb9::$land_type as $key => $value)
							{
						?>
							<option class="w3-hover-theme" value="<?php echo $key?>" ><?php echo $value[session::get('lang')]?></option>
						<?php
							}
						?>
						</select>
						<div class=" err_notification " id="valid_ne_land_status">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>عدد الوحدات</b></label>
						<input type="number" name="ne_land_units" id="ne_land_units" class="w3-input w3-border w3-margin-bottom" />
						<div class=" err_notification " id="valid_ne_land_units">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
				</div>
				<div class="w3-row w3-row-padding">
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>عدد الطوابق</b></label>
						<input type="number" name="ne_land_floor" id="ne_land_floor" class="w3-input w3-border w3-margin-bottom" />
						<div class=" err_notification " id="valid_ne_land_floor">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
				</div>
			</form>
		</div>
		<footer class="w3-container w3-theme">
			<p class="w3-center">
				<button id="add_new_land" class="w3-btn w3-theme-l5 w3-hover-theme">إضافة ارض</button>
				<button type="button" class="w3-btn w3-theme-l5 w3-hover-theme new_land_close">الغاء</button>
			</p>
		</footer>
	</div>
</div>
	
<!-- Add new house -->
<div id="new_house" class="w3-modal">
	<div class="w3-modal-content w3-animate-zoom w3-card-4" style="width:800px">
		<header class="w3-container w3-theme"> 
			<h3><span class="w3-button w3-display-topleft new_house_close">&times;</span></h3>
			<h3><i class="fa fa-plus"></i> إضافة أرض جديدة</h3>
		</header>
		<div class="w3-container w3-padding">
			<form id="new_house_form">
				<input type="hidden" class="hid_info" name="csrf" value="<?php echo session::get('csrf'); ?>" />
				<div class="w3-row w3-row-padding">
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>رقم الارض <i class="w3-red">*</i></b></label>
						<input type="number" name="ne_house_no" id="ne_house_no" class="w3-input w3-border w3-margin-bottom" />
						<div class="err_notification " id="valid_ne_house_no">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>رقم الارض الفرعي <i class="w3-red">*</i></b></label>
						<input type="number" name="ne_house_sub_no" id="ne_house_sub_no" class="w3-input w3-border w3-margin-bottom" value="0" />
						<div class=" err_notification " id="valid_ne_house_sub_no">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
				</div>
				<div class="w3-row w3-row-padding">
					<div class="w3-half w3-right">
						<label class="w3-text-theme "><b>الطابق</b></label>
						<input type="number" name="ne_house_floor" id="ne_house_floor" class="w3-input w3-border w3-margin-bottom" />
						<div class="err_notification " id="valid_ne_house_floor">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>الحالة السكنية <i class="w3-red">*</i></b></label>
						<select name="ne_house_status" class="w3-select ">
							<option class="w3-hover-theme" value="" selected></option>
						<?php
							foreach(kb9::$house_live_type as $key => $value)
							{
						?>
							<option value="<?php echo $key?>" ><?php echo $value[session::get('lang')]?></option>
						<?php
							}
						?>
						</select>
						<div class="err_notification " id="valid_ne_house_status">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
				</div>
				<div class="w3-row w3-row-padding">
					<div class="w3-half w3-right">
						<label class="w3-text-theme "><b>رقم البطاقة الخدمية <i class="w3-red">*</i></b></label>
						<input type="number" name="ne_house_card" id="ne_house_card" class="w3-input w3-border w3-margin-bottom" />
						<div class="err_notification " id="valid_ne_house_card">
							هنالك خطأ في هذا الحقل
						</div>
						<div class="err_notification" id="duplicate_ne_house_card">
							<?php echo $this->lang['error_dup']?>
						</div>
					</div>
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>وصف الوحدة</b></label>
						<input type="text" name="ne_house_desc" id="ne_house_desc" class="w3-input w3-border w3-margin-bottom" />
						<div class="err_notification " id="valid_ne_house_desc">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
				</div>
				<div class="w3-row w3-row-padding">
					<div class="w3-half w3-right">
						<label class="w3-text-theme "><b>اسم الساكن الاساسي <i class="w3-red">*</i></b></label>
						<input type="text" name="ne_house_name" id="ne_house_name" class="w3-input w3-border w3-margin-bottom" />
						<div class="err_notification " id="valid_ne_house_name">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
					<div class="w3-half">
						<label class="w3-text-theme w3-left"><b>Name of the primary inhabitant</b></label>
						<input type="text" name="ne_house_name_en" id="ne_house_name_en" class="w3-input w3-border w3-margin-bottom" />
						<div class=" err_notification " id="valid_ne_house_name_en">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
				</div>
				<div class="w3-row w3-row-padding">
					<div class="w3-half w3-right">
						<label class="w3-text-theme "><b>رقم الهاتف <i class="w3-red">*</i></b></label>
						<input type="phone" name="ne_house_phone" id="ne_house_phone" class="w3-input w3-border w3-margin-bottom" />
						<div class=" err_notification " id="valid_ne_house_phone">
							هنالك خطأ في هذا الحقل
						</div>
						<div class="err_notification" id="duplicate_ne_house_phone">
							<?php echo $this->lang['error_dup']?>
						</div>
					</div>
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>البريد الالكتروني <i class="w3-red">*</i></b></label>
						<input type="email" name="ne_house_email" id="ne_house_email" class="w3-input w3-border w3-margin-bottom" />
						<div class=" err_notification " id="valid_ne_house_email">
							هنالك خطأ في هذا الحقل
						</div>
						<div class="err_notification" id="duplicate_ne_house_email">
							<?php echo $this->lang['error_dup']?>
						</div>
					</div>
				</div>
				<div class="w3-row w3-row-padding">
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>نوع الهوية</b></label>
						<select name="ne_house_id_type" class="w3-select ">
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
						<div class=" err_notification " id="valid_ne_house_id_type">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>رقم الهوية</b></label>
						<input type="text" name="ne_house_id_no" id="ne_house_id_no" class="w3-input w3-border w3-margin-bottom" />
						<div class=" err_notification " id="valid_ne_house_id_no">
							هنالك خطأ في هذا الحقل
						</div>
						<div class="err_notification" id="duplicate_ne_house_id_no">
							<?php echo $this->lang['error_dup']?>
						</div>
					</div>
				</div>
				<div class="w3-row w3-row-padding">
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>الجنس</b></label>
						<select name="ne_house_gender" class="w3-select ">
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
						<div class=" err_notification " id="valid_ne_house_gender">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>تاريخ الميلاد</b></label>
						<input type="text" name="ne_house_birth" id="ne_house_birth" class="w3-input w3-border w3-margin-bottom datepicker" />
						<div class=" err_notification " id="valid_ne_house_birth">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
				</div>
				<div class="w3-row w3-row-padding">
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>الجنسية</b></label>
						<select name="ne_house_nat" class="w3-select ">
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
						<div class=" err_notification " id="valid_ne_house_nat">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>الحالة الإجتماعية</b></label>
						<select name="ne_house_social" class="w3-select ">
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
						<div class=" err_notification " id="valid_ne_house_social">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
				</div>
				<div class="w3-row w3-row-padding">
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>المستوى الأكاديمي</b></label>
						<select name="ne_house_acadimic" class="w3-select ">
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
						<div class="err_notification " id="valid_ne_house_acadimic">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
					<div class="w3-half w3-right">
						<label class="w3-text-theme"><b>الوظيفة</b></label>
						<input type="text" name="ne_home_job" id="ne_home_job" class="w3-input w3-border w3-margin-bottom" />
						<div class=" err_notification " id="valid_ne_home_job">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
				</div>
			</form>
		</div>
		<footer class="w3-container w3-theme">
			<p class="w3-center">
				<button id="add_new_house" class="w3-btn w3-theme-l5 w3-hover-theme">إضافة ارض</button>
				<button type="button" class="w3-btn w3-theme-l5 w3-hover-theme new_house_close">الغاء</button>
			</p>
		</footer>
	</div>
</div>
	

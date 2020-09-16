<div class="w3-container" style="max-width:1400px;margin-top:70px">

	<!-- Header -->
	<header class="w3-row w3-white w3-margin-bottom">
		<button id="new_Staff_button" class="w3-hover-theme w3-button w3-theme w3-card-2 w3-animate-opacity">
			إضافة موظف جديد <i class="fa fa-plus"></i>
		</button>
	</header>
	<div class="w3-row w3-theme-d1 w3-padding">
		<form id="Staff_search" target="_blank" action="<?php echo URL?>staff/export" method="post">
			<input type="hidden" name="csrf" id="csrf" class="hid_info" value="<?php echo session::get('csrf'); ?>" />
			<div class="w3-twothird w3-right">
				<div class="w3-row-padding">
					<div class="w3-third w3-right" >
						<label>اسم الموظف</label>
						<input name="name" class="w3-input w3-border w3-theme "/>
					</div>
					<div class="w3-row- w3-third w3-right" >
						<label>اسم المستخدم</label>
						<input name="email" class="w3-input w3-border w3-theme"/>
					</div>
					<div class="w3-row w3-third w3-right">
						<label>نوع المستخدم</label>
						<select id="type" name="type" class="w3-select w3-border w3-theme">
							<option value="" selected>الكل</option>
							<?php
								foreach(staff_settings::$staf_asso_type as $key => $val)
								{
									if($key == "admin")
									{
										continue;
									}
									echo "<option value='".$key."'>".$val["AR"]."</option>";
								}
							?>
						</select> 
					</div>
				</div>
			</div>
			<div class="w3-third w3-left w3-padding w3-center">
				<button id="search_Staff" type="button" class="w3-button w3-margin-top w3-light-grey">
					<i class="fa fa-search"></i> تصفية البيانات
				</button>
				<button id="msg_staff_button" type="button" class="w3-button w3-margin-top w3-light-grey">
					<i class="fa fa-send"></i> ارسال رسالة
				</button>
			</div>
		</form>
	</div> 

	<!--Staff List-->	
	<div class="w3-row w3-responsive" id="Staff_list"></div>
	
	<!-- Add new Staff -->
	<div id="new_Staff" class="w3-modal">
		<div class="w3-modal-content w3-animate-zoom w3-card-4" style="width:400px">
			<header class="w3-container w3-theme"> 
				<h3><span class="w3-button w3-display-topleft new_Staff_close">&times;</span></h3>
				<h3><i class="fa fa-plus"></i> إضافة موظف جديد</h3>
			</header>
			<div class="w3-container w3-padding">
				<form class="" id="new_Staff_form">
					<input type="hidden" class="hid_info" name="csrf" value="<?php echo session::get('csrf'); ?>" />
					<div class="w3-row">
						<div>
							<label class="w3-text-theme"><b>اسم الموظف</b></label>
							<input type="text" name="name" id="name" class="w3-input w3-border w3-margin-bottom" />
							<div class="w3-hide err_notification " id="valid_name">
								هنالك خطأ في هذا الحقل
							</div>
						</div>
						<div >
							<label class="w3-text-theme">نوع المستخدم</label>
							<select id="type" name="type" class="w3-select w3-border">
								<option value="" selected>الكل</option>
								<?php
									foreach(staff_settings::$staf_asso_type as $key => $val)
									{
										if($key == "admin")
										{
											continue;
										}
										echo "<option value='".$key."'>".$val["AR"]."</option>";
									}
								?>
							</select> 
						</div>
						<div>
							<label class="w3-text-theme"><b>الهاتف</b></label>
							<input type="phone" name="phone" id="phone" class="w3-input w3-border w3-margin-bottom" />
							<div class="w3-hide err_notification " id="valid_phone">
								هنالك خطأ في هذا الحقل
							</div>
							<div class="w3-hide err_notification " id="duplicate_phone">
								البيانات المدخلة في هذا الحقل مدخلة من قبل
							</div>
						</div>
						<div>
							<label class="w3-text-theme"><b>البريد الإلكتروني</b></label>
							<input type="email" name="email" id="email" class="w3-input w3-border w3-margin-bottom" />
							<div class="w3-hide err_notification " id="valid_email">
								هنالك خطأ في هذا الحقل
							</div>
							<div class="w3-hide err_notification " id="duplicate_email">
								البيانات المدخلة في هذا الحقل مدخلة من قبل
							</div>
						</div>
						<div>
							<label class="w3-text-theme"><b>كلمة المرور</b></label>
							<input name="pass" type="password" class="w3-input w3-border w3-margin-bottom"/>
							<div class="w3-hide err_notification " id="valid_pass">
								هنالك خطأ في هذا الحقل
							</div>
						</div>
					</div>
				</form>
			</div>
			<footer class="w3-container w3-theme">
				<p class="w3-center">
					<button id="add_new_Staff" class="w3-btn w3-theme-l5 w3-hover-theme">إضافة الموظف</button>
					<button type="button" class="w3-btn w3-theme-l5 w3-hover-theme new_Staff_close">الغاء</button>
				</p>
			</footer>
		</div>
	</div>
	
	<!-- Update Staff -->
	<div id="upd_Staff" class="w3-modal">
		<div class="w3-modal-content w3-animate-zoom w3-card-4" style="width:400px">
			<header class="w3-container w3-theme"> 
				<h3><span class="w3-button w3-display-topleft upd_Staff_close">&times;</span></h3>
				<h3><i class="fa fa-pencil"></i> تعديل بيانات الموظف</h3>
			</header>
			<div class="w3-container w3-padding">
				<form class="" id="upd_Staff_form">
					<input type="hidden" class="hid_info" name="csrf" value="<?php echo session::get('csrf'); ?>" />
					<input type="hidden" id="upd_id" name="upd_id" value="" />
					<div class="w3-row">
						<div>
							<label class="w3-text-theme"><b>اسم الموظف</b></label>
							<input name="upd_name" id="upd_name" class="w3-input w3-border w3-margin-bottom" type="text">
							<div class="w3-hide err_notification " id="valid_upd_name">
								هنالك خطأ في هذا الحقل
							</div>
						</div>
						<div >
							<label class="w3-text-theme">نوع المستخدم</label>
							<select id="upd_type" name="upd_type" class="w3-select w3-border">
								<option value="" selected>الكل</option>
								<?php
									foreach(staff_settings::$staf_asso_type as $key => $val)
									{
										if($key == "admin")
										{
											continue;
										}
										echo "<option value='".$key."'>".$val["AR"]."</option>";
									}
								?>
							</select> 
							<div class="w3-hide err_notification " id="valid_upd_type">
								هنالك خطأ في هذا الحقل
							</div>
						</div>
						<div>
							<label class="w3-text-theme"><b>الهاتف</b></label>
							<input type="phone" name="upd_phone" id="upd_phone" class="w3-input w3-border w3-margin-bottom" />
							<div class="w3-hide err_notification " id="valid_upd_phone">
								هنالك خطأ في هذا الحقل
							</div>
							<div class="w3-hide err_notification " id="duplicate_upd_phone">
								البيانات المدخلة في هذا الحقل مدخلة من قبل
							</div>
						</div>
						<div>
							<label class="w3-text-theme"><b>البريد الإلكتروني</b></label>
							<input type="email" name="upd_email" id="upd_email" class="w3-input w3-border w3-margin-bottom" />
							<div class="w3-hide err_notification " id="valid_upd_email">
								هنالك خطأ في هذا الحقل
							</div>
							<div class="w3-hide err_notification " id="duplicate_upd_email">
								البيانات المدخلة في هذا الحقل مدخلة من قبل
							</div>
						</div>
						<div>
							<label class="w3-text-theme"><b>كلمة المرور</b></label>
							<label class="w3-text-theme">اترك الحقل فارغا اذا كنت لا تريد تعديل كلمة المرور</label>
							<input name="upd_pass" type="password" class="w3-input w3-border "/>
							<div class="w3-hide err_notification " id="valid_upd_pass">
								هنالك خطأ في هذا الحقل
							</div>
						</div>
						<!--div>
							<label>القسم</label>
							<select id="upd_dep" name="upd_dep" class="w3-select w3-border">
								<option value="" selected>الكل</option>
							<?php
								foreach($this->dep_list as $key => $val)
								{
									echo "<option value='".$val['dep_id']."'>".$val['dep_name']."</option>";
								}
							?>
							</select> 
							<div class="w3-hide err_notification " id="valid_upd_dep">
								هنالك خطأ في هذا الحقل
							</div>
						</div-->
					</div>
				</form>
			</div>
			<footer class="w3-container w3-theme">
				<p Class="w3-center">
					<button id="add_upd_Staff" class="w3-btn w3-theme-l5 w3-hover-theme">تعديل بيانات الموظف</button>
					<!--button id="add_del_Staff" class="w3-btn w3-theme-l5 w3-hover-theme">حذف بيانات الموظف</button-->
					<button type="button" class="w3-btn w3-theme-l5 w3-hover-theme upd_Staff_close">الغاء</button>
				</p>
			</footer>
		</div>
	</div>
	
	
</div>

<!-- MSG staff -->
<div id="msg_staff" class="w3-modal">
	<div class="w3-modal-content w3-animate-zoom w3-card-4" style="width:800px">
		<header class="w3-container w3-theme"> 
			<h3><span class="w3-button w3-display-topleft msg_staff_close">&times;</span></h3>
			<h3><i class="fa fa-send"></i> ارسال رسالة</h3>
		</header>
		<div class="w3-container w3-padding">
			<form class="" id="msg_staff_form">
				<input type="hidden" class="hid_info" name="csrf" value="<?php echo session::get('csrf'); ?>" />
				<input type="hidden" name="id" id="staff_id" value="" />
				<div class="w3-row">
					<div>
						<label class="w3-text-theme"><b>الرسالة</b></label>
						<textarea type="text" name="msg_comm" id="msg_comm" class="w3-input w3-border w3-margin-bottom"></textarea>
						<div class="w3-hide err_notification " id="valid_msg_comm" >
							هنالك خطأ في هذا الحقل
						</div>
					</div>
				</div>
				<div class="w3-row">
					<div class="w3-half">
						<div>
							<input type="checkbox" name="sms_msg" id="sms_msg" class="w3-check" value="1" />
							<label class="w3-text-theme"><b>ارسال الرسالة بواسطة الرسائل النصية</b></label>
						</div>
					</div>
					<div class="w3-half">
						<div>
							<input type="checkbox" name="email_msg" id="email_msg" class="w3-check" value="1" checked />
							<label class="w3-text-theme"><b>ارسال الرسالة بواسطة البريد الإلكتروني</b></label>
						</div>
					</div>
				</div>
			</form>
		</div>
		<footer class="w3-container w3-theme">
			<p class="w3-center">
				<button id="add_move_trns" class="w3-btn w3-theme-l5 w3-hover-theme">ارسال <i class="fa fa-send"></i> </button>
				<button type="button" class="w3-btn w3-theme-l5 w3-hover-theme msg_staff_close">الغاء</button>
			</p>
		</footer>
	</div>
</div>

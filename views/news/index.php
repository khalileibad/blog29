<div class="w3-container" style="max-width:1400px;margin-top:70px">

	<!-- Header -->
	<header class="w3-row w3-white w3-margin-bottom">
		<button id="new_news_button" class="w3-hover-theme w3-button w3-theme w3-card-2 w3-animate-opacity">
			إضافة خبر جديد <i class="fa fa-plus"></i>
		</button>
		
	</header>
	
	<div class="w3-row w3-theme w3-padding">
		<form id="news_search">
			<input type="hidden" name="csrf" id="csrf" class="hid_info" value="<?php echo session::get('csrf'); ?>" />
			<div class="w3-threequarter w3-right w3-row-padding">
				<div class="w3-third w3-right">
					<label>رقم الخبر</label>
					<input name="no" class="w3-input "/>
				</div>
				<div class="w3-third w3-right">
					<label>تاريخ الخبر</label>
					<input name="date" class="w3-input datepicker"/>
				</div>
				<div class="w3-quarter w3-right">		
					<label>حالة الخبر</label>
					<select name="status" class="w3-select ">
						<option class="w3-hover-theme" value="" selected></option>
						<option class="w3-hover-theme" value="1">نشط</option>
						<option class="w3-hover-theme" value="0">غير نشط</option>
					</select>
				</div>
			</div>
			<div class="w3-quarter w3-left w3-center w3-padding-16">
				<button id="search_news" type="button" class="w3-button w3-margin-top w3-light-grey">
					بحث <i class="fa fa-search"></i>
				</button>
			</div>
		</form>
	</div> 
	
	<!--News List-->	
	<div class="w3-row w3-responsive" id="news_list"></div>
	
	<!-- Add new News -->
	<div id="new_news" class="w3-modal">
		<div class="w3-modal-content w3-animate-zoom w3-card-4" style="width:800px">
			<header class="w3-container w3-theme"> 
				<h3><span class="w3-button w3-display-topleft new_news_close">&times;</span></h3>
				<h3><i class="fa fa-plus"></i> إضافة خبر جديد</h3>
			</header>
			<div class="w3-container w3-padding">
				<form id="new_news_form" method="post" action="<?php echo URL?>news/new_news" enctype="multipart/form-data" class="image_form" data-msg="active_ok">
					<input type="hidden" class="hid_info" name="csrf" value="<?php echo session::get('csrf'); ?>" />
					<div class="w3-row w3-row-padding">
						<div class="w3-half w3-right">
							<label class="w3-text-theme"><b>اسم الخبر</b></label>
							<input type="text" name="name" id="name" class="w3-input w3-border w3-margin-bottom" />
							<div class="w3-hide err_notification " id="valid_name">
								هنالك خطأ في هذا الحقل
							</div>
						</div>
						<div class="w3-half w3-left">
							<label class="w3-text-theme w3-left"><b>News Name</b></label>
							<input type="text" name="name_en" id="name_en" class="w3-input w3-border w3-margin-bottom" />
							<div class="w3-hide err_notification " id="valid_name_en">
								هنالك خطأ في هذا الحقل
							</div>
						</div>
					</div>
					<div class="w3-row w3-row-padding">
						<div class="w3-half w3-right">
							<label class="w3-text-theme "><b>عنوان الخبر</b></label>
							<input type="text" name="title" id="title" class="w3-input w3-border w3-margin-bottom" />
							<div class="w3-hide err_notification " id="valid_title">
								هنالك خطأ في هذا الحقل
							</div>
						</div>
						<div class="w3-half">
							<label class="w3-text-theme w3-left"><b>News Title</b></label>
							<input type="text" name="title_en" id="title_en" class="w3-input w3-border w3-margin-bottom" />
							<div class="w3-hide err_notification " id="valid_title_en">
								هنالك خطأ في هذا الحقل
							</div>
						</div>
					</div>
					<div class="w3-row w3-row-padding">
						<img id="profile_img" class="profile-pic form_images" src="" alt="">
						<div class="p-image">
							<input class="file-upload image_upload" type="file" accept="image/*" id="user_img" name="user_img" data-id="profile_img"/> 
						</div>
					</div>
					<div class="w3-row w3-row-padding">
						<label class="w3-text-theme w3-right"><b>تفاصيل الخبر</b></label>
						<textarea name="details" id="details" class="w3-input w3-border w3-margin-bottom"></textarea>
						<div class="w3-hide err_notification " id="valid_details">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
					<div class="w3-row w3-row-padding">
						<label class="w3-text-theme w3-left"><b>News details</b></label>
						<textarea name="details_en" id="details_en" class="w3-input w3-border w3-margin-bottom"></textarea>
						<div class="w3-hide err_notification " id="valid_details_en">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
				</form>
			</div>
			<footer class="w3-container w3-theme">
				<p class="w3-center">
					<button id="add_new_news" class="w3-btn w3-theme-l5 w3-hover-theme">إضافة خبر</button>
					<button type="button" class="w3-btn w3-theme-l5 w3-hover-theme new_news_close">الغاء</button>
				</p>
			</footer>
		</div>
	</div>
	
	<!-- Update News -->
	<div id="upd_news" class="w3-modal">
		<div class="w3-modal-content w3-animate-zoom w3-card-4" style="width:800px">
			<header class="w3-container w3-theme"> 
				<h3><span class="w3-button w3-display-topleft upd_class_close">&times;</span></h3>
				<h3><i class="fa fa-pencil"></i> تعديل بيانات الخبر</h3>
			</header>
			<div class="w3-container w3-padding">
				<form id="upd_news_form" method="post" action="<?php echo URL?>news/upd_news" enctype="multipart/form-data" class="image_form" data-msg="active_ok">
					<input type="hidden" class="hid_info" name="csrf" value="<?php echo session::get('csrf'); ?>" />
					<input type="hidden" name="upd_id" id="upd_id" value="" />
					<div class="w3-row w3-row-padding">
						<div class="w3-half w3-right">
							<label class="w3-text-theme"><b>اسم الخبر</b></label>
							<input type="text" name="upd_name" id="upd_name" class="w3-input w3-border w3-margin-bottom" />
							<div class="w3-hide err_notification " id="valid_upd_name">
								هنالك خطأ في هذا الحقل
							</div>
						</div>
						<div class="w3-half w3-left">
							<label class="w3-text-theme w3-left"><b>News Name</b></label>
							<input type="text" name="upd_name_en" id="upd_name_en" class="w3-input w3-border w3-margin-bottom" />
							<div class="w3-hide err_notification " id="valid_upd_name_en">
								هنالك خطأ في هذا الحقل
							</div>
						</div>
					</div>
					<div class="w3-row w3-row-padding">
						<div class="w3-half w3-right">
							<label class="w3-text-theme "><b>عنوان الخبر</b></label>
							<input type="text" name="upd_title" id="upd_title" class="w3-input w3-border w3-margin-bottom" />
							<div class="w3-hide err_notification " id="valid_upd_title">
								هنالك خطأ في هذا الحقل
							</div>
						</div>
						<div class="w3-half">
							<label class="w3-text-theme w3-left"><b>News Title</b></label>
							<input type="text" name="upd_title_en" id="upd_title_en" class="w3-input w3-border w3-margin-bottom" />
							<input type="hidden" name="old_img[]" id="old_img" value="" />
							<div class="w3-hide err_notification " id="valid_upd_title_en">
								هنالك خطأ في هذا الحقل
							</div>
						</div>
					</div>
					<div class="w3-row w3-row-padding">
						<img id="upd_profile_img" class="profile-pic form_images" src="" alt="">
						<div class="p-image">
							<input class="file-upload image_upload" type="file" accept="image/*" id="upd_news_img" name="upd_news_img" data-id="upd_profile_img"/> 
						</div>
					</div>
					<div class="w3-row w3-row-padding">
						<label class="w3-text-theme w3-right"><b>تفاصيل الخبر</b></label>
						<textarea name="upd_details" id="upd_details" class="w3-input w3-border w3-margin-bottom"></textarea>
						<div class="w3-hide err_notification " id="valid_upd_details">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
					<div class="w3-row w3-row-padding">
						<label class="w3-text-theme w3-left"><b>News details</b></label>
						<textarea name="upd_details_en" id="upd_details_en" class="w3-input w3-border w3-margin-bottom"></textarea>
						<div class="w3-hide err_notification " id="valid_upd_details_en">
							هنالك خطأ في هذا الحقل
						</div>
					</div>
				</form>
			</div>
			<footer class="w3-container w3-theme">
				<p Class="w3-center">
					<button id="add_upd_news" class="w3-btn w3-theme-l5 w3-hover-theme">تعديل بيانات الخبر</button>
					<button type="button" class="w3-btn w3-theme-l5 w3-hover-theme upd_class_close">الغاء</button>
				</p>
			</footer>
		</div>
	</div>
</div>
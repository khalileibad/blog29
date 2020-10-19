<main id="main">
	<!-- ======= profile Section ======= 
	
	
	-->
	<section id="testimonials" class="testimonials">
		<div class="container">
			<nav>
				<div class="nav nav-tabs" id="nav-tab" role="tablist">
					<a class="nav-item nav-link active" id="nav-blog-view" data-toggle="tab" href="#nav-blog" role="tab" aria-controls="nav-blog" aria-selected="false">التدوينات</a>
					<a class="nav-item nav-link" id="nav-edit-profile" data-toggle="tab" href="#nav-edit" role="tab" aria-controls="nav-edit" aria-selected="false">تعديل البيانات الشخصية</a>
				</div>
			</nav>
			
			<div class="tab-content" id="nav-tabContent">
				
				<!-- =============== MY Blog ============== -->
				<div class="tab-pane fade show active" id="nav-blog" role="tabpanel" aria-labelledby="nav-blog-view">
					<section id="blog_data" class="blog border">
						
					</section><!-- End Blog Section -->
				</div>
				<!-- =============== End MY Blog ============== -->	
				
				<!-- ======= profile edit Section ======= -->
				<div class="tab-pane fade active" id="nav-edit" role="tabpanel" aria-labelledby="nav-edit-profile">
					<section id="contact" class="contact border">
						<div class="container">
							<div class="row">
								<div class="col-lg-12">
									<form id="profile_form" action="<?php echo URL?>accept/profile" method="post" role="form" enctype="multipart/form-data" class="php-form">
										<input type="hidden" name="csrf" id="csrf" class="hid_info" value="<?php echo session::get('csrf'); ?>" />
										<div class="form-row">
											<div class="col-md-3 form-group">
												<div class="text-center">
													<img id="profile_img" src="<?php echo URL."public/IMG/users/".$this->info['user_img'] ?>" width="120px" height="120px" class="rounded profile-pic form_images" alt="...">
												</div>
											</div>
											<div class="col-md-9 form-group">
												<label for="img">لتغير صورة البروفايل</label>
												<input type="file" name="user_img" class="file-upload image_upload form-control-file" data-id="profile_img" id="img" accept="image/*">
												<div class="err_notification" id="valid_user_img">هنالك خطأ في هذا الحقل</div>
											</div>
										</div>
										<div class="form-row">
											<div class="col-md-4 form-group">
												<label for="name">الاسم</label>
												<input type="text" name="name" class="form-control" id="name" value="<?php echo $this->info['name']?>" />
												<div class="err_notification" id="valid_name">هنالك خطأ في هذا الحقل</div>
											</div>
											<div class="col-md-4 form-group">
												<label for="email">البريد الإلكترونى/ اسم المستخدم</label>
												<input type="email" class="form-control" name="email" id="email" value="<?php echo $this->info['email']?>" data-rule="email" data-msg="من فضلك ادخل بريد الإلكترونى صحيح" />
												<div class="err_notification" id="valid_email">هنالك خطأ في هذا الحقل</div>
											</div>
											<div class="col-md-4 form-group">
												<label for="phone">رقم الهاتف</label>
												<input type="phone" class="form-control" name="phone" id="phone" value="<?php echo $this->info['phone']?>" data-rule="email" data-msg="من فضلك ادخل بريد الإلكترونى صحيح" />
												<div class="err_notification" id="valid_phone">هنالك خطأ في هذا الحقل</div>
											</div>
										</div>
										<div class="form-row">
											<div class="col-md-12 form-group">
												<label for="description">نبذة مختصرة</label>
												<textarea class="form-control" name="description" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="اكتب رسالتك هنا ..."><?php echo $this->info['about']?></textarea>
												<div class="err_notification" id="valid_description">هنالك خطأ في هذا الحقل</div>
											</div>
										</div>
										<div class="form-row">
											<div class="col-md-12 form-group">
												<label for="address">العنوان</label>
												<textarea class="form-control" name="address" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="اكتب رسالتك هنا ..."><?php echo $this->info['address']?></textarea>
												<div class="err_notification" id="valid_address">هنالك خطأ في هذا الحقل</div>
											</div>
										</div>
										<div class="form-row">
											<div class="col-md-3 form-group">
												<label for="facebook">رابط صفحة فيسبوك</label>
												<input type="url" name="facebook" class="form-control" id="facebook" value="<?php echo $this->info['user_face']?>" />
												<div class="err_notification" id="valid_facebook">هنالك خطأ في هذا الحقل</div>
											</div>
											<div class="col-md-3 form-group">
												<label for="twitter">رابط صفحة تويتر</label>
												<input type="url" class="form-control" name="twitter" id="twitter" value="<?php echo $this->info['user_twitter']?>" />
												<div class="err_notification" id="valid_twitter">هنالك خطأ في هذا الحقل</div>
											</div>
											<div class="col-md-3 form-group">
												<label for="linkedin">رابط صفحة لينكيدان</label>
												<input type="url" class="form-control" name="linkedin" id="linkedin" value="<?php echo $this->info['user_linked']?>" />
												<div class="err_notification" id="valid_linkedin">هنالك خطأ في هذا الحقل</div>
											</div>
											<div class="col-md-3 form-group">
												<label for="instagram">رابط صفحة انستقرام</label>
												<input type="url" class="form-control" name="instagram" id="instagram" value="<?php echo $this->info['user_instegram']?>" />
												<div class="err_notification" id="valid_instagram">هنالك خطأ في هذا الحقل</div>
											</div>
										</div>
										<div class="form-row">
											<div class="col-md-4 form-group">
												<label for="pwd">كلمة المرور السابقة</label>
												<input type="password" class="form-control" name="old_pwd" id="old_pwd" placeholder="كلمة المرور السابقة" data-rule="minlen:4" data-msg="ادخل كلمة المرور" />
												<div class="err_notification" id="valid_old_pwd">هنالك خطأ في هذا الحقل</div>
											</div>
											<div class="col-md-4 form-group">
												<label for="pwd">كلمة المرور - اترك الحقل فارغ اذا لم تكن تريد تعديل كلمة المرور</label>
												<input type="password" class="form-control" name="pwd" id="pwd" placeholder="كلمة المرور الجديدة" data-rule="minlen:4" data-msg="ادخل كلمة المرور" />
												<div class="err_notification" id="valid_pwd">هنالك خطأ في هذا الحقل</div>
											</div>
											<div class="col-md-4 form-group">
												<label for="pwd2">تاكيد كلمة لمرور</label>
												<input type="password" class="form-control" name="pwd2" id="pwd2" placeholder="تاكيد كلمة المرور" data-rule="minlen:4" data-msg="ادخل كلمة المرور" />
												<div class="err_notification" id="valid_pwd2">هنالك خطأ في هذا الحقل</div>
											</div>
										</div>
							
										<div class="mb-3">
											<div class="loading">تحميل</div>
											<div class="error-message"></div>
											<div class="sent-message">تم التعديل بنجاح</div>
										</div>
										<div class="text-center"><button type="submit">تحديث</button></div>
									</form>
								</div>
							</div>
						</div>
					</section><!-- End profile edit Section -->
				</div>
			</div>
		</div>
	</section><!-- End profile Section -->
</main><!-- End #main -->

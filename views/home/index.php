<main id="main">
	<!-- ======= profile Section ======= 
	
	
	-->
	<section id="testimonials" class="testimonials">
		<div class="container">
			<div class="row">
				<div class="testimonial-item">
					<img src="<?php echo URL."public/IMG/users/".$this->info['user_img'] ?>" class="img-fluid testimonial-img" alt="">
					<h3><?php echo $this->info['name']?></h3>
					<h4>كاتب ومحرر</h4>
					<p><?php echo $this->info['about']?></p>
				<?php
					echo (!empty($this->info['user_twitter']))?'<a href="'.$this->info['user_twitter'].'" target="_blank"><i class="icofont-twitter"></i></a>':"";
					echo (!empty($this->info['user_face']))?'<a href="'.$this->info['user_face'].'" target="_blank"><i class="icofont-facebook"></i></a>':"";
					echo (!empty($this->info['user_instegram']))?'<a href="'.$this->info['user_instegram'].'" target="_blank"><i class="icofont-instagram"></i></a>':"";
					echo (!empty($this->info['user_linked']))?'<a href="'.$this->info['user_linked'].'" target="_blank"><i class="icofont-linkedin"></i></a>':"";
				?>
				</div>
			</div>
			<br/>
			<nav>
				<div class="nav nav-tabs" id="nav-tab" role="tablist">
					<a class="nav-item nav-link" id="nav-add-blog" data-toggle="tab" href="#nav-add" role="tab" aria-controls="nav-add" aria-selected="true">إضافة تدوينة جديدة</a>
					<a class="nav-item nav-link" id="nav-blog-view" data-toggle="tab" href="#nav-blog" role="tab" aria-controls="nav-blog" aria-selected="false">التدوينات</a>
					<a class="nav-item nav-link active" id="nav-edit-profile" data-toggle="tab" href="#nav-edit" role="tab" aria-controls="nav-edit" aria-selected="false">تعديل البيانات الشخصية</a>
				</div>
			</nav>
			
			<div class="tab-content" id="nav-tabContent">
				<!-- =============== New Blog ============== -->
				<div class="tab-pane fade show" id="nav-add" role="tabpanel" aria-labelledby="nav-add-blog">
					<section id="contact" class="contact border">
						<div class="container">
							<div class="row">
								<div class="col-lg-8">
									<form action="#" method="post" role="form" class="php-form">
										<div class="form-row">
											<div class="col-md-6 form-group">
												<div class="text-center">
													<img src="assets/img/logo.png" width="200px" height="120px" class="rounded" alt="...">
												</div>
											</div>
											<div class="col-md-6 form-group">
												<label for="img">اختار صورة للتدوينة</label>
												<input type="file" class="form-control-file" id="img">
											</div>
										</div>
										<div class="form-row">
											<div class="col-md-12 form-group">
												<label for="name">عنوان التدوينة</label>
												<input type="text" name="name" class="form-control" id="name" placeholder="عنوان التدوينة" data-rule="minlen:4" data-msg="من فضلك ادخل عنوان لا يقل عن 5 احرف" />
												<div class="validate"></div>
											</div>
										</div>
										<div class="form-row">
											<div class="col-md-12 form-group">
												<label for="content">المحتوى</label>
												<textarea class="form-control summernote" name="message" rows="15" data-rule="required" data-msg="من فضلك اكتب المحتوى" placeholder="اكتب رسالتك هنا ..."></textarea>
												<div class="validate"></div>
											</div>
										</div>
										<div class="form-row">
											<div class="col-md-12 form-group">
												<label for="descriptison">وصف مختصر</label>
												<textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="من اكت الوصف المختصر للتدوينة" placeholder="اكتب رسالتك هنا ..."></textarea>
												<div class="validate"></div>
											</div>
										</div>
										<div class="form-row">
											<div class="col-md-12 form-group">
												<label for="email">التصنيفات</label>
												<select class="form-control" id="cat" data-rule="email" data-msg="من فضل اختر تصنيف">
													<option>بدون</option>
													<option>شعراً</option>
													<option>نثراً</option>
													<option>الانسان</option>
													<option>تصنيف 1</option>
													<option>2صنيف 1</option>
												</select>
												<div class="validate"></div>
											</div>
										</div>
										<div class="form-row">
											<div class="col-md-12 form-group">
												<label for="tag">الوسم</label>
												<input type="text" class="form-control" name="tag" id="tag" placeholder="اكتب الوسم" data-rule="minlen:4" data-msg="من فضلك ادخل الوسم" />
												<div class="validate"></div>
											</div>
										</div>
							
										<div class="mb-3">
											<div class="loading">تحميل</div>
											<div class="error-message"></div>
											<div class="sent-message">تمت اضافة التدوينة .. التدوينة قيد المراجعة</div>
										</div>
										<div class="text-center"><button type="submit">إضافة التدوينة</button></div>
									</form>
								</div>
							</div>
						</div>
					</section>
				</div>
				<!-- ================== End New Blog ================== -->
				
				<!-- =============== MY Blog ============== -->
				<div class="tab-pane fade" id="nav-blog" role="tabpanel" aria-labelledby="nav-blog-view">
					<section id="blog_data" class="blog border">
						
					</section><!-- End Blog Section -->
				</div>
				<!-- =============== End MY Blog ============== -->	
				
				<!-- ======= profile edit Section ======= -->
				<div class="tab-pane fade active" id="nav-edit" role="tabpanel" aria-labelledby="nav-edit-profile">
					<!-- ======= profile edit Section ======= -->
					<section id="contact" class="contact border">
						<div class="container">
							<div class="row">
								<div class="col-lg-12">
									<form action="<?php echo URL?>home/profile" method="post" role="form" enctype="multipart/form-data" class="image_form php-form">
										<div class="form-row">
											<div class="col-md-3 form-group">
												<div class="text-center">
													<img id="profile_img" src="<?php echo URL."public/IMG/users/".$this->info['user_img'] ?>" width="120px" height="120px" class="rounded profile-pic form_images" alt="...">
												</div>
											</div>
											<div class="col-md-9 form-group">
												<label for="img">لتغير صورة البروفايل</label>
												<input type="file" name="user_img" class="file-upload image_upload form-control-file" data-id="profile_img" id="img" accept="image/*">
											</div>
										</div>
										<div class="form-row">
											<div class="col-md-4 form-group">
												<label for="name">الاسم</label>
												<input type="text" name="name" class="form-control" id="name" value="<?php echo $this->info['name']?>" />
												<div class="validate"></div>
											</div>
											<div class="col-md-4 form-group">
												<label for="email">البريد الإلكترونى</label>
												<input type="email" class="form-control" name="email" id="email" value="<?php echo $this->info['email']?>" data-rule="email" data-msg="من فضلك ادخل بريد الإلكترونى صحيح" />
												<div class="validate"></div>
											</div>
											<div class="col-md-4 form-group">
												<label for="phone">رقم الهاتف</label>
												<input type="phone" class="form-control" name="phone" id="phone" value="<?php echo $this->info['phone']?>" data-rule="email" data-msg="من فضلك ادخل بريد الإلكترونى صحيح" />
												<div class="validate"></div>
											</div>
										</div>
										<div class="form-row">
											<div class="col-md-12 form-group">
												<label for="details">نبذة مختصرة</label>
												<textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="اكتب رسالتك هنا ..."><?php echo $this->info['about']?></textarea>
												<div class="validate"></div>
											</div>
										</div>
										<div class="form-row">
											<div class="col-md-12 form-group">
												<label for="details">العنوان</label>
												<textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="اكتب رسالتك هنا ..."><?php echo $this->info['address']?></textarea>
												<div class="validate"></div>
											</div>
										</div>
										<div class="form-row">
											<div class="col-md-4 form-group">
												<label for="pwd">كلمة المرور</label>
												<input type="password" class="form-control" name="pwd" id="pwd" placeholder="كلمة المرور" data-rule="minlen:4" data-msg="ادخل كلمة المرور" />
												<div class="validate"></div>
											</div>
											<div class="col-md-4 form-group">
												<label for="pwdg">تاكيد كلمة لمرور</label>
												<input type="password" class="form-control" name="pwd" id="pwd" placeholder="تاكيد كلمة المرور" data-rule="minlen:4" data-msg="ادخل كلمة المرور" />
												<div class="validate"></div>
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

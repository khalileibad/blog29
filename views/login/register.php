<main id="main">
	<!-- ======= Breadcrumbs ======= -->
	<section id="breadcrumbs" class="breadcrumbs">
		<div class="container">
			<div class="d-flex justify-content-between align-items-center">
				<h2>صفحة التسجيل</h2>
				<ol>
					<li><a href="<?php echo URL?>">الرئيسية</a></li>
					<li>التسجيل</li>
				</ol>
			</div>
		</div>
	</section><!-- End Breadcrumbs -->

	<!-- ======= registeration Section ======= -->
	<section id="contact" class="contact">
		<div class="container">
			<h2 class="text-center">التسجيل</h2>
			<div class="row mt-5 d-flex justify-content-center">
				<div class="col-lg-4 mt-5 mt-lg-0">
					<form id="reg_form" method="post" role="form" class="php-email-form">
						<input type="hidden" class="hid_info" name="csrf" id="csrf" value="0" />
						<div class="form-row">
							<input type="text" name="name" class="form-control" id="name" placeholder="الاسم" data-rule="minlen:4" data-msg="من فضلك ادخل 4 خروق على الاقل" />
							<div class="err_notification" id="valid_name">
								هنالك خطأ في هذا الحقل
							</div>
						</div><br/>
						<div class="form-row">
							<input type="phone" name="phone" class="form-control" id="phone" placeholder="رقم الهاتف" data-rule="minlen:4" data-msg="ادخل رقم الهاتف" />
							<div class="err_notification" id="valid_phone">
								هنالك خطأ في هذا الحقل
							</div>
							<div class="err_notification" id="duplicate_phone">
								البيانات في هذا الحقل مكررة
							</div>
						</div><br/>
						<div class="form-row">
							<input type="date" name="birth" class="form-control" id="birth" placeholder="تاريخ الميلاد" data-rule="minlen:4" data-msg="ادخل تاريخ الميلاد" />
							<div class="err_notification" id="valid_birth">
								هنالك خطأ في هذا الحقل
							</div>
						</div><br/>
						<div class="form-row">							
							<input type="email" class="form-control" name="email" id="email" placeholder="البريد الإلكترونى" data-rule="email" data-msg="من فضلك ادخل بريد الإلكترونى صحيح" />
							<div class="err_notification" id="valid_email">
								هنالك خطأ في هذا الحقل
							</div>
							<div class="err_notification" id="duplicate_email">
								البيانات في هذا الحقل مكررة
							</div>
						</div><br/>
						<div class="form-row">
							<input type="password" class="form-control" name="pwd" id="pwd" placeholder="كلمة المرور" data-rule="minlen:4" data-msg="ادخل كلمة المرور" />
							<div class="err_notification" id="valid_pwd">
								هنالك خطأ في هذا الحقل
							</div>
						</div><br/>
						<div class="form-row">
							<input type="password" class="form-control" name="pwd2" id="pwd2" placeholder="تأكبد كلمة المرور" data-rule="minlen:4" data-msg="ادخل كلمة المرور" />
							<div class="err_notification" id="valid_pwd2">
								هنالك خطأ في هذا الحقل
							</div>
						</div>
						<div class="form-row">
							<input type="checkbox" class="custom-form-control" id="customCheck1" name="accept" value="1" />
							<label class="custom-control-label" for="customCheck1">اقبل <a target="_blank" href="<?php echo URL?>dashboard/terms"> الاحكام والشروط</a></label>
							<br/>
							<div class="err_notification" id="valid_accept">
								الرجاء قبول الأحكام والشروط
							</div>
						</div>
						<div class="text-center"><button type="submit">تسجيل</button></div>
					</form>
				</div>
			</div>
		</div>
	</section><!-- End Contact Section -->
</main><!-- End #main -->
<div id="error_reg_msg" class="d-none"><?php echo (!empty($this->MSG))?$this->MSG:"";?></div>
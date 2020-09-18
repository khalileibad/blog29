<main id="main">
	<!-- ======= Breadcrumbs ======= -->
	<section id="breadcrumbs" class="breadcrumbs">
		<div class="container">
			<div class="d-flex justify-content-between align-items-center">
				<h2>تسجيل دخول</h2>
				<ol>
					<li><a href="<?php echo URL?>">الرئيسية</a></li>
					<li>تسجيل دخول</li>
				</ol>
			</div>
		</div>
	</section><!-- End Breadcrumbs -->

	<!-- ======= Contact Section ======= -->
	<section id="contact" class="contact">
		<div class="container">
			<h2 class="text-center">تسجيل دخول</h2>
			<div class="row mt-5 d-flex justify-content-center">
				<div class="col-lg-4 mt-5 mt-lg-0">
					<form action="<?php echo URL?>login/login" method="post" role="form" class="php-form">
						<input type="hidden" class="hid_info" name="csrf" id="csrf" value="0" />
						<div class="form-row">							
							<input type="email" class="form-control" name="usrname" id="email" placeholder="البريد الإلكترونى" data-rule="email" data-msg="من فضلك ادخل بريد الإلكترونى صحيح" />
							<div class="validate"></div>
						</div><br/>
						<div class="form-row">
							<input type="password" class="form-control" name="psw" id="pwd" placeholder="كلمة المرور" data-rule="minlen:4" data-msg="ادخل كلمة المرور" />
							<div class="validate"></div>
						</div>
							
						<div class="mb-3">
							<div class="loading">تحميل</div>
							<div class="error-message"></div>
						</div>
						<div class="text-center"><button type="submit">تسجيل دخول</button></div>
					</form>
				</div>
			</div>
		</div>
	</section><!-- End Contact Section -->
</main><!-- End #main -->


<!-- Model For Errors -->
<div id="error_msg" class="d-none"><?php echo (!empty($this->MSG))?$this->MSG:"";?></div>
<div id="err_INPUT_ERROR" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<p>إسم المستخدم و/ أو كلمة المرور خطأ</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
			</div>
		</div>
	</div>
</div>

<!-- Model For Errors -->
<div id="err_UNACTIVE" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<p>لقد تم إيقاف حسابك</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
			</div>
		</div>
	</div>
</div>
  	
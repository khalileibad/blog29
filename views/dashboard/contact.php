<main id="main">
	<!-- ======= Breadcrumbs ======= -->
	<section id="breadcrumbs" class="breadcrumbs">
		<div class="container">
			<div class="d-flex justify-content-between align-items-center">
				<h2>اتصل بنا</h2>
				<ol>
					<li><a href="index.html">الرئيسية</a></li>
					<li>اتصل بنا</li>
				</ol>
			</div>
		</div>
	</section><!-- End Breadcrumbs -->

	<!-- ======= Contact Section ======= -->
	<section id="contact" class="contact">
		<div class="container">
			<div class="row mt-5">
				<div class="col-lg-4">
					<div class="info">
						<div class="email">
							<i class="icofont-envelope"></i>
							<h4>البريد الإلكترونى:</h4>
							<p><?php echo EMAIL_ADD?></p>
						</div>
						<div class="phone">
							<i class="icofont-phone"></i>
							<h4>للاتصال:</h4>
							<p><?php echo PHONE_NUM?></p>
						</div>
					</div>
				</div>
				
				<div class="col-lg-8 mt-5 mt-lg-0">
					<form id="contact_form" method="post" role="form" class="php-form">
						<input type="hidden" class="hid_info" name="csrf" id="csrf" value="<?php echo session::get('csrf'); ?>" />
						<div class="form-row">
							<div class="col-md-6 form-group">
								<input type="text" name="name" class="form-control" id="name" placeholder="الاسم" data-rule="minlen:4" data-msg="من فضلك ادخل 4 خروق على الاقل" />
								<div class="validate"></div>
							</div>
							<div class="col-md-6 form-group">
								<input type="email" class="form-control" name="email" id="email" placeholder="البريد الإلكترونى" data-rule="email" data-msg="من فضلك ادخل بريد الإلكترونى صحيح" />
								<div class="validate"></div>
							</div>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="subject" id="subject" placeholder="الموضوع" data-rule="minlen:4" data-msg="من فضلك ادخل 8 احرف على الاقل للموضوع" />
							<div class="validate"></div>
						</div>
						<div class="form-group">
							<textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="اكتب رسالتك هنا ..."></textarea>
							<div class="validate"></div>
						</div>
						<div class="mb-3">
							<div class="loading">تحميل</div>
							<div class="error-message"></div>
							<div class="sent-message">تم ارسال رسالتك بنجاح .. شكراَ!</div>
						</div>
						<div class="text-center"><button type="submit">ارسال الرسالة</button></div>
					</form>
				</div>
			</div>
		</div>
	</section><!-- End Contact Section -->
</main><!-- End #main -->

<!-- Modal For contact -->
<div id="cont_ok" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">اتصل بنا</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>تم ارسال رسالتك بنجاح .. شكراَ!</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
			</div>
		</div>
	</div>
</div>	
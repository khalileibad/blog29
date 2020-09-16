<!-- ======= Top Bar ======= -->
<section id="topbar" class="d-none d-lg-block">
	<div class="container d-flex">
		<div class="contact-info mr-auto">
			<i class="icofont-sign-in"></i><a href="login.html">دخول</a>
			<i class="icofont-user"></i><a href="register.html">تسجيل</a>
		</div>
	</div>
</section>
	
<main id="main">
	<!-- ======= Breadcrumbs ======= -->
	<section id="breadcrumbs" class="breadcrumbs">
		<div class="container">
			<div class="d-flex justify-content-between align-items-center">
				<h2>تسجيل دخول</h2>
				<ol>
					<li><a href="index.html">الرئيسية</a></li>
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
  	
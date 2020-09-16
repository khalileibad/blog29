		<div class="d-none" id="targetLayer"></div>
		
		<!--Target Progress Bar-->
		<div id="targetProgress" class="modal">
			<div class="w3-modal-content w3-card-4 w3-animate-opacity" style="max-width:200px">
				<div class="w3-border">
					<progress id="progress_area" value="0" max="100" style="width:100%;height:100%"></progress>
				</div>
			</div>
		</div>

		<!-- ======= Footer ======= -->
		<footer id="footer">
			<div class="footer-top">
				<div class="container">
					<div class="row">
						<div class="col-lg-4 col-md-6">
							<div class="footer-info">
								<h4>تابع 29 على</h4>
								<div class="social-links mt-3">
									<a href="<?php echo TWITTER?>" class="twitter"><i class="icofont-twitter"></i></a>
									<a href="<?php echo FACE?>" class="facebook"><i class="icofont-facebook"></i></a>
									<a href="<?php echo INSTAGRAM?>" class="instagram"><i class="icofont-instagram"></i></a>
									<a href="<?php echo GOOGLE?>" class="google-plus"><i class="icofont-skype"></i></a>
									<a href="<?php echo LINKEDIN?>" class="linkedin"><i class="icofont-linkedin"></i></a>
								</div>
							</div>
						</div>
						<div class="col-lg-2 col-md-6 footer-links">
							<h4>روابط مفيدة</h4>
							<ul>
								<li><i class="icofont-simple-left"></i> <a href="<?php echo URL ?>dashboard/terms">شروط الاستخدام</a></li>
								<li><i class="icofont-simple-left"></i> <a href="<?php echo URL ?>dashboard/privacy">بيان الخصوصية</a></li>
								<li><i class="icofont-simple-left"></i> <a href="<?php echo URL ?>dashboard/contact">اتصل بنا</a></li>
							</ul>
						</div>
						<div class="col-lg-2 col-md-6 footer-links">
							<h4>الزوار</h4>
							<ul>
								<li><i class="icofont-users"></i>  عدد الزوار <?php echo session::get('NEW_VISIT')?></li>
								<li><i class="icofont-world"></i>  عدد الزيارات <?php echo session::get('VISIT')?></li>
							</ul>
						</div>
						<div class="col-lg-4 col-md-6 footer-newsletter">
							<h4>اشترك فى القائمة البريدية</h4>
							<form id="mail_list" method="post">
								<input type="email" name="email_list"><input id="email_list_send" type="submit" value="اشترك">
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="copyright">
					&copy; كل الحقوق محفوظة 2020
				</div>
				<!--div class="credits">
					Designed by <a href="https://maknorsoft.com/">maknorsoft</a>
				</div-->
			</div>
		</footer><!-- End Footer -->

		<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
		<script type="text/javascript">
			var URL = "<?php echo URL?>";
			var E_HIDE = "w3-hide";
		</script>
		
		<!-- Vendor JS Files -->
		<script src="<?php echo URL?>public/vendor/jquery/jquery.min.js"></script>
		<script src="<?php echo URL?>public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="<?php echo URL?>public/vendor/jquery.easing/jquery.easing.min.js"></script>

		<!-- Template Main JS File -->
		<script src="<?php echo URL?>public/JS/main.js"></script>
		<script src="<?php echo URL?>public/JS/default.js"></script>
		<?php
			if(isset($this->JS))
			{
				foreach($this->JS as $v)
				{
					echo '<script src="'.URL.$v.'"></script>';
				}
			}
		?>
	</body>
</html>

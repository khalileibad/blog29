<div class="container">
	<div class="row justify-content-center">
		<div class="login-form">
			<form id="forget_form">
				<input type="hidden" name="csrf" value="0" />
				<div class="form-icon text-center">
					<a href="<?php echo URL?>">
						<img src="<?php echo URL?>public/IMG/logo1.jpg" class="img-fluid " alt="الرئيسية">
					</a>
				</div>
				<div class="form-group">
					<input type="text" class="form-control item" id="usrname" name="usrname" placeholder="<?php echo $this->lang['uname']?>">
				</div>
				<div class="form-group">
					<a href="<?php echo URL?>login/" class="float-right"><?php echo $this->lang['has_account']?></a>
				</div>
				<div class="form-group">
					<button id="forget_send" type="button" class="btn btn-block create-account"><?php echo $this->lang['send']?></button>
				</div>
			</form>
			<div class="social-media text-center">
				<h5>كل الحقوق محفوظة</h5>
				<div class="social-icons">
					<a target="_blank" href="<?php echo FACE?>"><i class="icofont-facebook" title="Facebook"></i></a>
					<a target="_blank" href="<?php echo TWITTER?>"><i class="icofont-twitter" title="Twitter"></i></a>
					<a target="_blank" href="<?php echo INSTAGRAM?>"><i class="icofont-instagram" title="Instagram"></i></a>
					<a target="_blank" href="<?php echo YOUTUBE?>"><i class="icofont-youtube" title="Youtube"></i></i></a>
				</div>
				<div id="error_msg" class="d-none"><?php echo (!empty($this->MSG))?$this->MSG:"";?></div>
			</div>
		</div>
	</div>
</div>
<br><br>

<!-- Model For Errors -->
<div id="forget_req" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<p>لقد تم ارسال طلب تغيير كلمة المرور, قم بمراجعة بريدك الالكتروني</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang['close']?></button>
			</div>
		</div>
	</div>
</div>



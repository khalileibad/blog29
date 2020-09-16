<!--targetLayer - For Form submit - Hidden-->
<div id="targetLayer" class="d-none">FORM</div>
<!-- TOP Nav Bar END -->
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<div class="iq-card">
				<div class="iq-card-body p-0">
					<div class="iq-edit-list">
						<ul class="iq-edit-profile d-flex nav nav-pills">
							<li class="col-md-3 p-0">
								<a class="nav-link active" data-toggle="pill" href="#personal-information">
									<?php echo $this->lang['pres_info']?>
								</a>
							</li>
							<li class="col-md-3 p-0">
								<a class="nav-link" data-toggle="pill" href="#chang-pwd">
									<?php echo $this->lang['ch_pass']?>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="iq-edit-list-data">
				<div class="tab-content">
					<div class="tab-pane fade active show" id="personal-information" role="tabpanel">
						<div class="iq-card">
							<div class="iq-card-header d-flex justify-content-between">
								<div class="iq-header-title">
									<h4 class="card-title"><?php echo $this->lang['pres_info']?></h4>
								</div>
							</div>
							<div class="iq-card-body">
								<form method="post" action="<?php echo URL?>profile/upd_info" enctype="multipart/form-data" class="image_form" data-msg="active_ok">
									<input type="hidden" class="hid_info" name="csrf" id="csrf" value="<?php echo session::get('csrf'); ?>" />
									<div class="form-group row align-items-center">
										<div class="col-md-12">
											<div class="profile-img-edit">
												<img id="profile_img" class="profile-pic" src="<?php echo URL."public/IMG/user/".$this->info['staff_id']."/".$this->info['staff_img']?>" alt="profile-pic">
												<div class="p-image">
													<i class="ri-pencil-line upload-button input_file_icon" data-id="user_img"></i>
													<input class="file-upload image_upload" type="file" accept="image/*" id="user_img" name="user_img" data-id="profile_img"/> 
												</div>
											</div>
										</div>
									</div>
									<div class=" row align-items-center">
										<div class="form-group col-sm-6" dir="rtl">
											<label for="name">الاسم</label>
											<input type="text" class="form-control" id="name" name="name" value="<?php echo $this->info['staff_name']?>">
											<div class="d-none err_notification " id="valid_name">
												<?php echo $this->lang['error_not']?>
											</div>
					
										</div>
										<div class="form-group col-sm-6" dir="ltr">
											<label for="name_en" class="float-right">Name:</label>
											<input type="text" class="form-control" id="name_en" name="name_en" value="<?php echo $this->info['staff_name_EN']?>">
											<div class="d-none err_notification " id="valid_name_en">
												<?php echo $this->lang['error_not']?>
											</div>
					
										</div>
										<div class="form-group col-sm-6">
											<label for="phone"><?php echo $this->lang['phone']?></label>
											<input type="phone" class="form-control" id="phone" name="phone" value="<?php echo $this->info['staff_phone']?>">
											<div class="d-none err_notification " id="valid_phone">
												<?php echo $this->lang['error_not']?>
											</div>
										</div>
										<div class="form-group col-sm-6">
											<label for="email"><?php echo $this->lang['email']?></label>
											<input type="email" class="form-control" id="email" name="email" value="<?php echo $this->info['staff_email']?>">
											<div class="d-none err_notification " id="valid_email">
												<?php echo $this->lang['error_not']?>
											</div>
										</div>
									<?php
										if(session::get('user_type') != "admin")
										{
									?>
										<div class="form-group col-sm-6">
											<label for="speci"><?php echo $this->lang['spec']?></label>
											<select class="form-control" id="speci" name="speci">
												<option selected=""></option>
											<?php
												foreach(clinic::$dr_types as $key => $value)
												{
													$sel = ($key == $this->info['staff_special'])?"selected":"";
											?>
												<option value="<?php echo $key?>" <?php echo $sel?> ><?php echo $value[session::get('lang')]?></option>
											<?php
												}
											?>
											</select>
											<div class="d-none err_notification " id="valid_speci">
												<?php echo $this->lang['error_not']?>
											</div>
										</div>
									<?php
										}
									?>
										<div class="form-group col-sm-6">
											<label><?php echo $this->lang['address']?></label>
											<input type="text" class="form-control" id="address" name="address" value="<?php echo $this->info['staff_address']?>">
											<div class="d-none err_notification " id="valid_address">
												<?php echo $this->lang['error_not']?>
											</div>
										</div>
									</div>
									<button type="submit" class="btn btn-primary mr-2"><!--?php echo $this->lang['save']?-->تحديث البيانات</button>
									<!--button type="reset" class="btn iq-bg-danger"><?php echo $this->lang['cancel']?></button-->
								</form>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="chang-pwd" role="tabpanel">
						<div class="iq-card">
							<div class="iq-card-header d-flex justify-content-between">
								<div class="iq-header-title">
									<h4 class="card-title"><?php echo $this->lang['ch_pass']?></h4>
								</div>
							</div>
							<div class="iq-card-body">
								<form id="res_pass">
									<input type="hidden" class="hid_info" name="csrf" id="csrf" value="<?php echo session::get('csrf'); ?>" />
									<div class="form-group">
										<label for="old_password"><?php echo $this->lang['curr_pass']?></label>
										<input type="Password" class="form-control" id="old_password" name="old_password" value="">
										<div class="d-none err_notification " id="valid_old_password">
											<?php echo $this->lang['error_not']?>
										</div>
									</div>
									<div class="form-group">
										<label for="new_password"><?php echo $this->lang['new_pass']?></label>
										<input type="Password" class="form-control" id="new_password" name="new_password" value="">
										<div class="d-none err_notification " id="valid_new_password">
											<?php echo $this->lang['error_not']?>
										</div>
									</div>
									<div class="form-group">
										<label for="conf_password"><?php echo $this->lang['conf_new_pass']?></label>
										<input type="Password" class="form-control" id="conf_password" name="conf_password" value="">
										<div class="d-none err_notification " id="valid_conf_password">
											<?php echo $this->lang['error_not']?>
										</div>
									</div>
									<button type="button" id="reset" class="btn btn-primary mr-2"><?php echo $this->lang['save']?></button>
									<!--button type="reset" class="btn iq-bg-danger"><?php echo $this->lang['cancel']?></button-->
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal For Active/free -->
<div id="active_ok" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body h5">
				<p><?php echo $this->lang['update_don']?> <i id="new_save_id" class="d-none"></i></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang['close']?></button>
			</div>
		</div>
	</div>
</div>

<!-- password -->
<div id="pass_ok" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><?php echo $this->lang['update']?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>تم اعادة ضبط كلمة المرور</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang['close']?></button>
			</div>
		</div>
	</div>
</div>
<!-- Modal For send data -->
<div id="send_ok" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<p>جاري تحديث البيانات</p>
			</div>
		</div>
	</div>
</div>
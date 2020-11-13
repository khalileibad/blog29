<!-- !PAGE CONTENT! -->
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="iq-card">
				<div class="iq-card-header d-flex  justify-content-between">
					<div class="iq-header-title text-center">
						<h4 class="card-title ">المستخدمين</h4>
					</div>
				</div>
				<div class="iq-card-body">
					<div id="table" class="table-editable">
						<span class="table-add float-right mb-3 mr-2">
							<button type="button" class="btn btn-sm iq-bg-success" data-toggle="modal" data-target="#new_dr">
								<i class="ri-add-fill"><span class="pl-1">إضافة مستخدم</span></i>
							</button>
						</span>
						<form id="staff_search">
							<input type="hidden" name="csrf" id="csrf" class="hid_info" value="<?php echo session::get('csrf'); ?>" />
							<div id="topbar" class="row mr-auto">
								
							</div>
						</form>
						<div class="w3-row w3-responsive w3-white" id="Staff_list"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



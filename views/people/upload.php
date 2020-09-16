<div class="w3-container" style="max-width:1400px;margin-top:70px">
	<!-- Header -->
	<header class="w3-container w3-white">
		<h4>إضافة المواطنين عن طريق ملف الاكسل</h4>
	</header>
	<div class="w3-container w3-padding">
		<button onclick="uploadInfo('info')" class="w3-btn w3-block w3-theme w3-right-align">
			<i class="fa fa-info"></i> معلومات مهمة عن ملف الاكسل - إضغط هنا
		</button>
		<div id="info" class="w3-container w3-padding w3-hide w3-animate-opacity">
			<h4>يتم الرفع عن طريق رقم البطاقة الخدمية, لذلك لا بد أن يكون المنزل مسجل في النظام</h4>
			<h4>نوع الملف CSV - comma ( ,) UTF-8 </h4>
			<h4>أو EXCEL </h4>
			<h4>محتوى ملف الاكسل المراد رفعه </h4>
			<div class="w3-row-padding">
				<table class="w3-table-all w3-centered">
					<thead>
						<tr class="w3-light-grey">
							<th class="w3-border">رقم البطاقة الخدمية</th>
							<th class="w3-border">الإسم</th>
							<th class="w3-border">Name</th>
							<th class="w3-border">نوع الهوية</th>
							<th class="w3-border">رقم الهوية</th>
							<th class="w3-border">رقم الهاتف</th>
							<th class="w3-border">البريد الالكتروني</th>
							<th class="w3-border">الجنس</th>
							<th class="w3-border">تاريخ الميلاد</th>
							<th class="w3-border">الجنسية</th>
							<th class="w3-border">الحالة الإجتماعية</th>
							<th class="w3-border">المستوى الأكاديمي</th>
							<th class="w3-border">الوظيفة</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>رقم</td>
							<td>نص</td>
							<td>نص</td>
							<td>
								إختار:
								<ul>
							<?php
								foreach(kb9::$id_type as $key => $val)
								{
									echo "<li>".$key.": ".$val['AR']."</li>";
								}
							?>
								</ul>
							</td>
							<td>لا يتكرر</td>
							<td>لا يتكرر</td>
							<td>لا يتكرر</td>
							<td>
								إختار:
								<ul>
							<?php
								foreach(kb9::$gender as $key => $val)
								{
									echo "<li>".$key.": ".$val['AR']."</li>";
								}
							?>
								</ul>
							</td>
							<td>تاريخ</td>
							<td>
								كود الدولة<br/>
								مثلا<br/>
								السودان: SD
							</td>
							<td>
								إختار:
								<ul>
							<?php
								foreach(kb9::$Social as $key => $val)
								{
									echo "<li>".$key.": ".$val['AR']."</li>";
								}
							?>
								</ul>
							</td>
							<td>
								إختار:
								<ul>
							<?php
								foreach(kb9::$Acadimic as $key => $val)
								{
									echo "<li>".$key.": ".$val['AR']."</li>";
								}
							?>
								</ul>
							</td>
							<td>نص</td>
						</tr>
					</tbody>
				</table>
				
				<h4 class="w3-margin-top">شكل الملف محتوى على البيانات - الصف الاول لازم يكون بنفس اسامى الحقول فى الجدول ادناه</h4>
				<table class="w3-table-all w3-centered">
					<thead>
						<tr class="w3-light-grey">
							<th>رقم البطاقة الخدمية</th>
							<th>الإسم</th>
							<th>Name</th>
							<th>نوع الهوية</th>
							<th>رقم الهوية</th>
							<th>رقم الهاتف</th>
							<th>البريد الالكتروني</th>
							<th>الجنس</th>
							<th>تاريخ الميلاد</th>
							<th>الجنسية</th>
							<th>الحالة الإجتماعية</th>
							<th>المستوى الأكاديمي</th>
							<th>الوظيفة</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>5658652</td>
							<td>عبدالله على محمد على</td>
							<td>Abdullah Ali Mohamed Ali</td>
							<td>PASS</td>
							<td>P12345678</td>
							<td>0123456789</td>
							<td>abd@gmail.com</td>
							<td>M</td>
							<td>1980-01-01</td>
							<td>SD</td>
							<td>MARR</td>
							<td>ABOV</td>
							<td>طبيب</td>
						</tr>
						<tr>
							<td>5658652</td>
							<td>محمد عبدالله على محمد على</td>
							<td>Mohamed Abdullah Ali Mohamed Ali</td>
							<td>NAT_NO</td>
							<td>9987612345678</td>
							<td>0900123456</td>
							<td>moh.abd@gmail.com</td>
							<td>M</td>
							<td>2000-01-01</td>
							<td>SD</td>
							<td>CELI</td>
							<td>UNIV</td>
							<td>طالب</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="w3-container w3-margin-top">
		<input type="hidden" name="csrf" id="csrf" value="<?php echo session::get('csrf'); ?>" />
		<input type="file" name="students" class="display_file w3-margin-bottom" data-location="file_cont" data-table="upl_list"/>
		<br/>
		<div id="file_cont" class="w3-row w3-responsive">... محتوى الملف</div>
		<button id="upload_Student_button" class="w3-hover-theme w3-button w3-margin-top w3-theme w3-card-2 w3-animate-opacity" >
			إضافة مواطنين  <i class="fa fa-upload"></i>
		</button>
	</div>
</div>

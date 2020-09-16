<table class="w3-table w3-bordered w3-striped w3-border-top w3-hoverable w3-centered">
	<thead>
		<tr class="w3-theme">
			<th class="w3-border">الإسم</th>
			<th class="w3-border">نوع الهوية</th>
			<th class="w3-border">رقم الهوية</th>
			<th class="w3-border">تاريخ الميلاد</th>
			<th class="w3-border">الهاتف</th>
			<th class="w3-border">البريد الالكتروني</th>
			<th class="w3-border">الجنس</th>
			<th class="w3-border">الجنسية</th>
			<th class="w3-border">الحالة الإجتماعية</th>
			<th class="w3-border">المستوى الأكاديمي</th>
			<th class="w3-border">الوظيفة</th>
			<th class="w3-border" colspan="2">الاجراء</th>
		</tr>
	</thead>
	<tbody >
	<?php
		foreach($this->peo_info AS $key => $val)
		{
			$cls = (!empty($val['peo_main']))?"w3-theme-l3":"";
	?>
		<tr class="<?php echo $cls?>">
			<td class="w3-center w3-border w3-hide peo_id"><?php echo $val['peo_id'];?></td>
			<td class="w3-center w3-border w3-hide peo_main"><?php echo $val['peo_main'];?></td>
			<td class="w3-center w3-border peo_name" data-ar="<?php echo $val['peo_name'];?>" data-en="<?php echo $val['peo_name_EN'];?>" ><?php echo (session::get('lang')=='AR')?$val['peo_name']:$val['peo_name_EN'];?></td>
			<td class="w3-center w3-border peo_id_type" data-id="<?php echo $val['peo_id_type'];?>"><?php echo (!empty($val['peo_id_type']))?kb9::$id_type[$val['peo_id_type']][session::get('lang')]:"";?></td>
			<td class="w3-center w3-border peo_id_no"><?php echo $val['peo_id_no'];?></td>
			<td class="w3-center w3-border peo_birth"><?php echo $val['peo_birth'];?></td>
			<td class="w3-center w3-border peo_phone"><?php echo $val['peo_phone'];?></td>
			<td class="w3-center w3-border peo_email"><?php echo $val['peo_email'];?></td>
			<td class="w3-center w3-border peo_gender" data-id="<?php echo $val['peo_gender'];?>"><?php echo (!empty($val['peo_gender']))?kb9::$gender[$val['peo_gender']][session::get('lang')]:"";?></td>
			<td class="w3-center w3-border peo_nat" data-id="<?php echo $val['peo_nationality'];?>"><?php echo (!empty($val['peo_nationality']))?kb9::$countries[$val['peo_nationality']][session::get('lang')]:"";?></td>
			<td class="w3-center w3-border peo_soc" data-id="<?php echo $val['peo_social'];?>"><?php echo (!empty($val['peo_social']))?kb9::$Social[$val['peo_social']][session::get('lang')]:"";?></td>
			<td class="w3-center w3-border peo_aca" data-id="<?php echo $val['peo_acadimic'];?>"><?php echo (!empty($val['peo_acadimic']))?kb9::$Acadimic[$val['peo_acadimic']][session::get('lang')]:"";?></td>
			<td class="w3-center w3-border peo_job"><?php echo $val['peo_job'];?></a></td>
			<td class="w3-center w3-border"><button class='w3-button w3-theme peo_upd'>تحديث</button></td>
			<td class="w3-center w3-border"><?php echo (empty($val['peo_main']))?"<button class='w3-button w3-theme peo_del'>حذف</button>":"--"?></td>
		</tr>
	<?php
		}
	?>
	</tbody>
</table>
		
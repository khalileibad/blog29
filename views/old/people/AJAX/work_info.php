<table class="w3-table w3-bordered w3-striped w3-border-top w3-hoverable w3-centered">
	<thead>
		<tr class="w3-theme">
			<th class="w3-border">الإسم</th>
			<th class="w3-border">الهاتف</th>
			<th class="w3-border">الجنس</th>
			<th class="w3-border">الجنسية</th>
			<th class="w3-border">الحالة الإجتماعية</th>
			<th class="w3-border">الوظيفة</th>
			<th class="w3-border" colspan="2">الاجراء</th>
		</tr>
	</thead>
	<tbody >
	<?php
		foreach($this->work_info AS $key => $val)
		{
	?>
		<tr>
			<td class="w3-center w3-border w3-hide work_id"><?php echo $val['work_id'];?></td>
			<td class="w3-center w3-border work_name" data-ar="<?php echo $val['work_name'];?>" data-en="<?php echo $val['work_name_EN'];?>" ><?php echo (session::get('lang')=='AR')?$val['work_name']:$val['work_name_EN'];?></td>
			<td class="w3-center w3-border work_phone"><?php echo $val['work_phone'];?></td>
			<td class="w3-center w3-border work_gender" data-id="<?php echo $val['work_gender'];?>"><?php echo (!empty($val['work_gender']))?kb9::$gender[$val['work_gender']][session::get('lang')]:"";?></td>
			<td class="w3-center w3-border work_nat" data-id="<?php echo $val['work_nationality'];?>"><?php echo (!empty($val['work_nationality']))?kb9::$countries[$val['work_nationality']][session::get('lang')]:"";?></td>
			<td class="w3-center w3-border work_soc" data-id="<?php echo $val['work_social'];?>"><?php echo (!empty($val['work_social']))?kb9::$Social[$val['work_social']][session::get('lang')]:"";?></td>
			<td class="w3-center w3-border work_job"><?php echo $val['work_job'];?></td>
			<td class="w3-center w3-border"><button class='w3-button w3-theme work_upd'>تحديث</button></td>
			<td class="w3-center w3-border"><button class='w3-button w3-theme work_del'>حذف</button></td>
		</tr>
	<?php
		}
	?>
	</tbody>
</table>


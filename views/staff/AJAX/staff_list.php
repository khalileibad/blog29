<table class="table table-bordered table-responsive-md table-striped text-center">
	<thead>
		<tr>
			<th>#</th>
			<th>اسم الموظف</th>
			<th>نوع المستخدم</th>
			<th>البريد الإلكتروني</th>
			<th>الهاتف</th>
			<th colspan="2">الأجراء</th>
		</tr>
	</thead>
	<tbody >
	<?php
		$i = 1;
		foreach($this->user_list AS $key => $val)
		{
			$class 	= ($val['staff_active'] == '1')?"iq-bg-danger":"iq-bg-success";
			$txt	= ($val['staff_active'] == '1')?"تجميد":"تنشيط";
	?>
		<tr>
			<td><?php echo $i++;?></td>
			<td class="d-none sta_id"><?php echo $val['staff_id'];?></td>
			<td class="sta_name"><?php echo $val['staff_name'];?></a></td>
			<td class="sta_type" data-id="<?php echo $val['staff_type'];?>"><?php echo staff_settings::$staf_asso_type[$val['staff_type']]['AR'];?></a></td>
			<td class="sta_email"><?php echo $val['staff_email'];?></a></td>
			<td class="sta_phone"><?php echo $val['staff_phone'];?></a></td>
			<td class=""><button class='btn btn-rounded btn-sm my-0 iq-bg-success user_upd'>تحديث</button></td>
			<td class=""><button class='btn btn-rounded btn-sm my-0 user_act <?php echo $class;?> '><?php echo $txt;?></button></td>
		</tr>
	<?php
		}
	?>
	</tbody>
</table>

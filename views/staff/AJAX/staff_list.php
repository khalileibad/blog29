<table class="w3-table-all w3-bordered w3-striped w3-border-top w3-hoverable w3-centered">
	<thead>
		<tr class="w3-theme">
			<th class="w3-border"><input type="checkbox" id='msgs' /></th>
			<th class="w3-border">#</th>
			<th class="w3-border">اسم الموظف</th>
			<th class="w3-border">نوع المستخدم</th>
			<th class="w3-border">البريد الإلكتروني</th>
			<th class="w3-border" colspan="2">الأجراء</th>
		</tr>
	</thead>
	<tbody >
	<?php
		$i = 1;
		foreach($this->user_list AS $key => $val)
		{
			$class 	= ($val['staff_active'] == '1')?"w3-red":"w3-green";
			$txt	= ($val['staff_active'] == '1')?"تجميد":"تنشيط";
			
	?>
		<tr>
			<td class="w3-center w3-border"><input type="checkbox" class="msgs" data-id="<?php echo $val['staID']?>" /></td>
			<td class="w3-center"><?php echo $i++;?></td>
			<td class="w3-center w3-hide sta_id"><?php echo $val['staID'];?></td>
			<td class="w3-border w3-border sta_name"><?php echo $val['staff_full_name'];?></a></td>
			<td class="w3-border w3-border sta_type" data-id="<?php echo $val['staff_type'];?>"><?php echo staff_settings::$staf_asso_type[$val['staff_type']]['AR'];?></a></td>
			<td class="w3-border w3-border sta_email"><?php echo $val['staff_email'];?></a></td>
			<td class="w3-center w3-border"><button class='w3-button w3-theme user_upd'>تحديث</button></td>
			<td class="w3-center w3-border"><button class='w3-button user_act <?php echo $class;?> '><?php echo $txt;?></button></td>
		</tr>
	<?php
		}
	?>
	</tbody>
</table>

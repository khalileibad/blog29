<table class="w3-table w3-bordered w3-striped w3-border-top w3-hoverable w3-centered">
	<thead>
		<tr class="w3-theme">
			<th class="w3-border">الرقم</th>
			<th class="w3-border">اسم</th>
			<th class="w3-border">الهاتف</th>
			<th class="w3-border">البريد الإلكتروني</th>
			<th class="w3-border">رقم البطاقة الخدمية</th>
			<th class="w3-border">حالة سكن المقدم</th>
			<th class="w3-border">رقم الارض</th>
			<th class="w3-border" colspan="3">صاحب الارض المسجل</th>
			<th class="w3-border">تاريخ الطلب</th>
			<th class="w3-border" colspan="2">الاجراء</th>
		</tr>
	</thead>
	<tbody >
	<?php
		foreach($this->req_people_list AS $key => $val)
		{
	?>
		<tr>
			<td class="w3-center w3-border req_id"><?php echo $val['req_id'];?></td>
			<td class="w3-center w3-border req_name"><?php echo $val['req_name'];?></a></td>
			<td class="w3-center w3-border req_phone"><?php echo $val['req_phone'];?></a></td>
			<td class="w3-center w3-border req_email"><?php echo $val['req_email'];?></a></td>
			<td class="w3-center w3-border req_card"><?php echo $val['req_card'];?></a></td>
			<td class="w3-center w3-border req_home_status"><?php echo kb9::$house_live_type[$val['req_home_status']][session::get('lang')];?></a></td>
			
			<td class="w3-center w3-border req_land"><?php echo $val['req_land'];?></a></td>
			<td class="w3-center w3-border req_land_owner" data-id="<?php echo $val['l_id'];?><"><?php echo (session::get('lang')=='AR')?$val['l_owner_name']:$val['l_owner_name_EN'];;?></a></td>
			<td class="w3-center w3-border req_land_phone"><?php echo $val['l_owner_phone'];?></a></td>
			<td class="w3-center w3-border req_land_email"><?php echo $val['l_owner_email'];?></a></td>
			
			<td class="w3-center w3-border req_time"><?php echo $val['create_at'];?></a></td>
			<td class="w3-center w3-border"><button class="w3-button btn-p w3-border w3-border-theme w3-round w3-green accept_req">إضافة</button></td>
			<td class="w3-center w3-border"><button class="w3-button btn-p w3-border w3-border-theme w3-round w3-red del_req">حذف</button></td>
			
		</tr>
	<?php
		}
	?>
	</tbody>
</table>


<table class="w3-table w3-bordered w3-striped w3-border-top w3-hoverable w3-centered">
	<thead>
		<tr class="w3-theme">
			<th class="w3-border" colspan="2">الوحدة السكنية</th>
			<th class="w3-border"colspan="3">المالك</th>
			<th class="w3-border">نوع السكن</th>
			<th class="w3-border">رقم البطاقة الخدمية</th>
			<th class="w3-border" colspan="3">المسؤول</th>
			<th class="w3-border">عدد السكان</th>
			<th class="w3-border">عدد العمال</th>
			<th class="w3-border">الاجراء</th>
		</tr>
	</thead>
	<tbody >
	<?php
		foreach($this->people_list AS $key => $val)
		{
	?>
		<tr>
			<td class="w3-center w3-border peo_lno"><?php echo $val['l_no'];?></td>
			<td class="w3-center w3-border peo_lsub_no"><?php echo $val['l_sub_no'];?></a></td>
			<td class="w3-center w3-border peo_owner"><?php echo (session::get('lang')=='AR')?$val['l_owner_name']:$val['l_owner_name_EN'];?></a></td>
			<td class="w3-center w3-border peo_land_phone"><?php echo $val['l_owner_phone'];?></a></td>
			<td class="w3-center w3-border peo_land_email"><?php echo $val['l_owner_email'];?></a></td>
			<td class="w3-center w3-border peo_card"><?php echo kb9::$house_live_type[$val['h_type']][session::get('lang')];?></a></td>
			<td class="w3-center w3-border peo_card" data-id="<?php echo $val["h_id"]?>"><?php echo $val['h_card'];?></a></td>
			<td class="w3-center w3-border peo_house"><?php echo (session::get('lang')=='AR')?$val['peo_name']:$val['peo_name_EN'];?></a></td>
			<td class="w3-center w3-border peo_house_phone"><?php echo $val['peo_phone'];?></a></td>
			<td class="w3-center w3-border peo_house_email"><?php echo $val['peo_email'];?></a></td>
			<td class="w3-center w3-border peo_people"><?php echo $val['people'];?></a></td>
			<td class="w3-center w3-border peo_workers"><?php echo $val['workers'];?></a></td>
			<td class="w3-center w3-border"><a target="_blank" href="<?php echo URL."people/info/".$val["h_id"]?>" class="w3-button btn-p w3-border w3-border-theme w3-round">التفاصيل</a></td>
			
		</tr>
	<?php
		}
	?>
	</tbody>
</table>


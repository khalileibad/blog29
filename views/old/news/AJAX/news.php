<table class="w3-table w3-bordered w3-striped w3-border-top w3-hoverable w3-centered">
	<thead>
		<tr class="w3-theme">
			<th class="w3-border">الرقم</th>
			<th class="w3-border">اسم</th>
			<th class="w3-border">العنوان</th>
			<th class="w3-border">الحالة</th>
			<th class="w3-border" colspan="2">الجراء</th>
		</tr>
	</thead>
	<tbody >
<?php
	foreach($this->news_list AS $key => $val)
	{
		if(!empty($val['n_active']))
		{
			$cls 	= "fa-check";
			$class	= "w3-red";
			$txt	= "تجميد";
		}else
		{
			$cls 	= "fa-times";
			$class	= "w3-green";
			$txt	= "تنشيط";
		}
		
?>
	<tr>
		<td class="w3-center w3-border news_id"><?php echo $val['n_id'];?></td>
		<td class="w3-border w3-border news_name"><?php echo (session::get('lang')=='AR')?$val['n_name']:$val['n_name_EN'];?></a></td>
		<td class="w3-border w3-border news_title"><?php echo (session::get('lang')=='AR')?$val['n_title']:$val['n_title_EN'];?></a></td>
		<td class="w3-border w3-border news_active"><i class="fa <?php echo $cls?>" aria-hidden="true"></i></a></td>
		<td class="w3-center w3-border"><button class="w3-button btn-p w3-border w3-border-theme w3-round w3-green upd_news">تعديل</button></td>
		<td class="w3-center w3-border"><button class='w3-button news_act <?php echo $class;?> '><?php echo $txt;?></button></td>
	</tr>
<?php
	}
?>
	</tbody>
</table>


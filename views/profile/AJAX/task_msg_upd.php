<?php
	foreach($this->msgs as $key => $val)
	{
?>
	<tr data-id="<?php echo $val['mis_id']?>" class="task_notification w3-red">
		<td><?php echo $val['ta_name_en']?></td>
		<td><div class="noti_msg_txt txt_over"><?php echo $val['mis_comm']?></div></td>
		<td><?php echo $val['uname']?></td> 
		<td><?php echo $val['mis_time']?></td> 
	</tr>
<?php
	}
?>
<div class="w3-modal-content w3-animate-opacity w3-card-8">
	<header class="w3-container w3-light-grey"> 
		<span class="w3-closebtn task_comments_close">&times;</span>
		<h2>Task <?php echo $this->task['ta_name_en']?> - Comments</h2>
	</header>
	<div class="w3-container">
		<input type="hidden" id="task_comment_id" value="<?php echo $this->task['ta_id']?>" />
		<ul class="w3-ul" id="task_sms">
		<?php
			foreach($this->msgs as $key => $val)
			{
		?>
			<li><?php echo $val['uname_EN'].' - '.$val['mis_comm'].' - '.$val['mis_time']?></li>
		<?php
			}
		?>
		</ul>
		<textarea id="task_comment_comment" class="w3-input w3-border"></textarea><br>
	</div>
	<footer class="w3-container w3-light-grey w3-padding">
		<button id="task_comments_save" class="w3-btn w3-blue w3-padding">Send</button> 
		<button class="w3-btn w3-white w3-border task_comments_close" >Close</button>
	</footer>
</div>

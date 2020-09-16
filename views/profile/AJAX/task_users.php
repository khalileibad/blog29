<div class="w3-modal-content w3-animate-opacity w3-card-8">
	<header class="w3-container w3-light-grey"> 
		<span class="task_user_close w3-closebtn">&times;</span>
		<h2>Task <?php echo $this->task['ta_name_en']?> users</h2>
		<input type="hidden" id="curr_task_id" value="<?php echo $this->task['ta_id']?>" />
	</header>
	<div class="w3-container w3-center">
		<p>Current Staff</p>
		<?php
			if(count($this->task['book']) == 0)
			{
				echo "<p>No Active Users For This Task</p>";
			}
		?>
		<div class="w3-row-padding w3-container" id="book_staff_list">
		<?php
			$active = array();
			foreach($this->task['book'] as $key => $val)
			{
				array_push($active,$val['bo_user']);
		?>
			<div id="book_user_<?php echo $val['bo_user']?>" class="w3-card w3-quarter booked_user">
				<div class="w3-container w3-blue">
					<p class="book_user_name"><?php echo $val['uname_EN']?></p>
					<button class="w3-btn staf_remove" data-id="<?php echo $val['bo_user']?>">Remove</button>
				</div>
			</div>
		<?php
			}
		?>
		</div>
		<hr/>
		<p>Add New Staff</p>
		<div class="w3-row-padding w3-container" id="new_staff_list">
		<?php
			foreach($this->su_staf as $key => $val)
			{
				if(array_search($val['u_id'],$active)!== false)
				{
					continue;
				}
		?>
			<div id="new_user_<?php echo $val['u_id']?>" class="w3-card w3-quarter">
				<div class="w3-container w3-blue">
					<p class="new_user_name"><?php echo $val['uname_EN']?></p>
					<button class="w3-btn staf_add" data-id="<?php echo $val['u_id']?>">Add</button>
				</div>
			</div>
		<?php
			}
		?>
		</div>
	</div>
	<footer class="w3-container w3-light-grey w3-padding">
		<button id="upd_staff_task" class="w3-btn w3-white w3-border">Update</button>
		<button class="w3-btn w3-white w3-border task_user_close">Close</button>
	</footer>
</div>

<!--
$this->view->task 	= $this->model->tasks_info($id);
			$this->view->su_staf= $this->model->sub_staff_list();
			
	-->	 
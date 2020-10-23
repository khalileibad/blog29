<div class="container-fluid">
	<?php
		foreach($this->comm_list as $val)
		{
	?>
		<div class="row">
			<div class="col-1">
				<input type="checkbox" name="accept[]" value="<?php echo $val['com_id']?>" class="comm_accept_radio" checked />
			</div>
			<div class="col-3">
				<h4 class="entry-title">
					<a href="<?php echo URL."blog/details/".$val['b_id']?>"><?php echo $val['b_title']?></a>
				</h4>
				<div class="entry-img">
					<img src="<?php echo URL."public/IMG/blog/".$val['b_img'] ?>" class="rounded-circle" alt="Cinque Terre" width="150" height="150">
				</div>
			</div>
			<div class="col-3">
				<h5><?php echo $val['com_aut_name']?></h5>
				<h5><?php echo $val['com_aut_phone']?></h5>
				<h5><?php echo $val['com_aut_email']?></h5>
			</div>
			<div class="col-5">
				<?php echo $val['com_comment']?>
			</div>
		</div>
	<?php
		}
	?>	
</div>
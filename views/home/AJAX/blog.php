<div class="container">
	<div class="row">
	<?php
		foreach($this->blog_list['data'] as $val)
		{
	?>
		<div class="col-lg-4  col-md-6 d-flex align-items-stretch" data-aos="fade-up">
			<article class="entry">
				<div class="entry-img">
					<img src="<?php echo URL."public/IMG/blog/".$val['img'] ?>" alt="" class="img-fluid">
				</div>
				<h2 class="entry-title">
					<a href="<?php echo URL."blog/details/".$val['id']?>"><?php echo $val['title']?></a>
				</h2>
				<div class="entry-meta">
					<ul>
						<li class="d-flex align-items-center"><i class="icofont-wall-clock"></i><time datetime="<?php echo $val['publish']?>"><?php echo $val['publish']?></time></li>
					</ul>
				</div>
				<div class="entry-content">
					<p><?php echo $val['desc']?></p>
					<div class="read-more">
						<a href="<?php echo URL."blog/details/".$val['id']?>">اقراء المزيد </a>
					</div>
				</div>
			</article><!-- End blog entry -->
		</div>
	<?php
		}
	?>	
	</div>
</div>

<div class="blog-pagination" data-aos="fade-up" id="paging">
	<input id="paging_curr_no" type="hidden" value="<?php echo $this->blog_list['curr']?>" />
	<ul class="justify-content-center">
		<li class="<?php if($this->blog_list['curr'] == 1){echo "disabled";}?>"><a id="paging_prev"><i class="icofont-rounded-right"></i></a></li>
	<?php
		for($i = 1;$i <= $this->blog_list['no_page'];$i++)
		{
			$active = ($i == $this->blog_list['curr'])?"active":"";
			echo "<li class='$active'><a class='paging_no' data-id='$i'>$i</a></li>";
		}
	?>
		<!--li class="active"><a href="#">2</a></li-->
		<li class="<?php if($this->blog_list['curr'] == $this->blog_list['no_page']){echo "disabled";}?>"><a id="paging_next"><i class="icofont-rounded-left"></i></a></li>
	</ul>
</div>

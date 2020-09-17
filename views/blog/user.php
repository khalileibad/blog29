<main id="main">
	<!-- ======= Breadcrumbs ======= -->
	<section id="breadcrumbs" class="breadcrumbs">
		<div class="container">
			<div class="d-flex justify-content-between align-items-center">
				<h2><?php echo $this->blog['title']?></h2>
				<ol>
					<li><a href="<?php echo URL?>">الرئيسية</a></li>
					<li><a href="<?php echo URL?>blog/index"> التدوينة</a></li>
				</ol>
			</div>
		</div>
	</section><!-- End Breadcrumbs -->
		
	<!-- ======= Blog Section ======= -->
	<section id="blog" class="blog">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 entries">
					<div class="blog-author clearfix">
						<img src="<?php echo URL."public/IMG/users/".$this->blog['user_img'] ?>" class="rounded-circle float-right" alt="">
						<h4><?php echo $this->blog['name']?></h4>
						<div class="social-links">
						<?php
							echo (!empty($val['user_twitter']))?'<a href="'.$val['user_twitter'].'" target="_blank"><i class="icofont-twitter"></i></a>':"";
							echo (!empty($val['user_face']))?'<a href="'.$val['user_face'].'" target="_blank"><i class="icofont-facebook"></i></a>':"";
							echo (!empty($val['user_instegram']))?'<a href="'.$val['user_instegram'].'" target="_blank"><i class="icofont-instagram"></i></a>':"";
							echo (!empty($val['user_linked']))?'<a href="'.$val['user_linked'].'" target="_blank"><i class="icofont-linkedin"></i></a>':"";
						?>
						</div>
						<p><?php echo $this->blog['name']?></p>
					</div><!-- End blog author bio -->
						
					
					
					
				</div><!-- End blog entries list -->
				<div class="col-lg-4">
					<div class="sidebar">
						<h3 class="sidebar-title">التصنيفات</h3>
						<div class="sidebar-item categories">
							<ul>
							<?php
								foreach($this->menu as $val)
								{
									echo "<li><a href='".URL."blog/index/".$val['id']."'>".$val['name']." <span>(".$val['count'].")</span></a></li>";
								}
							?>
							</ul>
						</div><!-- End sidebar categories-->
					</div><!-- End sidebar -->
				</div><!-- End blog sidebar -->
			</div>
		</div>
	</section><!-- End Blog Section -->
</main><!-- End #main -->

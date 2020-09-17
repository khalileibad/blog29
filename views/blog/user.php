<main id="main">
	<!-- ======= Breadcrumbs ======= -->
	<section id="breadcrumbs" class="breadcrumbs">
		<div class="container">
			<div class="d-flex justify-content-between align-items-center">
				<h2><?php echo $this->user['name']?></h2>
				<ol>
					<li><a href="<?php echo URL?>">الرئيسية</a></li>
					<li>الكاتبين</li>
				</ol>
			</div>
		</div>
	</section><!-- End Breadcrumbs -->
	<!--
	
	
	-->
	<!-- ======= Blog Section ======= -->
	<section id="blog" class="blog">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 entries">
					<div class="blog-author clearfix">
						<img src="<?php echo URL."public/IMG/users/".$this->user['user_img'] ?>" class="rounded-circle float-right" alt="">
						<h4><?php echo $this->user['name']?></h4>
						<div class="social-links">
						<?php
							echo (!empty($this->user['user_twitter']))?'<a href="'.$this->user['user_twitter'].'" target="_blank"><i class="icofont-twitter"></i></a>':"";
							echo (!empty($this->user['user_face']))?'<a href="'.$this->user['user_face'].'" target="_blank"><i class="icofont-facebook"></i></a>':"";
							echo (!empty($this->user['user_instegram']))?'<a href="'.$this->user['user_instegram'].'" target="_blank"><i class="icofont-instagram"></i></a>':"";
							echo (!empty($this->user['user_linked']))?'<a href="'.$this->user['user_linked'].'" target="_blank"><i class="icofont-linkedin"></i></a>':"";
						?>
						</div>
						<p><?php echo $this->user['name']?></p>
					</div><!-- End blog author bio -->
					
					<div class="container">
						<div class="section-title">
							<h2>المدونات</h2>
						</div>
						<div class="row">
						<?php
							foreach($this->user['blogs'] as $val)
							{
						?>
							<div class="col-lg-4  col-md-6 d-flex align-items-stretch" data-aos="fade-up">
								<article class="entry">
									<div class="entry-img">
										<img src="<?php echo URL."public/IMG/blog/".$val['img'] ?>" alt="" class="img-fluid" />
									</div>
									<h2 class="entry-title">
										<a href="<?php echo URL."blog/details/".$val['id']?>"><?php echo $val['title']?></a>
									</h2>
									<div class="entry-meta">
										<ul>
											<li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <time datetime="<?php echo $val['publish']?>"><?php echo $val['publish']?></time></li>
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

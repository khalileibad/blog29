<!-- ======= Hero Section ======= -->
<section id="hero">
	<div class="hero-container" data-aos="fade-up">
		<h1>مدوّنة -الحرف التاسع والعشرون- 29</h1>
		<h2>هي مدوّنة أدبية مستقلّة، تُعنى بتجسير الفجوة بين الكتّاب والأدباء السودانيون وبين القارئ العربي من المحيط للخليج، وكل قرّاء العربية في المهجر.</h2>
		<a href="<?php echo URL ?>login/register" class="btn-get-started scrollto">اكتب معنا</a>
	</div>
</section><!-- End Hero -->
	
<main id="main">
	<!-- ======= Blog Section ======= -->
	<section id="blog" class="blog">
		<div class="container">
			<div class="section-title text-right">
				<h2>احدث التدوينات</h2>
			</div>
			<div class="row">
				<div class="col-lg-8">
					<div id="carouseId" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#carouseId" data-slide-to="0" class="active"></li>
							<li data-target="#carouseId" data-slide-to="1"></li>
							<li data-target="#carouseId" data-slide-to="2"></li>
						</ol>
						<div class="carousel-inner">
						<?php
							$active = "active";
							foreach($this->last_blog as $val)
							{
						?>
							<div class="carousel-item <?php echo $active?>" style="">
								<img src="<?php echo URL."public/IMG/blog/".$val['img'] ?>" class="img-fluid rounded d-block w-100 h-100" alt="" style="height: 200px"> <!--  -->
								<div class="carousel-caption d-md-block">
									<h3> <a href="<?php echo URL."blog/details/".$val['id']?>"> <?php echo $val['title']?> </a></h3>
									<p><?php echo $val['desc']?></p>
									<div class="entry-meta">
										<div>
										<?php 
											foreach($val['cat'] as $value)
											{
												echo "<span class='rounded-circle mx-1 p-1 ".$value['class']."'>".$value['name']."</span>";
											}
										?>
										</div>
										<span> <a href="<?php echo URL."blog/user/".$val['user']?>"><i class="icofont-user"></i> <?php echo $val['name']?> </a></span> | 
										<span>
											<i class="icofont-wall-clock"></i>
											<time datetime="<?php echo $val['publish']?>"> <?php echo $val['publish']?> </time> 
										</span>
									</div>
								</div>
							</div>
						<?php
								$active = "";
							}
						?>
						</div>
					</div>
				</div>
					
				<div class="col-lg-4">
					<div class="sidebar">
						<!--div class="sidebar-item search-form">
							<form action="">
								<input type="text">
								<button type="submit"><i class="icofont-search"></i></button>
							</form>
						</div><!-- End sidebar search formn-->

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
					</div>
				</div>
			</div>
		</div>
		<br/>
		<div class="container">
			<div class="section-title">
				<h2>التصنيف</h2>
				<p>الاكثر شهرة</p>
			</div>
			<div class="row">
			<?php
				foreach($this->most_read_blog as $val)
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
								<li class="d-flex align-items-center"><i class="icofont-user"></i> <a href="<?php echo URL."blog/user/".$val['user']?>"><?php echo $val['name']?></a></li>
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
			
			<!--div class="section-title">
				<h2>التصنيف</h2>
				<p>الاكثر شهرة</p>
			</div>
			<div class="row">
				<div class="col-lg-4  col-md-6 d-flex align-items-stretch" data-aos="fade-up">
					<article class="entry">
						<div class="entry-img">
							<img src="<?php echo URL ?>public/IMG/blog/blog-1.jpg" alt="" class="img-fluid">
						</div>
						<h2 class="entry-title">
							<a href="blog-single.html">حول الهوية السودانية</a>
						</h2>
						<div class="entry-meta">
							<ul>
								<li class="d-flex align-items-center"><i class="icofont-user"></i> <a href="blog-single.html">رنا  مروان</a></li>
								<li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a href="blog-single.html"><time datetime="2020-08-22">اغسطس 22, 2020</time></a></li>
							</ul>
						</div>
						<div class="entry-content">
							<p>
								اقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيد.
							</p>
							<div class="read-more">
								<a href="blog-single.html">اقراء المزيد </a>
							</div>
						</div>
					</article><!-- End blog entry ->
				</div>
				<div class="col-lg-4  col-md-6 d-flex align-items-stretch" data-aos="fade-up">
					<article class="entry">
						<div class="entry-img">
							<img src="<?php echo URL ?>public/IMG/blog/blog-1.jpg" alt="" class="img-fluid">
						</div>
						<h2 class="entry-title">
							<a href="blog-single.html">حول الهوية السودانية</a>
						</h2>
						<div class="entry-meta">
							<ul>
								<li class="d-flex align-items-center"><i class="icofont-user"></i> <a href="blog-single.html">رنا  مروان</a></li>
								<li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a href="blog-single.html"><time datetime="2020-08-22">اغسطس 22, 2020</time></a></li>
							</ul>
						</div>
						<div class="entry-content">
							<p>
								اقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيد.
							</p>
							<div class="read-more">
								<a href="blog-single.html">اقراء المزيد </a>
							</div>
						</div>
					</article><!-- End blog entry ->
				</div>
				<div class="col-lg-4  col-md-6 d-flex align-items-stretch" data-aos="fade-up">
					<article class="entry">
						<div class="entry-img">
							<img src="<?php echo URL ?>public/IMG/blog/blog-1.jpg" alt="" class="img-fluid">
						</div>
						<h2 class="entry-title">
							<a href="blog-single.html">حول الهوية السودانية</a>
						</h2>
						<div class="entry-meta">
							<ul>
								<li class="d-flex align-items-center"><i class="icofont-user"></i> <a href="blog-single.html">رنا  مروان</a></li>
								<li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a href="blog-single.html"><time datetime="2020-08-22">اغسطس 22, 2020</time></a></li>
							</ul>
						</div>
						<div class="entry-content">
							<p>
								اقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيداقراء المزيد.
							</p>
							<div class="read-more">
								<a href="blog-single.html">اقراء المزيد </a>
							</div>
						</div>
					</article><!-- End blog entry ->
				</div>
			</div-->
		</div>
	</section><!-- End Blog Section -->
</main><!-- End #main -->


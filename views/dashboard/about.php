<main id="main">
	<!-- ======= Breadcrumbs ======= -->
	<section id="breadcrumbs" class="breadcrumbs">
		<div class="container">
			<div class="d-flex justify-content-between align-items-center">
				<h2>عن مدونة الحرف التاسع والعشرون 29</h2>
				<ol>
					<li><a href="<?php echo URL ?>">الرئيسية</a></li>
					<li>عن 29</li>
				</ol>
			</div>
		</div>
	</section><!-- End Breadcrumbs -->
		
	<!-- ======= About Section ======= -->
	<section id="about" class="about">
		<div class="container">
			<div class="row content">
				<h2>مدوّنة -الحرف التاسع والعشرون- 29</h2>
				<h3>هي مدوّنة أدبية مستقلّة، تُعنى بتجسير الفجوة بين الكتّاب والأدباء السودانيون وبين القارئ العربي من المحيط للخليج، وكل قرّاء العربية في المهجر.</h3>
			</div>
		</div>
	</section><!-- End About Section -->

    <!-- ======= Team Section ======= -->
    <section id="team" class="team section-bg">
		<div class="container">
			<div class="section-title">
				<p>فريق العمل</p>
			</div>

			<div class="row">
			<?php
				foreach($this->staff as $val)
				{
			?>
				<div class="col-lg-6 mb-3">
					<div class="member d-flex align-items-start">
						<div class="pic col-lg-3"><img src="<?php echo URL."public/IMG/users/".$val['staff_img'] ?>" class="img-fluid" alt=""></div>
						<div class="member-info col-lg-9">
							<h4><?php echo $val['staff_name']?></h4>
							<span><?php echo $val['staff_title']?></span>
							<p><?php echo str_replace("\n","<br/>",$val['staff_about']);?></p>
							<div class="social">
							<?php
								echo (!empty($val['staff_twitter']))?'<a href="'.$val['staff_twitter'].'" target="_blank"><i class="icofont-twitter"></i></a>':"";
								echo (!empty($val['staff_face']))?'<a href="'.$val['staff_face'].'" target="_blank"><i class="icofont-facebook"></i></a>':"";
								echo (!empty($val['staff_instagram']))?'<a href="'.$val['staff_instagram'].'" target="_blank"><i class="icofont-instagram"></i></a>':"";
								echo (!empty($val['staff_linked']))?'<a href="'.$val['staff_linked'].'" target="_blank"><i class="icofont-linkedin"></i></a>':"";
							?>
							</div>
						</div>
					</div>
				</div>
			<?php
				}
			?>
			</div>
		</div>
	</section><!-- End Team Section -->
</main><!-- End #main -->

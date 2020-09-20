<!-- ======= Top Bar ======= -->
<section id="topbar" class="d-none d-lg-block">
	<div class="container d-flex">
		<div class="contact-info mr-auto">
		<?php 
			if(session::get('user_type'))
			{
		?>
			<a href="<?php echo URL ?>login/logout"><i class="icofont-sign-out"></i> خروج </a>
		<?php
			}else{
		?>
			<a href="<?php echo URL ?>login"><i class="icofont-sign-in"></i> دخول</a>
			<a href="<?php echo URL ?>login/register"><i class="icofont-user"></i>تسجيل</a>
		<?php
			}
		?>
		</div>
	</div>
</section>
	
<!-- ======= Header ======= -->
<header id="header" class="header-inner-pages sticky-top">
	<div class="container d-flex align-items-center">

		<!--h1 class="logo"><a href="index.html">blog</a></h1-->
		<!-- Uncomment below if you prefer to use an image logo -->
		<a href="<?php echo URL ?>" class="logo"><img src="<?php echo URL ?>public/IMG/logo.png" alt="" class="img-fluid"></a>

		<nav class="nav-menu d-none mr-auto d-lg-block">
			<ul>
				<li><a href="<?php echo URL ?>dashboard/">الرئيسية</a></li>
			<?php
				if(session::get('user_type'))
				{
					switch(session::get('user_type'))
					{
						case "bloger":
							echo '<li><a href="'.URL.'home/">صفحتي </a></li>';
						break;
						case "accept":
						break;
						case "admin":
						break;
					}
				}
			?>
				<li><a href="<?php echo URL ?>blog/index">التدوينات</a></li>
			<?php
				foreach($this->menu as $val)
				{
					echo "<li><a href='".URL."blog/index/".$val['id']."'>".$val['name']."</a></li>";
				}
			?>
				<!--li class="drop-down"><a href="#">التصنيفات</a>
					<ul>
						<li><a href="#">تصنيف 1</a></li>
						<li><a href="#">تصنيف 1</a></li>
						<li><a href="#">تصنيف 1</a></li>
						<li><a href="#">تصنيف 1</a></li>
						<li><a href="#">تصنيف 1</a></li>
					</ul>
				</li-->
				<li><a href="<?php echo URL ?>dashboard/about">عن 29 </a></li>
				<li><a href="<?php echo URL ?>dashboard/contact">اتصل بنا</a></li>
			</ul>
		</nav><!-- .nav-menu -->
		<!--a href="index.html" class="get-started-btn ml-auto">Get Started</a-->
	</div>
</header><!-- End Header -->


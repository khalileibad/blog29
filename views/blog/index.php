<main id="main">
	<!-- ======= Breadcrumbs ======= -->
	<section id="breadcrumbs" class="breadcrumbs">
		<div class="container">
			<div class="d-flex justify-content-between align-items-center">
				<h2><?php echo (!empty($this->category))?"تدوينات ".$this->category['cat_name']:"كل التدوينات";?></h2>
				<ol>
					<li><a href="<?php echo URL;?>">الرئيسية</a></li>
				<?php
					if(!empty($this->category))
					{
						echo '<li><a href="'.URL.'blog/">التدوينات</a></li>';
						echo '<li>'.$this->category['cat_name'].'</li>';
					}else
					{
						echo "<li>التدوينات</li>";
					}
				?>
				</ol>
			</div>
			<div class="d-flex justify-content-between align-items-center">
				<?php echo (!empty($this->category['cat_desc']))?$this->category['cat_desc']:"";?>
			</div>
		</div>
	</section><!-- End Breadcrumbs -->

	<!-- ======= Blog Section ======= -->
	<input type="hidden" id="category" value="<?php echo (!empty($this->category))?$this->category['cat_id']:"0";?>" />
	<section id="blog_data" class="blog">
		
	</section><!-- End Blog Section -->
</main><!-- End #main -->

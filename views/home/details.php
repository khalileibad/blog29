<main id="main">
	<section id="testimonials" class="testimonials">
		<div class="container">
			<h2><?php echo $this->blog['title'];?></h2>
			<span class="d-flex align-items-center"><i class="icofont-like"></i><?php echo $this->blog['likes']?></span>
			<span class="d-flex align-items-center"><i class="icofont-eye"></i> <?php echo $this->blog['b_see']?></span>
			
			<div class="row">
				<div class="col-lg-8">
					<form id="upd_blog_form" action="<?php echo URL?>home/upd_blog" method="post" role="form" enctype="multipart/form-data" class="php-form">
						<input type="hidden" name="csrf" class="hid_info" value="<?php echo session::get('csrf'); ?>" />
						<input type="hidden" name="id" value="<?php echo $this->blog['id']; ?>" />
						<div class="form-row">
							<div class="col-md-6 form-group">
								<div class="text-center">
									<img id="blog_image" src="<?php echo URL."public/IMG/blog/".$this->blog['img']?>" width="200px" height="120px" class="rounded" alt="...">
								</div>
							</div>
							<div class="col-md-6 form-group">
								<label for="img">اختار صورة للتدوينة</label>
								<input type="file" name="blog_img" class="file-upload image_upload form-control-file" data-id="blog_image" id="img" accept="image/*">
								<div class="err_notification" id="valid_blog_img">هنالك خطأ في هذا الحقل</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-md-12 form-group">
								<label for="name">عنوان التدوينة</label>
								<input type="text" name="blog_name" class="form-control" id="name" value="<?php echo $this->blog['title'];?>" placeholder="عنوان التدوينة" data-rule="minlen:4" data-msg="من فضلك ادخل عنوان لا يقل عن 5 احرف" />
								<div class="err_notification" id="valid_blog_name">هنالك خطأ في هذا الحقل</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-md-12 form-group">
								<label for="content">المحتوى</label>
								<textarea class="form-control" id="blog_content" name="blog_content" data-rule="required" data-msg="من فضلك اكتب المحتوى" placeholder="اكتب رسالتك هنا ..."><?php echo $this->blog['text'];?></textarea>
								<div class="err_notification" id="valid_blog_content">هنالك خطأ في هذا الحقل</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-md-12 form-group">
								<label for="descriptison">وصف مختصر</label>
								<textarea class="form-control" id="blog_desc" name="blog_desc" data-rule="required" data-msg="من اكت الوصف المختصر للتدوينة" placeholder="اكتب رسالتك هنا ..."><?php echo $this->blog['desc'];?></textarea>
								<div class="err_notification" id="valid_blog_desc">هنالك خطأ في هذا الحقل</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-md-12 form-group">
								<label>التصنيفات</label>
								<ul class="list-inline">
								<?php
									foreach($this->menu as $val)
									{
										$ch = (in_array($val['id'],$this->blog['cat']))?" checked ":"";
										echo "<li><input class='' type='checkbox' name='category[]' ".$ch." value='".$val['id']."'/>".$val['name']."</li>";
									}
								?>
								</ul>
								<div class="err_notification" id="valid_category">هنالك خطأ في هذا الحقل</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-md-12 form-group">
								<label for="tag">الوسم (اضف فاصلة بين كل وسم واخر)</label>
								<input type="text" class="form-control" name="tag" id="tag" value="<?php echo $this->blog['keywords'];?>" placeholder="اكتب الوسم" data-rule="minlen:4" data-msg="من فضلك ادخل الوسم" />
								<div class="err_notification" id="valid_tag">هنالك خطأ في هذا الحقل</div>
							</div>
						</div>
						<div class="text-center"><button type="submit">تعديل التدوينة</button></div>
					</form>
				</div>
			</div>
			<div class="row">
				<div class="blog-comments" id="blog-comments">
					<h4 class="comments-count">التعليقات <?php echo count($this->blog['comment'])?></h4>
				<?php
					foreach($this->blog['comment'] as $val)
					{
				?>
					<div class="comment clearfix">
						<h5><a><?php echo $val['name']?></a></h5>
						<time datetime="<?php echo $val['date']?>"><?php echo $val['date']?></time>
						<p><?php echo $val['comm']?></p>
					</div><!-- End comment #1 -->
				<?php
					}
				?>
				</div><!-- End blog comments -->
			</div>
		</div>
	</section><!-- End profile Section -->
</main><!-- End #main -->

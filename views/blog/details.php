<main id="main">
	<!-- ======= Breadcrumbs ======= -->
	<section id="breadcrumbs" class="breadcrumbs">
		<div class="container">
			<div class="d-flex justify-content-between align-items-center">
				<h2><?php echo htmlspecialchars_decode($this->blog['title'])?></h2>
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
					<article class="entry entry-single">
						<div class="entry-img">
							<img src="<?php echo URL."public/IMG/blog/".$this->blog['img'] ?>" alt="" class="img-fluid rounded d-block w-100 h-100">
						</div>
						<h2 class="entry-title">
							<a><?php echo htmlspecialchars_decode($this->blog['title'])?></a>
						</h2>
						<div class="entry-meta">
							<ul>
								<li class="d-flex align-items-center"><a href="<?php echo URL."blog/user/".$this->blog['user']?>"><i class="icofont-user"></i> <?php echo $this->blog['name']?></a></li>
								<li class="d-flex align-items-center"><a><i class="icofont-wall-clock"></i> <time datetime="<?php echo $this->blog['publish']?>"><?php echo $this->blog['publish']?></time></a></li>
								<li class="d-flex align-items-center"><a id="add_like"><i class="icofont-like"></i> <i id="like_count"><?php echo $this->blog['likes']?></i></a></li>
								<li class="d-flex align-items-center"><a><i class="icofont-eye"></i> <?php echo $this->blog['b_see']?></a></li>
								<li class="d-flex align-items-center"><a href="#blog-comments"><i class="icofont-comment"></i><?php echo count($this->blog['comment'])?> </a></li>
							</ul>
						</div>
						<div class="entry-content">
							<?php echo htmlspecialchars_decode($this->blog['text']);?>
						</div>
						<div class="entry-footer clearfix">
							<div class="float-right">
								<i class="icofont-folder"></i>
								<ul class="cats">
								<?php 
									foreach($this->blog['cat'] as $value)
									{
										echo "<li><a href='".URL."blog/index/".$value['id']."'>".$value['name']."</a> , </li>";
									}
								?>
								</ul>
								<i class="icofont-tags"></i>
								<ul class="tags">
								<?php
									foreach(explode(",",$this->blog['keywords']) as $val)
									{
										echo '<li><a>'.$val.'</a></li>';
									}
								?>
								</ul>
							</div>
							<?php
								$share = URL."blog/details/".$this->blog['id'];
							?>
							<div class="float-left share">
								<a href="https://twitter.com/share?ref_src=twsrc%5Etfw&url=<?php echo $share ?>" title="Share on Twitter"><i class="icofont-twitter"></i></a>
								<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share ?>&amp;src=sdkpreparse" title="Share on Facebook"><i class="icofont-facebook"></i></a>
								<a href="mailto:?subject=I wanted you to see this site&amp;body=Check out this site <?php echo $share ?>&amp;src=sdkpreparse" title="Share on Facebook"><i class="icofont-email"></i></a>
								<!--a href="" title="Share on Instagram"><i class="icofont-instagram"></i></a-->
							</div>
						</div>
					</article><!-- End blog entry -->
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
						
					<div class="blog-comments" id="blog-comments">
						<h4 class="comments-count">التعليقات <?php echo count($this->blog['comment'])?></h4>
					<?php
						foreach($this->blog['comment'] as $val)
						{
					?>
						<div class="comment clearfix">
							<img src="<?php echo URL?>public/IMG/logo.png" class="comment-img  float-right" alt="">
							<h5><a><?php echo $val['name']?></a></h5>
							<time datetime="<?php echo $val['date']?>"><?php echo $val['date']?></time>
							<p><?php echo $val['comm']?></p>
							<!--Replay: -->
						<?php
							foreach($val['rep'] as $v)
							{
						?>
							<div id="comment-reply-1" class="comment comment-reply clearfix">
								<img src="<?php echo URL."public/IMG/users/".$this->blog['user_img'] ?>" class="comment-img  float-right" alt="">
								<h5><a href=""><?php echo $this->blog['name']?></a> <a class="reply"><i class="icofont-reply"></i> الرد</a></h5>
								<time datetime="<?php echo $v['date']?>"><?php echo $v['date']?></time>
								<p><?php echo $v['comm']?></p>
							</div><!-- End comment reply #1-->
						<?php
							}
						?>
						</div><!-- End comment #1 -->
					<?php
						}
					?>
							
						<div class="reply-form">
							<h4>اترك تعليقاَ</h4>
							<form id="blog_comment" method="post" role="form" class="php-form">
								<input type="hidden" class="hid_info" name="csrf" id="csrf" value="<?php echo session::get('csrf'); ?>" />
								<input type="hidden" id="blog_id" name="blog_id" value="<?php echo $this->blog['id']?>" />
								<div class="form-row">
									<div class="col-md-6 form-group">
										<input type="text" name="name" class="form-control" id="name" placeholder="الاسم" data-rule="minlen:4" data-msg="من فضلك ادخل 4 خروق على الاقل" />
										<div class="validate"></div>
									</div>
									<div class="col-md-6 form-group">
										<input type="email" class="form-control" name="email" id="email" placeholder="البريد الإلكترونى" data-rule="email" data-msg="من فضلك ادخل بريد الإلكترونى صحيح" />
										<div class="validate"></div>
									</div>
								</div>
								<div class="form-group">
									<textarea class="form-control" name="message" rows="2" data-rule="required" data-msg="Please write something for us" placeholder="التعليق *"></textarea>
									<div class="validate"></div>
								</div>
								<button type="submit" class="btn btn-primary">ارسل التعليق</button>
							</form>
						</div>
					</div><!-- End blog comments -->
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

<!-- Modal For contact -->
<div id="comm_ok" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">اتصل بنا</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>تم ارسال رسالتك بنجاح .. شكراَ!, سيتم مراجعتها من قبل ادارة النظام ثم عرضها</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
			</div>
		</div>
	</div>
</div>	

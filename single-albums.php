<?php get_header(); ?>

<div id="single-albums">
<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
	<?php 	$images = get_field('images'); 
			$total_number = count($images);
	?>



	<?php if ($images) : ?>
		<section id="slider" class="flexslider">
			<ul class="slides">
				<?php foreach( $images as $image ): ?>
					<li data-id="<?php echo $image['id']; ?>">


						<picture>
							<!--[if IE 9]><video style="display: none;"><![endif]-->
							<source srcset="<?php echo $image['sizes']['massive-image']; ?>" media="(min-width: 1600px)">
							<source srcset="<?php echo $image['sizes']['desktop']; ?>" media="(min-width: 1000px)">
							<source srcset="<?php echo $image['sizes']['tablet']; ?>" media="(min-width: 500px)">
							<source srcset="<?php echo $image['sizes']['mobile']; ?>" media="(min-width: 300px)">
							<!--[if IE 9]></video><![endif]-->
							<span class="vertical"></span><img srcset="<?php echo $image['url']; ?>" alt="<?php echo $image['title']; ?>" />
						</picture>

						<button aria-label="Add to lightbox"  class="lightbox-add icon-plus button calign" data-id="<?php echo $image['id']; ?>"></button>
						<div class="modal midway-horizontal midway-vertical">
							<p class="message success"></p>
						</div>

						<?php if($image['description']): ?>
							<div class="desc-overlay">
								<div class="center midway-horizontal midway-vertical">
									<div class="description">
										<button class="button">
											<i class="icon-cross"></i>
										</button>

										<h3><?php echo $image['title']; ?></h3>
										<p>
											<?php echo $image['description']; ?>
										</p>								
									</div>
								</div>
							</div>
						<?php endif; ?>							
					</li>
				<?php endforeach;?>
			</ul>
		<footer>
			<button aria-label="Gallery Toggle" class="toggle-gallery button">All Images</button>
			<button aria-label="Switch Colour" class="color-toggle button" >Background</button>
			<button aria-label="Add to lightbox" class="add button" data-id="">Add to Lightbox</button>
			<button aria-label="Show description" class="info button">Info</button>

			<span class="gallery-meta">
				<span class="count"></span>&nbsp;of <?php echo $total_number; ?> -
				<span class="title"></span>
			</span>
		</footer><!-- end footer -->
		</section><!-- end of flexslider -->	

 	<section id="gallery-content" class="clearfix">
		<div class="summary left">
			<h2>
				<?php the_title(); ?>
			</h2>
			<?php the_content(); ?>
		</div>


		<div class="gallery">
			<ul class="clearfix">
				<?php foreach( $images as $image ): ?>
					<li class="column col-1-3" data-id="<?php echo $image['id']; ?>">
						<span class="vertical"></span><a href="#" >
							<img class="lazy"  src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo $image['sizes']['grid-item']; ?>" alt="<?php echo $image['alt']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>">
							<i class="valign">View Image</i>
						</a>
					</li>
				<?php endforeach;?>
			</ul>
		</div>

	<?php endif; ?>
	</section><!-- end of album content -->

<?php endwhile; endif; ?>	
</div><!-- end of #single-albums -->

<?php get_footer(); ?>
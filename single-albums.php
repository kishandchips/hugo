<?php get_header(); ?>
<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
	<?php 	$images = get_field('images'); 
			$total_number = count($images);
	?>

	<?php if ($images) : ?>
		<section class="flexslider">
			<ul class="slides">
				<?php foreach( $images as $image ): ?>
					<li data-id="<?php echo $image['id']; ?>">
						<div class="image">
							<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['title']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>"  >							
							<a class="lightbox-btn" href="#" data-id="<?php echo $image['id']; ?>">Save to Lightbox</a>
							<div class="modal">
								<p class="message success"></p>
							</div>
						</div>
					</li>
				<?php endforeach;?>
			</ul>

		<footer>
			<a href="#" class="toggle-gallery">All Images</a>
			<span class="gallery-meta"><?php gallery_meta() ?>&nbsp;
				<span class="count"></span>
				&nbsp;of <?php echo $total_number; ?> -
				<span class="title">&nbsp;<?php echo $image['title']; ?></span>
			</span>
		</footer>
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
						<a href="#" >
							<span class="vertical"></span><img class="b-lazy" src=data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw== data-src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>">
						</a>
					</li>
				<?php endforeach;?>
			</ul>
		</div>
	<?php endif; ?>
	</section><!-- end of album content -->

<?php endwhile; endif; ?>
<?php get_footer(); ?>
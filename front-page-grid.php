<?php get_header(); ?>

<div id="home">
<?php
	$pageid =$post->ID;
?>

<div class="splash">
	<div class="valign">
		<h1 class="splashdamage">Hugo Rittson-Thomas</h1>
	</div>
</div>


<section class="album-grid clearfix">
	<?php $terms = get_terms( 'album-category' ) ?>

	<?php foreach ($terms as $term) : ?>
		<div class="album-cat">
			<header>
				<h2><?php echo $term->name; ?></h2>	
			</header>
		
			<?php $query = new WP_Query(array(
					'post_type' => 'albums',
					'posts_per_page' => -1,
					'album-category' => $term->slug
				)); 
			?>
			<div class="album-items clearfix">
				<?php if($query->have_posts()): while($query->have_posts()): $query->the_post(); ?>
				<?php $images = get_field('images', $post->ID); ?>

				<?php if($images): ?>
					<?php foreach ($images as $image):?>
						<div class="item" data-id="<?php echo $image['id']; ?>">
							<a href="<?php the_permalink(); ?>">
								<div class="overlay">
									<span class="vertical"></span><span><?php echo $image['title']; ?></span>
								</div>
								<img class="lazy" data-src="<?php echo $image['sizes']['grid-item'] ?> " alt="<?php echo $image['alt']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height'];?>" src=data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==>
							</a>
						</div>							
					<?php endforeach; ?>				
				<?php endif; ?>
				<?php endwhile; endif; ?>
			</div><!-- album-items -->
		</div><!-- album-cat-->
	<?php endforeach; ?>


</section><!-- end of album-grid -->	
</div>

<?php get_footer(); ?>
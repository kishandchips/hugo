<?php get_header(); ?>
<?php
	$pageid =$post->ID;
?>

<div class="splash">
	<div class="valign">
		<h1 class="splashdamage">Hugo Rittson-Thomas</h1>
	</div>
</div>

<section class="album-grid clearfix">
	<?php  
		
		$query = new WP_Query(array(
			'post_type' => 'albums',
			'post_status' => array('publish'),
	    ));
	?>
	<?php while($query->have_posts()): $query->the_post(); ?>
	<section class="album">
		<header>
		<?php the_title(); ?>		
		</header>
		<div class="album-images">
			
		</div>
	</section>
	<?php endwhile; ?>
</section>
<!-- end of albums -->
<?php get_footer(); ?>
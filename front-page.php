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

<?php query_posts(array( 
	'post_type' => 'albums',
	'posts_per_page' => -1,
	'post_parent' => 0
)); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<section class="album">
		<header>
			<h2>
				<?php the_title(); ?>					
			</h2>
		</header>

		<?php 
	        $args=array(
	                'orderby' => 'menu_order',
	                'order' => 'ASC',
	                'posts_per_page' => -1,
	                'post_type' => 'albums',
	                'post_parent' => $post->ID
	        );

	        $childpages = new WP_Query($args);
		?>

		<?php while ($childpages->have_posts()): $childpages->the_post() ?>

		<?php
			$args = array(
				'post_type' => 'attachment',
				'numberposts' => -1,
				'post_parent' => $post->ID,
				'exclude' => get_post_thumbnail_id( $post->ID )
			);

			$attachments = get_children($args);
			if ($attachments) {
				foreach ($attachments as $attachment) {
					echo '<p>';
					the_attachment_link($attachment->ID, false);
					echo '</p>';
					echo '<pre>';
					var_dump($attachment);					
					echo '</pre>';
				}
			}
		?>

		<?php endwhile; ?>
	</section>
<?php endwhile; endif; ?>


</section>
<!-- end of albums -->
<?php get_footer(); ?>
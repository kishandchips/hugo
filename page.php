<?php global $post; ?>
<?php get_header(); ?>
<div id="page">
	<div id="header">
		<h1 class="site-title"><?php wp_title(); ?> </h1>
	</div>
	<div class="inner container">
		<?php while ( have_posts() ) : the_post(); ?>
		<div id="content">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	
				<div class="page-content">
					<?php the_content(); ?>
				</div>
			
			</article>
		</div>
	<?php endwhile; // end of the loop. ?>

</div><!-- #single -->
<?php get_footer(); ?>
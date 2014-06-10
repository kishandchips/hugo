<?php get_header(); ?>

<?php
	$args = array(		
		//Type & Status Parameters
		'post_type'   => 'albums',
		'post_status' => 'any',
		
		//Pagination Parameters
		'posts_per_page'         => 10,
		'posts_per_archive_page' => 10,
		'nopaging'               => false,
		'paged'                  => get_query_var('paged'),	
	);
	
	$query = new WP_Query( $args );
?>

<?php if ($query->have_posts()) : while($query->have_posts()) : $query->the_post(); ?>
	<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
<pre>

</pre>
	
<?php endwhile; endif; ?>

<?php get_footer(); ?>
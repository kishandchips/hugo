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
			<?php the_title(); ?>		
			</header>
			<?php 
			        $args=array(
			                'orderby' => 'menu_order',
			                'order' => 'ASC',
			                'posts_per_page' => 3,
			                'post_type' => get_post_type( $post->ID ),
			                'post_parent' => $post->ID
			        );

			        $childpages = new WP_Query($args);

			        if($childpages->post_count > 0) {
			            echo "<ul>";
			            while ($childpages->have_posts()) {
			                 $childpages->the_post();
			                 echo "<li>".get_the_title()."</li>";

			            }
			            echo "</ul>";

			            echo "Josh";
			        }
			        
			 ?>
		</section>
	<?php endwhile; endif; ?>
</section>
<!-- end of albums -->
<?php get_footer(); ?>
<?php

get_header(); ?>

	<section id="archive-grid">
		<div id="content" class="isotope" role="main">

			<?php 
				$wp_query->query_vars["posts_per_page"] = -1;
			?>		

		    <?php 
				$i = 1;
				$array = array(1,4,7,10);
			?> 	
			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

						<article id="post-<?php the_ID(); ?>" class="image item column  <?php if (in_array($i, $array)){echo 'col-1-2 large';} else {echo 'col-1-4 small';} ?>">
							<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
							<a class="image-popup-vertical-fit" rel="prettyPhoto[pp_gal]" href="<?php echo $image[0]; ?>" title="<?php the_title(); ?>">
								<?php if (in_array($i, $array)): ?>
										<?php the_post_thumbnail('press-large'); ?>
								<?php else: ?>
										<?php the_post_thumbnail('press-medium'); ?>								
								<?php endif; ?>
								<div class="overlay"></div>
								<figcaption class="valign">
									<h2><?php the_title(); ?></h2>
								</figcaption>			
			                </a>
						</article>

					<?php $i++; ?>
				<?php endwhile; ?>		

			<?php endif; ?>				
		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_footer(); ?>
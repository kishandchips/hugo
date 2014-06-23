<?php get_header(); ?>

<div id="home">
<?php
	global $post;
	$pageid =$post->ID;
?>

	<div class="splash">
		<div class="valign">
			<h1 class="splashdamage">Hugo Rittson-Thomas</h1>
		</div>
	</div>

	<div class="albums clearfix">

		<div class="column col-1-2">
			<div class="album sizetwo" style="background-image:url(<?php the_field('formal_portraits_bg', $pageid) ?>)">
				<div class="background"></div>
				<div class="overlay"></div>

				<div class="valign">
					<ul class="category-links">
						<li class="heading">Formal Portraits</li>
						<?php  
							$query = new WP_Query(array(
								'tax_query' => array(
							        array(
							        'taxonomy' => 'album-category',
							        'field' => 'slug',
							        'terms' => 'formal portraits',
							    ))
						    ));
						?>
						<?php while($query->have_posts()): $query->the_post(); ?>
							<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );	?>
							<li data-bg="<?php echo $url; ?>">
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
							</li>
						<?php endwhile; ?>						
					</ul>
				</div>
			</div>	
			<!-- end of formal portraits -->

			<div class="album sizeone" style="background-image:url(<?php the_field('nature_bg', $pageid) ?>)">
				<div class="background"></div>
				<div class="overlay"></div>

				<div class="valign">
					<ul class="category-links">
						<li class="heading">Nature</li>
						<?php  
							$query = new WP_Query(array(
								'tax_query' => array(
							        array(
							        'taxonomy' => 'album-category',
							        'field' => 'slug',
							        'terms' => 'nature',
							    ))
						    ));
						?>
						<?php while($query->have_posts()): $query->the_post(); ?>
							<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );	?>
							<li data-bg="<?php echo $url; ?>">
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
							</li>
						<?php endwhile; ?>						
					</ul>
				</div>
			</div>
			<!-- end of nature -->

		</div><!-- left -->
		
		<div class="column col-1-2">
			<div class="album sizeone" style="background-image:url(<?php the_field('features_bg', $pageid) ?>)">
				<div class="background"></div>
				<div class="overlay"></div>

				<div class="valign">
					<ul class="category-links">
						<li class="heading">Features</li>
						<?php  
							$query = new WP_Query(array(
								'tax_query' => array(
							        array(
							        'taxonomy' => 'album-category',
							        'field' => 'slug',
							        'terms' => 'features',
							    ))
						    ));
						?>	
						<?php while($query->have_posts()): $query->the_post(); ?>
							<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );	?>
							<li data-bg="<?php echo $url; ?>">
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
							</li>
						<?php endwhile; ?>						
					</ul>	
				</div>
			</div>
			<!-- end of features -->

			<div class="album sizetwo" style="background-image:url(<?php the_field('lifestyle_portraits_bg', $pageid) ?>)">
				<div class="background"></div>
				<div class="overlay"></div>

				<div class="valign">
					<ul class="category-links">
						<li class="heading">Lifestyle Portraits</li>
						<?php  
							$query = new WP_Query(array(
								'tax_query' => array(
							        array(
							        'taxonomy' => 'album-category',
							        'field' => 'slug',
							        'terms' => 'lifestyle portraits',
							    ))
						    ));
						?>
						<?php while($query->have_posts()): $query->the_post(); ?>
							<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );	?>
							<li data-bg="<?php echo $url; ?>">
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
							</li>
						<?php endwhile; ?>						
					</ul>
				</div>
			</div>
			<!-- end of lifestyle portraits -->

		</div><!-- right -->

		<div class="column col-full">
			<div class="album sizethree" style="background-image:url(<?php the_field('landscapes_bg', $pageid) ?>)">
				<div class="background"></div>
				<div class="overlay"></div>

				<div class="valign">
					<ul class="category-links">
						<li class="heading">Landscapes</li>
						<?php  
							$query = new WP_Query(array(
								'tax_query' => array(
							        array(
							        'taxonomy' => 'album-category',
							        'field' => 'slug',
							        'terms' => 'landscapes',
							    ))
						    ));
						?>
						<?php while($query->have_posts()): $query->the_post(); ?>
							<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );	?>
							<li data-bg="<?php echo $url; ?>">
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
							</li>
						<?php endwhile; ?>						
					</ul>
				</div>
			</div>
			<!-- end of landscapes -->

		</div>
		<!-- bottom -->
	</div>
	<!-- end of albums -->	
</div>

<?php get_footer(); ?>
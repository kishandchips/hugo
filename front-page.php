<?php get_header(); ?>

<div id="home">
<?php
	global $post;
	$pageid =$post->ID;
?>

	<div class="splash">
		<div class="valign">
			<h1 class="splashdamage">Hugo Rittson Thomas</h1>
		</div>
	</div>
	<div class="fadeIn"></div>
	<style>
		#exhibition {
			background: #f3f3ee;
			text-align: center;
			padding: 33px;
			line-height: 2;
		}

		#exhibition strong {
			font-size: 16.55px;
		}

		#exhibition a {
			text-decoration: underline;
		}

		#exhibition small {
			font-weight: normal;
			font-size: 14.5px;
		};
	</style>
	<div id="exhibition">
		<strong>Visit Hugo Rittson Thomas’s exhibition of <i>The Queen’s People</i> at the <a href="https://www.google.co.uk/maps/place/Eleven/@51.4943726,-0.1479269,17z/data=!3m1!4b1!4m2!3m1!1s0x487605220dc96543:0xc36d5e084e063c02" target="_blank">Eleven Gallery, 11 Eccleston Street, London SW1 9LX</a> 19 August – 19 September 2015</strong><br>
		<small>For further information contact Susannah Haworth  +44 (0)20 7823 5540 <a href="mailto:susannah@elevenfineart.com">susannah@elevenfineart.com</a></small><br>
		<a href="http://www.elevenfineart.com" target="_blank">www.elevenfineart.com</a>
	</div>

	<div class="albums clearfix">

		<div class="column col-1-2">
			<div class="album sizetwo" style="background-image:url(<?php the_field('formal_portraits_bg', $pageid) ?>)">
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
				<div class="background">
						<?php $i=0; ?>
						<?php while($query->have_posts()): $query->the_post(); ?>
							<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );	?>
						<?php $i++; ?>
							<div class="bg" data-bg="<?php echo $i; ?>" style="background-image:url(<?php echo $url; ?>)"></div>
						<?php endwhile; ?>	
				</div>
				<div class="overlay"></div>

				<div class="valign">
					<ul class="category-links">
						<li class="heading">Formal Portraits</li>
						<?php $i=0; ?>
						<?php while($query->have_posts()): $query->the_post(); ?>
						<?php $i++; ?>
							<li data-bg="<?php echo $i; ?>">
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
							</li>
						<?php endwhile; ?>						
					</ul>
				</div>
			</div>	
			<!-- end of formal portraits -->

			<div class="album sizeone" style="background-image:url(<?php the_field('nature_bg', $pageid) ?>)">
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
				<div class="background">
						<?php $i=0; ?>
						<?php while($query->have_posts()): $query->the_post(); ?>
							<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );	?>
						<?php $i++; ?>
							<div class="bg" data-bg="<?php echo $i; ?>" style="background-image:url(<?php echo $url; ?>)"></div>
						<?php endwhile; ?>	
				</div>
				<div class="overlay"></div>

				<div class="valign">
					<ul class="category-links">
						<li class="heading">Nature</li>
						<?php $i=0; ?>
						<?php while($query->have_posts()): $query->the_post(); ?>
						<?php $i++; ?>
							<li data-bg="<?php echo $i; ?>">
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
				<?php  
					$query = new WP_Query(array(
						'tax_query' => array(
					        array(
					        'taxonomy' => 'album-category',
					        'field' => 'slug',
					        'terms' => 'features',
					        'orderby' => 'menu_order',
					        'order' => 'DESC'
					    ))
				    ));
				?>	
				<div class="background">
						<?php $i=0; ?>
						<?php while($query->have_posts()): $query->the_post(); ?>
							<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );	?>
						<?php $i++; ?>
							<div class="bg" data-bg="<?php echo $i; ?>" style="background-image:url(<?php echo $url; ?>)"></div>
						<?php endwhile; ?>	
				</div>
				<div class="overlay"></div>

				<div class="valign">
					<ul class="category-links">
						<li class="heading">Features</li>
						<?php $i=0; ?>
						<?php while($query->have_posts()): $query->the_post(); ?>
						<?php $i++; ?>
							<li data-bg="<?php echo $i; ?>">
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
							</li>
						<?php endwhile; ?>						
					</ul>	
				</div>
			</div>
			<!-- end of features -->
			
			<div class="album sizetwo" style="background-image:url(<?php the_field('lifestyle_portraits_bg', $pageid) ?>)">
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
				<div class="background">
						<?php $i=0; ?>
						<?php while($query->have_posts()): $query->the_post(); ?>
							<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );	?>
						<?php $i++; ?>
							<div class="bg" data-bg="<?php echo $i; ?>" style="background-image:url(<?php echo $url; ?>)"></div>
						<?php endwhile; ?>	
				</div>
				<div class="overlay"></div>

				<div class="valign">
					<ul class="category-links">
						<li class="heading">Lifestyle Portraits</li>
						<?php $i=0; ?>
						<?php while($query->have_posts()): $query->the_post(); ?>
						<?php $i++; ?>
							<li data-bg="<?php echo $i; ?>">
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
				<div class="background">
						<?php $i=0; ?>
						<?php while($query->have_posts()): $query->the_post(); ?>
							<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );	?>
						<?php $i++; ?>
							<div class="bg" data-bg="<?php echo $i; ?>" style="background-image:url(<?php echo $url; ?>)"></div>
						<?php endwhile; ?>	
				</div>
				<div class="overlay"></div>

				<div class="valign">
					<ul class="category-links">
						<li class="heading">Landscapes</li>
						<?php $i=0; ?>
						<?php while($query->have_posts()): $query->the_post(); ?>
						<?php $i++; ?>
							<li data-bg="<?php echo $i; ?>">
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
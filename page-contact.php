<?php
/*
Template Name: Contact
*/
?>
<?php get_header(); ?>

<div id="contact" class="container">
<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
	<?php $image = get_field('contact_image'); ?>
	<header>
		<div class="bio column col-1-2 equal-height">
			<?php the_content(); ?>	
		</div>
		<figure class="column col-1-2 slowfade equal-height" style="background-image: url(<?php echo $image['url']; ?>)">
		</figure>
	</header>
	
	<section class="contact-section">
			<div class="details column col-1-2">
				<div class="detail">
					<i class="icon-phone"></i>
					<h3>Call Us</h3>
					<p><?php the_field('contact_number') ?></p>
				</div>
				<div class="detail">
					<i class="icon-mail"></i>
					<h3>Email</h3>
					<p><a href="mailto:<?php the_field('contact_email') ?>"><?php the_field('contact_email') ?></a></p>					
				</div>
				<div class="detail">
					<i class="icon-map"></i>
					<h3>Visit</h3>
					<p><a href="<?php the_field('address_link') ?>" title="Hugo Rittson Photography Studio Address" target="_blank"><?php the_field('contact_address') ?></a></p>
				</div>
			</div>	
			<div class="form column col-1-2">
				<?php gravity_form(2, true, true, false, '', true); ?>
			</div>
	</section>		
<?php endwhile; endif; ?>	
</div>

<?php get_footer(); ?>
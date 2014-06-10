<?php
/*
Template Name: Contact
*/
?>
<?php get_header(); ?>
<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
	<div class="bio-section" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/hugo2bsedit.jpg)">
		<div class="bio-text">
			<?php the_content(); ?>	
		</div>
	</div>
	<div class="contact-section">
			<div class="contact-details column col-2-5">
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
			<div class="form-section column col-3-5">
				<?php gravity_form(2, true, true, false, '', false); ?>
			</div>
	</div>
<?php endwhile; endif; ?>
<?php get_footer(); ?>
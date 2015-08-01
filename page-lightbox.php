<?php
/*
Template Name: Lightbox
*/
?>
<?php get_header(); ?>

<?php 	lightbox_images(); 
		$total_number = count($lightbox_images);
?>

<?php if ( $lightbox_images ) : ?>
<div id="lightbox">
	<div class="lightbox-form-wrapper">
		<div class="lightbox-form">
			<button aria-label="Lightbox Toggle" class="lightbox-toggle icon-cross button"></button>
			<?php gravity_form(1, true, true, false, '', true); ?>		
		</div>
	</div><!-- end of lightbox-wrapper -->

	<section id="slider" class="flexslider">
		<ul class="slides">
			<?php foreach( $lightbox_images as $image ): ?>
				<li data-id="<?php echo $image ?>">
					<span class="vertical"></span><?php echo wp_get_attachment_image($image,'full'); ?>
					<button aria-label="Remove from lightbox" class="lightbox-remove icon-minus button midway-horizontal midway-vertical" data-id="<?php echo $image ?>"></button>					
				</li>
			<?php endforeach;?>
		</ul>		
		<footer>
			<button aria-label="Gallery Toggle" class="toggle-gallery button">All Images</button>
			<button aria-label="Switch Colour" class="color-toggle button">Background</button>
			<button aria-label="Remove from lightbox" class="remove button" data-id="">Remove from Lightbox</button>
		</footer><!-- end of footer -->
	</section><!-- end of #slider -->

	<section id="gallery-content" class="clearfix">
		<div class="gallery column col-full">
			<ul class="clearfix">
				<?php foreach( $lightbox_images as $image ): ?>
					<?php if($image !== '0') : ?>
					<li class="column col-1-6" data-id="<?php echo $image ?>">
						<span class="vertical"></span><a href="#" >
							<?php echo wp_get_attachment_image( $image, 'full' ); ?>
						</a>
					</li>
					<?php endif; ?>
				<?php endforeach;?>
			</ul>
		</div>
		<footer>
			<button aria-label="Lightbox Toggle" class="lightbox-toggle button">Share</button>
			<button aria-label="Switch Colour" class="color-toggle button" >Background</button>
			<button aria-label="Clear Selection" class="lightbox-clear btn" >Clear Selection</button>
		</footer>
	</section><!-- end of #gallery-content -->
</div><!-- end of #lightbox -->

<?php else : ?>
	<div class="instructions">
<!-- 		<header>
			<h2 class="title">My Favourites</h2>
		</header> -->

		<div class="frame">
			<div class="row">
				<div class="column col-full">
					<h2 class="big">Save images here for later</h2>
				</div>
				
				<div class="column col-1-3">
					<img src="<?php echo get_template_directory_uri(); ?>/img/step1.png" alt="">
					
					<p><strong>1.</strong>Hover over any image and add it to your lightbox by clicking the icon.</p>
				</div>
				<div class="column col-1-3">
					<img src="<?php echo get_template_directory_uri(); ?>/img/step2.png" alt="">
					
					<p><strong>2.</strong>Images will be saved to the lightbox page for future reference.</p>
				</div>
				<div class="column col-1-3">
					<img src="<?php echo get_template_directory_uri(); ?>/img/step3.png" alt="">
					
					<p><strong>3.</strong>Click the share icon and share your collection with your friends.</p>
				</div>
			</div>			
		</div>
	</div><!-- end of instructions -->
<?php endif; ?>

<?php get_footer(); ?>
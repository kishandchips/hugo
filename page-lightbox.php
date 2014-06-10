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
	<section class="flexslider">
		<ul class="slides">
			<?php foreach( $lightbox_images as $image ): ?>
				<li>
					<div class="image valign">
						<?php echo wp_get_attachment_image($image,'full'); ?>
						<a class="lightbox-remove" href="#" data-id="<?php echo $image ?>">Remove from Lightbox</a>
					</div>
				</li>
			<?php endforeach;?>
		</ul>		
		<footer>
			<a href="#" class="toggle-gallery">All Images</a>
		</footer>
	</section><!-- end of flexslider -->

	<section id="gallery-content" class="clearfix">
		<div class="gallery column col-full">
			<ul class="clearfix">
				<?php foreach( $lightbox_images as $image ): ?>
					<?php if($image !== '0') : ?>
					<li class="column col-1-6">
						<a href="#" >
							<span class="vertical"></span><?php echo wp_get_attachment_image( $image, 'full' ); ?>
						</a>
					</li>
					<?php endif; ?>
				<?php endforeach;?>
			</ul>
		</div>
		<div class="lightbox-actions">
			<?php gravity_form(1, false, false, false, '', false); ?>
			<a href="" class="clear-selection btn">Clear Selection</a>
		</div>
	</section><!-- end of lightbox content -->

<?php else : ?>
	<div class="lightbox">
	<header>
		<h2 class="title">My Lightbox</h2>
	</header>
		<div class="frame">
			<div class="row">
				<div class="column col-full">
					<h2 class="big">Save images here for later</h2>
				</div>
				
				<div class="column col-1-3">
					<strong>1</strong>
					<p>Click the "Save to Lightbox" link under any image you are interested in</p>
				</div>
				<div class="column col-1-3">
					<strong>2</strong>
					<p>Images will be saved to this page for future reference</p>
				</div>
				<div class="column col-1-3">
					<strong>3</strong>
					<p>You can also share your lightbox with others by email</p>
				</div>
			</div>			
		</div>
	</div><!-- end of instructions -->
<?php endif; ?>

<?php get_footer(); ?>
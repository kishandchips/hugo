<?php
/*
Template Name: Lightbox
*/
?>
<?php get_header(); ?>

<div id="lightbox">
<?php 	lightbox_images(); 
		$total_number = count($lightbox_images);
?>

<?php if ( $lightbox_images ) : ?>

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
					<div class="image">
						<?php echo wp_get_attachment_image($image,'full'); ?>
						<button aria-label="Remove from lightbox" class="lightbox-remove icon-minus button calign" href="#" data-id="<?php echo $image ?>"></button>					
					</div>
				</li>
			<?php endforeach;?>
		</ul>		
		<footer>
			<button aria-label="Gallery Toggle" class="toggle-gallery button">All Images</button>
			<button aria-label="Switch Colour" class="color-toggle button">Background</button>
		</footer>
	</section><!-- end of flexslider -->

	<section id="gallery-content" class="clearfix">
		<div class="gallery column col-full">
			<ul class="clearfix">
				<?php foreach( $lightbox_images as $image ): ?>
					<?php if($image !== '0') : ?>
					<li class="column col-1-6" data-id="<?php echo $image ?>">
						<a href="#" >
							<span class="vertical"></span><?php echo wp_get_attachment_image( $image, 'full' ); ?>
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
	</section><!-- end of lightbox content -->

<?php else : ?>
	<div class="lightbox">
		<header>
			<h2 class="title">My Favourites</h2>
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
</div>

<?php get_footer(); ?>
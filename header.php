<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0" />
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
<title><?php wp_title('-','true','right'); ?></title>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="js-loader">
</div>
<?php if(get_field('bg_color')): ?>
	<?php $bgcolor = get_field('bg_color'); ?>
<?php endif; ?>
<div id="weezy" class="<?php echo $bgcolor; ?>">
	<header id="header" >
		<div class="wrapper clearfix">
			<div class="logo left">
				<a href="<?php echo home_url(); ?>">
					<i class="icon-logo"></i>
					<i class="icon-home"></i>
				</a>
			</div>
			<?php 
				$args = array(
					'theme_location' => 'header_menu',
					'menu' => '',
					'container' => 'nav',
					'container_class' => 'links right',
				);
			
				wp_nav_menu( $args ); 
			?>
		</div>
	</header>			

	<main id="main" class="clearfix">
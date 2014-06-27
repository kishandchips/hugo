<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0" />
<title><?php wp_title('-','true','right'); ?><?php bloginfo('name'); ?></title>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="weezy">
	<header id="header" >
		<div class="wrapper clearfix">
			<div class="logo left">
				<a href="<?php echo home_url(); ?>">
					<i class="icon-logo"></i>
					<i class="icon-home"></i>
					<!-- <img src="<?php echo get_template_directory_uri(); ?>/img/logo.png"  alt="Hugo Rittson Photography"> -->
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
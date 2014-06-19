<!DOCTYPE html>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title('-','true','right'); ?><?php bloginfo('name'); ?></title>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="weezy">
	<header id="header" >
		<div class="logo left">
			<a href="<?php echo home_url(); ?>">
				<img src="<?php echo get_template_directory_uri(); ?>/img/logo.png"  alt="Hugo Rittson Photography">
			</a>
		</div>
		<div class="links right">
			<a class="menu-button" href="#" title="Galleries">Galleries</a>
			<a href="<?php bloginfo('url'); ?>/lightbox" title="Lightbox">Lightbox<span class="counter"></span></a>
			<a href="<?php bloginfo('url'); ?>/contact" title="Galleries">Contact</a>
		</div>
	</header>	

	<main id="main" class="clearfix">
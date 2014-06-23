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
		<div class="wrapper">
			<div class="logo left">
				<a href="<?php echo home_url(); ?>">
					<i class="icon-logo"></i>
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
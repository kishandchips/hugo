	</main>
</div><!-- weezy baby -->

<div id="overlaymenu">

	<header class="clearfix">
		<div class="logo left">
		<a href="#">
			<img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="">
		</a>
		</div>
		<div class="right">
			<a class="menu-button" href="">Close Menu</a>
		</div>
	</header>

	<div class="valign">
		<h2>Galleries</h2>
		<?php 
			$args = array(
				'theme_location' => 'overlay_menu_l',
				'menu' => '',
				'container' => 'nav',
			);
		
			wp_nav_menu( $args ); 
		?><!-- LEFT MENU -->
		<?php 
			$args = array(
				'theme_location' => 'overlay_menu_r',
				'menu' => '',
				'container' => 'nav',
			);
		
			wp_nav_menu( $args ); 
		?><!-- RIGHT MENU -->
	</div>

</div><!-- OVERLAY MENU -->

<div class="modal">
	<p class="message success"></p>
</div><!-- MODAL -->

<?php wp_footer(); ?>
</body>
</html>
	</main>
</div><!-- weezy baby -->

<div id="overlaymenu">

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

<?php wp_footer(); ?>
</body>
</html>
<?php
require_once( dirname(__file__) . '/lavatheme/functions.php' );

class Volcanic_Pixels_Canvas extends Volcanic_Pixels_Theme {
	function register_nav_menus() {
		register_nav_menu( 'primary', 'Primary Menu' );
	}

	function do_scripts() {
		wp_register_script( 'modernizr', self::get_url( '/js/modernizr.js' )  );
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'modernizr' );
	}

	function primary_menu() {
		wp_nav_menu( array( 'theme_location' => 'primary' ) );
	}
}
$theme = new Volcanic_Pixels_Canvas();
?>
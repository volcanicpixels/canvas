<?php
require_once( dirname(__file__) . '/lavatheme/functions.php' );

class Volcanic_Pixels_Canvas extends Volcanic_Pixels_Theme {
	function admin_menu() {
		$this->change_post_menu_label();
	}

	function init() {
		$this->change_post_object_label();
	}

	function do_scripts() {
		wp_register_script( 'modernizr', self::get_url( '/js/modernizr.js' )  );
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'modernizr' );
	}

	function change_post_menu_label() {
		global $menu;
		global $submenu;
		$menu[5][0] = 'Articles';
		$submenu['edit.php'][5][0] = 'Articles';
		$submenu['edit.php'][10][0] = 'Add Article';
		$submenu['edit.php'][16][0] = 'Article Tags';
		echo '';
	}
	function change_post_object_label() {
		global $wp_post_types;
		$labels = &$wp_post_types['post']->labels;
		$labels->name = 'Articles';
		$labels->singular_name = 'Article';
		$labels->add_new = 'Add Article';
		$labels->add_new_item = 'Add Article';
		$labels->edit_item = 'Edit Article';
		$labels->new_item = 'Article';
		$labels->view_item = 'View Article';
		$labels->search_items = 'Search Articles';
		$labels->not_found = 'No Articles found';
		$labels->not_found_in_trash = 'No Articles found in Trash';
	}


}
$theme = new Volcanic_Pixels_Canvas();
?>
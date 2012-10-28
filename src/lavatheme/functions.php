<?php
class Volcanic_Pixels_Theme {

	public $loader;
	public $twig;
	static $theme;

	function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'do_scripts' ) );
		$this->register_nav_menus();
		self::set_theme( $this );
	}

	static function set_theme( $theme ) {
		self::$theme = $theme;
	} 

	static function get_theme() {
		return self::$theme;
	}

	function register_nav_menus() {
	}

	function do_scripts() {
	}

	function get_url( $append = '' ) {
		return get_bloginfo('template_directory') . $append;
	}

	function get_logo_text( $part = 0 ) {
		$text = get_bloginfo('name');
		if( $part == 0) {
			return $text;
		} else {
			$text = explode( ' ', $text );
			if( array_key_exists( $part - 1, $text ) ) {
				return $text[$part - 1];
			}
		}
	}

	function render_page() {
		if( !class_exists( 'Twig_Autoloader' ) ) {
			require_once( dirname(dirname(__file__)) . '/Twig/Autoloader.php' );
		}
		Twig_Autoloader::register();
		$templates = $this->get_templates();
		$this->loader = new Twig_Loader_Filesystem( dirname(dirname(__file__)) . '/templates' );
		$this->twig = new Twig_Environment( $this->loader );
		$this->add_template_functions();

		foreach( $templates as $possible_template ) {
			if( file_exists( dirname(dirname(__file__)) . '/templates/' . $possible_template ) ) {
				$template = $this->twig->loadTemplate( $possible_template );
				$template->display( $this->get_variables() );
				return;
			}
		}
	}

	function add_template_functions() {
		$funcs = array(
			'body_class',
			'wp_head',
			'wp_footer',
			'wp_title'
		);

		foreach( $funcs as $func ) {
			$this->twig->addFunction( $func, new Twig_Function_Function($func) );
		}
	}

	function add_template_function( $function_name, $method_name = null ) {
		if( is_null( $method_name ) ) {
			$method_name = $function_name;
		}
		$this->twig->addFunction( $function_name, new Twig_Function_Function( get_class() . '::get_theme()->' . $method_name ) );
	}

	function get_templates() {
		$templates = array();

		if( is_front_page() )
			$templates[] = 'front_page.twig';

		$templates[] = 'base.twig';
		return $templates;
	}

	function get_variables() {
		return array(
			'stylesheet_uri'=> get_stylesheet_uri()
		);
	}
	
}
?>
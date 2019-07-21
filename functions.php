<?php
/**
 * Understrap functions and definitions
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$understrap_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/jetpack.php',                         // Load Jetpack compatibility file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker.
	'/woocommerce.php',                     // Load WooCommerce functions.
	'/editor.php',                          // Load Editor functions.
	'/deprecated.php',                      // Load deprecated functions.
);

foreach ( $understrap_includes as $file ) {
	$filepath = locate_template( 'inc' . $file );
	if ( ! $filepath ) {
		trigger_error( sprintf( 'Error locating /inc%s for inclusion', $file ), E_USER_ERROR );
	}
	require_once $filepath;
}

/**
 * Create custom post type for shows
 */
function create_shows() {
	register_post_type( 'shows',
	// CPT Options
	array(
		'labels' => array(
			'name'                => _x( 'Shows', 'Post Type General Name', 'text_domain' ),
			'singular_name'       => _x( 'Show', 'Post Type Singular Name', 'text_domain' ),
			'menu_name'           => __( 'Shows', 'text_domain' ),
			'parent_item_colon'   => __( 'Parent Show:', 'text_domain' ),
			'all_items'           => __( 'All Shows', 'text_domain' ),
			'view_item'           => __( 'View Show', 'text_domain' ),
			'add_new_item'        => __( 'Add New Show', 'text_domain' ),
			'add_new'             => __( 'Add New', 'text_domain' ),
			'edit_item'           => __( 'Edit Show', 'text_domain' ),
			'update_item'         => __( 'Update Show', 'text_domain' ),
			'search_items'        => __( 'Search Shows', 'text_domain' ),
		),
		'public' => true,
		'has_archive' => true,
		'menu_icon' => 'dashicons-tickets',
	 )
	);
	}
	// Hooking up our function to theme setup
	add_action( 'init', 'create_shows' );

	/**
	 * Add Swipebox js and styles on Gallery Template
	 */
	add_action('wp_enqueue_scripts','Load_Gallery_Template_Scripts');
	function Load_Gallery_Template_Scripts(){
			if ( is_page_template('gallery.php') ) {
					wp_enqueue_script('swipebox', get_template_directory_uri() . '/js/jquery.swipebox.min.js', array('jquery'), '1.0', false);
					wp_enqueue_style('swipebox-css', get_template_directory_uri() . '/css/swipebox.min.css');
			} 
	}


	/**
	 * Set up Site-Wide settings in Customizer
	 */
	function hotrodsrock_customize_register( $wp_customize ) {
		$wp_customize->add_section( 'hotrodsrock_custom' , array(
			'title'      => __( 'Site Settings', 'hotrodsrock' ),
			'priority'   => 30,
		) );

		$wp_customize->add_setting( 'phone' , array(
			'default'   => '',
			'transport' => 'refresh',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'phone_number', array(
			'label'      => __( 'Phone Number', 'hotrodsrock' ),
			'section'    => 'hotrodsrock_custom',
			'settings'   => 'phone',
			'type'			 => 'text'
		) ) );

		$wp_customize->add_setting( 'email' , array(
			'default'   => '',
			'transport' => 'refresh',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'email_address', array(
			'label'      => __( 'Email Address', 'hotrodsrock' ),
			'section'    => 'hotrodsrock_custom',
			'settings'   => 'email',
			'type'			 => 'text'
		) ) );
	
 }
 add_action( 'customize_register', 'hotrodsrock_customize_register' );
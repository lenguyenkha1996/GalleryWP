<?php
/**
 * vivah-royal-wedding: Customizer
 *
 * @package WordPress
 * @subpackage vivah-royal-wedding
 * @since 1.0
 */

function vivah_royal_wedding_customize_register( $wp_customize ) {

	$wp_customize->add_panel( 'vivah_royal_wedding_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Theme Settings', 'vivah-royal-wedding' ),
	    'description' => __( 'Description of what this panel does.', 'vivah-royal-wedding' ),
	) );

	$wp_customize->add_section( 'vivah_royal_wedding_theme_options_section', array(
    	'title'      => __( 'General Settings', 'vivah-royal-wedding' ),
		'priority'   => 30,
		'panel' => 'vivah_royal_wedding_panel_id'
	) );

	// Add Settings and Controls for Layout
	$wp_customize->add_setting('vivah_royal_wedding_theme_options',array(
        'default' => __('Right Sidebar','vivah-royal-wedding'),
        'sanitize_callback' => 'vivah_royal_wedding_sanitize_choices'	        
	));

	$wp_customize->add_control('vivah_royal_wedding_theme_options',array(
        'type' => 'radio',
        'label' => __('Do you want this section','vivah-royal-wedding'),
        'section' => 'vivah_royal_wedding_theme_options_section',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vivah-royal-wedding'),
            'Right Sidebar' => __('Right Sidebar','vivah-royal-wedding'),
            'One Column' => __('One Column','vivah-royal-wedding'),
            'Three Columns' => __('Three Columns','vivah-royal-wedding'),
            'Four Columns' => __('Four Columns','vivah-royal-wedding'),
            'Grid Layout' => __('Grid Layout','vivah-royal-wedding')
        ),
	));

	//Banner
	$wp_customize->add_section('vivah_royal_wedding_banner',array(
		'title'	=> __('Banner','vivah-royal-wedding'),
		'description'=> __('This section will appear below general setting section','vivah-royal-wedding'),
		'panel' => 'vivah_royal_wedding_panel_id',
	));

	for ( $count = 0; $count <= 0; $count++ ) {

		$wp_customize->add_setting( 'vivah_royal_wedding_page_settings' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'vivah_royal_wedding_sanitize_dropdown_pages'
		));

		$wp_customize->add_control( 'vivah_royal_wedding_page_settings' . $count, array(
			'label'    => __( 'Select Banner Page', 'vivah-royal-wedding' ),
			'description'=> __('Size of image should be 1675px x 555px','vivah-royal-wedding'),
			'section'  => 'vivah_royal_wedding_banner',
			'type'     => 'dropdown-pages'
		));
	}

	//Bride And Groom
	$wp_customize->add_section('vivah_royal_wedding_our_services',array(
		'title'	=> __('Bride And Groom','vivah-royal-wedding'),
		'description'=> __('This section will appear below the banner.','vivah-royal-wedding'),
		'panel' => 'vivah_royal_wedding_panel_id',
	));	

	$wp_customize->add_setting('vivah_royal_wedding_section_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vivah_royal_wedding_section_title',array(
		'label'	=> __('Section Title','vivah-royal-wedding'),
		'section'=> 'vivah_royal_wedding_our_services',
		'setting'=> 'vivah_royal_wedding_section_title',
		'type'=> 'text'
	));

	for ( $count = 0; $count <= 1; $count++ ) {

		$wp_customize->add_setting( 'vivah_royal_wedding_services' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'vivah_royal_wedding_sanitize_dropdown_pages'
		));
		$wp_customize->add_control( 'vivah_royal_wedding_services' . $count, array(
			'label'    => __( 'Select Service Page', 'vivah-royal-wedding' ),
			'section'  => 'vivah_royal_wedding_our_services',
			'type'     => 'dropdown-pages'
		));
	}

	//Footer
    $wp_customize->add_section( 'vivah_royal_wedding_footer', array(
    	'title'      => __( 'Footer Text', 'vivah-royal-wedding' ),
		'priority'   => null,
		'panel' => 'vivah_royal_wedding_panel_id'
	) );

    $wp_customize->add_setting('vivah_royal_wedding_footer_copy',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vivah_royal_wedding_footer_copy',array(
		'label'	=> __('Footer Text','vivah-royal-wedding'),
		'section'	=> 'vivah_royal_wedding_footer',
		'setting'	=> 'vivah_royal_wedding_footer_copy',
		'type'		=> 'text'
	));

	$wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport  = 'postMessage';

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title a',
		'render_callback' => 'vivah_royal_wedding_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => 'vivah_royal_wedding_customize_partial_blogdescription',
	) );

	//front page
	$num_sections = apply_filters( 'vivah_royal_wedding_front_page_sections', 4 );

	// Create a setting and control for each of the sections available in the theme.
	for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
		$wp_customize->add_setting( 'panel_' . $i, array(
			'default'           => false,
			'sanitize_callback' => 'vivah_royal_wedding_sanitize_dropdown_pages',
			'transport'         => 'postMessage',
		) );

		$wp_customize->add_control( 'panel_' . $i, array(
			/* translators: %d is the front page section number */
			'label'          => sprintf( __( 'Front Page Section %d Content', 'vivah-royal-wedding' ), $i ),
			'description'    => ( 1 !== $i ? '' : __( 'Select pages to feature in each area from the dropdowns. Add an image to a section by setting a featured image in the page editor. Empty sections will not be displayed.', 'vivah-royal-wedding' ) ),
			'section'        => 'theme_options',
			'type'           => 'dropdown-pages',
			'allow_addition' => true,
			'active_callback' => 'vivah_royal_wedding_is_static_front_page',
		) );

		$wp_customize->selective_refresh->add_partial( 'panel_' . $i, array(
			'selector'            => '#panel' . $i,
			'render_callback'     => 'vivah_royal_wedding_front_page_section',
			'container_inclusive' => true,
		) );
	}
}
add_action( 'customize_register', 'vivah_royal_wedding_customize_register' );

function vivah_royal_wedding_customize_partial_blogname() {
	bloginfo( 'name' );
}

function vivah_royal_wedding_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

function vivah_royal_wedding_is_static_front_page() {
	return ( is_front_page() && ! is_home() );
}

function vivah_royal_wedding_is_view_with_layout_option() {
	// This option is available on all pages. It's also available on archives when there isn't a sidebar.
	return ( is_page() || ( is_archive() && ! is_active_sidebar( 'sidebar-1' ) ) );
}

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Vivah_Royal_Wedding_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'Vivah_Royal_Wedding_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new Vivah_Royal_Wedding_Customize_Section_Pro(
				$manager,
				'example_1',
				array(
					'priority' => 9,
					'title'    => esc_html__( 'Wedding Pro', 'vivah-royal-wedding' ),
					'pro_text' => esc_html__( 'Go Pro','vivah-royal-wedding' ),
					'pro_url'  => esc_url( 'https://www.luzuk.com/themes/wedding-wordpress-theme/' ),
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'vivah-royal-wedding-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'vivah-royal-wedding-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
Vivah_Royal_Wedding_Customize::get_instance();
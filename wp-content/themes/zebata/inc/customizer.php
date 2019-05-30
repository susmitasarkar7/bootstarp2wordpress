<?php
/**
 * zebata Theme Customizer
 *
 * @package zebata
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function zebata_customize_register( $wp_customize ) {

	global $zebataPostsPagesArray, $zebataYesNo, $zebataSliderType, $zebataServiceLayouts, $zebataAvailableCats, $zebataBusinessLayoutType;

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'zebata_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'zebata_customize_partial_blogdescription',
		) );
	}
	
	$wp_customize->add_panel( 'zebata_general', array(
		'priority'       => 10,
		'capability'     => 'edit_theme_options',
		'title'      => __('General Settings', 'zebata'),
		'active_callback' => '',
	) );

	$wp_customize->get_section( 'title_tagline' )->panel = 'zebata_general';
	$wp_customize->get_section( 'background_image' )->panel = 'zebata_general';
	$wp_customize->get_section( 'background_image' )->title = __('Site background', 'zebata');
	$wp_customize->get_section( 'header_image' )->panel = 'zebata_general';
	$wp_customize->get_section( 'header_image' )->title = __('Header Settings', 'zebata');
	$wp_customize->get_control( 'header_image' )->priority = 20;
	$wp_customize->get_control( 'header_image' )->active_callback = 'zebata_show_wp_header_control';	
	$wp_customize->get_section( 'static_front_page' )->panel = 'zebata_business_page';
	$wp_customize->get_section( 'static_front_page' )->title = __('Select frontpage type', 'zebata');
	$wp_customize->get_section( 'static_front_page' )->priority = 9;
	$wp_customize->remove_section('colors');
	$wp_customize->add_control( 
			new WP_Customize_Color_Control( 
			$wp_customize, 
			'background_color', 
			array(
				'label'      => __( 'Background Color', 'zebata' ),
				'section'    => 'background_image',
				'priority'   => 9
			) ) 
	);
	//$wp_customize->remove_section('static_front_page');	
	//$wp_customize->remove_section('header_image');	

	/* Upgrade */	
	$wp_customize->add_section( 'zebata_business_upgrade', array(
		'priority'       => 8,
		'capability'     => 'edit_theme_options',
		'title'      => __('Upgrade to PRO', 'zebata'),
		'active_callback' => '',
	) );		
	$wp_customize->add_setting( 'zebata_show_sliderr',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);	
	$wp_customize->add_control( new zebata_Customize_Control_Upgrade(
		$wp_customize,
		'zebata_show_sliderr',
		array(
			'label'      => __( 'Show headerr?', 'zebata' ),
			'settings'   => 'zebata_show_sliderr',
			'priority'   => 10,
			'section'    => 'zebata_business_upgrade',
			'choices' => '',
			'input_attrs'  => 'yes',
			'active_callback' => ''			
		)
	) );
	
	/* Usage guide */	
	$wp_customize->add_section( 'zebata_business_usage', array(
		'priority'       => 9,
		'capability'     => 'edit_theme_options',
		'title'      => __('Theme Usage Guide', 'zebata'),
		'active_callback' => '',
	) );		
	$wp_customize->add_setting( 'zebata_show_sliderrr',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);	
	$wp_customize->add_control( new zebata_Customize_Control_Guide(
		$wp_customize,
		'zebata_show_sliderrr',
		array(

			'label'      => __( 'Show headerr?', 'zebata' ),
			'settings'   => 'zebata_show_sliderrr',
			'priority'   => 10,
			'section'    => 'zebata_business_usage',
			'choices' => '',
			'input_attrs'  => 'yes',
			'active_callback' => ''				
		)
	) );
	
	/* Header Section */
	$wp_customize->add_setting( 'zebata_show_slider',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'zebata_sanitize_yes_no_setting',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'zebata_show_slider',
		array(
			'label'      => __( 'Show header?', 'zebata' ),
			'settings'   => 'zebata_show_slider',
			'priority'   => 10,
			'section'    => 'header_image',
			'type'    => 'select',
			'choices' => $zebataYesNo,
		)
	) );	
	$wp_customize->add_setting( 'zebata_header_type',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'zebata_sanitize_slider_type_setting',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'zebata_header_type',
		array(
			'label'      => __( 'Header type :', 'zebata' ),
			'settings'   => 'zebata_header_type',
			'priority'   => 11,
			'section'    => 'header_image',
			'type'    => 'select',
			'choices' => $zebataSliderType,
		)
	) );
	
	$wp_customize->add_setting( 'zebata_slider_cat',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'zebata_sanitize_cat_setting',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'zebata_slider_cat',
		array(
			'label'      => __( 'Select a category for owl slider :', 'zebata' ),
			'settings'   => 'zebata_slider_cat',
			'priority'   => 20,
			'section'    => 'header_image',
			'type'    => 'select',
			'choices' => $zebataAvailableCats,
		)
	) );	
	
	
	/* Business page panel */
	$wp_customize->add_panel( 'zebata_business_page', array(
		'priority'       => 20,
		'capability'     => 'edit_theme_options',
		'title'      => __('Home/Front Page Settings', 'zebata'),
		'active_callback' => '',
	) );
	
	$wp_customize->add_section( 'zebata_business_page_layout_selection', array(
		'priority'       => 10,
		'capability'     => 'edit_theme_options',
		'title'      => __('Select FrontPage Layout', 'zebata'),
		'active_callback' => 'zebata_front_page_sections',
		'panel'  => 'zebata_business_page',
	) );
	$wp_customize->add_setting( 'zebata_business_page_layout_type',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'zebata_sanitize_layout_type',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'zebata_business_page_layout_type',
		array(
			'label'      => __( 'Layout type :', 'zebata' ),
			'settings'   => 'zebata_business_page_layout_type',
			'priority'   => 10,
			'section'    => 'zebata_business_page_layout_selection',
			'type'    => 'select',
			'choices' => $zebataBusinessLayoutType,
		)
	) );	
	
	
	$wp_customize->add_section( 'zebata_business_page_layout_three', array(
		'priority'       => 30,
		'capability'     => 'edit_theme_options',
		'title'      => __('Four settings', 'zebata'),
		'active_callback' => 'zebata_front_page_sections',
		'panel'  => 'zebata_business_page',
	) );
	$wp_customize->add_setting( 'zebata_three_welcome_post',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'zebata_sanitize_post_selection',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'zebata_six_welcome_post',
		array(
			'label'      => __( 'Welcome post :', 'zebata' ),
			'settings'   => 'zebata_three_welcome_post',
			'priority'   => 10,
			'section'    => 'zebata_business_page_layout_three',
			'type'    => 'select',
			'choices' => $zebataPostsPagesArray,
		)
	) );
	
	$wp_customize->add_setting( 'zebata_three_services_cat',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'zebata_sanitize_cat_setting',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'zebata_three_services_cat',
		array(
			'label'      => __( 'Select a category :', 'zebata' ),
			'settings'   => 'zebata_three_services_cat',
			'priority'   => 20,
			'section'    => 'zebata_business_page_layout_three',
			'type'    => 'select',
			'choices' => $zebataAvailableCats,
		)
	) );	
	
	$wp_customize->add_setting( 'zebata_three_services_num',
		array(
			'default'    => 6,
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'zebata_three_services_num',
		array(
			'label'      => __( 'Number of posts :', 'zebata' ),
			'settings'   => 'zebata_three_services_num',
			'priority'   => 30,
			'section'    => 'zebata_business_page_layout_three',
			'type'    => 'text',
		)
	) );	
	
	$wp_customize->add_section( 'business_page_layout_wooone', array(
		'priority'       => 60,
		'capability'     => 'edit_theme_options',
		'title'      => __('Woo One settings', 'zebata'),
		'active_callback' => 'zebata_front_page_sections',
		'panel'  => 'zebata_business_page',
	) );

	$wp_customize->add_setting( 'zebata_wooone_welcome_post',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'zebata_sanitize_post_selection',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'zebata_wooone_welcome_post',
		array(
			'label'      => __( 'Welcome post :', 'zebata' ),
			'settings'   => 'zebata_wooone_welcome_post',
			'priority'   => 10,
			'section'    => 'business_page_layout_wooone',
			'type'    => 'select',
			'choices' => $zebataPostsPagesArray,
		)
	) );
	$wp_customize->add_setting( 'zebata_wooone_latest_heading',
		array(
			'default'    => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'zebata_wooone_latest_heading',
		array(
			'label'      => __( 'Products Heading :', 'zebata' ),
			'settings'   => 'zebata_wooone_latest_heading',
			'priority'   => 20,
			'section'    => 'business_page_layout_wooone',
			'type'    => 'text',
		)
	) );
	$wp_customize->add_setting( 'zebata_wooone_latest_text',
		array(
			'default'    => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'zebata_wooone_latest_text',
		array(
			'label'      => __( 'Products Text :', 'zebata' ),
			'settings'   => 'zebata_wooone_latest_text',
			'priority'   => 30,
			'section'    => 'business_page_layout_wooone',
			'type'    => 'text',
		)
	) );	

	$wp_customize->add_section( 'zebata_business_page_quote', array(
		'priority'       => 110,
		'capability'     => 'edit_theme_options',
		'title'      => __('Quote Settings', 'zebata'),
		'active_callback' => '',
		'panel'  => 'zebata_general',
	) );
	$wp_customize->add_setting( 'zebata_show_quote',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'zebata_sanitize_yes_no_setting',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'zebata_show_quote',
		array(
			'label'      => __( 'Show quote?', 'zebata' ),
			'settings'   => 'zebata_show_quote',
			'priority'   => 10,
			'section'    => 'zebata_business_page_quote',
			'type'    => 'select',
			'choices' => $zebataYesNo,
		)
	) );
	$wp_customize->add_setting( 'zebata_quote_post',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'zebata_sanitize_post_selection',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'zebata_quote_post',
		array(
			'label'      => __( 'Select post', 'zebata' ),
			'description' => __( 'Select a post/page you want to show in quote section', 'zebata' ),
			'settings'   => 'zebata_quote_post',
			'priority'   => 11,
			'section'    => 'zebata_business_page_quote',
			'type'    => 'select',
			'choices' => $zebataPostsPagesArray,
		)
	) );	
	
	$wp_customize->add_section( 'zebata_business_page_social', array(
		'priority'       => 120,
		'capability'     => 'edit_theme_options',
		'title'      => __('Social Settings', 'zebata'),
		'active_callback' => '',
		'panel'  => 'zebata_general',
	) );	
	$wp_customize->add_setting( 'zebata_show_social',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'zebata_sanitize_yes_no_setting',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'zebata_show_social',
		array(
			'label'      => __( 'Show social?', 'zebata' ),
			'settings'   => 'zebata_show_social',
			'priority'   => 10,
			'section'    => 'zebata_business_page_social',
			'type'    => 'select',
			'choices' => $zebataYesNo,
		)
	) );
	$wp_customize->add_setting( 'business_page_facebook',
		array(
			'default'    => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);
	$wp_customize->add_control( 'business_page_facebook', array(
	  'type' => 'text',
	  'section' => 'zebata_business_page_social', // Add a default or your own section
	  'label' => __( 'Facebook', 'zebata' ),
	  'description' => __( 'Enter your facebook url.', 'zebata' ),
	) );
	$wp_customize->add_setting( 'business_page_flickr',
		array(
			'default'    => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);
	$wp_customize->add_control( 'business_page_flickr', array(
	  'type' => 'text',
	  'section' => 'zebata_business_page_social', // Add a default or your own section
	  'label' => __( 'Flickr', 'zebata' ),
	  'description' => __( 'Enter your flickr url.', 'zebata' ),
	) );
	$wp_customize->add_setting( 'business_page_gplus',
		array(
			'default'    => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);
	$wp_customize->add_control( 'business_page_gplus', array(
	  'type' => 'text',
	  'section' => 'zebata_business_page_social', // Add a default or your own section
	  'label' => __( 'Gplus', 'zebata' ),
	  'description' => __( 'Enter your gplus url.', 'zebata' ),
	) );
	$wp_customize->add_setting( 'business_page_linkedin',
		array(
			'default'    => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);
	$wp_customize->add_control( 'business_page_linkedin', array(
	  'type' => 'text',
	  'section' => 'zebata_business_page_social', // Add a default or your own section
	  'label' => __( 'Linkedin', 'zebata' ),
	  'description' => __( 'Enter your linkedin url.', 'zebata' ),
	) );
	$wp_customize->add_setting( 'business_page_reddit',
		array(
			'default'    => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);
	$wp_customize->add_control( 'business_page_reddit', array(
	  'type' => 'text',
	  'section' => 'zebata_business_page_social', // Add a default or your own section
	  'label' => __( 'Reddit', 'zebata' ),
	  'description' => __( 'Enter your reddit url.', 'zebata' ),
	) );
	$wp_customize->add_setting( 'business_page_stumble',
		array(
			'default'    => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);
	$wp_customize->add_control( 'business_page_stumble', array(
	  'type' => 'text',
	  'section' => 'zebata_business_page_social', // Add a default or your own section
	  'label' => __( 'Stumble', 'zebata' ),
	  'description' => __( 'Enter your stumble url.', 'zebata' ),
	) );
	$wp_customize->add_setting( 'business_page_twitter',
		array(
			'default'    => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);
	$wp_customize->add_control( 'business_page_twitter', array(
	  'type' => 'text',
	  'section' => 'zebata_business_page_social', // Add a default or your own section
	  'label' => __( 'Twitter', 'zebata' ),
	  'description' => __( 'Enter your twitter url.', 'zebata' ),
	) );	
	
}
add_action( 'customize_register', 'zebata_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function zebata_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function zebata_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function zebata_customize_preview_js() {
	wp_enqueue_script( 'zebata-customizer', esc_url( get_template_directory_uri() ) . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'zebata_customize_preview_js' );

require get_template_directory() . '/inc/variables.php';

function zebata_sanitize_yes_no_setting( $value ){
	global $zebataYesNo;
    if ( ! array_key_exists( $value, $zebataYesNo ) ){
        $value = 'select';
	}
    return $value;	
}

function zebata_sanitize_post_selection( $value ){
	global $zebataPostsPagesArray;
    if ( ! array_key_exists( $value, $zebataPostsPagesArray ) ){
        $value = 'select';
	}
    return $value;	
}

function zebata_front_page_sections(){
	
	$value = false;
	
	if( 'page' == get_option( 'show_on_front' ) ){
		$value = true;
	}
	
	return $value;
	
}

function zebata_show_wp_header_control(){
	
	$value = false;
	
	if( 'header' == get_theme_mod( 'header_type' ) ){
		$value = true;
	}
	
	return $value;
	
}

function zebata_show_header_one_control(){
	
	$value = false;
	
	if( 'header-one' == get_theme_mod( 'header_type' ) ){
		$value = true;
	}
	
	return $value;
	
}

function zebata_sanitize_slider_type_setting( $value ){

	global $zebataSliderType;
    if ( ! array_key_exists( $value, $zebataSliderType ) ){
        $value = 'select';
	}
    return $value;	
	
}

function zebata_sanitize_cat_setting( $value ){
	
	global $zebataAvailableCats;
	
	if( ! array_key_exists( $value, $zebataAvailableCats ) ){
		
		$value = 'select';
		
	}
	return $value;
	
}

function zebata_sanitize_layout_type( $value ){
	
	global $zebataBusinessLayoutType;
	
	if( ! array_key_exists( $value, $zebataBusinessLayoutType ) ){
		
		$value = 'select';
		
	}
	return $value;
	
}

add_action( 'customize_register', 'zebata_load_customize_classes', 0 );
function zebata_load_customize_classes( $wp_customize ) {
	
	class zebata_Customize_Control_Upgrade extends WP_Customize_Control {

		public $type = 'zebata-upgrade';
		
		public function enqueue() {

		}

		public function to_json() {
			
			parent::to_json();

			$this->json['link']    = $this->get_link();
			$this->json['value']   = $this->value();
			$this->json['id']      = $this->id;
			//$this->json['default'] = $this->default;
			
		}	
		
		public function render_content() {}
		
		public function content_template() { ?>

			<div id="zebata-upgrade-container" class="zebata-upgrade-container">

				<ul>
					<li>More sliders</li>
					<li>More layouts</li>
					<li>Color customization</li>
					<li>Font customization</li>
				</ul>

				<p>
					<a href="https://www.themealley.com/business/">Upgrade</a>
				</p>
									
			</div><!-- .zebata-upgrade-container -->
			
		<?php }	
		
	}
	
	class zebata_Customize_Control_Guide extends WP_Customize_Control {

		public $type = 'zebata-guide';
		
		public function enqueue() {

		}

		public function to_json() {
			
			parent::to_json();

			$this->json['link']    = $this->get_link();
			$this->json['value']   = $this->value();
			$this->json['id']      = $this->id;
			//$this->json['default'] = $this->default;
			
		}	
		
		public function render_content() {}
		
		public function content_template() { ?>

			<div id="zebata-upgrade-container" class="zebata-upgrade-container">

				<ol>
					<li>Select 'A static page' for "your homepage displays" in 'select frontpage type' section of 'Home/Front Page settings' tab.</li>
					<li>Enter details for various section like header, welcome, services, quote, social sections.</li>
				</ol>
									
			</div><!-- .zebata-upgrade-container -->
			
		<?php }	
		
	}	

	$wp_customize->register_control_type( 'zebata_Customize_Control_Upgrade' );
	$wp_customize->register_control_type( 'zebata_Customize_Control_Guide' );
	
	
}
<?php
/**
 * Customizer default options
 *
 * @package Theme Palace
 * @subpackage Kids Education
 * @since Kids Education 0.1
 *
 * @return array An array of default values
 */

function kids_education_get_default_theme_options() {
	$theme_data = wp_get_theme(); // get theme data
	$kids_education_default_options = array(

		// Main Slider
		'enable_main_slider'			=> 'disabled',
		'main_slider_type'				=> 'page',
		'main_slider_no_of_posts'		=> 2,
		'main_slider_learn_more_text'   => esc_html__( 'Learn more', 'kids-education' ),
		'main_slider_excerpt'			=> 20,



		// Features section
		'features_enable'				=> 'disabled',
		'features_section_title' 		=> esc_html__( 'School Activities', 'kids-education' ),
		'features_section_type'			=> 'category',
		'features_dropdown_categories'  => null,
		'feature_excerpt'			=> 20,

		// gallery section
		'gallery_enable'				=> 'disabled',
		'gallery_source'				=> 'category',
		'gallery_title'					=> esc_html__( 'Our Gallery', 'kids-education' ),
		'gallery_no_of_img'				=> 8,
		'gallery_category'				=> null,
		'gallery_page_readmore'			=> esc_html__( 'Load More', 'kids-education' ),

		// Category blog
		'category_blog_enable' 			=> 'disabled',
		'category_blog_content_type'	=> 'category',
		'category_blog_title'			=> esc_html__( 'Kindergarten Blog & News', 'kids-education' ),
		'category_blog_count' 			=> 3,
		'category_blog_excerpt'			=> 20,

		// Recent
		'recent_enable' 				=> 'disabled',
		'recent_title' 					=> esc_html__( 'Recent Classes', 'kids-education' ),
		'recent_count'	 				=> 6,
		'recent_visible_no_of_slides' 	=> 3,
		'recent_content_type'	 		=> 'post',
		'recent_excerpt'				=> 20,

		// Search Course
		'search_course_enable'			=> 'disabled',

		// Theme Options
		'search_text'					=> esc_html__( 'Search...', 'kids-education' ),
		'long_excerpt_length'           => 25,
		'short_excerpt_length'          => 10,
		'read_more_text'		        => esc_html__( 'Read More >>', 'kids-education' ),
		'breadcrumb_enable'         	=> false,
		'breadcrumb_separator'         	=> '/',
		'post_navigation_enable'		=> true,
		'post_navigation_type'			=> 'default',
		'pagination_enable'         	=> true,
		'pagination_type'         		=> 'default',
		'reset_options'      			=> false,
		'enable_frontpage_content' 		=> true,

	);

	$output = apply_filters( 'kids_education_default_theme_options', $kids_education_default_options );
	// Sort array in ascending order, according to the key:
	if ( ! empty( $output ) ) {
		ksort( $output );
	}

	return $output;
}

/**
 * Returns kids_education_content registered for journal.
 *
 * @since Kids Education 0.1
 */
function kids_education_get_content() {
	$theme_data = wp_get_theme();

	$kids_education_content['left'] 	= sprintf( _x( 'Copyright &copy; %1$s %2$s.', '1: Year, 2: Site Title with home URL', 'kids-education' ), date_i18n( 'Y', strtotime( date( 'Y' ) ) ), '<a href="'. esc_url( home_url( '/' ) ) .'">'. esc_attr( get_bloginfo( 'name', 'display' ) ) . '</a>' );

	$kids_education_content['right']	= 'Desarrollo: <a href="https://www.dlimon.net" target="_blank" style="text-decoration: underline;">💎Daniel Limón</a>';

	return apply_filters( 'kids_education_get_content', $kids_education_content );
}
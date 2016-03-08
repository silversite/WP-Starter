<?php

if ( ! function_exists( 'silverwp_get_layout_main_menu' ) ) {
	/**
	 *
	 * Get layout main menu used in theme options
	 * Main (top) menu position
	 *
	 * @return array
	 */
	function silverwp_get_layout_main_menu() {
		return array(
			array(
				'label' => \SilverWp\Translate::translate( 'Static / scrollable' ),
				'value' => 'static'
			),
			array(
				'label' => \SilverWp\Translate::translate( 'Fixed' ),
				'value' => 'fixed'
			),
		);
	}
}
if ( ! function_exists( 'silverwp_get_background_repeat' ) ) {
	/**
	 *
	 * get background repeat data used for
	 * _style_background() repeat method in theme options
	 *
	 * @return array
	 */
	function silverwp_get_background_repeat() {
		return array(
			array(
				'label' => 'no repeat',
				'value' => 'no-repeat'
			),
			array(
				'label' => 'repeat',
				'value' => 'repeat'
			),
			array(
				'label' => 'repeat-x',
				'value' => 'repeat-x'
			),
			array(
				'label' => 'repeat-y',
				'value' => 'repeat-y'
			),
		);
	}
}
if ( ! function_exists( 'silverwp_get_background_position' ) ) {
	/**
	 * Get background position data used for
	 * _style_background() position method in theme options
	 *
	 * @return array
	 */
	function silverwp_get_background_position() {
		return array(
			array(
				'label' => 'center top',
				'value' => 'center-top'
			),
			array(
				'label' => 'center bottom',
				'value' => 'center-bottom'
			),
			array(
				'label' => 'left top',
				'value' => 'left-top'
			),
			array(
				'label' => 'left bottom',
				'value' => 'left-bottom'
			),
			array(
				'label' => 'right top',
				'value' => 'right-top'
			),
			array(
				'label' => 'right bottom',
				'value' => 'right-bottom'
			),
		);
	}
}
if ( ! function_exists( 'silverwp_get_sidebar' ) ) {
	/**
	 *
	 * Source function for sidebar metabox
	 *
	 * @return array
	 */
	function silverwp_get_sidebar() {
		$img_uri = \SilverWp\FileSystem::getDirectory( 'image_uri' );
		return array(
			array(
				'value' => 0,
				'label' => \SilverWp\Translate::translate( 'None' ),
				'img'   => $img_uri . 'admin/sidebar/icon_0_sidebar_off.png',
			),
			array(
				'value' => 1,
				'label' => \SilverWp\Translate::translate( 'Left sidebar' ),
				'img'   => $img_uri . 'admin/sidebar/icon_1_sidebar_off.png',
			),
			array(
				'value' => 2,
				'label' => \SilverWp\Translate::translate( 'Right sidebar' ),
				'img'   => $img_uri . 'admin/sidebar/icon_2_sidebar_off.png',
			),
		);
	}
}

if ( ! function_exists( 'silverwp_get_default_colour_picker' ) ) {

	/**
	 * Get default color for colour picker
	 *
	 * @param string $key
	 *
	 * @return array
	 */
	function silverwp_get_default_colour_picker( $key ) {
		$colours = array(
			'style_layout[brand-primary]'            => '#F2F2F2',
			'style_background[body-bg]'              => '#F2F2F2',
			'style_fonts_body[text-color]'           => '#7F7F7F',
			'style_fonts_heading[headings-color]'    => '#F2F2F2',
			'style_fonts_main_menu[menu-text-color]' => '#F2F2F2',
		);

		return isset( $colours[ $key ] ) ? $colours[ $key ] : null;
	}
}
if ( ! function_exists( 'silverwp_get_title_style' ) ) {
	/**
	 * list of title style used in
	 * short code [title][/title]
	 *
	 * @return array
	 */
	function silverwp_get_title_style() {
		return array(
			array(
				'value' => 'style1',
				'label' => \SilverWp\Translate::translate( 'Style 1' ),
			),
			array(
				'value' => 'style2',
				'label' => \SilverWp\Translate::translate( 'Style 2' ),
			),
			array(
				'value' => 'style3',
				'label' => \SilverWp\Translate::translate( 'Style 3' ),
			),
		);
	}
}

if ( ! function_exists( 'silverwp_get_topbar_layout' ) ) {
	/**
	 * List of top bar layouts
	 *
	 * @return array
	 */
	function silverwp_get_topbar_layout() {
		$img_uri = \SilverWp\FileSystem::getDirectory( 'image_uri' );
		$layouts = array(
			array(
				'value' => 'logo_center',
				'label' => \SilverWp\Translate::translate( 'Logo center' ),
				'img'   => $img_uri . 'admin/topbar/logo_center.png',
			),
			array(
				'value' => 'logo_left',
				'label' => \SilverWp\Translate::translate( 'Logo left' ),
				'img'   => $img_uri . 'admin/topbar/logo_left.png',
			),
			array(
				'value' => 'logo_right',
				'label' => \SilverWp\Translate::translate( 'Logo right' ),
				'img'   => $img_uri . 'admin/topbar/logo_right.png',
			),
			array(
				'value' => 'logobox_center',
				'label' => \SilverWp\Translate::translate( 'Logo box center' ),
				'img'   => $img_uri . 'admin/topbar/logobox_center.png',
			),
			array(
				'value' => 'logobox_left',
				'label' => \SilverWp\Translate::translate( 'Logo box left' ),
				'img'   => $img_uri . 'admin/topbar/logobox_left.png',
			),
			array(
				'value' => 'logobox_right',
				'label' => \SilverWp\Translate::translate( 'Logo box right' ),
				'img'   => $img_uri . 'admin/topbar/logobox_right.png',
			),
		);

		return $layouts;
	}
}
if ( ! function_exists( 'silverwp_get_header_layout' ) ) {
	/**
	 * List of header layouts
	 *
	 * @return array
	 */
	function silverwp_get_header_layout() {
		$img_uri = \SilverWp\FileSystem::getDirectory( 'image_uri' );

		$layouts = array(
			array(
				'value' => 'image',
				'label' => \SilverWp\Translate::translate( 'Header image' ),
				'img'   => $img_uri . 'admin/layout/header_image.png',
			),
			array(
				'value' => 'slider',
				'label' => \SilverWp\Translate::translate( 'Header slider' ),
				'img'   => $img_uri . 'admin/layout/header_slider.png',
			),
			array(
				'value' => 'titlebar',
				'label' => \SilverWp\Translate::translate( 'Header title bar' ),
				'img'   => $img_uri . 'admin/layout/header_titlebar.png',
			),
			array(
				'value' => 'without',
				'label' => \SilverWp\Translate::translate( 'Without header' ),
				'img'   => $img_uri . 'admin/layout/header_without.png',
			),
		);

		return $layouts;
	}
}

if ( ! function_exists( 'silverwp_get_button_style' ) ) {
	/**
	 * List of header layouts
	 *
	 * @return array
	 * @access public
	 */
	function silverwp_get_button_style() {
		$layouts = array(
			array(
				'label' => \SilverWp\Translate::translate( 'Rounded' ),
				'value' => 'sm-rnd'
			),
			array(
				'label' => \SilverWp\Translate::translate( 'Square' ),
				'value' => 'sqr'
			),
			array(
				'label' => \SilverWp\Translate::translate( 'Round' ),
				'value' => 'rnd'
			),
			/*
			array(
				'label' => \SilverWp\Translate::translate( 'Outlined' ),
				'value' => 'outlined'
			),
			array(
				'label' => \SilverWp\Translate::translate( '3D' ),
				'value' => '3d'
			),
			array(
				'label' => \SilverWp\Translate::translate( 'Square Outlined' ),
				'value' => 'square_outlined'
			),
			*/
		);

		return $layouts;
	}
}
if ( ! function_exists( 'silverwp_get_icon_position' ) ) {
	/**
	 * List of icon position
	 *
	 * @return array
	 * @access public
	 */
	function silverwp_get_icon_position() {
		$layouts = array(
			array(
				'label' => \SilverWp\Translate::translate( 'Left' ),
				'value' => 'left'
			),
			array(
				'label' => \SilverWp\Translate::translate( 'Right' ),
				'value' => 'right'
			),
		);

		return $layouts;
	}
}
if ( ! function_exists( 'silverwp_get_text_align_list' ) ) {
	/**
	 * List of text align
	 *
	 * @return array
	 * @access public
	 */
	function silverwp_get_text_align_list() {
		$layouts = array(
			array(
				'label' => \SilverWp\Translate::translate( 'Left' ),
				'value' => 'left'
			),
			array(
				'label' => \SilverWp\Translate::translate( 'Right' ),
				'value' => 'right'
			),
			array(
				'label' => \SilverWp\Translate::translate( 'Center' ),
				'value' => 'center'
			),
			array(
				'label' => \SilverWp\Translate::translate( 'Justify' ),
				'value' => 'justify'
			),
		);

		return $layouts;
	}
}
/**
 * Get separator title align
 *
 * @return array
 */
function silverwp_get_sc_title_align() {

	$title_align = array(
		array(
			'label' => \SilverWp\Translate::translate( 'Align center' ),
			'value' => 'separator_align_center',
		),
		array(
			'label' => \SilverWp\Translate::translate( 'Align left' ),
			'value' => 'separator_align_left',
		),
		array(
			'label' => \SilverWp\Translate::translate( 'Align right' ),
			'value' => 'separator_align_right',
		),
	);

	return $title_align;
}

if ( ! function_exists( 'silverwp_get_button_position' ) ) {
	/**
	 * List of text align
	 *
	 * @return array
	 */
	function silverwp_get_button_position() {
		$layouts = array(
			array(
				'label' => \SilverWp\Translate::translate( 'Align Left' ),
				'value' => 'left'
			),
			array(
				'label' => \SilverWp\Translate::translate( 'Align Right' ),
				'value' => 'right'
			),
			array(
				'label' => \SilverWp\Translate::translate( 'Align bottom' ),
				'value' => 'center'
			),
		);

		return $layouts;
	}
}
if ( ! function_exists( 'silverwp_get_button_css_animation' ) ) {
	/**
	 * List of text align
	 *
	 * @return array
	 */
	function silverwp_get_button_css_animation() {
		$layouts = array(
			array(
				'label' => \SilverWp\Translate::translate( 'No' ),
				'value' => ''
			),
			array(
				'label' => \SilverWp\Translate::translate( 'Top to bottom' ),
				'value' => 'top-to-bottom'
			),
			array(
				'label' => \SilverWp\Translate::translate( 'Bottom to top' ),
				'value' => 'bottom-to-top'
			),
			array(
				'label' => \SilverWp\Translate::translate( 'Left to right' ),
				'value' => 'left-to-right'
			),
			array(
				'label' => \SilverWp\Translate::translate( 'Right to left' ),
				'value' => 'right-to-left'
			),
			array(
				'label' => \SilverWp\Translate::translate( 'Appear from center' ),
				'value' => 'appear'
			),
		);

		return $layouts;
	}
}
/**
 * List of separator style
 *
 * @return array
 */
function silverwp_get_separator_style() {
	$styles = array(
		array(
			'label' => \SilverWp\Translate::translate( 'No' ),
			'value' => ''
		),
		array(
			'label' => \SilverWp\Translate::translate( 'Border' ),
			'value' => 'border'
		),
		array(
			'label' => \SilverWp\Translate::translate( 'Dashed' ),
			'value' => 'dashed'
		),
		/*array(
			'label'  => \SilverWp\Translate::translate( 'Double' ),
			'value' => 'double'
		),*/
		array(
			'label' => \SilverWp\Translate::translate( 'Shadow' ),
			'value' => 'shadow'
		),
	);

	return $styles;
}

/**
 * Function return separator width
 *
 * @return array
 */
function silverwp_get_separator_width() {
	$styles = array(
		array(
			'label' => '100%',
			'value' => ''
		),
		array(
			'label' => '90%',
			'value' => '90'
		),
		array(
			'label' => '80%',
			'value' => '80'
		),
		array(
			'label' => '70%',
			'value' => '70'
		),
		array(
			'label' => '60%',
			'value' => '60'
		),
		array(
			'label' => '50%',
			'value' => '50'
		),
	);

	return $styles;
}

/**
 * Function return flip type
 *
 * @return array
 */
function silverwp_get_flip_type() {
	$flip_type = array(
		array(
			'label' => \SilverWp\Translate::translate( 'Flip Horizontally From Left' ),
			'value' => 'horizontal_flip_left',
		),
		array(
			'label' => \SilverWp\Translate::translate( 'Flip Horizontally From Right' ),
			'value' => 'horizontal_flip_right',
		),
		array(
			'label' => \SilverWp\Translate::translate( 'Flip Vertically From Top' ),
			'value' => 'vertical_flip_top',
		),
		array(
			'label' => \SilverWp\Translate::translate( 'Flip Vertically From Bottom' ),
			'value' => 'vertical_flip_bottom',
		),
		array(
			'label' => \SilverWp\Translate::translate( 'Vertical Door Flip' ),
			'value' => 'vertical_door_flip',
		),
		array(
			'label' => \SilverWp\Translate::translate( 'Reverse Vertical Door Flip' ),
			'value' => 'reverse_vertical_door_flip',
		),
		array(
			'label' => \SilverWp\Translate::translate( 'Horizontal Door Flip' ),
			'value' => 'horizontal_door_flip',
		),
		array(
			'label' => \SilverWp\Translate::translate( 'Reverse Horizontal Door Flip' ),
			'value' => 'reverse_horizontal_door_flip',
		),
		array(
			'label' => \SilverWp\Translate::translate( 'Book Flip (Beta)' ),
			'value' => 'reverse_horizontal_door_flip',
		),
		array(
			'label' => \SilverWp\Translate::translate( 'Reverse Horizontal Door Flip' ),
			'value' => 'style_9',
		),
		array(
			'label' => \SilverWp\Translate::translate( 'Flip From Left (Beta)' ),
			'value' => 'flip_left',
		),
		array(
			'label' => \SilverWp\Translate::translate( 'Flip From Right (Beta)' ),
			'value' => 'flip_right',
		),
		array(
			'label' => \SilverWp\Translate::translate( 'Flip From Top (Beta)' ),
			'value' => 'flip_top',
		),
		array(
			'label' => \SilverWp\Translate::translate( 'Flip From Bottom (Beta)' ),
			'value' => 'flip_bottom',
		),
	);

	return $flip_type;
}

/**
 * Function return array with all rounded style
 *
 * @return array
 */
function silverwp_get_rounded_style() {
	$rounded_style = array(
		array(
			'label' => \SilverWp\Translate::translate( 'Round' ),
			'value' => 'round',
		),
		array(
			'label' => \SilverWp\Translate::translate( 'Rounded' ),
			'value' => 'rounded',
		),
		array(
			'label' => \SilverWp\Translate::translate( 'Square' ),
			'value' => 'square',
		),
	);

	return $rounded_style;
}
/**
 * EOF
 */

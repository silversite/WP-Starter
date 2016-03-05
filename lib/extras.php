<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;
use SilverWp\Db\Query;
use SilverWp\Helper\Control\SidebarPosition;
use SilverWp\Helper\Option;
use SilverWpAddons\MetaBox\Post;
use SilverWpAddons\MetaBox\Page;

/**
 * Add <body> classes
 *
 * @param array $classes
 *
 * @return array
 */
function body_class( array $classes ) {
	// Add page slug if it doesn't exist
	if ( is_single() || is_page() && ! is_front_page() ) {
		if ( ! in_array( basename( get_permalink() ), $classes ) ) {
			$classes[] = basename( get_permalink() );
		}
	}
	// Add class if sidebar is active
	if ( Setup\display_sidebar() && SidebarPosition::isDisplayed() ) {
		$classes[] = 'sidebar-primary';
		$classes[] = 'is-sidebar';
	} else {
		$classes[] = 'is-no-sidebar';
	}
	//if we are in page
	if ( is_page() ) {
		$the_query = new Query();
		$the_query->setPostType( 'page' );
		$the_query->setMetaBox( Page::getInstance() );
		$the_query->setPostId( get_the_ID() );
		$the_query->get_posts();
		//and show header is disabled
		if ( $the_query->getMetaBox( 'show_header' ) == 0 ) {
			$classes[] = 'is-no-content-header';
		}
		//check sidebar position and add class
		switch ( $the_query->getSidebarPosition() ) {
			case 'left':
				$classes[] = 'is-sidebar-left';
				break;
			case 'right':
				$classes[] = 'is-sidebar-right';
				break;
		}

		$beyond_content = $the_query->getMetaBox( 'beyond_content' );
		if ( isset( $beyond_content['above_content'] )
		     && $beyond_content['above_content'] !== 'empty'
		) {
			$classes[] = 'is-data-above-content';
		}

		//social plugin
		if ( $plugin_position = $the_query->getMetaBox( 'social_plugin_position' ) ) {
			switch ( $plugin_position ) {
				case 'right':
					$classes[]
						= 'is-social-plugin is-social-plugin-screen-right';
					break;
				case 'left':
					$classes[]
						= 'is-social-plugin is-social-plugin-content-left';
					break;

			}
		}
		wp_reset_postdata();
	} else {
		//all additional views get plugin position from TO
		if ( $plugin_position = Option::get_theme_option( 'social_plugin_position' ) ) {
			switch ( $plugin_position ) {
				case 'right':
					$classes[]
						= 'is-social-plugin is-social-plugin-screen-right';
					break;
				case 'left':
					$classes[]
						= 'is-social-plugin is-social-plugin-content-left';
					break;
			}
		}
	}

	if ( is_single() ) {
		$the_query = new Query();
		$the_query->setPostType( 'post' );
		$the_query->setPostId( get_the_ID() );
		$the_query->setMetaBox( Post::getInstance() );
		$the_query->get_posts();
		switch ( $the_query->getSidebarPosition() ) {
			case 'left':
				$classes[] = 'is-sidebar-left';
				break;
			case 'right':
				$classes[] = 'is-sidebar-right';
				break;
		}
		wp_reset_postdata();
	} else {
		switch ( Option::get_theme_option( 'blogposts_sidebar' ) ) {
			case '1':
				$classes[] = 'is-sidebar-left';
				break;
			case '2':
				$classes[] = 'is-sidebar-right';
				break;
		}
	}

	if ( \SilverWp\get_customizer_option( 'navbar_standard_menu' ) === '1' ) {
		$classes[] = 'is-standard-navigation';
	}

	return $classes;
}

add_filter( 'body_class', __NAMESPACE__ . '\\body_class' );

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
	return ' &hellip; <a href="' . get_permalink() . '">' . esc_html__( 'Continued', 'whiteblack' ) . '</a>';
}

add_filter( 'excerpt_more', __NAMESPACE__ . '\\excerpt_more' );
add_filter( 'the_content_more_link', __NAMESPACE__ . '\\excerpt_more' );
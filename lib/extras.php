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

		//check sidebar position and add class
		switch ( $the_query->getSidebarPosition() ) {
			case 'left':
				$classes[] = 'is-sidebar-left';
				break;
			case 'right':
				$classes[] = 'is-sidebar-right';
				break;
			default:
				$page_sidebar_position = \SilverWp\get_theme_option( 'pages_sidebar' ); // default (Theme Options)
				$classes[] = $page_sidebar_position === '1' ? 'is-sidebar-left' : ($page_sidebar_position === '2' ? 'is-sidebar-right' : '');
		}

		wp_reset_postdata();
	}

	if ( is_single() ) {
		$the_query = new Query();
		$the_query->setPostType( 'post' );
		$the_query->setPostId( get_the_ID() );
		$the_query->setMetaBox( Post::getInstance() );
		$the_query->get_posts();

		//check sidebar position and add class
		switch ( $the_query->getSidebarPosition() ) {
			case 'left':
				$classes[] = 'is-sidebar-left';
				break;
			case 'right':
				$classes[] = 'is-sidebar-right';
				break;
			default:
				$blog_sidebar_position = \SilverWp\get_theme_option( 'blogposts_sidebar' ); // default (Theme Options)
				$classes[] = $blog_sidebar_position === '1' ? 'is-sidebar-left' : ($blog_sidebar_position === '2' ? 'is-sidebar-right' : '');
		}
		wp_reset_postdata();
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
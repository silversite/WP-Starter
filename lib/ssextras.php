<?php

namespace SilverWp;

use SilverWp\Customizer\CustomizerAbstract;
use SilverWp\Helper\Option;
use SilverWp\MetaBox\MetaBoxAbstract;
use SilverWp\Pager\Pager;
use SilverWp\Helper\Control\SidebarPosition;
use Roots\Sage\Config;

if ( ! function_exists( __NAMESPACE__ . '\pager' ) ) {
	/**
	 * Generate url for pagination
	 *
	 * @param int $total_pages
	 * @param int $current_page
	 *
	 * @return array
	 * @since 0.1
	 * @author Michal Kalkowski <michal at silversite.pl>
	 */
	function pager( $total_pages, $current_page ) {
		if ( \SilverWp\is_active() ) {
			$pager = new Pager( $total_pages, $current_page );
			$pager->setPrevArrow( '<i class="icon-left-dir"></i>' );
			$pager->setNextArrow( '<i class="icon-right-dir"></i>' );
			$pager->setDotsClass( 'page-dots' );
			$pager->setTagBeforeHref( '<li>' );
			$pager->setTagAfterHref( '</li>' );
			$pager->setNextHrefClass( 'next page-arrow' );
			$pager->setPrevHrefClass( 'prev page-arrow' );
			$pager->show_all = false;

			return $pager;
		}

		return false;
	}
}

if ( ! function_exists( __NAMESPACE__ . '\get_permalink_current_language' ) ) {
	/**
	 * This is a handy function to get the correct permalink dependent on
	 * the current language when using WordPress plugin WPML.
	 * What this dose, instead of calling the get_permalink( $post_id )
	 * that just returns the url for that post_id.
	 *
	 * @param int $post_id
	 *
	 * @return bool|false|string
	 * @see http://www.ordinarycoder.com/wpml-get-permalink-on-current-language/
	 */
	function get_permalink_current_language( $post_id ) {
		if ( function_exists( 'icl_object_id' ) ) {
			$language = ICL_LANGUAGE_CODE;

			$lang_post_id = icl_object_id( $post_id, get_post_type(), true, $language );

			if ( $lang_post_id != 0 ) {
				$url = get_permalink( $lang_post_id );
			} else {
				// No page found, it's most likely the homepage
				global $sitepress;
				$url = $sitepress->language_url( $language );
			}
		} else {
			$url = get_permalink( $post_id );
		}

		return $url;
	}
}

if ( ! function_exists( __NAMESPACE__ . '\get_image_size_name' ) ) {

	/**
	 * Returns name of registered image sizes names.
	 *
	 * @param int    $col_num - number of grid columns
	 * @param string $format  - normal size (thumbnail) or wide image (featured or single view) - "thumbnail" / "featured"
	 *
	 * @return string
	 * @access public
	 * @author Marcin Dobroszek <marcin at silversite.pl>
	 */
	function get_image_size_name( $col_num, $format = 'thumbnail', $has_sidebar = 'auto' ) {

        if ( $has_sidebar === 'auto' ) {
	        if ( \SilverWp\is_active() ) {
		        $has_sidebar = Config\display_sidebar()
		                       && SidebarPosition::isDisplayed(); // aside
	        } else {
		        $has_sidebar = Config\display_sidebar(); //aside
	        }
        }

		if ( $has_sidebar ) { // content with Sidebar
			if ( $format === 'thumbnail' ) { // single column width
				switch ( $col_num ) {
					case 1:
						return 'medium'; // 2/3 width of container
					case 2:
						return 'thumbnail'; // 1/3 width of container
					case 3:
						return 'thumbnail'; // not recommended
				}
			} else { // featured box or single view - double or triple column width
				return 'medium'; // 2/3 width of container  /  full width of Main content
			}
		} else { // content without sidebar
			if ( $format === 'thumbnail' ) { // single column width
				switch ( $col_num ) {
					case 1:
						return 'large'; // full width of container
					case 2:
						return 'half-container'; // 1/2 width of container
					case 3:
						return 'thumbnail'; // 1/3 width of container
				}
			} else { // featured box or single view - double or triple column width
				return 'full-container'; // full width of container  /  full width of Main content
			}
		}
	}
}
if ( ! function_exists( __NAMESPACE__ . '\get_search_query' ) ) {
	/**
	 * Prepare search query for WP_Query class
	 *
	 * @return array
	 * @access public
	 * @global $query_string
	 */
	function get_search_query() {
		global $query_string;

		$query_args   = explode( '&', $query_string );
		$search_query = array();
		foreach ( $query_args as $key => $string ) {
			$query_split                     = explode( '=', $string );
			$search_query[ $query_split[0] ] = isset( $query_split[1] ) ? urldecode( $query_split[1] ) : '';
		} // foreach

		return $search_query;
	}
}

if ( ! function_exists( __NAMESPACE__ . '\is_active' ) ) {
	/**
	 * Check the base plugin is installed and activate
	 *
	 * @return bool
	 * @access public
	 */
	function is_active() {
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if (
			is_plugin_active('silverwp/silverwp.php')
		    && is_plugin_active('silverwp-addons/silverwp-addons.php')
		) {
			return true;
		}
		return false;
	}
}

if ( ! function_exists( __NAMESPACE__ . '\get_customizer_option' ) ) {
	/**
	 * Short cut to CustomizerAbstract::getOption()
	 *
	 * @param string $option_name
	 *
	 * @return string
	 * @access public
	 * @since 0.2
	 * @author Michal Kalkowski <michal at silversite.pl>
	 */
	function get_customizer_option( $option_name ) {
		if ( \SilverWp\is_active() ) {
			return CustomizerAbstract::getOption( $option_name );
		} else {
			return false;
		}
	}
}

if ( ! function_exists( __NAMESPACE__ . '\get_theme_option' ) ) {
	/**
	 * Short cut to SilverWp\Helper\Option::get_theme_option()
	 *
	 * @param string $option_name
	 *
	 * @return string
	 * @access public
	 * @author Marcin Dobroszek <marcin at silversite.pl>
	 * @since 0.2
	 */
	function get_theme_option( $option_name ) {
		if ( \SilverWp\is_active() ) {
			return Option::get_theme_option( $option_name );
		} else {
			return false;
		}
	}
}

if ( ! function_exists( __NAMESPACE__ . '\get_meta_box' )) {
	/**
	 * Get data from meta box
	 *
	 * @param MetaBoxAbstract|string $meta_box_class Meta box object instance or full name (string)
	 * @param string                 $meta_name
	 * @param null|int               $post_id
	 * @param bool|true              $remove_first if array remove or not first element this is
	 *                                             useful wen we have only one element in array
	 *
	 * @return array|bool|string
	 * @throws \Exception|\InvalidArgumentException
	 * @access public
	 */
	function get_meta_box(
		$meta_box_class, $meta_name, $post_id = null, $remove_first = true
	) {
		if ( \SilverWp\is_active() ) {
			if ( is_null( $post_id ) ) {
				$post_id = get_the_ID();
			}
			if ( is_object( $meta_box_class )
			     && $meta_box_class instanceof MetaBoxAbstract
			) {
				$meta_box = $meta_box_class->get( $post_id, $meta_name, $remove_first );
			} elseif ( is_string( $meta_box_class ) ) {
				$meta_box_class = strpos($meta_box_class,'post') !== false ? 'post' : $meta_box_class;

				$class_name = '\SilverWpAddons\MetaBox\\' . ucfirst( $meta_box_class );
				if ( class_exists( $meta_box_class ) ) {
					//if passed full class name
					$class_name = $meta_box_class;
				} elseif ( class_exists( $class_name ) ) {
					//if passed only last part of class name
					$class_name = '\SilverWpAddons\MetaBox\\' . ucfirst( $meta_box_class );
				} else {
					//if class not exists throw exception
//					throw new \InvalidArgumentException(
//						Translate::translate( 'Meta Box class: %s does not exists.', $class_name )
//					);
					return false;
				}
				/** @var MetaBoxAbstract $class_name */
				$meta_box = $class_name::getInstance()
				                       ->get( $post_id, $meta_name, $remove_first );
			}

			return $meta_box;
		}

		return false;
	}
}

if ( ! function_exists(  __NAMESPACE__ . '\get_template_part' ) ) {

	/**
	 * Load template part with parameters
	 *
	 * @param string $template_name template name
	 * @param array  $params        - associative array with
	 *                              variable_name => variable_value
	 *                              then in template will be available $variable_name
	 *
	 * @return string
	 * @access public
	 * @since  0.2
	 * @author Michal Kalkowski <michal at silversite.pl>
	 */
	function get_template_part( $template_name, array $params = array() ) {
		extract( $params );
		$template_file = locate_template( "$template_name.php" );
		include $template_file;
	}
}

if ( ! function_exists(  __NAMESPACE__ . '\get_related_posts_by_common_terms' ) ) {
	/**
	 * Returns related posts to a given post based on a specific taxonomy
	 * By default, this method returns list of posts with the highest number of common tags
	 *
	 * @param $post_id - the reference post for which we want to get the list of similar posts
	 * @param $number_posts - max how many related posts to return, 0 for unlimited
	 * @param $taxonomy - which taxonomy to use to determine related posts ( 'post_tag' or 'category' are the basic examples )
	 * @param $post_type - change to a custom post_type if you want to get related posts of another post type
	 * @return array|bool
	 */
	function get_related_posts_by_common_terms(
		$post_id, $number_posts = 0, $taxonomy = 'post_tag', $post_type = 'post'
	) {

		global $wpdb;

		$post_id = (int) $post_id;
		$number_posts = (int) $number_posts;

		$limit = $number_posts > 0 ? ' LIMIT ' . $number_posts : '';
		$sql = "SELECT tr.object_id, count( tr.term_taxonomy_id ) AS common_tax_count
             FROM {$wpdb->prefix}term_relationships AS tr
             INNER JOIN {$wpdb->prefix}term_relationships AS tr2 ON tr.term_taxonomy_id = tr2.term_taxonomy_id
             INNER JOIN {$wpdb->prefix}term_taxonomy as tt ON tt.term_taxonomy_id = tr2.term_taxonomy_id
             INNER JOIN {$wpdb->prefix}posts as p ON p.ID = tr.object_id
             WHERE
                tr2.object_id = %d
                AND tt.taxonomy = %s
                AND p.post_type = %s
             GROUP BY tr.object_id
             HAVING tr.object_id != %d
             ORDER BY common_tax_count DESC " . $limit;

		$related_posts_records = $wpdb->get_results(
			$wpdb->prepare( $sql, $post_id, $taxonomy, $post_type, $post_id )
		);

		if ( count( $related_posts_records ) === 0 ) {
			return false;
		}

		$related_posts = array();

		foreach ( $related_posts_records as $record ) {
			$related_posts[] = array(
				get_post( (int) $record->object_id )
			);
		}

		return $related_posts;
	}
}
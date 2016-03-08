<?php
namespace SilverWp\Sources;

use SilverWp\FileSystem;

if ( ! function_exists( __NAMESPACE__ . '\\get_icons' ) ) {

	/**
	 *
	 * Get list of icons (default: Fontello)
	 *
	 * @param string $name of css class
	 * @param string $path path to css file with fonts
	 *
	 * @param string $transient_name cache key name
	 *
	 * @return array|bool
	 */
	function get_icons(
		$name = 'icon',
		$path = null,
		$transient_name = 'silverwp_fontello_icons'
	) {
		if ( is_null( $path ) ) {
			$path = FileSystem::getDirectory( 'icons_path' ) . 'fontello.css';
		}

		if ( ( $icons = \get_transient( $transient_name ) ) == false ) {
			if ( ! file_exists( $path ) ) {
				return false;
			}
			$matches = array();

			$pattern = '/\.(' . $name . '-(?:\w+(?:-)?)+):before\s*{\s*content/';
			$subject = file_get_contents( $path );

			preg_match_all( $pattern, $subject, $matches, PREG_SET_ORDER );

			foreach ( $matches as $match ) {
				$icons[] = array(
					'value' => $match[1],
					'label' => str_replace( $name . '-', '', $match[1] ),
				);
			}
			set_transient( $transient_name, $icons, 60 * 60 * 24 );
		}

		return $icons;
	}
}
/**
 * EOF
 */

<?php

/*
 * Copyright (C) 2014 Michal Kalkowski <michal at silversite.pl>
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */
namespace SilverWpAddons;

use SilverWp\FileSystem;

try {
	//register required plugins
    if ( class_exists( '\SilverWp\SilverWp' ) ) {
        //register patches
	    $theme_root_path = get_stylesheet_directory();
	    $theme_root_uri = get_template_directory_uri();

        $file_system = FileSystem::getInstance();
        $file_system->addDirectory( 'data',  $theme_root_path . '/sources/' )->registerDataSource();

        $file_system->addDirectory( 'css_template_uri',  $theme_root_uri . '/assets/styles/' );
	    $file_system->addDirectory( 'css_template_path', $theme_root_path . '/assets/styles/' );

	    $file_system->addDirectory( 'css_uri', $theme_root_uri . '/dist/styles/' );
	    $file_system->addDirectory( 'css_path', $theme_root_path . '/dist/styles/' );

	    $file_system->addDirectory( 'images_uri', $theme_root_uri . '/dist/images/' );
	    $file_system->addDirectory( 'images_path', $theme_root_path . '/dist/images/' );

	    $file_system->addDirectory( 'icons_uri', $theme_root_uri . '/dist/fonts/' );
	    $file_system->addDirectory( 'icons_path', $theme_root_path . '/dist/fonts/' );

	    $file_system->addDirectory( 'js_uri', $theme_root_uri . '/dist/scripts/' );
	    $file_system->addDirectory( 'js_path', $theme_root_path . '/dist/scripts/' );

        $file_system->addDirectory( 'fonts_uri', $theme_root_uri . '/dist/fonts/' );
        $file_system->addDirectory( 'fonts_path', $theme_root_path . '/dist/fonts/' );

        $file_system->addDirectory( 'theme_plugin_uri', $theme_root_uri . '/plugins/' );
        $file_system->addDirectory( 'theme_plugin_path', $theme_root_path . '/plugins/' );

		if ( class_exists( '\SilverWpAddons\ShortCode\Setup' ) ) {
			$file_system->addDirectory( 'vc_templates', $theme_root_path . '/views/shortcodes/vc_templates/' );
			$file_system->addDirectory( 'sc_templates', $theme_root_path . '/views/shortcodes/' );
		}
	    $file_system->addDirectory( 'views', $theme_root_path . '/views/' );

	    $file_system->addDirectory( 'lib_path', $theme_root_path . '/lib/' );
	    $file_system->addDirectory( 'widgets_views', $theme_root_path . '/views/widgets/' );

        if ( function_exists( 'vc_set_as_theme' ) ) {
            $vc_templates = $file_system->getDirectories( 'vc_templates' );
            \SilverWpAddons\ShortCode\Setup::getInstance()->setViewPath( $vc_templates );
			//set default checked posts
	        $pt_array = get_option( 'wpb_js_content_types' );
	        if ( ! is_array( $pt_array ) || ! in_array( 'post', $pt_array ) ) {
		        $pt_array[] = 'post';
		        update_option( 'wpb_js_content_types', $pt_array );
	        }
	    }

        \SilverWp\SilverWp::getInstance();

	    if ( is_admin() ) {
		    $style_dir = trailingslashit( $theme_root_path );
		    require_once $style_dir . 'lib/ThemeOption/Option.php';
			\ThemeOption\Option::getInstance();
		}

		/*
	    $customizer = \Customizer\Customizer::getInstance();
		$customizer->addSection( new \Customizer\Panel\General() );
		$customizer->addSection( new \Customizer\Panel\StyleLayout() );
		$customizer->addSection( new \Customizer\Panel\Blog() );
		*/
	}
} catch ( \SilverWp\Exception $ex ) {
    $ex->catchException();
}
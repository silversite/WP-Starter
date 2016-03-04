<?php

namespace ThemeOption;

use SilverWp\ThemeOption\ThemeOptionAbstract;
use SilverWp\Translate;
use ThemeOption\Menu\Ad;
use ThemeOption\Menu\General;
use ThemeOption\Menu\Layout;
use ThemeOption\Menu\ThemeUpdate;

$style_dir = trailingslashit( get_stylesheet_directory() );

require_once $style_dir . 'lib/ThemeOption/Menu/General.php';
require_once $style_dir . 'lib/ThemeOption/Menu/Ad.php';
require_once $style_dir . 'lib/ThemeOption/Menu/Layout.php';
require_once $style_dir . 'lib/ThemeOption/Menu/Social.php';
require_once $style_dir . 'lib/ThemeOption/Menu/ThemeUpdate.php';

if ( ! class_exists( '\ThemeOption\Option' ) ) {
	/**
	 * Create Theme Options page
	 *
	 * @author        Michal Kalkowski <michal at silversite.pl>
	 * @version       0.3
	 * @category      WordPress
	 * @package       SilverWp
	 * @subpackage    ThemeOption
	 * @copyright (c) 2009 - 2014, SilverSite.pl
	 */
	class Option extends ThemeOptionAbstract {
		protected function setUp() {
			$this->labels = array(
				'page_title' => Translate::translate( 'Theme Options' ),
                'menu_label' => Translate::translate( 'Theme Options' ),
                'title'      => Translate::translate( 'Theme Options Panel' ),
            );
        }

        protected function createOptions() {
            $this->addMenu( new General() );
            $this->addMenu( new Ad() );
            $this->addMenu( new Layout() );
            //$this->addMenu( new Social() );
	        $this->addMenu( new ThemeUpdate() );
        }
    }
}
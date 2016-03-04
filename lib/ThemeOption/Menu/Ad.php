<?php

namespace ThemeOption\Menu;

use SilverWp\Helper\Control\Text;
use SilverWp\Helper\Control\Textarea;
use SilverWp\ThemeOption\Menu\MenuAbstract;
use SilverWp\ThemeOption\Menu\Section;
use SilverWp\Translate;

if ( ! class_exists( 'ThemeOption\Menu\Ad' ) ) {

	/**
	 * Advertise
	 *
	 * @author        Marcin <marcin at silversite.pl>
	 * @category      WordPress
	 * @package       SilverWp
	 * @subpackage    ThemeOption\Menu
	 * @copyright (c) 2009 - 2015, SilverSite.pl
	 */
	class Ad extends MenuAbstract {
		public function createMenu() {
			$this->setName( 'ad' );
			$this->setLabel( Translate::translate( 'Advert' ) );
			$this->setIcon( 'font-awesome:fa-cogs' );

			$section = new Section( 'adleft' );
			$section->setTitle( Translate::translate( 'Ad on the left' ) );
            $ad_left_width = new Text( 'adleftwidth' );
            $ad_left_width->setLabel( Translate::translate( 'Width of banners' ) );
            $ad_left_width->setDescription( Translate::translate( 'Set the size in "px".' ) );
            $section->addControl( $ad_left_width );
			$ad_left_1 = new Textarea( 'adleft1' );
            $ad_left_1->setLabel( Translate::translate( 'HTML code' ) );
			$section->addControl( $ad_left_1 );
			$this->addControl( $section );

            $section = new Section( 'adbottom' );
            $section->setTitle( Translate::translate( 'Ad on the bottom' ) );
            $ad_left_2 = new Textarea( 'adbottom1' );
            $ad_left_2->setLabel( Translate::translate( 'HTML code' ) );
            $section->addControl( $ad_left_2 );
            $this->addControl( $section );
		}
	}
}
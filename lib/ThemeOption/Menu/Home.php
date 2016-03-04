<?php
namespace SilverWp\ThemeOption\Menu;

use SilverWp\Helper\Control\Slider;
use SilverWp\Helper\Control\Toggle;
use SilverWp\Translate;

/**
 * Theme Options for Home page
 *
 * @author Michal Kalkowski <michal at silversite.pl>
 * @version $Id: Home.php 2568 2015-03-13 14:28:41Z padalec $
 * @category WordPress
 * @package SilverWp
 * @subpackage ThemeOption\Menu
 * @copyright (c) 2009 - 2014, SilverSite.pl
 */
class Home extends MenuAbstract {
    public function createMenu() {
        $this->setName( 'home' );
        $this->setLabel( Translate::translate( 'Home page' ) );
        $this->setIcon( 'font-awesome:fa-home' );

        $section = new Section( 'home_slider' );
        $section->setTitle( Translate::translate( 'Slider options' ) );

        $slider = new Slider( 'home_slider_interval' );
        $slider->setLabel( Translate::translate( 'Interval' ) );
        $slider->setMin( 1000 );
        $slider->setMax( 10000 );
        $slider->setStep( 500 );
        $slider->setDescription( Translate::translate( 'The amount of time to delay between automatically cycling an item. If false, carousel will not automatically cycle.' ) );
        $section->addControl( $slider );

        $toggle = new Toggle( 'home_slider_hover_pause' );
        $toggle->setLabel( Translate::translate( 'Pause when "hover"' ) . ':' );
        $toggle->setDescription( Translate::translate( 'Pauses the cycling of the carousel on mouse enter and resumes the cycling of the carousel on mouse leave.' ) );
        $section->addControl( $toggle );

        $toggle = new Toggle( 'home_slider_wrap' );
        $toggle->setLabel( Translate::translate( 'Wrap' ) . ':' );
        $toggle->setDescription( Translate::translate( 'Whether the carousel should cycle continuously or have hard stops.' ) );
        $section->addControl( $toggle );

        $this->addControl( $section );
    }
}

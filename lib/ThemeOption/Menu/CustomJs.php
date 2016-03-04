<?php
namespace ThemeOption\Menu;

use SilverWp\Helper\Control\CodeEditor;
use SilverWp\Helper\Control\Text;
use SilverWp\Helper\Control\Toggle;
use SilverWp\ThemeOption\Menu\MenuAbstract;
use SilverWp\ThemeOption\Menu\Section;
use SilverWp\Translate;

if ( ! class_exists( '\ThemeOption\Menu\CustomJs' ) ) {
    /**
     * CustomJs Providers Theme Options
     *
     * @author Michal Kalkowski <michal at silversite.pl>
     * @version $Id: CustomJs.php 2569 2015-03-13 16:46:33Z padalec $
     * @category WordPress
     * @package SilverWp
     * @subpackage ThemeOption\Menu
     * @copyright (c) 2009 - 2014, SilverSite.pl
     */
    class CustomJs extends MenuAbstract {
        public function createMenu() {
            $this->setName( 'tracking_js' );
            $this->setLabel( Translate::translate( 'Tracking & Javascript' ) );
            $this->setIcon( 'font-awesome:fa-js' );

            $section = new Section( 'js' );
            $section->setTitle( Translate::translate( 'Javascript' ) );
            $header_js = new CodeEditor( 'js_header_code' );
            $header_js->setLabel( Translate::translate( 'Custom code in Head page' ) );
            $header_js->setDescription( Translate::translate( 'Any code you place here will appear before &lt;/head&gt; tag of every.' ) );
            $header_js->setTheme( 'github' );
            $header_js->setMode( 'javascript' );
            $section->addControl( $header_js );

            $body_js = new CodeEditor( 'js_body_code' );
            $body_js->setLabel( Translate::translate( 'Custom code in Body page' ) );
            $body_js->setDescription( Translate::translate( 'Any code you place here will appear before &lt;/body&gt; tag of every page of your site.' ) );
            $body_js->setTheme( 'github' );
            $body_js->setMode( 'javascript' );
            $section->addControl( $body_js );

            $this->addControl( $section );

            $section = new Section( 'tracking' );
            $section->setTitle( Translate::translate( 'Tracking' ) );
            $tracking_code = new CodeEditor( 'tracking_code' );
            $tracking_code->setLabel( Translate::translate( 'Google analytics tracking code' ) );
            $tracking_code->setTheme( 'github' );
            $tracking_code->setMode( 'javascript' );
            $section->addControl( $tracking_code );

            $this->addControl( $section );
        }
    }
}
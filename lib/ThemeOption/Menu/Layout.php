<?php
namespace ThemeOption\Menu;

use SilverWp\Helper\Control\CodeEditor;
use SilverWp\Helper\Control\SidebarPosition;
use SilverWp\Helper\Control\Toggle;
use SilverWp\ThemeOption\Menu\MenuAbstract;
use SilverWp\Translate;

if ( ! class_exists( 'ThemeOption\Menu\Layout' ) ) {
    /**
     * Menu Layout
     *
     * @author        Michal Kalkowski <michal at silversite.pl>
     * @version       $Id: Layout.php 2576 2015-03-16 14:55:30Z padalec $
     * @category      WordPress
     * @package       SilverWp
     * @subpackage    ThemeOption\Menu
     * @copyright (c) 2009 - 2014, SilverSite.pl
     */
    class Layout extends MenuAbstract {

        /**
         *
         * This method is used to add
         * sections and controls inside menu page.
         *
         * @return void
         * @access protected
         */
        protected function createMenu() {
            $this->setName( 'layout' );
            $this->setLabel( Translate::translate( 'Styles and layout' ) );
            $this->setIcon( 'font-awesome:fa-home' );

            $toggle = new Toggle( 'friendly_date_format' );
            $toggle->setLabel( Translate::translate( 'Friendly date format' ) );
            $toggle->setDescription( Translate::translate( 'CuteTime plugin changes date format from "2009-10-25" to "2 days ago".' ) );
            $toggle->setDefault( 0 );
            $this->addControl( $toggle );

            $sidebar = new SidebarPosition( 'pages_sidebar' );
            $sidebar->setLabel( Translate::translate( 'Pages sidebar' ) );
            $sidebar->setDescription( Translate::translate( 'Default position for new Page.' ) );
            $sidebar->removeOption( 1 );
            $this->addControl( $sidebar );

            $sidebar = new SidebarPosition( 'blogposts_sidebar' );
            $sidebar->setLabel( Translate::translate( 'Blog sidebar' ) );
            $sidebar->setDescription( Translate::translate( 'Default position for new Post, Posts Page and Search.' ) );
            $sidebar->removeOption( 1 );
            $this->addControl( $sidebar );

            $css = new CodeEditor( 'custom_css' );
            $css->setLabel( Translate::translate( 'Custom CSS' ) );
            $css->setTheme( 'github' );
            $css->setMode( 'css' );

            $this->addControl( $css );
        }
    }
}
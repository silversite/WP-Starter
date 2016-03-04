<?php
namespace ThemeOption\Menu;

use SilverWp\Helper\Control\Notebox;
use SilverWp\Helper\Control\Text;
use SilverWp\ThemeOption\Menu\MenuAbstract;
use SilverWp\ThemeOption\Menu\Section;
use SilverWp\Translate;

if ( ! class_exists( 'ThemeOption\Menu\ThemeUpdate' ) ) {

    /**
     * Theme update submenu page
     *
     * @category WordPress
     * @package SilverWp
     * @subpackage ThemeOption\Menu
     * @author Michal Kalkowski <michal at dynamite-studio.pl>
     * @copyright Dynamite-Studio.pl 2014
     * @version $Revision:$
     */
    class ThemeUpdate extends MenuAbstract {

        /**
         *
         * Create menu
         *
         * @access protected
         * @return void
         */
        protected function createMenu() {
            $this->setName( 'theme_update' );
            $this->setLabel( Translate::translate( 'Theme update' ) );
            $this->setIcon( 'font-awesome:fa-home' );

            $section  = new Section( 'theme_api' );
            $note_box = new Notebox( 'note_box' );
            $note_box->setLabel( Translate::translate( 'Update your Theme from the WordPress Dashboard' ) );
            $note_box->setDescription( Translate::translate( 'If you want to get update notifications for your themes and if you want to be able to update your theme from your WordPress backend you need to enter your Themeforest account name as well as your Themeforest Secret API Key below:' ) );
            $section->addControl( $note_box );

            $user_name = new Text( 'tf_user_name' );
            $user_name->setLabel( Translate::translate( 'Your Themeforest User Name' ) );
            $user_name->setDescription( Translate::translate( 'Enter the Name of the User you used to purchase this theme' ) );
            $section->addControl( $user_name );

            $api_key = new Text( 'tf_api_key' );
            $api_key->setLabel( Translate::translate( 'Your Themeforest API Key' ) );
            $api_key->setDescription( Translate::translate( 'Enter the API Key of your Account here. <a href="">You can find your API Key here</a>' ) );
            $section->addControl( $api_key );

            $this->addControl( $section );
        }
    }
}

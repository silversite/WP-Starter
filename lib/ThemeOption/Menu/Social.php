<?php
namespace ThemeOption\Menu;

use SilverWp\Helper\Control\Notebox;
use SilverWp\Helper\Control\Select;
use SilverWp\Helper\Control\Text;
use SilverWp\Helper\Control\Toggle;
use SilverWp\ThemeOption\Menu\MenuAbstract;
use SilverWp\ThemeOption\Menu\Section;
use SilverWp\ThemeOption\Menu\SectionInterface;
use SilverWp\Translate;

if ( ! class_exists( 'ThemeOption\Menu\Social' ) ) {
    /**
     * Social Providers Theme Options
     *
     * @author        Michal Kalkowski <michal at silversite.pl>
     * @version       $Revision: $
     * @category      WordPress
     * @package       SilverWp
     * @subpackage    ThemeOption\Menu
     * @copyright (c) 2015, SilverSite.pl
     */
    class Social extends MenuAbstract {
        public function createMenu() {
            $this->setName( 'social' );
            $this->setLabel( Translate::translate( 'Social' ) );
            $this->setIcon( 'font-awesome:fa-share' );

            $section = new Section( 'social_accounts' );
            $section->setTitle( Translate::translate( 'Social accounts' ) );

            $accounts = silverwp_get_social_accounts();
            foreach ( $accounts as $slug => $name ) {
                $url = new Text( 'social_accounts[' . $slug . '][url]' );
                $url->setLabel( Translate::params( '%s URL', ucfirst( $name ) )
                    . ':' );
                $url->setValidation( 'url' );
                $section->addControl( $url );

                $order = new Text( 'social_accounts[' . $slug . '][order]' );
                $order->setLabel( Translate::params( '%s order',
                        ucfirst( $name ) ) . ':' );
                $order->setDefault( 0 );
                $section->addControl( $order );
            }

            $this->addControl( $section );

            $section = new Section( 'Social plugin' );
            $section->setTitle( Translate::translate( 'Vertical list of links to social accounts' ) );

            foreach ( $accounts as $provider => $label ) {
                $name = 'social_plugin[' . sanitize_title( $label ) . ']';
                $toggle = new Toggle( $name );
                $toggle->setLabel( ucfirst( $label ) );
                $section->addControl( $toggle );
            }

            $radio = new Select( 'social_plugin_position' );
            $radio->setLabel( Translate::translate( 'Position on the pages' ) );
            $radio->setDescription( Translate::translate( 'Default position for new page.' ) );
            $radio->setOptions( array(
                array(
                    'value' => 'no',
                    'label' => Translate::translate('No social plugin')
                ),
                array(
                    'value' => 'right',
                    'label' => Translate::translate( 'Right-hand side of the content' ),
                ),
                array(
                    'value' => 'left',
                    'label' => Translate::translate( 'Left-hand side of the screen' ),
                )
            ) );
            $radio->setDefault( 'no' );
            $section->addControl( $radio );

            $this->addControl( $section );

            $section = new Section( 'share' );
            $section->setTitle( Translate::translate( 'Share providers' ) );
            $this->shareProviders($section);
            $this->addControl( $section );

            $section = new Section( 'twitter_plugins' );
            $section->setTitle( Translate::translate( 'Twitter oAuth settings' ) );
            $toggle = new Toggle( 'use_twitter_plugin' );
            $toggle->setLabel( Translate::translate( 'Twitter oAuth Plugin enabled' ) );
            $section->addControl( $toggle );
            $this->twitterAuth( $section, $toggle );
            $this->addControl( $section );

            $section = new Section( 'instagram_plugins' );
            $section->setTitle( Translate::translate( 'Instagram oAuth settings' ) );
            $toggle = new Toggle( 'use_instagram_plugin' );
            $toggle->setLabel( Translate::translate( 'Instagram oAuth Plugin enabled' ) );
            $section->addControl( $toggle );
            $this->instagramAuth( $section, $toggle );
            $this->addControl( $section );
        }

        /**
         * all needed fields for oAuth authorization protocol
         *
         * @param SectionInterface $section
         *
         * @param Toggle           $toggle
         *
         * @return array
         * @throws \SilverWp\Helper\Control\Exception
         */
        protected function twitterAuth( SectionInterface $section, Toggle $toggle ) {
            $note_box = new Notebox();
            $note_box->setLabel(
                Translate::params(
                    'These details are available in <a href="%s" target="_blank">your dashboard</a>.'
                    , 'https://dev.twitter.com/apps'
                )
            );
            $note_box->setDependency( $toggle, 'vp_dep_boolean' );
            $note_box->setStatus( 'normal' );
            $section->addControl( $note_box );

            $text = new Text( 'twitter_oauth_key' );
            $text->setLabel( Translate::translate( 'OAuth Consumer Key' ) );
            $text->setDependency( $toggle, 'vp_dep_boolean' );
            $section->addControl( $text );

            $text = new Text( 'twitter_oauth_secret' );
            $text->setLabel( Translate::translate( 'OAuth Consumer Secret' ) );
            $text->setDependency( $toggle, 'vp_dep_boolean' );
            $section->addControl( $text );

            $text = new Text( 'twitter_oauth_access_token' );
            $text->setLabel( Translate::translate( 'OAuth Access Token' ) );
            $text->setDependency( $toggle, 'vp_dep_boolean' );
            $section->addControl( $text );

            $text = new Text( 'twitter_oauth_access_secret' );
            $text->setLabel( Translate::translate( 'OAuth Access Secret' ) );
            $text->setDependency( $toggle, 'vp_dep_boolean' );
            $section->addControl( $text );
        }

        /**
         *
         * List off all social share providers
         *
         * @param SectionInterface $section
         *
         * @access protected
         * @return array section with on/off buttons for providers
         */
        protected function shareProviders( SectionInterface $section ) {
            $providers = silverwp_get_social_providers();
            foreach ( $providers as $provider ) {
                if ( $provider['share_url'] != '' ) {
                    $name = 'social_share_providers[' . sanitize_title( $provider['name'] ) . ']';
                    $toggle = new Toggle( $name );
                    $toggle->setLabel( ucfirst( $provider['name'] ) );
                    $section->addControl( $toggle );
                }
            }
        }

        /**
         * All needed fields for oAuth authorization protocol
         *
         * @param SectionInterface $section
         *
         * @return array
         * @throws \SilverWp\Helper\Control\Exception
         */
        protected function instagramAuth( SectionInterface $section, Toggle $toggle ) {
            $note_box = new Notebox();
            $note_box->setLabel(
                Translate::params(
                    'These details are available in <a href="%s" target="_blank">your dashboard</a>.'
                    , 'https://instagram.com/developer/register/'
                ).'<br>'.
                Translate::translate( '<u>Client ID</u> or <u>Access Token</u> is required.' )
            );
            $note_box->setDependency( $toggle, 'vp_dep_boolean' );
            $note_box->setStatus( 'normal' );
            $section->addControl( $note_box );

            $text = new Text( 'instagram_client_id' );
            $text->setLabel( Translate::translate( 'Client ID' ) );
            $text->setDescription( Translate::translate( 'Your API client id from Instagram.' ) );
            $text->setDependency( $toggle, 'vp_dep_boolean' );
            $section->addControl( $text );

            $text = new Text( 'instagram_token' );
            $text->setLabel( Translate::translate( 'Access Token' ) );
            $text->setDescription( Translate::translate( 'A valid oAuth token.' ) );
            $text->setDependency( $toggle, 'vp_dep_boolean' );
            $section->addControl( $text );

            $text = new Text( 'instagram_user_id' );
            $text->setLabel( Translate::translate( 'User ID' ) );
            $text->setDescription( Translate::translate( 'Unique id of a user to get. You can check it on <a href="http://jelled.com/instagram/lookup-user-id" target="_blank">jelled.com</a>.' ) );
            $text->setDependency( $toggle, 'vp_dep_boolean' );
            $section->addControl( $text );
        }
    }
}
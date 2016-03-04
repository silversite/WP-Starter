<?php
namespace ThemeOption\Menu;

use SilverWp\Helper\Control\Color;
use SilverWp\ThemeOption\Menu\MenuAbstract;
use SilverWp\ThemeOption\Menu\Section;
use SilverWp\Translate;

if ( ! class_exists( 'ThemeOption\Menu\ShortCodes' ) ) {

    /**
     *
     * Short Codes default layout settings
     *
     * @category WordPress
     * @package SilverWp
     * @subpackage ThemeOption\Menu
     * @author Michal Kalkowski <michal at silversite.pl>
     * @copyright Dynamite-Studio.pl 2015
     * @version $Revision:$
     */
    class ShortCodes extends MenuAbstract {

        /**
         *
         * This method is used to add
         * sections and controls inside menu page.
         *
         * @return void
         * @access protected
         */
        protected function createMenu() {
            $this->setName( 'short_code' );
            $this->setLabel( Translate::translate( 'Short codes' ) );
            $this->setIcon( 'font-awesome:fa-css3' );

            $button = new Section( 'button' );
            $button->setLabel( Translate::translate( 'Button' ) );

            $color = new Color( 'button_color' );
            $color->setLabel( Translate::translate( 'Custom color' ) );
            $color->setDefault( get_theme_mod( 'brand-primary' ) );

            $button->addControl( $color );
            $this->addControl( $button );

            $flip_box = new Section( 'flipbox' );
            $flip_box->setLabel( Translate::translate( 'Flip box' ) );

            $front_title = new Color( 'flipbox_front_title_color' );
            $front_title->setLabel( Translate::translate( 'Front Side Title Text Color' ) );
            $front_title->setDefault( get_theme_mod( 'brand-primary' ) );
            $flip_box->addControl( $front_title );

            $front_description = new Color( 'flipbox_front_description_color' );
            $front_description->setLabel( Translate::translate( 'Front Side Description Text Color' ) );
            $front_description->setDefault( get_theme_mod( 'brand-primary' ) );
            $flip_box->addControl( $front_description );

            $back_title = new Color( 'flipbox_back_title_color' );
            $back_title->setLabel( Translate::translate( 'Back Side Title Text Color' ) );
            $back_title->setDefault( get_theme_mod( 'brand-primary' ) );
            $flip_box->addControl( $back_title );

            $back_description = new Color( 'flipbox_back_description_color' );
            $back_description->setLabel( Translate::translate( 'Back Side Description Text Color' ) );
            $back_description->setDefault( get_theme_mod( 'brand-primary' ) );
            $flip_box->addControl( $back_description );

            $this->addControl( $flip_box );

            $pie_charts = new Section( 'piecharts' );
            $pie_charts->setLabel( Translate::translate( 'Pie charts' ) );

            $pie_charts_color = new Color( 'piecharts_color' );
            $pie_charts_color->setLabel( Translate::translate( 'Chart Color' ) );
            $pie_charts_color->setDefault( get_theme_mod( 'brand-primary' ) );
            $pie_charts->addControl( $pie_charts_color );
            $this->addControl( $pie_charts );

            $progressbar = new Section( 'progressbar' );
            $progressbar->setLabel( Translate::translate( 'Progress bar' ) );

            $progressbar_color = new Color( 'progressbar_color' );
            $progressbar_color->setLabel( Translate::translate( 'Chart Color' ) );
            $progressbar_color->setDefault( get_theme_mod( 'brand-primary' ) );
            $progressbar->addControl( $progressbar_color );
            $this->addControl( $progressbar );

            $separator = new Section( 'separator' );
            $separator->setLabel( Translate::translate( 'Separator' ) );

            $separator_color = new Color( 'separator_color' );
            $separator_color->setLabel( Translate::translate( 'Separator color' ) );
            $separator_color->setDefault( get_theme_mod( 'brand-primary' ) );
            $separator->addControl( $separator_color );

            $this->addControl( $separator );

            $counter = new Section( 'counter' );
            $counter->setLabel( Translate::translate( 'Counter' ) );

            $label_color = new Color( 'counter_label_color' );
            $label_color->setLabel( Translate::translate( 'Separator color' ) );
            $label_color->setDefault( get_theme_mod( 'brand-primary' ) );
            $counter->addControl( $label_color );

            $border_color = new Color( 'counter_border_color' );
            $border_color->setLabel( Translate::translate( 'Border color' ) );
            $border_color->setDefault( get_theme_mod( 'brand-primary' ) );
            $counter->addControl( $border_color );

            $background_color = new Color( 'counter_background_color' );
            $background_color->setLabel( Translate::translate( 'Background color' ) );
            $background_color->setDefault( get_theme_mod( 'brand-primary' ) );
            $counter->addControl( $background_color );
            $this->addControl( $counter );
        }
    }
}
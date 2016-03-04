<?php
namespace ThemeOption\Menu;

use SilverWp\Helper\Control\Text;
use SilverWp\ThemeOption\Menu\MenuAbstract;
use SilverWp\ThemeOption\Menu\Section;
use SilverWp\Translate;

if ( ! class_exists( '\ThemeOption\Menu\CompanyInfo' ) ) {

    /**
     *
     * Company information theme option menu page
     *
     * @category WordPress
     * @package SilverWp
     * @subpackage ThemeOption\Menu
     * @author Michal Kalkowski <michal.kalkowski at dynamite-studio.pl>
     * @copyright Dynamite-Studio.pl 2015
     * @version $Revision:$
     */
    class CompanyInfo extends MenuAbstract {

        protected function createMenu() {
            $this->setName( 'company' );
            $this->setIcon( 'font-awesome:fa-css3' );
            $this->setTitle( Translate::translate( 'Company information' ) );

            $section = new Section( 'company_info' );

            $company_name = new Text( 'company_name' );
            $company_name->setLabel( Translate::translate( 'Name' ) . ':' );
            $section->addControl( $company_name );

            $company_street = new Text( 'company_street' );
            $company_street->setLabel( Translate::translate( 'Street' ) . ':' );
            $section->addControl( $company_street );

            $company_postcode = new Text( 'company_postcode' );
            $company_postcode->setLabel( Translate::translate( 'Postcode' ) . ':' );
            $section->addControl( $company_postcode );

            $company_city = new Text( 'company_city' );
            $company_city->setLabel( Translate::translate( 'City' ) . ':' );
            $section->addControl( $company_city );

            $company_region = new Text( 'company_region' );
            $company_region->setLabel( Translate::translate( 'State / Region' ) . ':' );
            $section->addControl( $company_region );

            $company_country = new Text( 'company_country' );
            $company_country->setLabel( Translate::translate( 'Country' ) . ':' );
            $section->addControl( $company_country );

            $company_phone1 = new Text( 'company_phone1' );
            $company_phone1->setLabel( Translate::params( 'Phone number %s', '#1' ) . ':' );
            $section->addControl( $company_phone1 );

            $company_phone2 = new Text( 'company_phone2' );
            $company_phone2->setLabel( Translate::params( 'Phone number %s', '#2' ) . ':' );
            $section->addControl( $company_phone2 );

            $company_mobile1 = new Text( 'company_mobile1' );
            $company_mobile1->setLabel( Translate::params( 'Mobile phone number %s', '#1' ) . ':' );
            $section->addControl( $company_mobile1 );

            $company_mobile2 = new Text( 'company_mobile2' );
            $company_mobile2->setLabel( Translate::params( 'Mobile phone number %s', '#2' ) . ':' );
            $section->addControl( $company_mobile2 );

            $company_fax = new Text( 'company_fax' );
            $company_fax->setLabel( Translate::translate( 'Fax number' ) . ':' );
            $section->addControl( $company_fax );

            $company_email = new Text( 'company_email' );
            $company_email->setLabel( Translate::translate( 'Email address' ) . ':' );
            $company_email->setValidation( 'email' );
            $section->addControl( $company_email );
            $this->addControl( $section );
        }
    }
}
<?php

namespace ThemeOption\Menu;

use SilverWp\Helper\Control\Text;
use SilverWp\Helper\Control\CodeEditor;
use SilverWp\Helper\Control\Toggle;
use SilverWp\Helper\Control\Upload;
use SilverWp\Helper\Control\Wpeditor;
use SilverWp\ThemeOption\Menu\MenuAbstract;
use SilverWp\ThemeOption\Menu\Section;
use SilverWp\Translate;

if ( ! class_exists( 'ThemeOption\Menu\General' ) ) {

	/**
	 * General
	 *
	 * @author        Michal Kalkowski <michal at silversite.pl>
	 * @version       $Id: General.php 2575 2015-03-16 09:52:36Z padalec $
	 * @category      WordPress
	 * @package       SilverWp
	 * @subpackage    ThemeOption\Menu
	 * @copyright (c) 2009 - 2014, SilverSite.pl
	 */
	class General extends MenuAbstract {
		public function createMenu() {
			$this->setName( 'general' );
			$this->setLabel( Translate::translate( 'General' ) );
			$this->setIcon( 'font-awesome:fa-cogs' );

			$section = new Section( 'logo' );
			$section->setTitle( Translate::translate( 'Brand Logo' ) );
			$loader_img = new Upload( 'general_header_logo' );
            $loader_img->setLabel( Translate::translate( 'Regular image' ) );
            $loader_img->setDescription( Translate::translate( 'Standard screen (x1).' ) );
			$section->addControl( $loader_img );
			//$this->addControl( $section );
            $loader_img_retina = new Upload( 'general_header_logo_retina' );
            $loader_img_retina->setLabel( Translate::translate( 'Bigger image' ) );
            $loader_img_retina->setDescription( Translate::translate( 'Retina screen (High DPI, x2).' ) );
            $section->addControl( $loader_img_retina );
            //$this->addControl( $section );
            $logo_width = new Text( 'general_header_logo_width' );
            $logo_width->setLabel( Translate::translate('Logo width') );
            $logo_width->setDescription( Translate::translate( 'Set the size in "px".' ) );
            $section->addControl( $logo_width );
            $logo_height = new Text( 'general_header_logo_height' );
            $logo_height->setLabel( Translate::translate('Logo height') );
            $logo_height->setDescription( Translate::translate( 'Set the size in "px".' ) );
            $section->addControl( $logo_height );
            $logo_margin = new Text( 'general_header_top_margin' );
            $logo_margin->setLabel( Translate::translate('Margin top') );
            $logo_margin->setDescription( Translate::translate( 'Set the size in "px".' ) );
            $section->addControl( $logo_margin );
            $this->addControl( $section );

            $section = new Section( 'footer_copyright' );
            $section->setTitle( Translate::translate( 'Copyright' ) );

			$footer_copyright = new Wpeditor( 'copyright' );
            $footer_copyright->setLabel( Translate::translate( 'Copyright text' ) );
            $footer_copyright->setDescription( Translate::translate( 'Entered text will be shown under the footer.' ) );
            $section->addControl( $footer_copyright );
            $this->addControl( $section );

			$section = new Section( 'js_section' );
			$section->setTitle( Translate::translate( 'Javascript' ) );
			$header_js = new CodeEditor( 'js_header_code' );
			$header_js->setLabel( Translate::translate( 'Custom code in Head page' ) );
			$header_js->setDescription( Translate::translate( 'Any code you place here will appear before &lt;/head&gt; tag of every.' ) );
			$header_js->setTheme( 'github' );
			$header_js->setMode( 'javascript' );
			$section->addControl( $header_js );

			$body_js = new CodeEditor( 'js_footer_code' );
			$body_js->setLabel( Translate::translate( 'Custom code in Body page' ) );
			$body_js->setDescription( Translate::translate( 'Any code you place here will appear before &lt;/body&gt; tag of every page of your site.' ) );
			$body_js->setTheme( 'github' );
			$body_js->setMode( 'javascript' );
			$section->addControl( $body_js );
			$this->addControl( $section );

			$section = new Section( 'comments_section' );
			$section->setTitle( Translate::translate( 'Comments' ) );
			$section->setDescription( Translate::translate( 'You can globally disable comments here.' ) );

			$toggle = new Toggle( 'comments_pages' );
			$toggle->setLabel( Translate::translate( 'Enable on Pages' ) );
			$toggle->setDefault( 0 );
			$section->addControl( $toggle );

			$toggle = new Toggle( 'comments_blogposts' );
			$toggle->setLabel( Translate::translate( 'Enable on Blogposts' ) );
			$toggle->setDefault( 1 );
			$section->addControl( $toggle );

			$this->addControl( $section );

		}
	}
}
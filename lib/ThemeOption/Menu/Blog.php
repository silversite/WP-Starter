<?php

/*
 * Copyright (C) 2014 Michal Kalkowski <michal at silversite.pl>
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

namespace ThemeOption\Menu;

use SilverWp\Helper\Control\Toggle;
use SilverWp\Helper\Control\Select;
use SilverWp\ThemeOption\Menu\MenuAbstract;
use SilverWp\ThemeOption\Menu\Section;
use SilverWp\Translate;

if ( ! class_exists( '\ThemeOption\Menu\Blog' ) ) {

	/**
	 *
	 * Theme option panel with Blog settings
	 *
	 * @category   WordPress
	 * @package    ThemeOptions
	 * @subpackage Menu
	 * @author     Michal Kalkowski <michal at silversite.pl>
	 * @copyright  SilverSite.pl (c) 2015
	 * @version    1.0
	 */
        
    class Blog extends MenuAbstract {

	    /**
	     *
	     * This method is used to add
	     * sections and controls inside menu page.
	     *
	     * @return void
	     * @access protected
	     */
	    protected function createMenu() {
		    $this->setName( 'blog' );
		    $this->setLabel( Translate::translate( 'Blog' ) );
		    $this->setIcon( 'font-awesome:fa-pencil' );
		    #sectionlist
		    $section = new Section( 'list' );
		    $section->setLabel( Translate::translate( 'Posts list' ) );
            $section->setDescription( Translate::translate( 'Archive view: Category, Tag.' ) );

            $select = new Select( 'blog_list_layout' );
            $select->setLabel( Translate::translate( 'Default layout' ) );
            $select->setOptions(
                array(
                    array(
                        'label' => Translate::translate( 'list view' ),
                        'value' => 'list',
                    ),
                    array(
                        'label' => Translate::translate( 'grid (1 column)' ),
                        'value' => 'grid1',
                    ),
                    array(
                        'label' => Translate::translate( 'grid (2 columns)' ),
                        'value' => 'grid2',
                    ),
                    array(
                        'label' => Translate::translate( 'grid (3 columns, recommended only if you do not use sidebar)' ),
                        'value' => 'grid3',
                    )
                )
            );
            $select->setDefault( 'list' );
            $section->addControl( $select );

		    $toggle = new Toggle( 'blog_list_author' );
		    $toggle->setLabel( Translate::translate( 'Show author' ) . ':' );
            $toggle->setDescription( Translate::translate( 'Layout: GRID' ) );
		    $section->addControl( $toggle );

		    $this->addControl( $section );
			#endsectionlist
		    #sectionitem
		    $section = new Section( 'item' );
		    $section->setLabel( Translate::translate( 'Single Post' ) );

		    $toggle = new Toggle( 'blog_item_author' );
		    $toggle->setLabel( Translate::translate( 'Show author' ) . ':' );
		    $section->addControl( $toggle );

		    $this->addControl( $section );
		    #endsectionitem
	    }
    }
}
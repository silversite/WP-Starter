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
//$layout_name = $args[ 'layout' ] === 'list' ? 'list' : 'grid';

if ( $the_query->have_posts() ) :

    $has_sidebar = \SilverWp\get_theme_option( 'blogposts_sidebar' ) !== '0';

    while ( $the_query->have_posts() ) : $the_query->the_post(); // the Loop
        $stickyCSS = is_sticky() ? 'sticky' : '';

        if ( $args[ 'layout' ] === 'grid1' ) :
            $column_number = 1;
            $gridFeaturedColumnCSS = 'col-sm-12 col-xs-12 post-grid-1-col'; // in 1 column layout - every posts are the same
        elseif ( $args[ 'layout' ] === 'grid2' ) :
            $column_number = 2;
            $gridColumnCSS = 'col-sm-6 col-xs-12 masonry-item masonry-sizer';
            $gridFeaturedColumnCSS = 'col-sm-12 col-xs-12 post-grid-2-cols masonry-item'; // featured post are 2 times wider
            $isFeatured = $the_query->getMetaBox( 'featured' );
        elseif ( $args[ 'layout' ] === 'grid3' ) :
            $column_number = 1;
            $gridColumnCSS = 'col-sm-4 col-xs-12 masonry-item masonry-sizer';
            $gridFeaturedColumnCSS = 'col-sm-8 col-xs-12 post-grid-3-cols masonry-item'; // featured post are 2 times wider
            $isFeatured = $the_query->getMetaBox( 'featured' );
        endif;

        // if this is layout with 1 column - every post look like featured in 2 or 3 columns version
        if ( $args[ 'layout' ] === 'grid1' || $isFeatured === '1' ) :
            ?>
            <div class="<?php echo $gridFeaturedColumnCSS ?>">
                <hr>
                <?php
                // featured post with image
                if ( has_post_thumbnail() ) :
                    ?>
                    <article <?php post_class( 'featured ' . $stickyCSS ) ?>>
                        <header class="post-header">
                            <div class="upper posts-list-category"><?php the_category(', ') ?></div>
                            <h2 class="upper posts-list-heading">
                                <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                            </h2>
                            <time datetime="<?php echo get_the_date( 'c' ) ?>"><?php echo get_the_date() ?></time>
                        </header>
                        <?php \SilverWp\get_template_part( 'templates/thumbnail-posts-list-featured', array( 'column_number' => $column_number, 'has_sidebar' => $has_sidebar, 'the_query' => $the_query ) ); ?>
                        <?php get_template_part('templates/entry-meta-grid-featured') ?>
                        <div class="posts-list-excerpt"><?php echo $the_query->getShortDescription() ?></div>
                        <?php get_template_part('templates/img-x-line'); ?>
                        <div class="upper upper-11">
                            <a href="<?php the_permalink() ?>" class="read-more">
                                <?php esc_html_e( 'Read full article', 'whiteblack' ) ?>
                            </a>
                        </div>
                    </article>
                <?php
                // featured post without image
                else:
                    ?>
                    <article <?php post_class( 'featured ' . $stickyCSS ) ?>>
                        <?php get_template_part('templates/ico-post-type'); ?>
                        <div class="upper posts-list-category"><?php the_category(', ') ?></div>
                        <h2 class="upper posts-list-heading">
                            <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                        </h2>
                        <div class="posts-list-excerpt"><?php echo $the_query->getShortDescription() ?></div>
                        <time datetime="<?php echo get_the_date( 'c' ) ?>"><?php echo get_the_date() ?></time>
                        <?php get_template_part('templates/img-x-line'); ?>
                        <div class="upper upper-11">
                            <a href="<?php the_permalink() ?>" class="read-more">
                                <?php esc_html_e( 'Read full article', 'whiteblack' ) ?>
                            </a>
                        </div>
                    </article>
                <?php
                endif;
                ?>
            </div>
        <?php
        // regular post (not featured in list)
        else :
            // regular post with image
            if ( has_post_thumbnail() ) :
                ?>
                <div class="<?php echo $gridColumnCSS ?>">
                    <article <?php post_class( $stickyCSS ) ?>>
                        <?php \SilverWp\get_template_part( 'templates/thumbnail-posts-list-grid', array( 'column_number' => $column_number, 'has_sidebar' => $has_sidebar ) ); ?>
                        <div class="upper posts-list-category"><?php the_category(', ') ?></div>
                        <h2 class="upper posts-list-heading">
                            <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                        </h2>
                        <?php get_template_part('templates/img-x-line'); ?>
                        <div class="posts-list-excerpt"><?php echo $the_query->getShortDescription() ?></div>
                        <time datetime="<?php echo get_the_date( 'c' ) ?>"><?php echo get_the_date() ?></time>
                    </article>
                </div>
            <?php
            // regular post without image
            else :
                ?>
                <div class="<?php echo $gridColumnCSS ?>">
                    <article <?php post_class( $stickyCSS ) ?>>
                        <?php get_template_part('templates/ico-post-type'); ?>
                        <div class="upper posts-list-category"><?php the_category(', ') ?></div>
                        <h2 class="upper posts-list-heading">
                            <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                        </h2>
                        <?php get_template_part('templates/img-x-line'); ?>
                        <div class="posts-list-excerpt"><?php echo $the_query->getShortDescription() ?></div>
                        <time datetime="<?php echo get_the_date( 'c' ) ?>"><?php echo get_the_date() ?></time>
                    </article>
                </div>
            <?php
            endif;
        endif;

	endwhile;

endif;
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

// JS Plugins
// ---
// imagesLoaded  [http://imagesloaded.desandro.com/]
//wp_enqueue_script( 'imagesloaded', get_stylesheet_directory_uri() . '/plugins/imagesloaded/imagesloaded.pkgd.min.js', array(), '3.1.8', true );
// Masonry  [http://masonry.desandro.com/]
//wp_enqueue_script( 'masonry', get_stylesheet_directory_uri() . '/plugins/masonry/masonry.pkgd.min.js', array( 'imagesloaded' ), '3.3.1', true );

$shortcodeAttr = $this->getAtts();

$layout_name = $shortcodeAttr['layout'] === 'list' ? 'list' : 'grid';
$limit       = isset( $shortcodeAttr['limit'] ) && ! empty( $shortcodeAttr['limit'] ) ? (int) $shortcodeAttr['limit'] : false;
$category    = isset( $shortcodeAttr['category'] ) && ! empty( $shortcodeAttr['category'] ) ? (int) $shortcodeAttr['category'] : false;
$class     = 'wpb_content_element  posts-list  layout-' . $layout_name; // wpb_posts-list
$el_class  = $this->getExtraClass( $shortcodeAttr['el_class'] );
$css_class = apply_filters(
	VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,
	$class . $el_class,
	$this->settings['base'],
	$shortcodeAttr
);
$css_class .= $this->getCSSAnimation( $shortcodeAttr['css_animation'] );

$args = array(
	'paged' => $this->getPaged()
);
if ( $shortcodeAttr[ 'hide_sticky_posts' ] ) {
	$args['post__not_in'] = get_option( 'sticky_posts' );
}
if ( $limit ) {
	$args['posts_per_page'] = $limit;
}
if ( $category ) {
	$args['cat'] = $category;
	$term_name   = 'cat';
	$term_value  = $category;
} else {
	$term_name  = '*';
	$term_value = '*';
}
$query_args = $this->getQueryArgs( $args );
$the_query  = new \SilverWp\Db\Query( $query_args );
$the_query->setMetaBox( \SilverWpAddons\MetaBox\Post::getInstance() );
if ( $the_query->have_posts() ) : ?>
	<section class="<?php echo $css_class; ?>">
    <?php // ------------- ?>
    <?php // Layout: LIST  ?>
    <?php // ------------- ?>
    <?php if ( $shortcodeAttr[ 'layout' ] === 'list' ) : ?>
        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); // the Loop ?>
            <?php
            $stickyCSS = is_sticky() ? ' sticky' : '';
            $isFeatured = $the_query->getMetaBox( 'featured' );
            ?>

            <?php if ( $isFeatured === '1' ): ?>
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
                        <?php \SilverWp\get_template_part( 'templates/thumbnail-posts-list-featured', array( 'column_number' => 1) ); ?>
                        <?php get_template_part('templates/entry-meta-grid-featured') ?>
                        <div class="posts-list-excerpt"><?php echo $the_query->getShortDescription() ?></div>
                        <?php get_template_part('templates/img-x-line'); ?>
                        <a href="<?php the_permalink() ?>" class="btn btn-primary btn-rnd" role="button">
                            <?php esc_html_e('Read full article', 'whiteblack') ?>
                        </a>
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
                <hr>
            <?php else: ?>
                <article <?php post_class( $stickyCSS ) ?>>
                    <div class="row">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="col-sm-4">
                                <?php get_template_part('templates/thumbnail-posts-list-list'); ?>
                            </div>
                            <div class="col-sm-8">
                                <div class="upper posts-list-category"><?php the_category(', ') ?></div>
                                <h2 class="upper posts-list-heading"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
                                <?php get_template_part('templates/img-x-line'); ?>
                                <div class="posts-list-excerpt"><?php echo $the_query->getShortDescription() ?></div>
                                <time datetime="<?php echo get_the_date( 'c' ) ?>"><?php echo get_the_date() ?></time>
                            </div>
                        <?php else : ?>
                            <div class="col-sm-12">
                                <div class="upper posts-list-category"><?php the_category(', ') ?></div>
                                <h2 class="upper posts-list-heading"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
                                <?php get_template_part('templates/img-x-line'); ?>
                                <div class="posts-list-excerpt"><?php echo $the_query->getShortDescription() ?></div>
                                <time datetime="<?php echo get_the_date( 'c' ) ?>"><?php echo get_the_date() ?></time>
                            </div>
                        <?php endif; ?>
                    </div>
                </article>
                <hr>
            <?php endif; ?>
        <?php endwhile; ?>
        <nav>
            <div class="upper upper-11 pagination">
                <span class="pagination-prev">
                    <?php next_posts_link( '<i class="icon-angle-left"></i>' . esc_html__( 'Older posts', 'whiteblack' ) , $the_query->max_num_pages ); ?>
                </span>
                <span class="pagination-next">
                    <?php previous_posts_link( esc_html__( 'Later posts', 'whiteblack' ) . '<i class="icon-angle-right"></i>' ); ?>
                </span>
            </div>
        </nav>
    <?php // ------------- ?>
    <?php // Layout: GRID  ?>
    <?php // ------------- ?>
    <?php
    elseif (
	    $shortcodeAttr['layout'] === 'grid1'
	    || $shortcodeAttr['layout'] === 'grid2'
	    || $shortcodeAttr['layout'] === 'grid3'
    ) : ?>
        <div class="row masonry" id="ajax-post-container">
            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); // the Loop ?>
                <?php
                $stickyCSS = is_sticky() ? 'sticky' : '';
                if ( $shortcodeAttr[ 'layout' ] === 'grid1' ) :
                    $column_number = 1;
                    $gridFeaturedColumnCSS = 'col-sm-12 col-xs-12 post-grid-1-col'; // in 1 column layout - every posts are the same
                elseif ( $shortcodeAttr[ 'layout' ] === 'grid2' ) :
                    $column_number = 2;
                    $gridColumnCSS = 'col-sm-6 col-xs-12 masonry-item masonry-sizer';
                    $gridFeaturedColumnCSS = 'col-sm-12 col-xs-12 post-grid-2-cols masonry-item'; // featured post are 2 times wider
                    $isFeatured = $the_query->getMetaBox( 'featured' );
                elseif ( $shortcodeAttr[ 'layout' ] === 'grid3' ) :
                    $column_number = 3;
                    $gridColumnCSS = 'col-sm-4 col-xs-12 masonry-item masonry-sizer';
                    $gridFeaturedColumnCSS = 'col-sm-12 col-xs-12 post-grid-3-cols masonry-item'; // featured post are 2 times wider
                    $isFeatured = $the_query->getMetaBox( 'featured' );
                endif;

                // if this is layout with 1 column - every post look like featured in 2 or 3 columns version
                if ( $shortcodeAttr[ 'layout' ] === 'grid1' || $isFeatured === '1' ) :
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
                                <?php \SilverWp\get_template_part( 'templates/thumbnail-posts-list-featured', array( 'column_number' => $column_number) ); ?>
                                <?php get_template_part('templates/entry-meta-grid-featured') ?>
                                <div class="posts-list-excerpt"><?php echo $the_query->getShortDescription() ?></div>
                                <?php get_template_part('templates/img-x-line'); ?>
                                <a href="<?php the_permalink() ?>" class="btn btn-primary btn-rnd" role="button">
                                    <?php esc_html_e('Read full article', 'whiteblack') ?>
                                </a>
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
                                <time datetime="<?php echo get_the_date( 'c' ) ?>"><?php echo get_the_date() ?></time>
                                <div class="posts-list-excerpt"><?php echo $the_query->getShortDescription() ?></div>
                                <?php get_template_part('templates/img-x-line'); ?>
                                <a href="<?php the_permalink() ?>"
                                   class="btn btn-primary btn-rnd"
                                   role="button">
                                    <?php esc_html_e('Read full article', 'whiteblack') ?>
                                </a>
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
                                <?php \SilverWp\get_template_part( 'templates/thumbnail-posts-list-grid', array( 'column_number' => $column_number ) ); ?>
                                <div class="upper posts-list-category"><?php the_category(', ') ?></div>
                                <h2 class="upper posts-list-heading">
                                    <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                                </h2>
                                <time datetime="<?php echo get_the_date( 'c' ) ?>"><?php echo get_the_date() ?></time>
                                <p class="posts-list-excerpt"><?php echo $the_query->getShortDescription() ?></p>
                                <?php get_template_part('templates/img-x-line'); ?>
                                <a href="<?php the_permalink() ?>" class="btn btn-primary btn-rnd" role="button">
                                    <?php esc_html_e('Read full article', 'whiteblack') ?>
                                </a>
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
                                <time datetime="<?php echo get_the_date( 'c' ) ?>"><?php echo get_the_date() ?></time>
                                <p class="posts-list-excerpt"><?php echo $the_query->getShortDescription() ?></p>
                                <?php get_template_part('templates/img-x-line'); ?>
                                <a href="<?php the_permalink() ?>" class="btn btn-primary btn-rnd" role="button">
                                    <?php esc_html_e('Read full article', 'whiteblack') ?>
                                </a>
                            </article>
                        </div>
                        <?php
                    endif;
                endif;
                ?>
            <?php endwhile; ?>
        </div>

        <?php if ($the_query->max_num_pages > 1): ?>
            <nav class="text-center">
                <?php if ( $this->getPaged() === 1 ) : // link MORE only on first page of pagination ?>
                    <div class="circle-icon ajax-load-more">
                        <a href="javascript:void(0)"
                           class="ajax ajax-pagination"
                           data-object="blogposts"
                           data-response_container="#ajax-post-container"
                           data-response_action="append"
                           data-pagination_container="#ajax-pagination-container"
                           data-post_type="post"
                           data-filter_name="<?php echo $term_name ?>"
                           data-filter_value="<?php echo $term_value ?>"
                           <?php if ( $limit ): ?>data-limit="<?php echo esc_attr( $limit ) ?>"<?php endif; ?>
                           data-current_page="<?php echo $this->getPaged() ?>"
                           data-layout="<?php echo $shortcodeAttr[ 'layout' ] ?>"
                           data-ignore_sticky_posts="<?php echo $shortcodeAttr[ 'hide_sticky_posts' ] ?>"
                           >
                            <span class="circle-icon-border">
                                <img src="<?php echo get_stylesheet_directory_uri() ?>/dist/images/icons/icon-load-more.png"
                                     srcset="<?php echo get_stylesheet_directory_uri() ?>/dist/images/icons/icon-load-more.png 1x, <?php echo get_stylesheet_directory_uri() ?>/dist/images/icons/icon-load-more@2x.png 2x"
                                     alt=""
                                     width="16"
                                     height="16">
                            </span><br>
                            <span class="upper upper-11"><?php esc_html_e('Load more posts', 'whiteblack') ?></span>
                        </a>
                    </div>
                <?php endif; ?>
                <ul class="upper upper-11 pagination" id="ajax-pagination-container">
                    <?php echo \SilverWp\pager( $the_query->max_num_pages, $this->getPaged() ); ?>
                </ul>
            </nav>
        <?php endif; ?>
    <?php endif; ?>
    </section>
<?php else: ?>

<?php endif;
/* Restore original Post Data */
wp_reset_postdata();

$this->endBlockComment( '.posts-list' ) . "\n";
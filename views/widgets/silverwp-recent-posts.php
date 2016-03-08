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
$show_date     = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
$show_author   = isset( $instance['show_author'] ) ? $instance['show_author'] : false;
$show_category = isset( $instance['show_category'] ) ? $instance['show_category'] : false;
$show_image    = isset( $instance['show_image'] ) ? $instance['show_image'] : false;

echo $args['before_widget'];

// Widget title
echo $args['before_title'];
echo $instance['title'];
echo $args['after_title'];

// Post list in widget
?>
<ul>
<?php

// array to call recent posts.
$query_args = array(
	'showposts'           => $instance['number'] ? absint( $instance['number'] ) : 5,
	'category__in'        => $instance['categories'] ? $instance['categories'] : '',
	'ignore_sticky_posts' => true,
	'meta_box_id'         => \SilverWpAddons\MetaBox\Post::getInstance()->getId(),
);

$wp_query = new \SilverWp\Db\Query( $query_args );

while ( $wp_query->have_posts() ) :
	$wp_query->the_post();
	$href_title = \SilverWp\Translate::translate( 'Permanent link to ' );
	$href_title .= \the_title_attribute( array( 'echo' => false ) );
	?>
	<li>
        <div class="media">
            <?php if ( $show_image ) : ?>
                <div class="media-left">
                    <a href="<?php the_permalink() ?>" title="<?php echo $href_title ?>">
                        <?php the_post_thumbnail( 'post-thumbnail' ) ?>
                    </a>
                </div>
            <?php endif; ?>
            <div class="media-body">
                <h4 class="media-heading"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>

                <?php if ( $show_date ) : ?>
                    <time datetime="<?php echo get_the_time( 'c' ) ?>"><?php echo get_the_date() ?></time>
                <?php endif; ?>

                <?php if ( $show_category ) : ?>
                    <?php
                    $cats = array();
                    foreach (get_the_category() as $cat) :
                        $cats[] = $cat->name;
                    endforeach;
                    echo sprintf( esc_html__( 'in %s', 'whiteblack' ), implode( ', ', $cats ) );
    ?>
                <?php endif; ?>

                <?php if ( $show_author ) : ?>
                    <div class="author"><?php the_author() ?></div>
                <?php endif; ?>
            </div>
        </div>
	</li>
	<?php
endwhile;

$wp_query->reset_postdata();

echo '</ul>';
echo $args['after_widget'];
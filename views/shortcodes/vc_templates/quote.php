<?php
/*
 * Copyright (C) 2014 Michal Kalkowski <michal at silversite.pl>
 *
 * SilverWp is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * SilverWp is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

$class = 'wpb_content_element  quote'; // wpb_quote

$el_class = $this->getExtraClass( $this->atts[ 'el_class' ] );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class . $el_class,
                            $this->settings[ 'base' ], $this->atts );
$css_class .= $this->getCSSAnimation( $this->atts[ 'css_animation' ] );
?>
<div class="<?php echo $css_class; ?>">
    <div class="line-x">
        <img src="<?php echo get_stylesheet_directory_uri() ?>/dist/images/line-x.png"
             srcset="<?php echo get_stylesheet_directory_uri() ?>/dist/images/line-x.png 1x, <?php echo get_stylesheet_directory_uri() ?>/dist/images/line-x@2x.png 2x"
             alt=""
             width="53"
             height="5">
    </div>
    <blockquote>
        <?php echo wpb_js_remove_wpautop( $content, true ); ?>
        <?php if ( isset( $this->atts[ 'author' ] ) && $this->atts[ 'author' ] ) : ?>
            <footer class="upper upper-11"><?php echo $this->atts[ 'author' ] ?></footer>
        <?php endif; ?>
    </blockquote>
    <div class="line-x">
        <img src="<?php echo get_stylesheet_directory_uri() ?>/dist/images/line-x.png"
             srcset="<?php echo get_stylesheet_directory_uri() ?>/dist/images/line-x.png 1x, <?php echo get_stylesheet_directory_uri() ?>/dist/images/line-x@2x.png 2x"
             alt=""
             width="53"
             height="5">
    </div>
</div>
<?php echo $this->endBlockComment( '.quote' ) . "\n";
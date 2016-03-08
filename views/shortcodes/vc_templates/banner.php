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

$class = 'wpb_content_element  image-banner'; // wpb_quote

$el_class = $this->getExtraClass( $this->atts[ 'el_class' ] );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class . $el_class,
                            $this->settings[ 'base' ], $this->atts );
$css_class .= $this->getCSSAnimation( $this->atts[ 'css_animation' ] );

$image = wp_get_attachment_image_src( $this->atts[ 'image' ], $this->atts[ 'size' ] );
$text = $this->atts[ 'name' ];
$link = vc_build_link( $this->atts[ 'url' ] );
?>

<?php if ( $image ): ?>
    <?php if ( !$text && isset( $link[ 'url' ] ) && $link[ 'url' ] ) : ?>
        <a href="<?php echo esc_url( $link[ 'url' ] ) ?>"
        <?php if ( $link[ 'target' ] ) : ?>target="<?php echo $link[ 'target' ] ?>"<?php endif; ?>
           class="full-figure">
    <?php endif ?>
            <figure class="<?php echo $css_class; ?>">
                <img class="img-responsive" src="<?php echo $image[0] ?>" alt="">
                <?php if ( $text ) : ?>
                    <figcaption>
                        <div class="upper">
                            <span class="table-cell td-middle"><?php echo esc_html( $text ) ?></span>
                        </div>
                        <?php if ( isset( $link[ 'url' ] ) && $link[ 'url' ] ) : ?>
                            <a href="<?php echo esc_url( $link[ 'url' ] ) ?>"
                               <?php if ( $link[ 'target' ] ) : ?>target="<?php echo $link[ 'target' ] ?>"<?php endif; ?>
                               class="full-figure">
                                <?php esc_html_e('Details', 'whiteblack') ?>
                            </a>
                        <?php endif; ?>
                    </figcaption>
                <?php endif; ?>
            </figure>
    <?php if ( !$text && isset( $link[ 'url' ] ) && $link[ 'url' ] ) : ?>
        </a>
    <?php endif ?>
<?php endif; ?>

<?php echo $this->endBlockComment( '.image-banner' ) . "\n";
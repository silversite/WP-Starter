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
$class = 'wpb_content_element sc-gallery-carousel'; // Gallery OWL Carousel
$el_class = $this->getExtraClass( $this->atts[ 'el_class' ] );
$css_class = apply_filters(
	VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,
	$class . $el_class,
    $this->settings[ 'base' ],
	$this->atts
);
$css_class .= $this->getCSSAnimation( $this->atts[ 'css_animation' ] );

$images = explode( ',', $this->atts['images'] );
$size = \SilverWp\get_image_size_name( 1, 'gallery' );
?>
<div class="<?php echo $css_class ?>">
    <div class="owl-carousel" data-wrap="0" data-interval="0" data-nav="0">
        <?php foreach ( $images as $img_id ) : ?>
            <?php echo wp_get_attachment_image( $img_id, $size ); ?>
        <?php endforeach; ?>
    </div>
    <div class="owl-nav">
        <span class="nav-prev"><i class="icon-angle-left"></i></span>
            <span class="nav-nums">
                <span class="nav-num current-page"></span>/<span class="nav-num max-num-pages"></span>
            </span>
        <span class="nav-next"><i class="icon-angle-right"></i></span>
    </div>
</div>
<?php
echo $this->endBlockComment( '.sc-gallery-carousel' ) . "\n";

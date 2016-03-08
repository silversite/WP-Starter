<?php
/*
 * Copyright (C) 2014 Marcin Dobroszek <marcin at silversite.pl>
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

$class = 'wpb_content_element  sc-social'; // wpb_social

$el_class = $this->getExtraClass( $this->atts[ 'el_class' ] );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class . $el_class,
    $this->settings[ 'base' ], $this->atts );
$css_class .= $this->getCSSAnimation( $this->atts[ 'css_animation' ] );

$social_accounts = \SilverWp\Helper\Social::getAccounts();
?>
<div class="<?php echo $css_class; ?>">
    <ul class="social-links">
        <?php foreach ( $social_accounts as $social_item ) : ?>
            <?php if ( isset( $this->atts[ $social_item[ 'slug' ] ] ) && $this->atts[ $social_item[ 'slug' ] ] ) : ?>
                <li>
                    <a href="<?php echo esc_url( $this->atts[ $social_item[ 'slug' ] ] ) ?>">
                        <i class="<?php echo esc_attr( $social_item[ 'icon' ] ) ?>"></i>
                        <?php echo $social_item[ 'name' ] ?>
                    </a>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</div>
<?php echo $this->endBlockComment( '.sc-social' ) . "\n";

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
if ( isset( $instance['accounts'] ) ) {
	$social_accounts = array_intersect_key(
		\SilverWp\Helper\Social::getIcons()
		, array_flip( $instance['accounts'] )
	);
//\SilverWp\Debug::dumpPrint($social_accounts);

	echo $args['before_widget'];

// widget title
	if ( isset( $instance['title'] ) && ! empty( $instance['title'] ) ) :
		echo $args['before_title'];
		echo $instance['title'];
		echo $args['after_title'] . "\n";
	endif
	?>
	<div class="widget_social-wrapper">
		<?php foreach ( $social_accounts as $social_item ) : ?>
			<div class="widget_social-item">
				<a href="<?php echo esc_url( $social_item['url'] ) ?>">
					<i class="<?php echo esc_attr( $social_item['icon'] ) ?>"></i>
					<span
						class="widget_social-item-name"><?php echo $social_item['label'] ?></span>
				</a>
			</div>
		<?php endforeach; ?>
	</div>
	<?php
	// Wrap the widget
	echo $args['after_widget'] . "\n";
}
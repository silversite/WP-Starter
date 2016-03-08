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
$title = $instance['title'];
unset($instance['title']);
$instance['size'] = 'q';
$type = $instance['type'];
$id   = $instance['flickr_id'];
$instance['source'] = $type;
$instance['layout'] = 'x';
unset( $instance['type'] );
unset( $instance['flickr_id'] );
$instance[ $type ] = $id;
$url_params    = http_build_query( $instance );

// Wrap the widget
?>
<div class="flickr-badge-wrapper">
	<?php
	$protocol = is_ssl() ? 'https' : 'http';

	// If the widget have an ID, we can continue
	if ( ! empty( $id ) ) :
		?>
		<script type="text/javascript"
		        src="<?php echo $protocol ?>://www.flickr.com/badge_code_v2.gne?<?php echo $url_params ?>">
		</script>
	<?php
	else :
	?>
		<p><?php esc_html__( 'Please provide an Flickr ID', 'whiteblack' ) ?></p>
		<?php
	endif;
	?>
</div>

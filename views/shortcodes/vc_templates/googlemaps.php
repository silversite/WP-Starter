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
extract( $this->getAtts() );
$content = trim( preg_replace( '/\s+/', ' ', do_shortcode( $this->shortcode_content ) ) );
$content = preg_replace("/(^)?(<br\s*\/?>\s*)+$/", '', $content); // http://stackoverflow.com/questions/9685976/removing-start-and-end-br-tags-in-php#answer-9686037

$marker_lat = $lat;
$marker_lng = $lng;
if ( $marker_icon == 'default' ) {
	$icon_url = '';
}
else {
	$ico_img = wp_get_attachment_image_src( $icon_img, 'large');
	$icon_url = $ico_img[0];
}
$id         = 'map_' . uniqid();
$wrap_id    = 'wrap_' . $id;
$map_type   = strtoupper( $map_type );
$map_height = substr( $height, - 1 ) != '%' && substr( $height, - 2 ) != 'px'
				? $height . 'px'
				: $height;

$margin_css = '';

if ( $top_margin != 'none' ) {
	$margin_css = $top_margin;
}

$map_override = $width == 'fullwidth' ? 'full' : '';
?>
<div id="<?php echo $wrap_id ?>" class="ultimate-map-wrapper <?php echo $el_class ?>" style="<?php echo ( $map_height != '' ? 'height:' . $map_height . ';' : ''); ?>">
	<div id="<?php echo $id ?>" data-map_override="<?php echo $map_override ?>" class="ultimate_google_map wpb_content_element <?php echo $margin_css ?>"
	<?php echo 'style="width: 100%; ' . ( $map_height != '' ? 'height:' . $map_height . ';' : '') . '"'; ?>
	>
	</div>
</div>

<?php
if ( $scrollwheel == 'disable' ) {
	$scrollwheel = 'false';
} else {
	$scrollwheel = 'true';
}
?>
<script type='text/javascript'>
	(function($) {

    'use strict';

	var map_<?php echo $id;?> = null,
        coordinate_<?php echo $id;?>;

    var $window = $(window);

	try
	{
		coordinate_<?php echo $id;?> = new google.maps.LatLng(<?php echo $lat;?>, <?php echo $lng;?>);
		var mapOptions =
		{
			zoom: <?php echo $zoom; ?>,
			center: coordinate_<?php echo $id; ?>,
			scaleControl: true,
			streetViewControl: <?php echo $streetviewcontrol; ?>,
			mapTypeControl: <?php echo $maptypecontrol; ?>,
			panControl: <?php echo $pancontrol; ?>,
			zoomControl: <?php echo $zoomcontrol; ?>,
			scrollwheel: <?php echo $scrollwheel; ?>,
			zoomControlOptions: {
				style: google.maps.ZoomControlStyle.<?php echo $zoomcontrolsize; ?>
			},
<?php
if ( $map_style == '' ) {
	?>
			mapTypeId: google.maps.MapTypeId.<?php echo $map_type; ?>,
	<?php
} else {
	?>
			mapTypeControlOptions: {
                mapTypeIds: [google.maps.MapTypeId.<?php echo $map_type ;?>, 'map_style']
			}
	<?php
}
?>
		};
<?php
if ( $map_style !== '' ) {
	?>
		var styles = <?php echo $map_style ?>;
		var styledMap = new google.maps.StyledMapType(styles,{name: "Styled Map"});
	<?php
}
?>
		var map_<?php echo $id ?> = new google.maps.Map(document.getElementById('<?php echo $id ?>'), mapOptions);
<?php
if ( $map_style !== '' ) {
	?>
		map_<?php echo $id; ?>.mapTypes.set('map_style', styledMap);
        map_<?php echo $id; ?>.setMapTypeId('map_style');
	<?php
}
if ( $marker_lat != '' && $marker_lng != '' ) {
	?>
		var marker_<?php echo $id; ?> = new google.maps.Marker({
			position: new google.maps.LatLng(<?php echo $marker_lat; ?>, <?php echo $marker_lng; ?>),
			animation: google.maps.Animation.DROP,
			map: map_<?php echo $id; ?>,
			icon: '<?php echo $icon_url; ?>'
		});
		google.maps.event.addListener(marker_<?php echo $id; ?>, 'click', toggleBounce);
	<?php
	if ( $content != '' ) {
		?>
		var infowindow = new google.maps.InfoWindow();
		infowindow.setContent('<div class="map_info_text" style="color:#000;"><?php echo $content ?></div>');
		infowindow.open(map_<?php echo $id; ?>,marker_<?php echo $id; ?>);
		<?php
	}
}
?>
	} catch (e) {}

        $(document).ready(function ($) {
			resize_ssvc_map('<?php echo $id; ?>', '<?php echo $wrap_id;?>');
			google.maps.event.trigger(map_<?php echo $id; ?>, 'resize');
            $window.resize(function () {
				resize_ssvc_map('<?php echo $id; ?>', '<?php echo $wrap_id; ?>');
				google.maps.event.trigger(map_<?php echo $id; ?>, 'resize');
				if (map_<?php echo $id; ?> != null) {
					map_<?php echo $id; ?>.setCenter(coordinate_<?php echo $id; ?>);
				}
			});
		});

        $window.load(function ($) {
			google.maps.event.trigger(map_<?php echo $id; ?>, 'resize');
			if (map_<?php echo $id; ?> != null) {
				map_<?php echo $id; ?>.setCenter(coordinate_<?php echo $id; ?>);
			}
		});

		function toggleBounce() {
			if (marker_<?php echo $id; ?>.getAnimation() != null) {
				marker_<?php echo $id; ?>.setAnimation(null);
			} else {
				marker_<?php echo $id; ?>.setAnimation(google.maps.Animation.BOUNCE);
			}
		}

        //resize map
        function resize_ssvc_map(map, wrap) {
            var $map = $('#' + map), $wrap = $('#' + wrap), map_width, ancenstor,
                map_override = $map.data('map_override'), is_relative = 'true';

            if ($wrap.parents('.wpb_column').length > 0) {
                ancenstor = $wrap.parents('.wpb_column');
            }
            else if ($wrap.parents('.wpb_row').length > 0) {
                ancenstor = $wrap.parents('.wpb_row');
            }
            else {
                ancenstor = $wrap.parent();
            }

            if (map_override == 'full') {
                ancenstor = $('body');
                is_relative = 'false';
            }

            if (!isNaN(map_override)) {
                for (var i = 1; i < map_override; i++) {
                    if (ancenstor.prop('tagName') != 'HTML') {
                        ancenstor = ancenstor.parent();
                    } else {
                        break;
                    }
                }
            }

            if (is_relative == 'false') {
                var ancenstorWidth = ancenstor.outerWidth();
                if ( $('.is-sidebar').length && $('.is-sidebar-right').length
                    && ancenstorWidth !== $('.wrap.container').innerWidth()) {
                    var originalMapWidth, offset,
                        containerWidth = $('.wrap.container').width();
                    originalMapWidth = $map.parent().width();
                    offset = Math.ceil( ((ancenstorWidth - parseInt(containerWidth, 10)) / 2) );
                    map_width = Math.ceil( (parseInt(originalMapWidth, 10) + offset) );
                }
                else {
                    map_width = ancenstorWidth;
                }
            }
            else {
                map_width = ancenstor.width();
            }

            $map.css({'position': 'absolute', 'width': map_width, 'min-width': map_width});

            if (is_relative == 'false') {
                var map_left = $map.offset().left,
                    map_left_pos = $map.position().left,
                    cal_left = (map_left_pos < 0) ? (map_left_pos + cal_left) : (map_left_pos - map_left);

                $map.css({'left': cal_left});
            }
        }

	})(jQuery);
</script>

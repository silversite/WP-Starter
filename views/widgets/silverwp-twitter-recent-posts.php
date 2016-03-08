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
//widget <section>
$out = $args['before_widget'];

// widget title
$out .= $args['before_title'];
$out .= isset( $instance['title'] )
        && empty( $instance['title'] ) === false
	? $instance['title'] : 'Twitter';
$out .= $args['after_title'] . "\n";

// ".tweet" CSS start Tweetie (Twitter Plugin)  [https://github.com/sonnyt/Tweetie]
$out .= '<ul class="tp_recent_tweets tweet" data-count="'
        . esc_attr( $instance['limit'] )
        . '"><!-- content loading by ajax --></ul>' . "\n";

//widget end </section>
$out .= $args['after_widget'];

echo $out;
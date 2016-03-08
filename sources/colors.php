<?php
/**
 *
 * all colors pallet
 *
 * @return array
 */
function silverwp_get_colours_full() {
    return array(
        array(
            'value' => 'silver-vc-bg-gray',//'#5e5e5e',
            'label' => \SilverWp\Translate::translate( 'Gray' )
        ),
        array(
            'value' => 'silver-vc-bg-black',
            'label' => \SilverWp\Translate::translate( 'Black' )
        ),
        array(
            'value' => 'silver-vc-bg-yellow',
            'label' => \SilverWp\Translate::translate( 'Yellow' )
        ),
        array(
            'value' => 'silver-vc-bg-brown',
            'label' => \SilverWp\Translate::translate( 'Brown' )
        ),
        array(
            'value' => 'silver-vc-bg-blue',
            'label' => \SilverWp\Translate::translate( 'Blue' )
        ),
        array(
            'value' => 'silver-vc-bg-green',
            'label' => \SilverWp\Translate::translate( 'Green' )
        ),
        array(
            'value' => 'silver-vc-bg-red',
            'label' => \SilverWp\Translate::translate( 'Red' )
        ),
        array(
            'value' => 'silver-vc-bg-violet',
            'label' => \SilverWp\Translate::translate( 'Violet' )
        ),
        array(
            'value' => 'silver-vc-bg-light-gray',
            'label' => \SilverWp\Translate::translate( 'Light gray' )
        ),
    );
}

/**
 *
 * @return array
 */
function silverwp_get_colours_special() {
    return array(
        array(
            'value' => 'silver-vc-bg-brand',
            'label' => \SilverWp\Translate::translate( 'Brand primary' )
        ),
        array(
            'value' => 'silver-vc-bg-transparent',
            'label' => \SilverWp\Translate::translate( 'Transparent' )
        ),
        array(
            'value' => 'silver-vc-bg-dark',
            'label' => \SilverWp\Translate::translate( 'Dark' )
        ),
        array(
            'value' => 'silver-vc-bg-light',
            'label' => \SilverWp\Translate::translate( 'Light' )
        )
    );
}

/**
 * bg colors for colourful bar
 *
 * @return array
 */
function silverwp_get_bgcolors_colourfulbar() {
    $arr = silverwp_get_colours_special();
    foreach ( $arr as $k => $v ) {
        if ( $v[ 'value' ] == 'transparent' ) {
            unset( $arr[ $k ] );
        }
    }

    return $arr;
}

/**
 * bg colors for colourful bar
 *
 * @return array
 */

function silverwp_get_buttons_colourfulbar() {
    return silverwp_get_colours_special();
}

/**
 * list of color in Font Awesome ShortCode
 *
 * @return array
 */

function silverwp_get_sc_font_awesome_colours() {
    $arrSpecial = silverwp_get_colours_special();
    foreach ( $arrSpecial as $k => $v ) {
        if ( $v[ 'value' ] == 'transparent' ) {
            unset( $arrSpecial[ $k ] );
        }
    }

    return array_merge( $arrSpecial, silverwp_get_colours_full() );
}

/**
 * list of colors in blog Short Code
 *
 * @return array
 */

function silverwp_get_sc_blog_colours() {
    return silverwp_get_colours_full();
}

/**
 * list of colors in portfolio Short Code
 *
 * @return array
 */

function silverwp_get_sc_protfolio_colours() {
    return silverwp_get_colours_full();
}

/**
 * list of button colors
 *
 * @return array
 */
function silverwp_get_sc_button_colours() {
    $special_color = silverwp_get_colours_special();
    $full_colors   = silverwp_get_colours_full();
    /*$arrSpecial = silverwp_get_colours_special();
    foreach( $arrSpecial as $k => $v ) {
        if ( $v['value'] == 'transparent' || $v['value'] == 'lightcolour' ) {
            unset( $arrSpecial[$k] );
        }
    }
    array_merge($arrSpecial, silverwp_get_colours_full());*/
    $button_color = array_merge( $special_color, $full_colors );

    return $button_color;
}

/**
 * list of colors in features Short Code
 *
 * @return array
 */

function silverwp_get_sc_features_colours() {
    return silverwp_get_colours_full();
}

/**
 * list of bg colors in company stats - Short Code
 *
 * @return array
 */

function silverwp_get_sc_company_bg_colours() {
    return silverwp_get_colours_special();
}

/**
 * list of bg colors in price plan Short Code
 *
 * @return array
 */

function silverwp_get_sc_price_plan_bg_colours() {
    return silverwp_get_colours_full();
}

/**
 * list of buttons colors in slider meta box
 *
 * @return array
 */

function silverwp_get_slider_button_colours() {
    return silverwp_get_colours_special();
}

/**
 * list of colors in pie charts meta box
 *
 * @return type
 */
function silverwp_get_pie_charts_colours() {
    return silverwp_get_colours_special();
}

/**
 * list of colors in price plan meta box
 *
 * @return type
 */
function silverwp_get_price_plan_colours() {
    $arr = silverwp_get_colours_special();
    foreach ( $arr as $k => $v ) {
        if ( $v[ 'value' ] == 'transparent' ) {
            unset( $arr[ $k ] );
        }
    }

    return $arr;
}

/**
 * list of colors in features meta box for buttons
 *
 * @return type
 */
function silverwp_get_features_buttons_colour() {
    return silverwp_get_colours_special();
}

//VP_Security::instance()->whitelist_function( 'silverwp_get_hiding_box_buttons_colour' );
/**
 * list of colors in features meta box for buttons
 *
 * @return type
 */
function silverwp_get_hiding_box_buttons_colour() {
    return silverwp_get_colours_special();
}

function silverwp_get_top_page_colour() {
    return array(
        array(
            'value' => 'dark',
            'label' => \SilverWp\Translate::translate( 'Dark' )
        ),
        array(
            'value' => 'light',
            'label' => \SilverWp\Translate::translate( 'Light' )
        ),
    );
}

function silverwp_get_top_page_header_colour() {
    return array(
        array(
            'value' => 'light',
            'label' => \SilverWp\Translate::translate( 'Light' )
        ),
        array(
            'value' => 'brandprimary',
            'label' => \SilverWp\Translate::translate( 'Brand primary' )
        ),
    );
}

/**
 * bg colors for highlight label
 *
 * @return array
 */
function silverwp_get_sc_highlight_color() {
    return array(
        array(
            'value' => 'brandcolour',
            'label' => \SilverWp\Translate::translate( 'Brand primary' )
        ),
        array(
            'value' => 'graycolour',
            'label' => \SilverWp\Translate::translate( 'Gray' )
        ),
        array(
            'value' => 'darkcolour',
            'label' => \SilverWp\Translate::translate( 'Dark' )
        ),
    );
}

/**
 * bg colors for dropcap letters
 *
 * @return array
 */
function silverwp_get_sc_dropcaps_color() {
    $arr = silverwp_get_colours_special();
    foreach ( $arr as $k => $v ) {
        if ( $v[ 'value' ] == 'lightcolour' ) {
            unset( $arr[ $k ] );
        }
    }

    return $arr;
}

if ( ! function_exists( 'silverwp_get_messages_color' ) ) {
    /**
     * Message colors lists
     *
     * @return array
     * @access public
     */
    function silverwp_get_messages_color() {
        $colors = array(
            array(
                'value' => 'alert-info',
                'label' => \SilverWp\Translate::translate( 'Informational' ),
            ),
            array(
                'value' => 'alert-warning',
                'label' => \SilverWp\Translate::translate( 'Warning' ),
            ),
            array(
                'value' => 'alert-success',
                'label' => \SilverWp\Translate::translate( 'Success' ),
            ),
            array(
                'value' => 'alert-danger',
                'label' => \SilverWp\Translate::translate( 'Error' ),
            ),
            array(
                'value' => 'custom',
                'label' => \SilverWp\Translate::translate( 'Custom' ),
            ),
        );

        return $colors;

    }
}

if ( ! function_exists( 'silverwp_get_label_color' ) ) {
    /**
     * Message colors lists
     *
     * @return array
     * @access public
     */
    function silverwp_get_label_color() {
        $special_color_full = silverwp_get_colours_special();
        $special_color = \SilverWp\Helper\RecursiveArray::removeByValue(
            $special_color_full,
            array( 'silver-vc-bg-transparent' )
        );

        $full_colors   = silverwp_get_colours_full();

        $colors = array_merge( $special_color, $full_colors );

        return $colors;
    }
}

if ( ! function_exists( 'silverwp_get_counter_colours' ) ) {
    /**
     * Message colors lists
     *
     * @return array
     * @access public
     */
    function silverwp_get_counter_colours() {
        $special_color_full = silverwp_get_colours_special();
        $special_color = \SilverWp\Helper\RecursiveArray::removeByValue(
            $special_color_full,
            array( 'silver-vc-bg-dark', 'silver-vc-bg-brand' )
        );

        $full_colors = silverwp_get_colours_full();
        $colors = array_merge( $special_color, $full_colors );

        return $colors;
    }
}

if ( ! function_exists( 'silverwp_get_progresbar_colours' ) ) {
    /**
     * Message colors lists
     *
     * @return array
     * @access public
     */
    function silverwp_get_progresbar_colours() {
        $full_colors = silverwp_get_colours_full();
        $colors = array_merge(
            $full_colors,
            array(
                array(
                    'label' => \SilverWp\Translate::translate( 'Custom' ),
                    'value' => 'custom',
                )
            )
        );
        return $colors;
    }
}

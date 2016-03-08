<?php
/**
 * source function used for fonts
 */
/**
 *
 * get layout main menu used in theme options
 *
 * @return array
 */
if (!function_exists('silverwp_get_font_family')) {
    function silverwp_get_font_family()
    {
        return array_merge(
            array(
                // Serif Fonts
                array(
                    'label' => 'Georgia',
                    'value' => 'Georgia' .  silverwp_get_default_font_family('Georgia')
                ),
                array(
                    'label' => 'Palatino Linotype',
                    'value' => 'Palatino Linotype' . silverwp_get_default_font_family('Palatino Linotype')
                ),
                array(
                    'label' => 'Times New Roman',
                    'value' => 'Times New Roman' . silverwp_get_default_font_family('Times New Roman')
                ),
                // Sans-Serif Fonts
                array(
                    'label' => 'Arial',
                    'value' => 'Arial' .  silverwp_get_default_font_family('Arial')
                ),
                array(
                    'label' => 'Arial Black',
                    'value' => 'Arial Black' .  silverwp_get_default_font_family('Arial Black')
                ),
                array(
                    'label' => 'Comic Sans MS',
                    'value' => 'Comic Sans MS' .  silverwp_get_default_font_family('Comic')
                ),
                array(
                    'label' => 'Impact',
                    'value' => 'Impact' .  silverwp_get_default_font_family('Impact')
                ),
                array(
                    'label' => 'Lucida Sans Unicode',
                    'value' => 'Lucida Sans Unicode' .  silverwp_get_default_font_family('Lucida Sans Unicode')
                ),
                array(
                    'label' => 'Tahoma',
                    'value' => 'Tahoma' .  silverwp_get_default_font_family('Tahoma')
                ),
                array(// bootstrap required
                    'label' => 'Helvetica Neue',
                    'value' => 'Helvetica Neue' .  silverwp_get_default_font_family('Helvetica Neue')
                ),
                array(
                    'label' => 'Trebuchet MS',
                    'value' => 'Trebuchet MS' .  silverwp_get_default_font_family('Trebuchet')
                ),
                array(
                    'label' => 'Verdana',
                    'value' => 'Verdana' .  silverwp_get_default_font_family('Verdana')
                ),
                // Monospace Fonts
                array(
                    'label' => 'Menlo',
                    'value' => 'Menlo' .  silverwp_get_default_font_family('Menlo')
                ),
                array(
                    'label' => 'Courier New',
                    'value' => 'Courier New' .  silverwp_get_default_font_family('Courier')
                ),
                array(
                    'label' => 'Lucida Console',
                    'value' => 'Lucida Console' .  silverwp_get_default_font_family('Lucida Console')
                ),
            ),
            silverwp_get_gwf_family()
        );
    }
}
if ( ! function_exists( 'silverwp_get_system_fonts' ) ) {
	function silverwp_get_system_fonts() {
		return array(
			// Serif Fonts
			'Georgia'             => 'Georgia'
			                         . silverwp_get_default_font_family( 'Georgia' ),
			'Palatino Linotype'   => 'Palatino Linotype'
			                         . silverwp_get_default_font_family( 'Palatino Linotype' ),
			'Times New Roman'     => 'Times New Roman'
			                         . silverwp_get_default_font_family( 'Times New Roman' ),
			// Sans-Serif Fonts
			'Arial'               => 'Arial'
			                         . silverwp_get_default_font_family( 'Arial' ),
			'Arial Black'         => 'Arial Black'
			                         . silverwp_get_default_font_family( 'Arial Black' ),
			'Comic Sans MS'       => 'Comic Sans MS'
			                         . silverwp_get_default_font_family( 'Comic' ),
			'Impact'              => 'Impact'
			                         . silverwp_get_default_font_family( 'Impact' ),
			'Lucida Sans Unicode' => 'Lucida Sans Unicode'
			                         . silverwp_get_default_font_family( 'Lucida Sans Unicode' ),
			'Tahoma'              => 'Tahoma'
			                         . silverwp_get_default_font_family( 'Tahoma' ),
			// bootstrap required
			'Helvetica Neue'      => 'Helvetica Neue'
			                         . silverwp_get_default_font_family( 'Helvetica Neue' ),
			'Trebuchet MS'        => 'Trebuchet MS'
			                         . silverwp_get_default_font_family( 'Trebuchet' ),
			'Verdana'             => 'Verdana'
			                         . silverwp_get_default_font_family( 'Verdana' ),
			// Monospace Fonts
			'Menlo'               => 'Menlo'
			                         . silverwp_get_default_font_family( 'Menlo' ),
			'Courier New'         => 'Courier New'
			                         . silverwp_get_default_font_family( 'Courier' ),
			'Lucida Console'      => 'Lucida Console'
			                         . silverwp_get_default_font_family( 'Lucida Console' ),
		);
	}
}

/**
 *
 * gogole font live preview
 *
 * @param string $face
 * @param string $weight
 * @param string $style
 * @param string $subset
 * @param integer $size
 * @return string
 */

if (!function_exists('silverwp_font_preview')) {
    VP_Security::instance()->whitelist_function('silverwp_font_preview');

    function silverwp_font_preview($face, $weight, $style, $subset = array(), $transform = 'none')
    {
        $fonst = \explode(',', \trim($face, ','));
        $Gwf = SilverWp\Helper\Gwf::getInstance();
        $link  = $Gwf->getFontLink($fonst[0], $weight, $style, $subset);
        $doc   = <<<EOD
<link href="$link" rel="stylesheet" type="text/css">
<p style="padding: 0 10px 0 10px; font-family: $face; font-style: $style; font-weight: $weight;text-transform:$transform">
    Grumpy wizards make toxic brew for the evil Queen and Jack
</p>
EOD;
        return $doc;
    }
}

/**
 * get google font familly
 *
 * @return array
 */
if (!function_exists('silverwp_get_gwf_family')) {
    VP_Security::instance()->whitelist_function('silverwp_get_gwf_family');

    function silverwp_get_gwf_family()
    {
        $fonts = \SilverWp\Helper\Gwf::getInstance()->getFontFamily();
        $result = array();
        foreach ($fonts as $font) {
            $result[] = array(
                'value' => $font . silverwp_get_default_font_family('gwf'),
                'label' => $font,
            );
        }
        return $result;
    }
}

/**
 * get font weight from font face
 *
 * @return array
 */
if (!function_exists('silverwp_get_gwf_weight')) {
    VP_Security::instance()->whitelist_function('silverwp_get_gwf_weight');

    function silverwp_get_gwf_weight($font_face)
    {
        if(empty($font_face ) || \is_null($font_face)) {
            return array();
        }
        $font_face = \explode(',', \trim($font_face, ','));

        $weights = \SilverWp\Helper\Gwf::getInstance()->getFontAttribute($font_face[0], 'weights');
        if (!$weights) {
            $weights = silverwp_get_default_font_attribute($font_face[0], 'weight');
        }
        $result = array();
        foreach ($weights as $weight) {
            $result[] = array(
                'value' => $weight,
                'label' => $weight,
            );
        }

        return $result;
    }
}

/**
 * get font style from font face
 *
 * @return array
 */
if (!function_exists('silverwp_get_gwf_style')) {
    VP_Security::instance()->whitelist_function('silverwp_get_gwf_style');

    function silverwp_get_gwf_style($font_face)
    {
        if (empty($font_face ) || \is_null($font_face)) {
            return array();
        }
        $font_face = \explode(',', trim($font_face, ','));

        $styles = \SilverWp\Helper\Gwf::getInstance()->getFontAttribute($font_face[0], 'styles');
        if (!$styles) {
            $styles = \silverwp_get_default_font_attribute($font_face[0], 'style');
        }

        $result = array();
        foreach ($styles as $style) {
            $result[] = array(
                'value' => $style,
                'label' => $style,
            );
        }

        return $result;
    }
}
/**
 * get font weight from font face
 *
 * @return array
 */
if ( !function_exists('silverwp_get_gwf_subset') ) {
    VP_Security::instance()->whitelist_function('silverwp_get_gwf_subset');

    function silverwp_get_gwf_subset($font_face)
    {
        if (empty($font_face) || \is_null($font_face)) {
            return array();
        }
        $font_face = \explode(',', trim($font_face, ','));
        $subsets = \SilverWp\Helper\Gwf::getInstance()->getFontAttribute($font_face[0], 'subsets');
        $result = array();
        foreach ($subsets as $subset) {
            $result[] = array(
                'value' => $subset,
                'label' => $subset,
            );
        }

        return $result;
    }
}
/**
 * get font weight from font face
 *
 * @return array
 */
if (!function_exists('silverwp_get_font_transform')) {
    VP_Security::instance()->whitelist_function('silverwp_get_font_transform');

    function silverwp_get_font_transform()
    {
        return array(
            array(
                'label' => 'none',
                'value' => 'none',
            ),
            array(
                'label' => 'uppercase',
                'value' => 'uppercase',
            )
        );
    }
}
/**
 * get font weight from font face
 *
 * @return array
 */
if (!function_exists('silverwp_get_font_type')) {
    VP_Security::instance()->whitelist_function('silverwp_get_font_type');

    function silverwp_get_font_type($font_face)
    {
        $result = '';
        if (empty($font_face) || \is_null($font_face)) {
            return $result;
        }
        $font_face = explode(',', trim($font_face, ','));
        $subsets = \SilverWp\Helper\Gwf::getInstance()->getFontAttribute($font_face[0], 'subsets');
        if (!$subsets) {
            $result = 'system';
        } else {
            $result = 'gwf';
        }
        return $result;
    }
}
if (!function_exists('silverwp_get_font_type_info')) {
    VP_Security::instance()->whitelist_function('silverwp_get_font_type_info');

    function silverwp_get_font_type_info($font_face)
    {
        $font_type = silverwp_get_font_type($font_face);
        switch ($font_type) {
            case 'gwf':
                $result = \SilverWp\Translate::translate('Google Web Font');
                break;
            case 'system':
                $result = \SilverWp\Translate::translate('System Font');
                break;
            default:
                $result = '';
                break;
        }
        $html  = '';
        $html .= '<p><strong>' . \SilverWp\Translate::translate('This Font is') . ': ' . $result . '</strong></p>';

        return $html;
    }
}

/**
 * get default font settings
 *
 * @return array
 */
if (!function_exists('silverwp_get_default_font')) {

    function silverwp_get_default_font($key)
    {
        $colours = array(
            'style_fonts_body[body-font-family]'            => 'Helvetica Neue' .  silverwp_get_default_font_family('Helvetica Neue'),
            'style_fonts_main_menu[menu-font-family]'       => 'Helvetica Neue' .  silverwp_get_default_font_family('Helvetica Neue'),
            'style_fonts_heading[headings-font-family]'     => 'Helvetica Neue' .  silverwp_get_default_font_family('Helvetica Neue'),
        );
        return isset($colours[ $key ] ) ? array($colours[ $key ] ) : null;
    }
}
/**
 * get default fonts family
 *
 * @return array
 */
if ( !function_exists('silverwp_get_default_font_family') ) {

    function silverwp_get_default_font_family($font_family)
    {
        $fonts = array(
            'gwf'                   => ', \'Helvetica Neue\', Helvetica, Arial, sans-serif',
            'Georgia'               => ', \'Times New Roman\', Times, serif',
            'Palatino Linotype'     => ', \'Book Antiqua\', Palatino, serif',
            'Times New Roman'       => ', Times, serif',
            'Arial'                 => ', Helvetica, sans-serif',
            'Arial Black'           => ', Gadget, sans-serif',
            'Comic'                 => ', cursive, sans-serif',
            'Impact'                => ', Charcoal, sans-serif',
            'Lucida Sans Unicode'   => ', \'Lucida Grande\', sans-serif',
            'Tahoma'                => ', Geneva, sans-serif',
            'Helvetica Neue'        => ', Helvetica, Arial, sans-serif',
            'Trebuchet'             => ', Helvetica, Arial, sans-serif',
            'Verdana'               => ', Geneva, sans-serif',
            'Menlo'                 => ', Monaco, Consolas, \'Courier New\', monospace',
            'Courier'               => ', Courier, monospace',
            'Lucida Console'        => ', Monaco, monospace',
        );
        return isset( $fonts[ $font_family ] ) ? $fonts[ $font_family ] : array();
    }
}

/**
 * get default fonts family
 *
 * @return array
 */
if (!function_exists('silverwp_get_default_font_attribute')) {

    function silverwp_get_default_font_attribute($font_face, $attribute)
    {
        $fonts = array(
            'Georgia' => array(
                'weight' => array('normal', 'bold'),
                'style'  => array('normal', 'italic')
            ),
            'Palatino Linotype' => array(
                'weight' => array('normal', 'bold'),
                'style'  => array('normal', 'italic')
            ),
            'Times New Roman' => array(
                'weight' => array('normal', 'bold'),
                'style'  => array('normal', 'italic')
            ),
            'Arial' => array(
                'weight' => array('normal', 'bold'),
                'style'  => array('normal', 'italic')
            ),
            'Arial Black' => array(
                'weight' => array('normal', 'bold'),
                'style'  => array('normal', 'italic')
            ),
            'Comic' => array(
                'weight' => array('normal', 'bold'),
                'style'  => array('normal', 'italic')
            ),
            'Impact' => array(
                'weight' => array('normal', 'bold'),
                'style'  => array('normal', 'italic')
            ),
            'Lucida Sans Unicode' => array(
                'weight' => array('normal', 'bold'),
                'style'  => array('normal', 'italic')
            ),
            'Tahoma' => array(
                'weight' => array('normal', 'bold'),
                'style'  => array('normal', 'italic')
            ),
            'Helvetica Neue' => array(
                'weight' => array('normal', 'bold'),
                'style'  => array('normal', 'italic')
            ),
            'Trebuchet' => array(
                'weight' => array('normal', 'bold'),
                'style'  => array('normal', 'italic')
            ),
            'Verdana' => array(
                'weight' => array('normal', 'bold'),
                'style'  => array('normal', 'italic')
            ),
            'Menlo' => array(
                'weight' => array('normal', 'bold'),
                'style'  => array('normal', 'italic')
            ),
            'Courier' => array(
                'weight' => array('normal', 'bold'),
                'style'  => array('normal', 'italic')
            ),
            'Lucida Console' => array(
                'weight' => array('normal', 'bold'),
                'style'  => array('normal', 'italic')
            ),
        );
        return isset($fonts[ $font_face ][ $attribute ]) ? $fonts[ $font_face ][ $attribute ] : array();
    }
}
if ( ! function_exists('silverwp_font_size_full') ) {
    function silverwp_font_size_full() {
        $font_size = array();
        for ( $i = 15; $i <= 72; $i ++ ) {
            $font_size[] = array(
                'label' => $i .'px',
                'value' => $i,
            );
        }
        return $font_size;
    }
}

if ( ! function_exists( 'silverwp_font_weight_full' ) ) {
    function silverwp_font_weight_full() {
        $font_weight = array(
            array(
                'label' => 'Thin 100',
                'value' => '100',
            ),
            array(
                'label' => 'Extra - Light 200',
                'value' => '200',
            ),
            array(
                'label' => 'Light 300',
                'value' => '300',
            ),
            array(
                'label' => 'Normal 400',
                'value' => '400',
            ),
            array(
                'label' => 'Medium 500',
                'value' => '500',
            ),
            array(
                'label' => 'Semi - Bold 600',
                'value' => '600',
            ),
            array(
                'label' => 'Bold 700',
                'value' => '700',
            ),
            array(
                'label' => 'Extra - Bold 800',
                'value' => '800',
            ),
            array(
                'label' => 'Ultra - Bold 900',
                'value' => '900',
            ),
        );

        return $font_weight;
    }
}

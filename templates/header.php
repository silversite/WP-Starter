<?php
// Theme Options configuration (values)
$logo_image = \SilverWp\get_theme_option( 'general_header_logo' );
$logo_image_retina = \SilverWp\get_theme_option( 'general_header_logo_retina' );
    $logo_image_attr_srcset = $logo_image_retina ? 'srcset="'.$logo_image_retina.' 2x"' : '';
$logo_image_margintop = \SilverWp\get_theme_option( 'general_header_top_margin' );
    $logo_image_margintop = $logo_image_margintop ? $logo_image_margintop : 0;
$site_name = get_bloginfo('name');
$logo_image_width = (int) get_option( 'general_header_logo_width' );
    $logo_image_attr_width = $logo_image_width ? 'width="'.$logo_image_width.'"' : '';
$logo_image_height = (int) get_option( 'general_header_logo_height' );
    $logo_image_attr_height = $logo_image_height ? 'height="'.$logo_image_height.'"' : '';
    $logo_image_attrs = $logo_image_attr_srcset . ' ' . $logo_image_attr_width . ' ' . $logo_image_attr_height;
?>
<header class="navbar navbar-default navbar-static-top banner">
    <div class="container">
        <div class="navbar-header">
            <button type="button"
                    class="navbar-toggle collapsed"
                    data-toggle="collapse"
                    data-target="#navbar-nav-collapse"
                    aria-expanded="false">
                <span class="sr-only"><?php _e('Toggle navigation', 'silverwp') ?></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand brand" href="<?php echo home_url('/'); ?>">
                <?php if ( $logo_image ): // IF setted Image ?>
                    <img src="<?php echo $logo_image; ?>"
                         alt="<?php echo esc_attr($site_name); ?>"
                         style="top:<?php echo $logo_image_margintop; ?>px"
                        <?php echo $logo_image_attrs; ?>>
                <?php else: // ELSE only text "Site name" ?>
                    <?php echo $site_name; ?>
                <?php endif; ?>
            </a>
        </div><!-- /.navbar-header -->
        <nav class="collapse navbar-collapse nav-primary" id="navbar-nav-collapse">
            <?php
            if (has_nav_menu('primary_navigation')) :
                wp_nav_menu(array(
                    //'menu'              => 'primary_navigation',
                    'theme_location'    => 'primary_navigation',
                    //'depth'             => 2,
                    'menu_class'        => 'nav navbar-nav',
                    //'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                    'walker'            => new wp_bootstrap_navwalker(),
                ));
            endif;
            ?>
        </nav>
    </div><!-- /.container -->
</header>

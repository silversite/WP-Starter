<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = array(
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/customizer.php', // Theme customizer

  'lib/wp_bootstrap_navwalker.php', // https://github.com/twittem/wp-bootstrap-navwalker
  'lib/ssextras.php',  // SilverWp extra functions
);

if ( class_exists( '\SilverWp\SilverWp' ) ) {
    $silverwp_includes = array(
        'lib/bootstrap.php', // Theme main configuration file
        'lib/image.php',     // Image size configuration
    );
    $sage_includes = array_merge( $sage_includes, $silverwp_includes );
}

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);

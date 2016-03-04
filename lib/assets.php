<?php

namespace Roots\Sage\Assets;

/**
 * Get paths for assets
 */
class JsonManifest {
  private $manifest;

  public function __construct($manifest_path) {
    if (file_exists($manifest_path)) {
      $this->manifest = json_decode(file_get_contents($manifest_path), true);
    } else {
      $this->manifest = array();
    }
  }

  public function get() {
    return $this->manifest;
  }

  public function getPath($key = '', $default = null) {
    $collection = $this->manifest;
    if (is_null($key)) {
      return $collection;
    }
    if (isset($collection[$key])) {
      return $collection[$key];
    }
    foreach (explode('.', $key) as $segment) {
      if (!isset($collection[$segment])) {
        return $default;
      } else {
        $collection = $collection[$segment];
      }
    }
    return $collection;
  }
}

function asset_path($filename) {
  $dist_path = get_template_directory_uri() . '/dist/';
  $directory = dirname($filename) . '/';
  $file = basename($filename);
  static $manifest;

  if (empty($manifest)) {
    $manifest_path = get_template_directory() . '/dist/' . 'assets.json';
    $manifest = new JsonManifest($manifest_path);
  }

  if (array_key_exists($file, $manifest->get())) {
    $manifestget = $manifest->get();
    return $dist_path . $directory . $manifestget[$file];
  } else {
    return $dist_path . $directory . $file;
  }
}

function assets() {
  if ( class_exists( '\SilverWp\SilverWp' ) ) {
    $custom_css = \SilverWp\get_theme_option( 'custom_css' );
    if ( ! empty( $custom_css ) ) {
      wp_add_inline_style( 'sage_css', $custom_css );
    }
  }

  wp_enqueue_style( 'gwf', 'https://fonts.googleapis.com/css?family=Open+Sans:400,400italic,700&subset=latin,latin-ext', false, null );
  //wp_enqueue_style( 'fontello', asset_path( 'fonts/fontello.css' ), false, null );
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 999 );

/**
 * Add custom JS
 */
if ( class_exists( '\SilverWp\SilverWp' ) ) {
  //...to head
  function head_script() {
    $head = '';
    $javascript_code = \SilverWp\get_theme_option( 'js_header_code' );
    if ( $javascript_code && ! empty( $javascript_code ) ) {
      $head .= '<script>' . "\n\r";
      $head .= $javascript_code . "\n\r";
      $head .= '</script>' . "\n\r";
    }
    echo $head;
  }
  add_action( 'wp_head', __NAMESPACE__ . '\\head_script', 101 );
  // ...to footer
  function footer_script() {
    $footer = '';
    $javascript_code = \SilverWp\get_theme_option( 'js_footer_code' );
    if ( $javascript_code && ! empty( $javascript_code ) ) {
      $footer .= '<script>'; // Custom Javascript code in Body page
      $footer .= $javascript_code;
      $footer .= '</script>';
    }
    echo $footer;
  }
  add_action( 'wp_footer', __NAMESPACE__ . '\\footer_script', 102 );
}

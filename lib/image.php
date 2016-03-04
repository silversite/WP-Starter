<?php
/**
 * image configuration file
 */
$image_sizes = array(
    'default' => array(
        'thumbnail' => array( // grid, container-grid-4 (grid archive)
            'width'  => 360,
            'height' => 999,
            'crop'   => false,
        ),
        'medium' => array( // full width with Sidebar (container-grid-9) / Featured or Single view
            'width'  => 750,
            'height' => 9999,
            'crop'   => false,
        ),
        'large' => array( // full container width (container-grid-12)
            'width'  => 1140,
            'height' => 9999,
            'crop'   => false,
        ),
        'post-thumbnail' => array( // widget: Recent posts
            'width'  => 60,
            'height' => 60,
            'crop'   => true,
        )
    ),
    'custom' => array(
        // add image for all post type
        'list' => array( // List view with Sidebar (Archive)
            'width'  => 230,
            'height' => 180,
            'crop'   => true,
        ),
        'half-container' => array( // half width of container without Sidebar (container-grid-6)
            'width'  => 555,
            'height' => 9999,
            'crop'   => false,
        ),
        'sticky-square' => array( // header Sticky plugin (Masonry Posts) - big square
            'width'  => 720,
            'height' => 720,
            'crop'   => true,
        ),
        'sticky-rectangle' => array( // header Sticky plugin (Masonry Posts) - rectangle
            'width'  => 720,
            'height' => 359,
            'crop'   => true,
        ),
        'sticky-carousel' => array( // header Sticky plugin (Carousel)
            'width'  => 1140,
            'height' => 520,
            'crop'   => true,
        ),
        'megamenu' => array( // dropdown navigation - megamenu  /  related posts
            'width'  => 263, // 248 - perfect for megamenu
            'height' => 174, // 164 - perfect for megamenu
            'crop'   => true,
        )
    )
);
if ( class_exists( '\SilverWp\Helper\Thumbnail' ) ) {
	$thumbnail = new \SilverWp\Helper\Thumbnail();
	$thumbnail->setImageSize( $image_sizes );
}

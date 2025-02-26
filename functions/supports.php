<?php
// Add theme supports
function my_theme_setup() {
    add_theme_support('post-thumbnails');
    add_theme_support( 'editor-styles' );
}
add_action('after_setup_theme', 'my_theme_setup');


// Mimes
function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

function fix_svg() {
  echo '<style type="text/css">
        .attachment-266x266, .thumbnail img {
             width: 100% !important;
             height: auto !important;
        }
        </style>';
}
add_action( 'admin_head', 'fix_svg' );
?>
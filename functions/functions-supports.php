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
?>
<?php
// Add theme supports
function my_theme_setup() {
    add_theme_support('post-thumbnails');
    add_theme_support( 'editor-styles' );
}
add_action('after_setup_theme', 'my_theme_setup');
?>
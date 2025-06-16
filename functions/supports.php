<?php
// Add theme supports
function my_theme_setup()
{
    add_theme_support('post-thumbnails');
    add_theme_support('editor-styles');
}
add_action('after_setup_theme', 'my_theme_setup');

// Mimes
function cc_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

function fix_svg()
{
    echo '<style type="text/css">
        .attachment-266x266, .thumbnail img {
             width: 100% !important;
             height: auto !important;
        }
        </style>';
}
add_action('admin_head', 'fix_svg');

function word_count($string, $limit)
{
    $words = explode(' ', $string);
    return implode(' ', array_slice($words, 0, $limit));
}

add_filter('wp_get_attachment_image_attributes', function ($attr, $attachment, $size) {
    if (! isset($attr['loading'])) {
        $attr['loading'] = 'lazy';
    }
    return $attr;
}, 10, 3);
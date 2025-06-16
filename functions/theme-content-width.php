<?php
function custom_theme_width($theme_json, $theme = null)
{
    $current_data = $theme_json->get_data();

    // Retrieve ACF fields from the options page with fallbacks.
    $content_width = get_field('width_content', 'option') ?: '800';
    $content_width_wide = get_field('width_content_wide', 'option') ?: '1240';

    $current_data['settings']['layout'] = array(
        'contentSize' => $content_width . 'px',
        'wideSize' => $content_width_wide . 'px'
    );

    return $theme_json->update_with($current_data);
}
add_filter('wp_theme_json_data_theme', 'custom_theme_width', 10, 2);
add_filter('wp_theme_json_data_block_editor', 'custom_theme_width', 10, 2);
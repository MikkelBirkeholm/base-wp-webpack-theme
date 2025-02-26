<?php
function custom_theme_colors( $theme_json, $theme = null ) {
    $current_data = $theme_json->get_data();

    // Retrieve ACF fields from the options page with fallbacks.
    $color1 = get_field('color_1', 'option') ?: '#000000';
    $color2 = get_field('color_2', 'option') ?: '#FFFFFF';
    $color3 = get_field('color_3', 'option') ?: "#FAFAFA";
    $color4 = get_field('color_4', 'option') ?: "#FAFAFA";
    $color5 = get_field('color_5', 'option') ?: "#002B41";
    $color6 = get_field('color_6', 'option') ?: '#0084C7';
    $color7 = get_field('color_7', 'option') ?: '#D9F642';
    $color8 = get_field('color_8', 'option') ?: '#223704';
    $color9 = get_field('color_9', 'option') ?: '#A29B30';
    $color10 = get_field('color_10', 'option') ?: '#FFD700';

    $colors_details = get_field('colors_details', 'option');

    $brand_color = isset($colors_details['color_brand']) ? $colors_details['color_brand'] : '#000000';
    $color_links_hover = isset($colors_details['color_links_hover']) ? $colors_details['color_links_hover'] : '#000000';

    // Override the palette.
    $current_data['settings']['color']['palette'] = [
        [
            'name'  => 'Color 1',
            'slug'  => 'color-1',
            'color' => $color1,
        ],
        [
            'name'  => 'Color 2',
            'slug'  => 'color-2',
            'color' => $color2,
        ],
        [
            'name'  => 'Color 3',
            'slug'  => 'color-3',
            'color' => $color3,
        ],
        [
            'name'  => 'Color 4',
            'slug'  => 'color-4',
            'color' => $color4,
        ],
        [
            'name'  => 'Color 5',
            'slug'  => 'color-5',
            'color' => $color5,
        ],
        [
            'name'  => 'Color 6',
            'slug'  => 'color-6',
            'color' => $color6,
        ],
        [
            'name'  => 'Color 7',
            'slug'  => 'lime',
            'color' => $color7,
        ],
        [
            'name'  => 'Color 8',
            'slug'  => 'color-8',
            'color' => $color8,
        ],
        [
            'name'  => 'Color 9',
            'slug'  => 'color-9',
            'color' => $color9,
        ],
        [
            'name'  => 'Color 10',
            'slug'  => 'color-10',
            'color' => $color10,
        ],
        [
            'name'  => 'Brand Color',
            'slug'  => 'brand-color',
            'color' => $brand_color,
        ],
        [
            'name'  => 'Links Hover',
            'slug'  => 'links-hover',
            'color' => $color_links_hover,
        ],
    ];
    
    return $theme_json->update_with( $current_data );
}
add_filter( 'wp_theme_json_data_theme', 'custom_theme_colors', 10, 2 );
?>
<?php
// Explainer: Theme theme must be set up with a options page + a repeater field called 'colors', with color_name and color_value sub-fields.
function custom_theme_colors($theme_json, $theme = null)
{
    $current_data = $theme_json->get_data();

    // Check if the colors repeater field exists and warn on screen if it doesn't. 
    if (!function_exists('have_rows') || !function_exists('get_sub_field')) {
        // Set a global flag to show admin notice
        global $acf_missing_notice;
        $acf_missing_notice = true;
        return $theme_json;
    }

    $current_data['settings']['color']['palette'] = [];
    if (have_rows('colors', 'option')) {
        while (have_rows('colors', 'option')) {
            the_row();
            $color_name = get_sub_field('color_name');
            $color_value = get_sub_field('color_value');
            $slug = sanitize_title($color_name);

            // Add each color to the palette.
            if (!empty($color_name) && !empty($color_value) && !empty($slug)) {
                $current_data['settings']['color']['palette'][] = [
                    'name'  => $color_name,
                    'slug'  => sanitize_title($color_name),
                    'color' => $color_value,
                ];
            }
        }
    } else {
        // Set a global flag to show admin notice if colors field is missing
        global $acf_colors_missing_notice;
        $acf_colors_missing_notice = true;
    }

    return $theme_json->update_with($current_data);
}
add_filter('wp_theme_json_data_theme', 'custom_theme_colors', 10, 2);

// Show admin notice if ACF is missing or colors field is missing
add_action('admin_notices', function () {
    global $acf_missing_notice, $acf_colors_missing_notice;
    if (!empty($acf_missing_notice)) {
        echo '<div class="notice notice-error"><p><strong>Warning:</strong> ACF functions are not available. Ensure ACF is installed and activated for theme colors to work.</p></div>';
    }
    if (!empty($acf_colors_missing_notice)) {
        echo '<div class="notice notice-error"><p><strong>Warning:</strong> The ACF options page or the "colors" repeater field is missing. Please create an options page with a "colors" repeater field for theme colors to work.</p></div>';
    }
});

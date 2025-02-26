<?php

add_action('acf/init', function () {
    acf_update_setting('enqueue_block_styles', false);
}, 1); // Priority set to 1 for early execution

// register webpack compiled js and css with theme
  function enqueue_webpack_scripts() {
    
    $cssFilePath = glob( get_template_directory() . '/css/build/main.min.css' );
    $cssFileURI = get_template_directory_uri() . '/css/build/' . basename($cssFilePath[0]);
    wp_enqueue_style( 'main_css', $cssFileURI );
    
    $jsFilePath = glob( get_template_directory() . '/js/build/main.min.js' );
    $jsFileURI = get_template_directory_uri() . '/js/build/' . basename($jsFilePath[0]);
    wp_enqueue_script( 'main_js', $jsFileURI , null , null , true );
     
  }
  add_action( 'wp_enqueue_scripts', 'enqueue_webpack_scripts' );

  add_filter('show_admin_bar', 'is_blog_admin'); // Remove admin bar from front end

  // Check blocks recursively
if (!function_exists('check_blocks_recursive')) {
    function check_blocks_recursive($blocks, $block_directories) {
        $found_blocks = [];

        foreach ($blocks as $block) {
            // Handle reusable blocks (core/block)
            if ($block['blockName'] === 'core/block' && !empty($block['attrs']['ref'])) {
                // Fetch the reusable block content by its ID
                $reusable_block_content = get_post_field('post_content', $block['attrs']['ref']);

                // Parse the reusable block content and check its blocks
                if ($reusable_block_content) {
                    $inner_blocks = parse_blocks($reusable_block_content);
                    $found_blocks = array_merge(
                        $found_blocks,
                        check_blocks_recursive($inner_blocks, $block_directories)
                    );
                }
            }

            // Check if block matches any in the block directories
            foreach ($block_directories as $block_directory) {
                $block_name = basename($block_directory);
                if (isset($block['blockName']) && strpos($block['blockName'], $block_name) !== false) {
                    $found_blocks[] = $block_name;
                }
            }

            // Check inner blocks recursively
            if (!empty($block['innerBlocks'])) {
                $found_blocks = array_merge(
                    $found_blocks,
                    check_blocks_recursive($block['innerBlocks'], $block_directories)
                );
            }
        }

        return $found_blocks;
    }
}

function enqueue_block_styles() {
    global $post;

    if (!$post) {
        return;
    }

    // Get the content of the current post/page
    $post_content = $post->post_content;

    // Scan for blocks, including nested blocks
    $used_blocks = parse_blocks($post_content);

    // List all block folders dynamically
    $block_directories = glob(get_template_directory() . '/blocks/*', GLOB_ONLYDIR);

    // Find all used blocks (including nested ones)
    $used_block_names = check_blocks_recursive($used_blocks, $block_directories);

    // Enqueue styles for each found block
    foreach (array_unique($used_block_names) as $block_name) {
        $block_css_file = get_template_directory() . '/css/build/style.' . $block_name . '.min.css';

        if (file_exists($block_css_file)) {
            wp_enqueue_style(
                $block_name . '_css',
                get_template_directory_uri() . '/css/build/style.' . $block_name . '.min.css'
            );
        }
    }
}
add_action('wp_enqueue_scripts', 'enqueue_block_styles');

function enqueue_block_scripts() {
    global $post;

    if (!$post) {
        return;
    }

    // Get the content of the current post/page
    $post_content = $post->post_content;

    // Parse the blocks, including nested blocks
    $used_blocks = parse_blocks($post_content);

    // List all block folders dynamically
    $block_directories = glob(get_template_directory() . '/blocks/*', GLOB_ONLYDIR);

    // Find all used blocks (including nested ones)
    $used_block_names = check_blocks_recursive($used_blocks, $block_directories);

    // Enqueue scripts for each found block
    foreach (array_unique($used_block_names) as $block_name) {
        $block_js_file = get_template_directory() . '/js/build/script.' . $block_name . '.min.js';

        if (file_exists($block_js_file)) {
            wp_enqueue_script(
                $block_name . '_js',
                get_template_directory_uri() . '/js/build/script.' . $block_name . '.min.js',
                array(), // Add any dependencies if needed, e.g., ['jquery']
                filemtime($block_js_file), // Use file modification time for versioning
                true // Load in the footer
            );
        }
    }
}
add_action('wp_enqueue_scripts', 'enqueue_block_scripts');

 
  
  // Enqueue editor styles
function enqueue_block_editor_styles() {
    // Dynamically find all block CSS files
    $block_directories = glob( get_template_directory() . '/css/build/*.css' );

    // $editor_styles = glob( get_template_directory() . '/css/editor.scss' );

    // // Enqueue the editor styles
    // wp_enqueue_style( 'block_editor_css', get_template_directory_uri() . '/css/editor.scss', false, '1.0', 'all' );
    
    foreach ( $block_directories as $block_css_file ) {
        $block_name = basename( $block_css_file, '.css' );
        $cssFileURI = get_template_directory_uri() . '/css/build/' . basename( $block_css_file );
        
        // Enqueue each block's CSS for the editor
        wp_enqueue_style( 'block_editor_css_' . $block_name, $cssFileURI );
    }
}
add_action( 'enqueue_block_editor_assets', 'enqueue_block_editor_styles' );


add_action('wp_enqueue_scripts', 'custom_localize_ajax_url');
function custom_localize_ajax_url() {
    wp_localize_script('jquery', 'ajax_params', array('ajax_url' => admin_url('admin-ajax.php'))); // 'jquery' is used to ensure it attaches to a script that definitely exists.
}
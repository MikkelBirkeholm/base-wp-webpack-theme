<?php
  // register webpack compiled js and css with theme
  function enqueue_webpack_scripts() {
    
    $cssFilePath = glob( get_template_directory() . '/css/build/main.min.*.css' );
    $cssFileURI = get_template_directory_uri() . '/css/build/' . basename($cssFilePath[0]);
    wp_enqueue_style( 'main_css', $cssFileURI );
    
    $jsFilePath = glob( get_template_directory() . '/js/build/main.min.*.js' );
    $jsFileURI = get_template_directory_uri() . '/js/build/' . basename($jsFilePath[0]);
    wp_enqueue_script( 'main_js', $jsFileURI , null , null , true );
     
  }
  add_action( 'wp_enqueue_scripts', 'enqueue_webpack_scripts' );

  add_filter('show_admin_bar', 'is_blog_admin'); // Remove admin bar from front end

//   add_editor_style();
  // Enqueue editor styles
  function enqueue_block_editor_styles() {
      $cssFilePath = glob( get_template_directory() . '/css/build/main.min.*.css' );
      $cssFileURI = get_template_directory_uri() . '/css/build/' . basename($cssFilePath[0]);
      wp_enqueue_style( 'block_editor_css', $cssFileURI );
  }
  add_action( 'enqueue_block_editor_assets', 'enqueue_block_editor_styles' );

add_action('wp_enqueue_scripts', 'custom_localize_ajax_url');
function custom_localize_ajax_url() {
    wp_localize_script('jquery', 'ajax_params', array('ajax_url' => admin_url('admin-ajax.php'))); // 'jquery' is used to ensure it attaches to a script that definitely exists.
}
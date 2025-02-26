<?php  



add_action( 'init', 'register_acf_blocks' );
function register_acf_blocks() {
	// Check if ACF is active
	if ( !function_exists('get_field') ) {
		// Create warning message
		$warning = 'This theme requires the Advanced Custom Fields plugin. Please install and activate the plugin.';
		echo '<div class="error"><p>' . $warning . '</p></div>';
		return;
	}



	$blocks = array_filter(glob(get_theme_file_path('/blocks/*')), 'is_dir');
	if ( !$blocks ) return;

	foreach ( $blocks as $block_dir ) :
		$block_name = basename($block_dir);
		$json_path 	= $block_dir . '/block.json';

		if ( !file_exists($json_path) ) continue;

		// Register block
		register_block_type( $json_path );

	endforeach;
}


?>
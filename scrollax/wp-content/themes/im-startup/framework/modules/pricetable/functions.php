<?php


define('PRICETABLE_FEATURED_WEIGHT', 1.175);
define('PRICETABLE_VERSION', '0.2.2');

/**
 * Activate the pricetable plugin
 */
function siteorigin_pricetable_activate(){
	// Flush rules so we can view price table pages
	flush_rewrite_rules();
	
	delete_option('siteorigin_pricetable_welcome');
}
register_activation_hook(__FILE__, 'siteorigin_pricetable_activate');

/**
 * Deactivate the pricetable plugin
 */
function siteorigin_pricetable_deactivate(){
	delete_option('siteorigin_pricetable_welcome');
}
register_deactivation_hook(__FILE__, 'siteorigin_pricetable_deactivate');

/**
 * Check if we need to redirect the user to the welcome page
 */
function siteorigin_pricetable_display_welcome(){
/*
	if(get_option('siteorigin_pricetable_welcome', false) === false && @$_GET['page'] != 'pricetable-welcome' && current_user_can('manage_options')){
		header('location:'.admin_url('edit.php?post_type=pricetable&page=pricetable-welcome'));
		exit();
	}
*/
}
//add_action('admin_init', 'siteorigin_pricetable_display_welcome');

/**
 * Add custom columns to pricetable post list in the admin
 * @param $cols
 * @return array
 */
function siteorigin_pricetable_register_custom_columns($cols){
	global $post;
	unset($cols['title']);
	unset($cols['date']);
	
	$cols['title'] = __('Title', 'pricetable');
	$cols['options'] = __('Options', 'pricetable');
	$cols['features'] = __('Features', 'pricetable');
	$cols['featured'] = __('Featured Option', 'pricetable');
	$cols['date'] = __('Date', 'pricetable');
	$cols['class'] = get_post_meta($post->ID, '_price_class', true);
	$cols['custom'] = get_post_meta($post->ID, '_price_custom', true);
	$cols['currency'] = get_post_meta($post->ID, '_price_currency', true);
	$cols['header_bg'] = get_post_meta($post->ID, '_price_header_bg', true);
	$cols['price_bg'] = get_post_meta($post->ID, '_price_price_bg', true);
	$cols['button_bg_first'] = get_post_meta($post->ID, '_price_button_bg_first', true);
	$cols['button_bg_second'] = get_post_meta($post->ID, '_price_button_bg_second', true);
	$cols['header_color'] = get_post_meta($post->ID, '_price_header_color', true);
	$cols['price_color'] = get_post_meta($post->ID, '_price_price_color', true);
	return $cols;
}
add_filter( 'manage_pricetable_posts_columns', 'siteorigin_pricetable_register_custom_columns');

/**
 * Render the contents of the admin columns
 * @param $column_name
 */
function siteorigin_pricetable_custom_column($column_name){
	global $post;
	switch($column_name){
	case 'options' :
		$table = get_post_meta($post->ID, 'price_table', true);
		print count($table);
		break;
	case 'features' :
	case 'featured' :
		$table = get_post_meta($post->ID, 'price_table', true);
		foreach($table as $col){
		if(!empty($col['featured']) && $col['featured'] == 'true'){
			if($column_name == 'featured') print $col['title'];
			else print count($col['features']);
			break;
		}
		}
		break;
	}
}
add_action( 'manage_pricetable_posts_custom_column', 'siteorigin_pricetable_custom_column');


/**
 * Enqueue the pricetable scripts
 */
function siteorigin_pricetable_scripts(){
	global $post, $pricetable_queued, $pricetable_displayed;
	if(is_singular() && (($post->post_type == 'pricetable') || ($post->post_type != 'pricetable' && preg_match( '#\[ *price_table([^\]])*\]#i', $post->post_content ))) || !empty($pricetable_displayed)){
		$pricetable_queued = true;
	}
}
add_action('wp_enqueue_scripts', 'siteorigin_pricetable_scripts');

/**
 * Metaboxes because we're boss
 * 
 * @action add_meta_boxes
 */
function siteorigin_pricetable_meta_boxes(){
	add_meta_box('pricetable', __('Price Table', 'pricetable'), 'siteorigin_pricetable_render_metabox', 'pricetable', 'normal', 'high');
	add_meta_box('pricetable-shortcode', __('Shortcode', 'pricetable'), 'siteorigin_pricetable_render_metabox_shortcode', 'pricetable', 'side', 'low');
}
add_action( 'add_meta_boxes', 'siteorigin_pricetable_meta_boxes' );

/**
 * Render the price table building interface
 * 
 * @param $post
 * @param $metabox
 */
function siteorigin_pricetable_render_metabox($post, $metabox){
	wp_nonce_field( plugin_basename( __FILE__ ), 'siteorigin_pricetable_nonce' );
	
	$table = get_post_meta($post->ID, 'price_table', true);
	if(empty($table)) $table = array();
	
	include(THEME_MODULES.'/pricetable/tpl/pricetable.build.php');
}

/**
 * Render the shortcode metabox
 * @param $post
 * @param $metabox
 */
function siteorigin_pricetable_render_metabox_shortcode($post, $metabox){
	?>
		<code>[price_table id=<?php print $post->ID ?>]</code>
		<small class="description"><?php _e('Displays price table on another page.', 'pricetable') ?></small>
	<?php
}

/**
 * Save the price table
 * @param $post_id
 * @return
 * 
 * @action save_post
 */
function siteorigin_pricetable_save($post_id){
	// Authorization, verification this is my vocation 
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( !wp_verify_nonce( @$_POST['siteorigin_pricetable_nonce'], plugin_basename( __FILE__ ) ) ) return;
	if ( !current_user_can( 'edit_post', $post_id ) ) return;
	
	// Create the price table from the post variables
	$table = array();
	foreach($_POST as $name => $val){
		if(substr($name,0,6) == 'price_'){
			$parts = explode('_', $name);
			
			$i = intval($parts[1]);
			if(@$parts[2] == 'feature'){
				// Adding a feature
				$fi = intval($parts[3]);
				$fn = $parts[4];
				
				if(empty($table[$i]['features'])) $table[$i]['features'] = array();
				$table[$i]['features'][$fi][$fn] = $val;
			}
			elseif(isset($parts[2])){
				// Adding a field
				$table[$i][$parts[2]] = $val;
			}
		}
	}
	
	// Clean up the features
	foreach($table as $i => $col){
		if(empty($col['features'])) continue;
		
		foreach($col['features'] as $fi => $feature){
			if(empty($feature['title']) && empty($feature['sub']) && empty($feature['description'])){
				unset($table[$i]['features'][$fi]);
			}
		}
		$table[$i]['features'] = array_values($table[$i]['features']);
	}
	
	if(isset($_POST['price_recommend'])){
		$table[intval($_POST['price_recommend'])]['featured'] = 'true';
	}
	
	$table = array_values($table);
	
	update_post_meta($post_id,'price_table', $table);
}
add_action( 'save_post', 'siteorigin_pricetable_save' );

/**
 * The price table shortcode.
 * @param array $atts
 * @return string
 * 
 * 
 */
function siteorigin_pricetable_shortcode($atts = array()) {
	global $post, $pricetable_displayed;
	
	$pricetable_displayed = true;
	
	extract( shortcode_atts( array(
		'id' => null,
		'width' => 100,
	), $atts ) );
	
	if($id == null) $id = $post->ID;
	
	$table = get_post_meta($id , 'price_table', true);
	if(empty($table)) $table = array();

	$params = Array();
	$params['class'] = get_post_meta($id, '_price_class', true);
	$params['custom'] = get_post_meta($id, '_price_custom', true);
	$params['currency'] = get_post_meta($id, '_price_currency', true);
	$params['header_bg'] = get_post_meta($id, '_price_header_bg', true);
	$params['price_bg'] = get_post_meta($id, '_price_price_bg', true);
	$params['button_bg_first'] = get_post_meta($id, '_price_button_bg_first', true);
	$params['button_bg_second'] = get_post_meta($id, '_price_button_bg_second', true);
	$params['header_color'] = get_post_meta($id, '_price_header_color', true);
	$params['price_color'] = get_post_meta($id, '_price_price_color', true);
	$params['after'] = get_post_meta($id, '_price_after', true);

	
	// Set all the classes
	$featured_index = null;
	foreach($table as $i => $column) {
		$table[$i]['classes'] = array('pricetable-column');
		$table[$i]['classes'][] = (@$table[$i]['featured'] === 'true') ? 'pricetable-featured' : 'pricetable-standard';
		
		if(@$table[$i]['featured'] == 'true') $featured_index = $i;
		if(@$table[$i+1]['featured'] == 'true') $table[$i]['classes'][] = 'pricetable-before-featured';
		if(@$table[$i-1]['featured'] == 'true') $table[$i]['classes'][] = 'pricetable-after-featured';
	}
	$table[0]['classes'][] = 'pricetable-first';
	$table[count($table)-1]['classes'][] = 'pricetable-last';
	
	// Calculate the widths
	$width_total = 0;
	foreach($table as $i => $column){
		//if(@$column['featured'] === 'true') $width_total += PRICETABLE_FEATURED_WEIGHT;
		//else
		
		$width_total++;
	}
	$width_sum = 0;
	foreach($table as $i => $column){
		//if(@$column['featured'] === 'true'){
			// The featured column takes any width left over after assigning to the normal columns
		//	$table[$i]['width'] = 100 - (floor(100/$width_total) * ($width_total-PRICETABLE_FEATURED_WEIGHT));
		//}
		//else{
			$table[$i]['width'] = round(100/$width_total , 1);
		//}
		$width_sum += $table[$i]['width'];
	}
	
	// Create fillers
	if(!empty($table[0]['features'])){
		for($i = 0; $i < count($table[0]['features']); $i++){
			$has_title = false;
			$has_sub = false;
			
			foreach($table as $column){
				$has_title = ($has_title || !empty($column['features'][$i]['title']));
				$has_sub = ($has_sub || !empty($column['features'][$i]['sub']));
			}
			
			foreach($table as $j => $column){
				if($has_title && empty($table[$j]['features'][$i]['title'])) $table[$j]['features'][$i]['title'] = '&nbsp;';
				if($has_sub && empty($table[$j]['features'][$i]['sub'])) $table[$j]['features'][$i]['sub'] = '&nbsp;';
			}
		}
	}
	
	// Find the best pricetable file to use
	//if(file_exists(get_stylesheet_directory().'/pricetable.php')) $template = get_stylesheet_directory().'/pricetable.php';
	//elseif(file_exists(get_template_directory().'/pricetable.php')) $template = get_template_directory().'/pricetable.php'; 


	$template = THEME_MODULES.'/pricetable/tpl/pricetable.php';
	
	// Render the pricetable
	ob_start();
	include($template);
	$pricetable = ob_get_clean();
	
	if($width != 100) $pricetable = '<div style="width:'.$width.'%; margin: 0 auto;">'.$pricetable.'</div>';
	
	$post->pricetable_inserted = true;
	
	return $pricetable;
}
add_shortcode( 'price_table', 'siteorigin_pricetable_shortcode' );

/**
 * Add the pricetable to the content.
 * 
 * @param $the_content
 * @return string
 * 
 * @filter the_content
 */
function siteorigin_pricetable_the_content_filter($the_content){
	global $post;
	
	if(is_single() && $post->post_type == 'pricetable' && empty($post->pricetable_inserted)){
		$the_content = siteorigin_pricetable_shortcode().$the_content;
	}
	return $the_content;
}
// Filter the content after WordPress has had a chance to do shortcodes (priority 10)
add_filter('the_content', 'siteorigin_pricetable_the_content_filter',11);

/**
 * @action wp_footer
 */
function siteorigin_pricetable_footer(){
	global $pricetable_queued, $pricetable_displayed;
	
	if(!empty($pricetable_displayed) && empty($pricetable_queued)){
		$pricetable_queued = true;
	}
}
add_action('wp_footer', 'siteorigin_pricetable_footer');

/**
 * Render the welcome screen
 */
function siteorigin_pricetable_render_welcome(){
	add_option('siteorigin_pricetable_welcome', true, null, 'no');
	
	$info = get_plugin_data(__FILE__);
	
	include(THEME_MODULES.'/pricetable/tpl/welcome.php');
}

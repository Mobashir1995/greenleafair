<?php

/**
 * Forcefully enable comment form on all posts
 * 
 * @param boolean $open
 * @param integer $post_id
 * 
 * @return boolean
 */
add_filter('comments_open', 'pd_force_comments_open', 1000,2);
function pd_force_comments_open($open, $post_id){
	$open = false;
	if( get_post_type($post_id) == 'post' ){
		$setting = get_option('pd_force_comment_option');
		if( $setting === '1' ){
			$open = true;
		}
	}
	return $open;
}

/**
 * Add option to forcefully enable comment to all posts
 */
function pd_forcefully_comment_settings_init() {
	// register a new setting for "reading" page
	register_setting('discussion', 'pd_force_comment_option');

	// register a new section in the "discussion" page
	add_settings_section(
		'pd_comment_section',
		'Additional Comment options by PluginDevs',
		'pd_commenct_section_cb',
		'discussion'
	);

	// register a new field in the "pd_enable_force_comment" section, inside the "reading" page
	add_settings_field(
		'pd_enable_force_comment',
		'Enable Comment',
		'pd_comment_settings_callback',
		'discussion',
		'pd_comment_section'
	);
}
add_action('admin_init', 'pd_forcefully_comment_settings_init');

function pd_commenct_section_cb(){
	echo "<p>Enable comment for posts by checking this option</p>";
}
// field content cb
function pd_comment_settings_callback() {
	// get the value of the setting we've registered with register_setting()
	$setting = get_option('pd_force_comment_option');
	// output the field
	?>
		<input type="checkbox" name="pd_force_comment_option" value="1" <?php checked(1, $setting, true); ?> />
    <?php
}
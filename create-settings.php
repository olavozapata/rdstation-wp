<?php

//Sections, settings and fields
function rdcf7_initialize_theme_options(){

	add_settings_field(
		'token_rdstation',
		'Token RD Station',
		'rdcf7_token_field_display',
		'general'
	);
	register_setting(
		'general',
		'token_rdstation'
	);
}
add_action('admin_init', 'rdcf7_initialize_theme_options');


//Callbacks
function rdcf7_token_field_display(){ 
	$token_rdstation = get_option('token_rdstation');?>
	<input type="text" value="<?= $token_rdstation ?>" size="32" name="token_rdstation">
<?php }
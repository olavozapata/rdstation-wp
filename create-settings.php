<?php

function create_settings(){
	add_settings_field('token_rdstation', 'Token RD Station', 'display_token_page', 'general');
	add_settings_field('form_identifier', 'Identificador', 'display_id_page', 'general');
	register_setting('general', 'token_rdstation', 'validate_token');
	register_setting('general', 'token_rdstation');
}
add_action('admin_init', 'create_settings');

function display_token_page(){ 
	$token = get_option('token_rdstation'); ?>
	<input type="text" name="token_rdstation" value="<?= $token ?>" size="32"/>
	<?php
}

function display_id_page(){
	$identifier = get_option('form_identifier'); ?>
	<input type="text" name="form_identifier" value="<?= $identifier ?>" />
	<?php
}

function validate_token(){
	$token = strip_tags( stripslashes($_POST['token_rdstation'] ) );
	if(!empty($token)){
		if(strlen($token) != 32){
			$token = NULL;
			add_settings_error('token_rdstation', 'token_length', 'O Token RD Station precisa conter 32 caracteres', 'error');
		}
	}
	return $token;
}

function validate_identifier(){
	$identifier = strip_tags( stripslashes($_POST['form_identifier'] ) );
	return $identifier;
}

?>
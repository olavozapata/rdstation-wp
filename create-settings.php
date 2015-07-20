<?php

function create_settings(){
	add_settings_field('token_rdstation', 'Token RD Station', 'display_page', 'general');
	register_setting('general', 'token_rdstation', 'validate_token');
}
add_action('admin_init', 'create_settings');

function display_page(){ 
	$token = get_option('token_rdstation'); ?>
	<input type="text" name="token_rdstation" value="<?= $token ?>" size="32"/>
	<?php
}

function validate_token(){
	$token = strip_tags( stripslashes($_POST['token_rdstation'] ) );
	if(!empty($token)){
		if(strlen($token) != 32){
			add_settings_error('token_rdstation', 'token_length', 'O Token RD Station precisa conter 32 caracteres', 'error');
		}
	}
	

}

?>
<?php

/*
Plugin Name: RD Station CF7
Description: Integração do Contact Form 7 com o RD Station
Author: Resultados Digitais
Author URI: http://resultadosdigitais.com.br
*/

require_once('create-settings.php');

if ( ! defined( 'WPCF7_LOAD_JS' ) )
    define( 'WPCF7_LOAD_JS', false );

function addLeadConversion( $rdstation_token, $identifier, $data_array ) {
 	$api_url = "http://www.rdstation.com.br/api/1.2/conversions";

	try {
		if (empty($data_array["token_rdstation"]) && !empty($rdstation_token)) { $data_array["token_rdstation"] = $rdstation_token; }
		if (empty($data_array["identificador"]) && !empty($identifier)) { $data_array["identificador"] = $identifier; }
		if (empty($data_array["email"])) { $data_array["email"] = $data_array["your-email"]; }
		if (empty($data_array["c_utmz"])) { $data_array["c_utmz"] = $_COOKIE["__utmz"]; }
		if (empty($data_array["client_id"]) && !empty($_COOKIE["rdtrk"])) { 
		    preg_match("/(\w{8}-\w{4}-4\w{3}-\w{4}-\w{12})/",$_COOKIE["rdtrk"],$Matches);
		    $data_array["client_id"] = $Matches[0];
		}
		unset(
			$data_array["password"],
			$data_array["password_confirmation"],
			$data_array["senha"],
		    $data_array["confirme_senha"],
		    $data_array["captcha"],
		    $data_array["_wpcf7"],
		    $data_array["_wpcf7_version"],
		    $data_array["_wpcf7_unit_tag"],
		    $data_array["_wpnonce"],
		    $data_array["_wpcf7_is_ajax_call"],
		    $data_array["_wpcf7_locale"],
		    $data_array["your-email"]
		);

		$args = [ 'body' => $data_array ];
		$response = wp_remote_post( $api_url, $args );
	}
	catch (Exception $e) {
		return $e->getMessage();
  	}
}

function get_form_data( $cf7 ) {
	$token_rdstation = get_option('token_rdstation');
	$identifier = get_option('form_identifier');
	$submission = WPCF7_Submission::get_instance();
	if ( $submission ) {
	 	$form_data = $submission->get_posted_data();
	}
  addLeadConversion($token_rdstation, $identifier, $form_data);
}
add_action('wpcf7_mail_sent', 'get_form_data');

?>
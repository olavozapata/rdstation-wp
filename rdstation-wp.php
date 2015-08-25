<?php

/*
Plugin Name: RD Station WP
Description: Integração do Contact Form 7 com o RD Station
Author: Resultados Digitais
Author URI: http://resultadosdigitais.com.br
*/

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

// Contact Form 7
include_once('contactform7/create-settings.php');
include_once('contactform7/lead-conversion.php');

// Gravity Forms
include_once('gravityforms/create-settings.php');
include_once('gravityforms/lead-conversion.php');

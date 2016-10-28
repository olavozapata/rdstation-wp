<?php

/*
Plugin Name: 	Integração RD Station
Plugin URI: 	https://wordpress.org/plugins/integracao-rdstation
Description:  Integre seus formulários de contato do WordPress com o RD Station
Version:      2.3
Author:       Resultados Digitais
Author URI:   http://resultadosdigitais.com.br
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html

Integração RD Station is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Integração RD Station is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Integração RD Station. If not, see https://www.gnu.org/licenses/gpl-2.0.html.

*/

require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
require_once('RD_Custom_Post_Type.php');
require_once('lead-conversion.php');

function enqueue_rd_admin_style($hook) {
    if ( 'post.php' != $hook ) return;
    wp_enqueue_style( 'rd_admin_style', plugin_dir_url( __FILE__ ) . 'styles/admin.css' );
}
add_action( 'admin_enqueue_scripts', 'enqueue_rd_admin_style' );


$contact_form_7 = new RD_Custom_Post_Type ( 'CF7', 'Contact Form 7', 'rdcf7', 'contact-form-7/wp-contact-form-7.php' );
new LeadConversion('contact_form_7', 'wpcf7_mail_sent');

$gravity_forms = new RD_Custom_Post_Type ( 'GF', 'Gravity Forms', 'rdgf', 'gravityforms/gravityforms.php' );
new LeadConversion('gravity_forms', 'gform_after_submission');

// execute the scripts on page and single posts (Edição Olavo)
function wpwoxcustomscript_display_hook_header() {
  global $post;
    if(is_single() || is_page()) {
echo html_entity_decode(get_post_meta($post->ID, '_wpwoxcustomscriptcontentinhead', true));
}

echo get_option('wpwoxcustomscript_all_head');
return;
}

function wpwoxcustomscript_display_hook_footer() {
  global $post;
    if(is_single() || is_page()) {
echo html_entity_decode(get_post_meta($post->ID, '_wpwoxcustomscriptcontentinfooter', true));
}

echo get_option('wpwoxcustomscript_all_body');
return;
}


function wpwoxcustomscript_display_hook($content='') {
	global $post;
  $contents=$content;
    if(is_single() || is_page()) {
   $contents= html_entity_decode(get_post_meta($post->ID, '_wpwoxcustomscriptcontenttop', true)) . $content . html_entity_decode(get_post_meta($post->ID, '_wpwoxcustomscriptcontentbottom', true));
     }

return $contents;
}




//Displays a box that allows users to insert the scripts for the post or page
function wpwoxcustomscript_metaboxs($post) {
  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'wpwox_noncename' );

	?>
  <label for="wpwoxcustomscriptcontentinhead"><?php _e('Área para inserção de scripts dentro da tag <strong>&lt;head&gt;</strong>','wpwoxcustomscript') ?></label><br />
  <textarea style="width:100%; min-height: 50px;" id="wpwoxcustomscriptcontentinhead" name="wpwoxcustomscriptcontentinhead" /><?php echo html_entity_decode(get_post_meta($post->ID,'_wpwoxcustomscriptcontentinhead',true)); ?></textarea><br />
  <label for="wpwoxcustomscriptcontentinfooter"><?php _e('Área para inserção do script de integração de formulário <strong>antes do fechamento do &lt;/body&gt;</strong>','wpwoxcustomscript') ?></label><br />
  <textarea style="width:100%; min-height: 150px;" id="wpwoxcustomscriptcontentinfooter" name="wpwoxcustomscriptcontentinfooter" /><?php echo html_entity_decode(get_post_meta($post->ID,'_wpwoxcustomscriptcontentinfooter',true)); ?></textarea>

  	<?php
}

//Add the meta box to post and page
function wpwox_custom_script_meta_box() {
	add_meta_box('wpwox_custom_script','Integração de scripts RD Station','wpwoxcustomscript_metaboxs','post','advanced');
	add_meta_box('wpwox_custom_script','Integração de scripts RD Station','wpwoxcustomscript_metaboxs','page','advanced');
}
add_action('admin_menu', 'wpwox_custom_script_meta_box');

// When the post is updating, save the script.

function wpwoxcustomscript_updates($pID) {

  // if the function is called by the WP autosave feature, nothing must be saved
  if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
    return;

  // verify this came from the our screen and with proper authorization,
  // because save_post can be triggered at other times

  if ( !wp_verify_nonce( $_POST['wpwox_noncename'], plugin_basename( __FILE__ ) ) )
      return;



  if ( 'page' == $_POST['post_type'] )
  {
    if ( !current_user_can( 'edit_page', $pID ) )
        return;
  }
  else
  {
    if ( !current_user_can( 'edit_post', $pID ) )
        return;
  }

  // update the meta datas here
  $text = (isset($_POST['wpwoxcustomscript_content_top'])) ? $_POST['wpwoxcustomscript_content_top'] : '';
 $text= str_replace("\n", '', $text);
  $text= esc_js($text);
  update_post_meta($pID, '_wpwoxcustomscriptcontenttop', $text);

  $text = (isset($_POST['wpwoxcustomscript_content_bottom'])) ? $_POST['wpwoxcustomscript_content_bottom'] : '';
   $text= str_replace("\n", '', $text);
  $text= esc_js($text);
update_post_meta($pID, '_wpwoxcustomscriptcontentbottom', $text);

    $text = (isset($_POST['wpwoxcustomscriptcontentinhead'])) ? $_POST['wpwoxcustomscriptcontentinhead'] : '';
     $text= str_replace("\n", '', $text);
  $text= esc_js($text);
update_post_meta($pID, '_wpwoxcustomscriptcontentinhead', $text);

  $text = (isset($_POST['wpwoxcustomscriptcontentinfooter'])) ? $_POST['wpwoxcustomscriptcontentinfooter'] : '';
 $text= str_replace("\n", '', $text);
  $text= esc_js($text);
  update_post_meta($pID, '_wpwoxcustomscriptcontentinfooter', $text);
}
add_action('save_post', 'wpwoxcustomscript_updates');

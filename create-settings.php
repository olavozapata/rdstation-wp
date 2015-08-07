<?php

//Create custom post type for integrations
function rdcf7_custom_post_type() {
    $labels = [
        'name'                  => _x( 'Integrações', 'post_type_general_name' ),
        'singular_name'         => _x( 'Integração', 'post_type_singular_name' ),
        'add_new'               => _x( 'Criar integração', 'integration' ),
        'add_new_item'          => __( 'Criar Nova Integração' ),
        'edit_item'             => __( 'Editar Integração' ),
        'new_item'              => __( 'Nova Integração' ),
        'all_items'             => __( 'Todas Integrações' ),
        'view_item'             => __( 'Ver Integrações' ),
        'search_items'          => __( 'Procurar Integrações' ),
        'not_found'             => __( 'Nenhuma integração encontrada' ),
        'not_found_in_trash'    => __( 'Nenhuma integração encontrada na lixeira' ), 
        'parent_item_colon'     => '',
        'menu_name'             => 'RD Station WP'
    ];
    $args = [
        'labels'                => $labels,
        'description'           => 'Integração do Contact Form 7 com o RD Station',
        'public'                => true,
        'menu_position'         => 50,
        'supports'              => [ 'title' ],
        'has_archive'           => false,
    ];
    register_post_type( 'rdcf7_integrations', $args );
}
add_action( 'init', 'rdcf7_custom_post_type' );

// Meta box - Form identifier 
function rdcf7_form_identifier_box() {
    add_meta_box( 
        'rdcf7_form_identifier_box',
        'Identificador',
        'rdcf7_form_identifier_box_content',
        'rdcf7_integrations',
        'normal'
    );
}
add_action( 'add_meta_boxes', 'rdcf7_form_identifier_box' );

function rdcf7_form_identifier_box_content(){
    $identifier = get_post_meta(get_the_ID(), 'form_identifier', true);
    echo '<input type="text" name="form_identifier" value="'.$identifier.'">';
}
add_action( 'save_post', 'rdcf7_form_identifier_box_save' );

function rdcf7_form_identifier_box_save( $post_id ) {
  $identifier = $_POST['form_identifier'];
  update_post_meta( $post_id, 'form_identifier', $identifier );
}

// Meta box - Token RD Station
function rdcf7_token_rdstation_box() {
    add_meta_box( 
        'rdcf7_token_rdstation_box',
        'Token RD Station',
        'rdcf7_token_rdstation_box_content',
        'rdcf7_integrations',
        'normal'
    );
}
add_action( 'add_meta_boxes', 'rdcf7_token_rdstation_box' );

function rdcf7_token_rdstation_box_content(){
    $token = get_post_meta(get_the_ID(), 'token_rdstation', true);
    echo '<input type="text" name="token_rdstation" size="32" value="'.$token.'">';
}
add_action( 'save_post', 'rdcf7_token_rdstation_box_save' );

function rdcf7_token_rdstation_box_save( $post_id ) {
  $token = $_POST['token_rdstation'];
  update_post_meta( $post_id, 'token_rdstation', $token );
}

// Meta box - CF7 ID
function rdcf7_form_id_box() {
    add_meta_box( 
        'rdcf7_form_id_box',
        'Qual formulário você deseja integrar ao RD Station?',
        'rdcf7_form_id_box_content',
        'rdcf7_integrations',
        'normal'
    );
}
add_action( 'add_meta_boxes', 'rdcf7_form_id_box' );

function rdcf7_form_id_box_content(){
    $form_id = get_post_meta(get_the_ID(), 'form_id', true); ?>
    <select name="form_id">
        <option value=""></option>
        <?php
            $args = ['post_type' => 'wpcf7_contact_form'];
            $cf7Forms = get_posts( $args );
            if( $cf7Forms ){
                foreach($cf7Forms as $cf7Form){
                    echo "<option value=".$cf7Form->ID.selected( $form_id, $cf7Form->ID, false) .">".$cf7Form->post_title."</option>";
                }
            }
        ?>
    </select>
    <?php 
}
add_action( 'save_post', 'rdcf7_form_id_box_save' );

function rdcf7_form_id_box_save( $post_id ) {
  $token = $_POST['form_id'];
  update_post_meta( $post_id, 'form_id', $token );
}

?>
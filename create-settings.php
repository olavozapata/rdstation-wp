<?php

//Menus
function rdcf7_add_menu_page(){
	add_menu_page(
		'RD Station CF7',
		'RD Station CF7',
		'manage_options',
		'rdcf7-theme-page',
		'rdcf7_page_display'
	);
}
add_action('admin_menu', 'rdcf7_add_menu_page');

//Sections, settings and fields
function rdcf7_initialize_theme_options(){
	add_settings_section(
		'rdcf7_data_section',
		'Informações para Integração',
		'rdcf7_section_data_display',
		'rdcf7-theme-page'
	);

	add_settings_field(
		'token_rdstation',
		'Token RD Station',
		'rdcf7_token_field_display',
		'rdcf7-theme-page',
		'rdcf7_data_section'
	);

	add_settings_field(
		'form_identifier',
		'Identificador do formulário',
		'rdcf7_form_identifier_display',
		'rdcf7-theme-page',
		'rdcf7_data_section'
	);

	add_settings_field(
		'form_id',
		'Selecione o formulário',
		'rdcf7_form_title_display',
		'rdcf7-theme-page',
		'rdcf7_data_section'
	);

	register_setting(
		'rdcf7_data_section',
		'rdcf7_options'
	);
}
add_action('admin_init', 'rdcf7_initialize_theme_options');


//Callbacks
function rdcf7_page_display(){ ?>
	<div class="wrap">
		<h2>Integração RD Station e Contact Form</h2>
		<form method="post" action="options.php">
			<?php
				settings_fields('rdcf7_data_section');
				do_settings_sections('rdcf7-theme-page');
				submit_button();
			?>
		</form>
	</div>
<?php }

function rdcf7_section_data_display(){
	echo "Insira as informações para integração do seu formulário de contato com o RD Station";
}

function rdcf7_token_field_display(){ 
	$options = get_option('rdcf7_options');
	$token = $options['token_rdstation'];
	?>
	<input type="text" name="rdcf7_options[token_rdstation]" id="rdcf7_options_token_rdstation" value="<?= $token ?>" size="32">
<?php }

function rdcf7_form_identifier_display(){ 
	$options = get_option('rdcf7_options');
	$identifier = $options['form_identifier'];
	?>
	<input type="text" name="rdcf7_options[form_identifier]" id="rdcf7_options_form_identifier" value="<?= $identifier ?>">
<?php }

function rdcf7_form_title_display( $cf7 ){
	$options = get_option('rdcf7_options'); ?>
	<select name="rdcf7_options[form_id]">
		<option value=""> </option>
		<?php
			$args = array('post_type' => 'wpcf7_contact_form', 'posts_per_page' => -1);
			if( $cf7Forms = get_posts( $args ) ){
				foreach($cf7Forms as $cf7Form){
					echo "<option value=".$cf7Form->ID.selected( $options['form_id'], $cf7Form->ID, false) .">".$cf7Form->post_title."</option>";
				}
			}
		?>
	</select>
	<?php
}
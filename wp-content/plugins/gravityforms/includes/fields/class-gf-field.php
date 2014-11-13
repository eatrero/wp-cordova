<?php

if ( ! class_exists( 'GFForms' ) ) {
	die();
}


class GF_Field extends stdClass implements ArrayAccess {

	// Suppress deprecation until all the add-ons have been updated
	const SUPPRESS_DEPRECATION_NOTICE = true;

	private static $deprecation_notice_fired = false;

	public function __construct( $data = array() ) {
		foreach ( $data as $key => $value ) {
			$this->{$key} = $value;
		}
	}

	/*
	 * Fires the deprecation notice only once per page
	 */
	private function maybe_fire_array_access_deprecation_notice( $offset ) {
		if ( self::SUPPRESS_DEPRECATION_NOTICE ) {
			return;
		};

		if ( ! self::$deprecation_notice_fired ) {
			_deprecated_function( 'Array access to the field object is now deprecated. Further notices will be suppressed. Offset: ' . $offset, '1.9', 'the object operator e.g. $field->' . $offset );
			self::$deprecation_notice_fired = true;
		}
	}

	/**
	 * Handles array notation
	 *
	 * @param mixed $offset
	 *
	 * @return bool
	 */
	public function offsetExists( $offset ) {
		$this->maybe_fire_array_access_deprecation_notice( $offset );

		return isset( $this->$offset );
	}

	public function offsetGet( $offset ) {
		$this->maybe_fire_array_access_deprecation_notice( $offset );
		if ( ! isset( $this->$offset ) ) {
			$this->$offset = '';
		}

		return $this->$offset;
	}

	public function offsetSet( $offset, $data ) {
		$this->maybe_fire_array_access_deprecation_notice( $offset );
		if ( $offset === null ) {
			$this[] = $data;
		} else {
			$this->$offset = $data;
		}
	}

	public function offsetUnset( $offset ) {
		$this->maybe_fire_array_access_deprecation_notice( $offset );
		unset( $this->$offset );
	}

	public function __isset( $key ) {
		return isset( $this->$key );
	}

	public function __set( $key, $value ) {
		$this->$key = $value;
	}

	public function &__get( $key ) {
		if ( ! isset( $this->$key ) ) {
			$this->$key = '';
		}

		return $this->$key;
	}

	public function __unset( $key ) {
		unset( $this->$key );
	}

	public function is_conditional_logic_supported(){
		return false;
	}

	public function get_value_default_if_empty( $value ) {

		if ( ! GFCommon::is_empty_array( $value ) ) {
			return $value;
		}

		return $this->get_value_default();
	}

	public function get_value_default(){

		if ( is_array( $this->inputs ) ) {
			$value = array();
			foreach ( $this->inputs as $input ) {
				$value[ strval( $input['id'] ) ] = $this->is_form_editor()  ? rgar( $input, 'defaultValue' ) : GFCommon::replace_variables_prepopulate( rgar( $input, 'defaultValue' ) );
			}
		} else {
			$value = $this->is_form_editor() ? $this->defaultValue : GFCommon::replace_variables_prepopulate( $this->defaultValue );
		}

		return $value;
	}

	public function get_value_merge_tag( $value, $input_id, $entry, $form, $modifier, $raw_value, $url_encode, $esc_html, $format ) {
		return $value;
	}

	public function get_value_entry_list( $value, $entry, $field_id, $columns, $form ){
		return esc_html( $value );
	}

	public function get_value_entry_detail( $value, $currency = '', $use_text = false, $format = 'html', $media = 'screen' ) {
		if ( ! is_array( $value ) && $format == 'html' ) {
			return nl2br( $value );
		}
	}

	public function is_description_above( $form ){
		$form_label_placement        = rgar( $form, 'labelPlacement' );
		$field_label_placement       = $this->labelPlacement;
		$form_description_placement   = rgar( $form, 'descriptionPlacement' );
		$field_description_placement = $this->descriptionPlacement;
		if ( empty( $field_description_placement ) ) {
			$field_description_placement = $form_description_placement;
		}
		$is_description_above = $field_description_placement == 'above' && ( $field_label_placement == 'top_label' || $field_label_placement == 'hidden_label' || ( empty( $field_label_placement ) && $form_label_placement == 'top_label' ) );

		return $is_description_above;
	}

	public function get_description( $description, $css_class ) {
		return IS_ADMIN || ! empty( $description ) ? "<div class='$css_class'>" . $description . '</div>' : '';
	}

	public function get_field_content( $value, $force_frontend_label, $form  ){

		$field_label = $this->get_field_label( $force_frontend_label, $value );

		$validation_message = ( $this->failed_validation && ! empty( $this->validation_message ) ) ? sprintf( "<div class='gfield_description validation_message'>%s</div>", $this->validation_message ) : '';

		$required_div  = IS_ADMIN || $this->isRequired ? sprintf( "<span class='gfield_required'>%s</span>", $this->isRequired ? '*' : '' ) : '';

		$admin_buttons = $this->get_admin_buttons();

		$target_input_id  = $this->get_first_input_id( $form );

		$for_attribute = empty( $target_input_id ) ? '' : "for='{$target_input_id}'";

		$description = $this->get_description( $this->description, 'gfield_description' );
		if ( $this->is_description_above( $form ) ) {
			$clear         = IS_ADMIN ? "<div class='gf_clear'></div>" : '';
			$field_content = sprintf( "%s<label class='gfield_label' $for_attribute >%s%s</label>%s{FIELD}%s$clear", $admin_buttons, esc_html( $field_label ), $required_div, $description, $validation_message );
		} else {
			$field_content = sprintf( "%s<label class='gfield_label' $for_attribute >%s%s</label>{FIELD}%s%s", $admin_buttons, esc_html( $field_label ), $required_div, $description, $validation_message );
		}
		return $field_content;
	}

	public function get_first_input_id( $form ){
		$form_id         = $form['id'];

		$is_entry_detail = $this->is_entry_detail();
		$is_form_editor  = $this->is_form_editor();
		$field_id    = $is_entry_detail || $is_form_editor || $form_id == 0 ? 'input_' : 'input_' . $form_id ;

		if ( is_array( $this->inputs ) ) {
			foreach ( $this->inputs as $input ) {
				if ( ! isset( $input['isHidden'] ) || ! $input['isHidden'] ) {
					$field_id .= '_' . str_replace( '.', '_', $input['id'] );
					break;
				}
			}
		} else {
			$field_id .= '_' . $this->id;
		}

		return $field_id;
	}

	public function get_field_label( $force_frontend_label, $value ){
		$field_label = $force_frontend_label ? $this->label : GFCommon::get_label( $this );
		if ( ( $this->inputType == 'singleproduct' || $this->inputType == 'calculation' ) && ! rgempty( $this->id . '.1', $value ) ) {
			$field_label = rgar( $value, $this->id . '.1' );
		}

		return $field_label;
	}

	public function get_admin_buttons(){
		$duplicate_disabled   = array( 'captcha', 'post_title', 'post_content', 'post_excerpt', 'total', 'shipping', 'creditcard' );
		$duplicate_field_link = ! in_array( $this->type, $duplicate_disabled ) ? "<a class='field_duplicate_icon' id='gfield_duplicate_{$this->id}' title='" . __( 'click to duplicate this field', 'gravityforms' ) . "' href='#' onclick='StartDuplicateField(this); return false;'><i class='fa fa-files-o fa-lg'></i></a>" : '';
		$duplicate_field_link = apply_filters( 'gform_duplicate_field_link', $duplicate_field_link );

		$delete_field_link = "<a class='field_delete_icon' id='gfield_delete_{$this->id}' title='" . __( 'click to delete this field', 'gravityforms' ) . "' href='#' onclick='StartDeleteField(this); return false;'><i class='fa fa-times fa-lg'></i></a>";
		$delete_field_link = apply_filters( 'gform_delete_field_link', $delete_field_link );
		$field_type_title  = GFCommon::get_field_type_title( $this->type );
		$admin_buttons     = IS_ADMIN ? "<div class='gfield_admin_icons'><div class='gfield_admin_header_title'>{$field_type_title} : " . __( 'Field ID', 'gravityforms' ) . " {$this->id}</div>" . $delete_field_link . $duplicate_field_link . "<a class='field_edit_icon edit_icon_collapsed' title='" . __( 'click to expand and edit the options for this field', 'gravityforms' ) . "'><i class='fa fa-caret-down fa-lg'></i></a></div>" : '';
		return $admin_buttons;
	}

	public function get_field_input( $form, $value = '', $entry = null ) {
		return '';
	}

	public function validate( $value, $form ) {

	}

	public function get_entry_inputs() {
		return $this->inputs;
	}

	public function get_input_value_submission( $standard_name, $custom_name = '', $field_values = array(), $get_from_post_global_var = true ) {

		$form_id = $this->formId;
		if ( ! empty( $_POST[ 'is_submit_' . $form_id ] ) && $get_from_post_global_var ) {
			$value = rgpost( $standard_name );
			$value = GFFormsModel::maybe_trim_input( $value, $form_id, $this );

			return $value;
		} else if ( $this->allowsPrepopulate ) {
			return GFFormsModel::get_parameter_value( $custom_name, $field_values, $this );
		}

	}

	public function get_value_submission( $field_values, $get_from_post_global_var = true ) {

		$inputs = $this->get_entry_inputs();

		if ( is_array( $inputs ) ) {
			$value = array();
			foreach ( $inputs as $input ) {
				$value[ strval( $input['id'] ) ] = $this->get_input_value_submission( 'input_' . str_replace( '.', '_', strval( $input['id'] ) ), RGForms::get( 'name', $input ), $field_values, $get_from_post_global_var );;
			}
		} else {
			$value = $this->get_input_value_submission( 'input_' . $this->id, $this->inputName, $field_values, $get_from_post_global_var );
		}

		return $value;
	}

	public function get_value_save_entry( $value, $form, $input_name, $lead_id, $lead ) {
		// only filter HTML on non-array based values
		if ( ! is_array( $value ) ) {
			$form_id    = $form['id'];
			$input_type = GFFormsModel::get_input_type( $this );
			//allow HTML for certain field types
			$allow_html     = in_array( $this->type, array( 'post_custom_field', 'post_title', 'post_content', 'post_excerpt', 'post_tags' ) ) || in_array( $input_type, array( 'checkbox', 'radio' ) ) ? true : false;
			$allowable_tags = apply_filters( 'gform_allowable_tags_{$form_id}', apply_filters( 'gform_allowable_tags', $allow_html, $this, $form_id ), $this, $form_id );

			if ( $allowable_tags !== true ) {
				$value = strip_tags( $value, $allowable_tags );
			}
		}

		return $value;
	}

	public function has_calculation() {

		if ( $this->type == 'number' ) {
			return $this->enableCalculation && $this->calculationFormula;
		}

		return GFFormsModel::get_input_type( $this ) == 'calculation';
	}

	public function get_conditional_logic_event( $event ) {
		if ( empty( $this->conditionalLogicFields ) || $this->is_entry_detail() || $this->is_form_editor() ) {
			return '';
		}

		switch ( $event ) {
			case 'keyup' :
				return "onchange='gf_apply_rules(" . $this->formId . ',' . GFCommon::json_encode( $this->conditionalLogicFields ) . ");' onkeyup='clearTimeout(__gf_timeout_handle); __gf_timeout_handle = setTimeout(\"gf_apply_rules(" . $this->formId . ',' . GFCommon::json_encode( $this->conditionalLogicFields ) . ")\", 300);'";
				break;

			case 'click' :
				return "onclick='gf_apply_rules(" . $this->formId . ',' . GFCommon::json_encode( $this->conditionalLogicFields ) . ");'";
				break;

			case 'change' :
				return "onchange='gf_apply_rules(" . $this->formId . ',' . GFCommon::json_encode( $this->conditionalLogicFields ) . ");'";
				break;
		}
	}

	public function register_form_init_scripts( $form ) {
		GFFormDisplay::add_init_script( $form['id'], $this->type . '_' . $this->id, GFFormDisplay::ON_PAGE_RENDER, $this->get_form_inline_script_on_page_render( $form ) );
	}

	public function get_form_inline_script_on_page_render( $form ) {
		return '';
	}

	public function get_field_placeholder_attribute() {

		$placeholder_value = GFCommon::replace_variables_prepopulate( $this->placeholder );

		return ! empty( $placeholder_value ) ? sprintf( "placeholder='%s'", esc_attr( $placeholder_value ) ) : '';
	}

	public function get_input_placeholder_attribute( $input ) {

		$placeholder_value = GFCommon::get_input_placeholder_value( $input );

		return ! empty( $placeholder_value ) ? sprintf( "placeholder='%s'", esc_attr( $placeholder_value ) ) : '';
	}

	public function get_input_placeholder_value( $input ) {

		$placeholder = rgar( $input, 'placeholder' );

		return empty( $placeholder ) ? '' : GFCommon::replace_variables_prepopulate( $placeholder );
	}

	public function add_button( $field_groups ) {

		// Check a button for the type hasn't already been added
		foreach ( $field_groups as $group ) {
			foreach ( $group['fields'] as $button ) {
				if ( isset( $button['data-type'] ) && $button['data-type'] == $this->type ) {
					return $field_groups;
				}
			}
		}


		$new_button = $this->get_form_editor_button();
		if ( ! empty( $new_button ) ) {
			foreach ( $field_groups as &$group ) {
				if ( $group['name'] == $new_button['group'] ) {
					$group['fields'][] = array(
						'class'     => 'button',
						'value'     => $new_button['text'],
						'data-type' => $this->type,
						'onclick'   => "StartAddField('{$this->type}');",
					);
					break;
				}
			}
		}

		return $field_groups;
	}

	/**
	 * Returns the button for the form editor. The array contains two elements:
	 * 'group' => 'standard_fields' // or  'advanced_fields', 'post_fields', 'pricing_fields'
	 * 'text'  => 'Button text'
	 *
	 * Built-in fields don't need to implement this because the buttons are added in sequence in GFFormDetail
	 *
	 * @return array
	 */
	public function get_form_editor_button() {
		return array(
			'group' => 'standard_fields',
			'text'  => $this->get_form_editor_field_title()
		);
	}

	public function get_form_editor_field_title() {
		return $this->type;
	}

	public function get_form_editor_field_settings() {
		return array();
	}

	public function get_form_editor_inline_script_on_page_render() {
		return '';
	}

	public function get_tabindex() {
		return GFCommon::$tab_index > 0 ? "tabindex='" . GFCommon::$tab_index ++ . "'" : '';
	}

	public function is_form_editor() {
		return ( IS_ADMIN && rgget( 'page' ) == 'gf_edit_forms' && ! rgget( 'view' ) ) || ( defined( 'DOING_AJAX' ) && DOING_AJAX && in_array( rgpost( 'action' ), array( 'rg_add_field', 'rg_refresh_field_preview', 'rg_duplicate_field', 'rg_delete_field', 'rg_change_input_type' ) ) );
	}

	public function is_entry_detail() {
		return IS_ADMIN && rgget( 'page' ) == 'gf_entries' && rgget( 'view' ) == 'entry';
	}

	public function is_entry_detail_edit() {
		return rgget( 'page' ) == 'gf_entries' && rgget( 'view' ) == 'entry' && isset( $_POST['screen_mode'] ) && $_POST['screen_mode'] == 'edit';
	}

}

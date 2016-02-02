<?php 

/**
 * Plugin Name: JDM Custom CTA
 * Plugin URI: http://labs.jdmdigital.co/code/jdm-custom-cta/
 * Description: There are many cases when theme developers may want the ability to add a call-to-action (or CTA) button to their theme that's easily editable from the WordPress backend. This reusable plugin does just that, and nothing more.
 * Version: 0.5
 * Author: JDM Digital
 * Author URI: http://jdmdigital.co
 * License: GPLv2 or later
 * GitHub Plugin URI: https://github.com/jdmdigital/jdm-custom-cta
 * GitHub Branch: master
 */

// Adds a box to the main column on the Post edit screen.
function jdm_add_meta_box() {

	$screens = array( 'page' );

	foreach ( $screens as $screen ) {

		add_meta_box(
			'jdm_sectionid',
			'Call to Action (CTA)',
			'jdm_meta_box_callback',
			$screen
		);
	}
}
add_action( 'add_meta_boxes', 'jdm_add_meta_box' );

// Prints the box content.
function jdm_meta_box_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'jdm_meta_box', 'jdm_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$ctaurl = get_post_meta( $post->ID, 'ctaurl', true ); // the URL
	$ctatxt = get_post_meta( $post->ID, 'ctatxt', true ); // the text

	echo '<p style="margin-bottom:1em;">Setup custom call to action (CTA) buttons here. Just paste the URL (starting http:// or https://) and enter the text the button should say. If you want to remove the button, just remove the URL and the button will disappear when you click "Update."</p>';
	echo '<table class="form-table"><tbody>';
	echo '<tr>';
	echo '<th scope="row"><label for="ctaurl">Button Link:</label></th>';
	echo '<td><input type="url" id="ctaurl" class="large-text" name="ctaurl" value="' . esc_attr( $ctaurl ) . '" placeholder="http://" /></td>';
	echo '</tr><tr>';
	echo '<th scope="row"><label for="ctatxt">Button Text:</label></th>';
	echo '<td><input type="text" id="ctatxt" class="normal-text" name="ctatxt" value="' . esc_attr( $ctatxt ) . '" placeholder="Click Here" style="" /></td>';
	echo '</tr></tbody></table>';
	echo '<p><b>Note:</b> Leave these fields blank to remove the button from this page.</p>';
}

/**
 * When the post is saved, saves our custom data.
 * @param int $post_id The ID of the post being saved.
 */
function jdm_save_meta_box_data( $post_id ) {

	// Check if our nonce is set.
	if ( ! isset( $_POST['jdm_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['jdm_meta_box_nonce'], 'jdm_meta_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	/* OK, it's safe for us to save the data now. */

	// Sanitize user input.
	$ctaurl = sanitize_text_field( $_POST['ctaurl'] );
	$ctatxt = sanitize_text_field( $_POST['ctatxt'] );

	// Add or Update the meta field in the database.
	if ( ! update_post_meta ($post_id, 'ctaurl', $ctaurl) ) { 
		add_post_meta($post_id, 'ctaurl', $ctaurl, true );	
	};
	
	if ( ! update_post_meta ($post_id, 'ctatxt', $ctatxt) ) { 
		add_post_meta($post_id, 'ctatxt', $ctatxt, true );	
	};
}
add_action( 'save_post', 'jdm_save_meta_box_data' );

/*
CTA Plugin Functions
Reference: http://labs.jdmdigital.co/code/jdm-custom-cta/
*/

// Checks if the ctaurl post meta field is set/and not empty
if(!function_exists('have_cta')) {
	function have_cta(){
		global $page, $post; 
		$ctaurl = get_post_meta( $post->ID, 'ctaurl', true ); // the URL
		
		if(isset($ctaurl) && !empty($ctaurl) ) {
			return true;
		} else {
			return false;
		}
	} // end have_cta()
}

if(!function_exists('has_cta')) {
	function has_cta(){
		global $page, $post; 
		$ctaurl = get_post_meta( $post->ID, 'ctaurl', true ); // the URL
		
		if(isset($ctaurl) && !empty($ctaurl) ) {
			return true;
		} else {
			return false;
		}
	} // end has_cta()
}

// Returns the HTML CTA link with the parameter class(es)
if(!function_exists('get_cta')) {
	function get_cta($class = NULL){
		global $page, $post; 
		
		if( is_null($class) ) {
			$class = 'btn-cta';
		} else {
			$class .= ' btn-cta'; 
		}
		
		$ctaurl = get_post_meta( $post->ID, 'ctaurl', true ); // the URL
		$ctatxt = get_post_meta( $post->ID, 'ctatxt', true ); // the text
		
		if(!isset($ctatxt) || empty($ctatxt) ) {
			$ctatxt = 'Click Here'; // default
		}
		
		if(isset($ctaurl) && !empty($ctaurl) ) {
			return '<a href="'.$ctaurl.'" class="'.$class.'">'.$ctatxt.'</a>';
		} 
	} // end get_cta()
}


// Echos get_cta(), basically
if(!function_exists('the_cta') && function_exists('get_cta')) {
	function the_cta($class = NULL){
		
		global $page, $post; 
		//$post = get_post( $id );
		
		if( is_null($class) ) {
			$class = 'btn-cta';
		} else {
			$class .= ' btn-cta'; 
		}
		
		$ctaurl = get_post_meta( $post->ID, 'ctaurl', true ); // the URL
		$ctatxt = get_post_meta( $post->ID, 'ctatxt', true ); // the text
		
		if(!isset($ctatxt) || empty($ctatxt) ) {
			$ctatxt = 'Click Here'; // default
		}
		
		if(isset($ctaurl) && !empty($ctaurl) ) {
			echo '<a href="'.$ctaurl.'" class="'.$class.'">'.$ctatxt.'</a>';
		} 
	} // end the_cta()
}

?>

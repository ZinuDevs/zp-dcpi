<?php

// Check if form is submitted
if ( isset( $_POST['submit'] ) ) {

  // Sanitize user input (important!)
  $event_id = sanitize_text_field( $_POST['event_id'] );
  $first_name = sanitize_text_field( $_POST['txt-firstname'] );
  $last_name = sanitize_text_field( $_POST['txt-lastname'] );
  $email = sanitize_email( $_POST['txt-email'] );
  $phone = sanitize_text_field( $_POST['txt-tel'] );
  $city = sanitize_text_field( $_POST['txt-city'] );
  $country = sanitize_text_field( $_POST['txt-country'] );
  $region = sanitize_text_field( $_POST['txt-region'] );

  // Create a new CPT entry
  $new_registration = array(
    'post_title'    => $first_name . ' ' . $last_name . ' Registration for ' . get_the_title( $event_id ),
    'post_type'     => 'event-registration', // Change to your actual event registration CPT
    'post_status'   => 'publish',
  );

  // Insert the registration entry
  $registration_id = wp_insert_post( $new_registration );

  // Update the registration entry meta data
  if ( $registration_id ) {
    update_post_meta( $registration_id, 'event_id', $event_id );
    update_post_meta( $registration_id, 'first_name', $first_name );
    update_post_meta( $registration_id, 'last_name', $last_name );
    update_post_meta( $registration_id, 'email', $email );
    update_post_meta( $registration_id, 'phone', $phone );
    update_post_meta( $registration_id, 'city', $city );
    update_post_meta( $registration_id, 'country', $country );
    update_post_meta( $registration_id, 'region', $region );
  }

  // Redirect the user after form submission
  if ( $registration_id ) {
    // Redirect to a success page or back to the registration form
    wp_redirect( home_url( '/registration-success' ) ); // Change to your success page URL
    exit;
  } else {
    // Redirect back to the registration form with an error message
    wp_redirect( add_query_arg( 'error', 'true', $_SERVER['HTTP_REFERER'] ) );
    exit;
  }

} else {
  // If form is not submitted, redirect back to the registration form
  wp_redirect( home_url( '/registration-form' ) ); // Change to your registration form URL
  exit;
}

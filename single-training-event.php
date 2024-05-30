<?php
/*
Template Name: Single Training Event Template
*/
?>

<?php get_header(); ?>

<div class="container">
 <?php
 while (have_posts()) :
   the_post();
   ?>
   <h1><?php the_title(); ?></h1>

   <?php $event_venue = get_field('event_venue'); ?>
   <?php if ($event_venue) : ?>
     <div class="event-venue">
       <p><strong>Event Venue:</strong> <?php echo $event_venue; ?></p>
       <?php $host_info = get_field('host_info'); ?>
       <?php if ($host_info) : ?>
         <p><?php echo $host_info; ?></p>
       <?php endif; ?>
     </div>
   <?php endif; ?>

   <?php $start_date = get_field('start_date'); ?>
   <?php $end_date = get_field('end_date'); ?>
   <?php if ($start_date && $end_date) : ?>
     <div class="event-dates">
       <p><strong>Event Dates:</strong> <?php echo date('F j, Y', strtotime($start_date)); ?> - <?php echo date('F j, Y', strtotime($end_date)); ?></p>
     </div>
   <?php endif; ?>

   <?php
   $training_tracks = get_field('training_tracks');
   if ($training_tracks) :
     ?>
     <div class="training-tracks">
       <p><strong>Training Tracks:</strong></p>
       <ul>
         <?php foreach ($training_tracks as $track) : ?>
           <li><?php echo esc_html($track->post_title); ?></li>
         <?php endforeach; ?>
       </ul>
     </div>
   <?php endif; ?>

   <?php $contact_person = get_field('contact_person'); ?>
   <?php $contact_mobile_number = get_field('contact_mobile_number'); ?>
   <?php $contact_email = get_field('contact_email'); ?>
   <?php if ($contact_person || $contact_mobile_number || $contact_email) : ?>
     <div class="contact-info">
       <p><strong>Contact Person:</strong> <?php echo $contact_person; ?></p>
       <p><strong>Mobile Number:</strong> <?php echo $contact_mobile_number; ?></p>
       <p><strong>Email:</strong> <?php echo $contact_email; ?></p>
     </div>
   <?php endif; ?>

   <?php if (has_post_thumbnail()) : ?>
     <div class="featured-image">
       <?php the_post_thumbnail('large'); ?>
     </div>
   <?php endif; ?>

   <?php
   // Get the event ID
   $event_id = get_the_ID();
   
   // Pass the event ID to the registration form page
   $registration_form_url = add_query_arg( 'event_id', $event_id, get_permalink( get_page_by_path( 'event-registration-form' ) ) );
   
   // Add the registration form button with link
   echo '<div class="register-cta">';
   echo '<a href="' . esc_url( $registration_form_url ) . '" class="btn btn-primary">Register Now</a>';
   echo '</div>';
   ?>

 <?php endwhile; ?>
</div>

<?php get_footer(); ?>

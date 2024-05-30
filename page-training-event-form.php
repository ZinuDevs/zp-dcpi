<?php
/* Template Name: New Training Event */
get_header();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['new_event_nonce'])) {
    // Validate nonce
    if (wp_verify_nonce($_POST['new_event_nonce'], 'new_event')) {
        // Sanitize and process form data
        $event_title = sanitize_text_field($_POST['event_title']);
        $event_venue = sanitize_text_field($_POST['event_venue']);
        $host_info = sanitize_textarea_field($_POST['host_info']);
        $start_date = sanitize_text_field($_POST['start_date']);
        $end_date = sanitize_text_field($_POST['end_date']);
        $training_tracks = array_map('sanitize_text_field', $_POST['training_tracks']);
        $contact_person = sanitize_text_field($_POST['contact_person']);
        $contact_mobile_number = sanitize_text_field($_POST['contact_mobile_number']);
        $contact_email = sanitize_email($_POST['contact_email']);

        // Insert the post
        $new_event = array(
            'post_title'   => $event_title,
            'post_status'  => 'publish',
            'post_type'    => 'training-event'
        );

        $post_id = wp_insert_post($new_event);

        if ($post_id) {
            // Update custom fields
            update_post_meta($post_id, 'event_venue', $event_venue);
            update_post_meta($post_id, 'host_info', $host_info);
            update_post_meta($post_id, 'start_date', $start_date);
            update_post_meta($post_id, 'end_date', $end_date);
            update_post_meta($post_id, 'training_tracks', $training_tracks);
            update_post_meta($post_id, 'contact_person', $contact_person);
            update_post_meta($post_id, 'contact_mobile_number', $contact_mobile_number);
            update_post_meta($post_id, 'contact_email', $contact_email);

            echo '<p>Event submitted successfully!</p>';
        } else {
            echo '<p>There was an error submitting your event.</p>';
        }
    } else {
        echo '<p>Security check failed. Please try again.</p>';
    }
}
?>

<form action="" method="post">
    <?php wp_nonce_field('new_event', 'new_event_nonce'); ?>
    <p>
        <label for="event_title">Event Title:</label>
        <input type="text" name="event_title" id="event_title" required>
    </p>
    <p>
        <label for="event_venue">Event Venue:</label>
        <input type="text" name="event_venue" id="event_venue" required>
    </p>
    <p>
        <label for="host_info">Host Info:</label>
        <textarea name="host_info" id="host_info" required></textarea>
    </p>
    <p>
        <label for="start_date">Start Date:</label>
        <input type="date" name="start_date" id="start_date" required>
    </p>
    <p>
        <label for="end_date">End Date:</label>
        <input type="date" name="end_date" id="end_date" required>
    </p>
    <p>
        <label for="training_tracks">Training Tracks:</label>
        <select name="training_tracks[]" id="training_tracks" multiple required>
            <?php
            $tracks = get_posts(array('post_type' => 'training_track', 'posts_per_page' => -1));
            foreach ($tracks as $track) {
                echo '<option value="' . esc_attr($track->ID) . '">' . esc_html($track->post_title) . '</option>';
            }
            ?>
        </select>
    </p>
    <p>
        <label for="contact_person">Contact Person:</label>
        <input type="text" name="contact_person" id="contact_person" required>
    </p>
    <p>
        <label for="contact_mobile_number">Contact Mobile Number:</label>
        <input type="text" name="contact_mobile_number" id="contact_mobile_number" required>
    </p>
    <p>
        <label for="contact_email">Contact Email:</label>
        <input type="email" name="contact_email" id="contact_email" required>
    </p>
    <p>
        <input type="submit" value="Submit Event">
    </p>
</form>

<?php get_footer(); ?>

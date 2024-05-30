<?php
/*
Template Name: Event Registration Form
*/

get_header();

// Get the event ID from the query parameter
$event_id = isset($_GET['event_id']) ? intval($_GET['event_id']) : 0;
?>

<div class="container">
    <h1>Event Registration</h1>
    <?php
    if ($event_id) {
        // Fetch event details using WP_Query
        $event_query = new WP_Query(array(
            'p' => $event_id,
            'post_type' => 'training-event',
        ));

        if ($event_query->have_posts()) {
            while ($event_query->have_posts()) {
                $event_query->the_post();
                $event_title = get_the_title();
                $start_date = get_field('start_date');
                $end_date = get_field('end_date');
                $city = get_field('city');

                // Display the retrieved event details
                echo '<h2>Registering for: ' . esc_html($event_title) . '</h2>';
                echo '<p><strong>Event Dates:</strong> ' . date('F j, Y', strtotime($start_date)) . ' - ' . date('F j, Y', strtotime($end_date)) . '</p>';
                echo '<p><strong>City:</strong> ' . esc_html($city) . '</p>';
            }
        } else {
            echo '<p>No event found.</p>';
        }

        wp_reset_postdata();
    } else {
        echo '<p>No event selected.</p>';
    }
    ?>

    <form method="post" action="">
        <?php
        // Display the Ultimate Member registration form
        echo do_shortcode('[ultimatemember form_id="433"]');
        ?>
        <input type="hidden" name="event_id" value="<?php echo esc_attr($event_id); ?>">
    </form>
</div>

<?php get_footer(); ?>

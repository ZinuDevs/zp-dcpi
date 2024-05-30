<?php
/*
Template Name: Training Event Archive
*/
?>

<?php get_header(); ?>

<div class="container">
  <h1>Training Events</h1>

  <?php if (have_posts()) : ?>
    <ul class="training-event-list">
      <?php while (have_posts()) : the_post(); ?>
        <li class="training-event">
          <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          <?php $start_date = get_field('start_date'); ?>
          <?php $end_date = get_field('end_date'); ?>
          <?php if ($start_date && $end_date) : ?>
            <p><strong>Dates:</strong> <?php echo date('F j, Y', strtotime($start_date)); ?> - <?php echo date('F j, Y', strtotime($end_date)); ?></p>
          <?php endif; ?>
          <?php
          $training_tracks = get_field('training_tracks');
          if ($training_tracks) :
            ?>
            <p><strong>Training Tracks:</strong>
              <?php foreach ($training_tracks as $track) : ?>
                <?php echo esc_html($track->post_title); ?>,
              <?php endforeach; ?>
            </p>
          <?php endif; ?>
          <?php $event_venue = get_field('event_venue'); ?>
          <?php if ($event_venue) : ?>
            <p><strong>Location:</strong> <?php echo $event_venue; ?></p>
          <?php endif; ?>
        </li>
      <?php endwhile; ?>
    </ul>
    <?php the_posts_pagination(); ?>
  <?php else : ?>
    <p>No training events found.</p>
  <?php endif; ?>
</div>

<?php get_footer(); ?>

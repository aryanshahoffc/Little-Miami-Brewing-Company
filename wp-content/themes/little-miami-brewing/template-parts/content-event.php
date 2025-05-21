<?php
/**
 * Template part for displaying event items
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('event-card'); ?>>
    <div class="event-image">
        <?php
        if (has_post_thumbnail()) {
            the_post_thumbnail('medium');
        }
        ?>
    </div>
    <div class="event-content">
        <h3 class="event-title"><?php the_title(); ?></h3>
        <?php
        $event_date = get_post_meta(get_the_ID(), 'event_date', true);
        $event_time = get_post_meta(get_the_ID(), 'event_time', true);
        ?>
        <div class="event-meta">
            <?php if ($event_date) : ?>
                <span class="event-date">
                    <i class="fas fa-calendar"></i>
                    <?php echo date('F j, Y', strtotime($event_date)); ?>
                </span>
            <?php endif; ?>
            <?php if ($event_time) : ?>
                <span class="event-time">
                    <i class="fas fa-clock"></i>
                    <?php echo esc_html($event_time); ?>
                </span>
            <?php endif; ?>
        </div>
        <div class="event-description">
            <?php the_excerpt(); ?>
        </div>
        <a href="<?php the_permalink(); ?>" class="btn btn-secondary">Learn More</a>
    </div>
</article>

<?php
/**
 * Template part for displaying testimonials
 */
?>

<section class="testimonials animate-on-scroll">
    <div class="container">
        <h2>What Our Clients Say About Us</h2>
        <div class="testimonials-grid">
            <?php
            // Check if WP Reviews plugin is active
            if (function_exists('wp_reviews_display')) {
                echo wp_reviews_display(array(
                    'number' => 3,
                    'layout' => 'grid',
                    'rating_min' => 4
                ));
            } else {
                // Fallback if plugin is not active
                echo '<p>Please install and activate the WP Reviews plugin to display testimonials.</p>';
            }
            ?>
        </div>
    </div>
</section>

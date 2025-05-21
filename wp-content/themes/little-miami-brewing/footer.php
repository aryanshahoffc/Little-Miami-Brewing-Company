<?php
/**
 * The footer for our theme
 */
?>

<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-info">
                <?php
                if (has_custom_logo()) {
                    the_custom_logo();
                } else {
                    echo '<h3>' . get_bloginfo('name') . '</h3>';
                }
                ?>
                <p><?php echo get_bloginfo('description'); ?></p>
            </div>

            <div class="footer-nav">
                <h4>Quick Links</h4>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'menu_class'     => 'footer-menu',
                    'depth'          => 1,
                ));
                ?>
            </div>

            <div class="footer-contact">
                <h4>Contact Us</h4>
                <address>
                    <!-- Add contact details here -->
                </address>
            </div>

            <div class="footer-social">
                <h4>Follow Us</h4>
                <!-- Add social media links here -->
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> Little Miami Brewing Company. All rights reserved.</p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

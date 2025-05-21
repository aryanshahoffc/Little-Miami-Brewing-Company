<?php
/**
 * The header for our theme
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header id="masthead" class="site-header">
    <div class="container">
        <div class="site-branding">
            <?php
            if (has_custom_logo()) {
                the_custom_logo();
            } else {
                ?>
                <h1 class="site-title">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                        <?php bloginfo('name'); ?>
                    </a>
                </h1>
                <?php
            }
            ?>
        </div>        <nav id="site-navigation" class="main-navigation">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_id'        => 'primary-menu',
            ));
            ?>
            <div class="social-icons">
                <?php if (get_theme_mod('facebook_url')) : ?>
                    <a href="<?php echo esc_url(get_theme_mod('facebook_url')); ?>" class="social-icon" target="_blank" rel="noopener noreferrer">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                <?php endif; ?>
                <?php if (get_theme_mod('instagram_url')) : ?>
                    <a href="<?php echo esc_url(get_theme_mod('instagram_url')); ?>" class="social-icon" target="_blank" rel="noopener noreferrer">
                        <i class="fab fa-instagram"></i>
                    </a>
                <?php endif; ?>
                <?php if (get_theme_mod('twitter_url')) : ?>
                    <a href="<?php echo esc_url(get_theme_mod('twitter_url')); ?>" class="social-icon" target="_blank" rel="noopener noreferrer">
                        <i class="fab fa-twitter"></i>
                    </a>
                <?php endif; ?>
            </div>
        </nav>
    </div>
</header>

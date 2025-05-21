<?php
/**
 * Little Miami Brewing Company functions and definitions
 */

if (!defined('_S_VERSION')) {
    define('_S_VERSION', '1.0.0');
}

/**
 * Enqueue scripts and styles
 */
function little_miami_scripts() {
    wp_enqueue_style('little-miami-style', get_stylesheet_uri(), array(), _S_VERSION);
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap', array(), null);
    wp_enqueue_script('little-miami-scripts', get_template_directory_uri() . '/js/main.js', array(), _S_VERSION, true);
}
add_action('wp_enqueue_scripts', 'little_miami_scripts');

/**
 * Register navigation menus
 */
function little_miami_menus() {
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'little-miami-brewing'),
        'footer' => __('Footer Menu', 'little-miami-brewing'),
    ));
}
add_action('init', 'little_miami_menus');

/**
 * Add theme support
 */
function little_miami_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    
    // Add theme support for custom logo
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    
    // Register Customizer settings
    add_action('customize_register', 'little_miami_customize_register');
}

function little_miami_customize_register($wp_customize) {
    // Hero Section
    $wp_customize->add_section('hero_section', array(
        'title' => __('Hero Section', 'little-miami-brewing'),
        'priority' => 30,
    ));

    // Hero Slide 1
    $wp_customize->add_setting('hero_slide_1');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_slide_1', array(
        'label' => __('Hero Slide 1', 'little-miami-brewing'),
        'section' => 'hero_section',
    )));

    // Feature Cards
    $wp_customize->add_section('feature_cards', array(
        'title' => __('Feature Cards', 'little-miami-brewing'),
        'priority' => 35,
    ));

    // Taproom Image
    $wp_customize->add_setting('taproom_image');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'taproom_image', array(
        'label' => __('Taproom Card Image', 'little-miami-brewing'),
        'section' => 'feature_cards',
    )));

    // Events Image
    $wp_customize->add_setting('events_image');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'events_image', array(
        'label' => __('Events Card Image', 'little-miami-brewing'),
        'section' => 'feature_cards',
    )));

    // Videos Section
    $wp_customize->add_section('videos_section', array(
        'title' => __('Videos', 'little-miami-brewing'),
        'priority' => 40,
    ));

    // Taproom Video URL
    $wp_customize->add_setting('taproom_video_url');
    $wp_customize->add_control('taproom_video_url', array(
        'label' => __('Taproom Video URL (YouTube)', 'little-miami-brewing'),
        'section' => 'videos_section',
        'type' => 'url',
    ));

    // Industrial Elegance Video URL
    $wp_customize->add_setting('elegance_video_url');
    $wp_customize->add_control('elegance_video_url', array(
        'label' => __('Industrial Elegance Video URL (YouTube)', 'little-miami-brewing'),
        'section' => 'videos_section',
        'type' => 'url',
    ));
}

    // Register Beer Custom Post Type
    register_post_type('beer', array(
        'labels' => array(
            'name' => __('Beers', 'little-miami-brewing'),
            'singular_name' => __('Beer', 'little-miami-brewing'),
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-beer',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest' => true,
    ));

    // Register Event Custom Post Type
    register_post_type('event', array(
        'labels' => array(
            'name' => __('Events', 'little-miami-brewing'),
            'singular_name' => __('Event', 'little-miami-brewing'),
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-calendar-alt',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest' => true,
    ));

    // Add custom meta boxes for beers and events
    add_action('add_meta_boxes', function() {
        add_meta_box(
            'beer_details',
            __('Beer Details', 'little-miami-brewing'),
            'beer_details_callback',
            'beer',
            'normal',
            'high'
        );

        add_meta_box(
            'event_details',
            __('Event Details', 'little-miami-brewing'),
            'event_details_callback',
            'event',
            'normal',
            'high'
        );
    });
}
add_action('after_setup_theme', 'little_miami_setup');

// Callback functions for meta boxes
function beer_details_callback($post) {
    wp_nonce_field('beer_details_nonce', 'beer_details_nonce');
    $beer_style = get_post_meta($post->ID, 'beer_style', true);
    $beer_abv = get_post_meta($post->ID, 'beer_abv', true);
    $beer_ibu = get_post_meta($post->ID, 'beer_ibu', true);
    ?>
    <p>
        <label for="beer_style"><?php _e('Beer Style:', 'little-miami-brewing'); ?></label>
        <input type="text" id="beer_style" name="beer_style" value="<?php echo esc_attr($beer_style); ?>">
    </p>
    <p>
        <label for="beer_abv"><?php _e('ABV (%):', 'little-miami-brewing'); ?></label>
        <input type="text" id="beer_abv" name="beer_abv" value="<?php echo esc_attr($beer_abv); ?>">
    </p>
    <p>
        <label for="beer_ibu"><?php _e('IBU:', 'little-miami-brewing'); ?></label>
        <input type="text" id="beer_ibu" name="beer_ibu" value="<?php echo esc_attr($beer_ibu); ?>">
    </p>
    <?php
}

function event_details_callback($post) {
    wp_nonce_field('event_details_nonce', 'event_details_nonce');
    $event_date = get_post_meta($post->ID, 'event_date', true);
    $event_time = get_post_meta($post->ID, 'event_time', true);
    ?>
    <p>
        <label for="event_date"><?php _e('Event Date:', 'little-miami-brewing'); ?></label>
        <input type="date" id="event_date" name="event_date" value="<?php echo esc_attr($event_date); ?>">
    </p>
    <p>
        <label for="event_time"><?php _e('Event Time:', 'little-miami-brewing'); ?></label>
        <input type="time" id="event_time" name="event_time" value="<?php echo esc_attr($event_time); ?>">
    </p>
    <?php
}

/**
 * Register widget area
 */
function little_miami_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Footer Widget Area', 'little-miami-brewing'),
        'id'            => 'footer-1',
        'description'   => esc_html__('Add widgets here.', 'little-miami-brewing'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}

// Load sample content setup file
if (is_admin()) {
    require_once get_template_directory() . '/inc/setup-sample-content.php';
}

// Add more customizer options
function little_miami_customize_register($wp_customize) {
    // Business Information Section
    $wp_customize->add_section('business_info', array(
        'title' => __('Business Information', 'little-miami-brewing'),
        'priority' => 45,
    ));

    // Address
    $wp_customize->add_setting('brewery_address', array(
        'default' => '',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('brewery_address', array(
        'label' => __('Address', 'little-miami-brewing'),
        'section' => 'business_info',
        'type' => 'textarea',
    ));

    // Hours
    $wp_customize->add_setting('brewery_hours', array(
        'default' => '',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('brewery_hours', array(
        'label' => __('Business Hours', 'little-miami-brewing'),
        'section' => 'business_info',
        'type' => 'textarea',
    ));

    // Contact Form ID
    $wp_customize->add_setting('contact_form_id', array(
        'default' => '',
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control('contact_form_id', array(
        'label' => __('Contact Form 7 ID', 'little-miami-brewing'),
        'section' => 'business_info',
        'type' => 'number',
    ));

    // Social Media Links
    $wp_customize->add_section('social_media', array(
        'title' => __('Social Media', 'little-miami-brewing'),
        'priority' => 50,
    ));

    $social_platforms = array('facebook', 'instagram', 'twitter');

    foreach ($social_platforms as $platform) {
        $wp_customize->add_setting($platform . '_url', array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control($platform . '_url', array(
            'label' => ucfirst($platform) . ' URL',
            'section' => 'social_media',
            'type' => 'url',
        ));
    }
}

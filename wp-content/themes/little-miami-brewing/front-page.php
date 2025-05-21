<?php get_header(); ?>

<main id="primary" class="site-main">
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-slider">
            <?php
            // Get hero slides from customizer or ACF
            $slides = [
                [
                    'image' => get_theme_mod('hero_slide_1', ''),
                    'title' => 'CINCINNATI BREWERY',
                    'subtitle' => 'PIZZA & EVENT CENTER'
                ],
                // Add more slides here
            ];

            foreach ($slides as $slide) :
            ?>
            <div class="hero-slide" style="background-image: url('<?php echo esc_url($slide['image']); ?>')">
                <div class="container">
                    <div class="hero-content">
                        <h1 class="hero-title"><?php echo esc_html($slide['title']); ?></h1>
                        <p class="hero-subtitle"><?php echo esc_html($slide['subtitle']); ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="hero-slider-dots"></div>
    </section>

    <!-- Feature Cards -->
    <section class="features">
        <div class="container">
            <div class="card-grid">
                <a href="#taproom" class="feature-card">
                    <img src="<?php echo get_theme_mod('taproom_image', ''); ?>" alt="Visit Our Taproom">
                    <div class="feature-card-content">
                        <h2 class="feature-card-title">Visit Our Taproom</h2>
                    </div>
                </a>
                <a href="#events" class="feature-card">
                    <img src="<?php echo get_theme_mod('events_image', ''); ?>" alt="Upcoming Events">
                    <div class="feature-card-content">
                        <h2 class="feature-card-title">Upcoming Events</h2>
                    </div>
                </a>
            </div>        </div>
    </section>

    <!-- Video Section -->
    <section class="video-section">
        <div class="container">
            <div class="video-grid">
                <div class="video-item">
                    <div class="video-wrapper">
                        <?php
                        $taproom_video_url = get_theme_mod('taproom_video_url', '');
                        if ($taproom_video_url) :
                            // Extract video ID if it's a YouTube URL
                            preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $taproom_video_url, $matches);
                            $video_id = $matches[1] ?? '';
                            if ($video_id) :
                        ?>
                            <iframe 
                                width="100%" 
                                height="315" 
                                src="https://www.youtube.com/embed/<?php echo esc_attr($video_id); ?>" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen>
                            </iframe>
                        <?php 
                            endif;
                        endif; 
                        ?>
                    </div>
                    <h3>Taproom & Pizza Kitchen</h3>
                </div>
                <div class="video-item">
                    <div class="video-wrapper">
                        <?php
                        $elegance_video_url = get_theme_mod('elegance_video_url', '');
                        if ($elegance_video_url) :
                            preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $elegance_video_url, $matches);
                            $video_id = $matches[1] ?? '';
                            if ($video_id) :
                        ?>
                            <iframe 
                                width="100%" 
                                height="315" 
                                src="https://www.youtube.com/embed/<?php echo esc_attr($video_id); ?>" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen>
                            </iframe>
                        <?php 
                            endif;
                        endif; 
                        ?>
                    </div>
                    <h3>Industrial Elegance</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about animate-on-scroll">
        <div class="container">
            <h2>Our Story</h2>
            <div class="about-content">
                <?php
                $about_page = get_page_by_path('about');
                if ($about_page) {
                    $content = apply_filters('the_content', $about_page->post_content);
                    echo wp_trim_words($content, 100, '... <a href="' . get_permalink($about_page) . '">Read More</a>');
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Our Beers Section -->
    <section id="our-beers" class="our-beers animate-on-scroll">
        <div class="container">
            <h2>Our Craft Beers</h2>
            <div class="beers-grid">
                <?php
                $args = array(
                    'post_type' => 'beer',
                    'posts_per_page' => 6,
                    'orderby' => 'menu_order',
                    'order' => 'ASC'
                );
                $beers_query = new WP_Query($args);
                if ($beers_query->have_posts()) :
                    while ($beers_query->have_posts()) : $beers_query->the_post();
                        get_template_part('template-parts/content', 'beer');
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <?php get_template_part('template-parts/content', 'testimonials'); ?>

    <!-- Events Section -->
    <section id="events" class="events animate-on-scroll">
        <div class="container">
            <h2>Upcoming Events</h2>
            <div class="events-grid">
                <?php
                $args = array(
                    'post_type' => 'event',
                    'posts_per_page' => 3,
                    'meta_key' => 'event_date',
                    'orderby' => 'meta_value',
                    'order' => 'ASC',
                    'meta_query' => array(
                        array(
                            'key' => 'event_date',
                            'value' => date('Y-m-d'),
                            'compare' => '>=',
                            'type' => 'DATE'
                        )
                    )
                );
                $events_query = new WP_Query($args);
                if ($events_query->have_posts()) :
                    while ($events_query->have_posts()) : $events_query->the_post();
                        get_template_part('template-parts/content', 'event');
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="visit" class="contact animate-on-scroll">
        <div class="container">
            <h2>Visit Us</h2>
            <div class="contact-grid">
                <div class="contact-info">
                    <h3>Location & Hours</h3>
                    <?php echo get_theme_mod('brewery_address', ''); ?>
                    <?php echo get_theme_mod('brewery_hours', ''); ?>
                </div>
                <div class="contact-form">
                    <?php echo do_shortcode('[contact-form-7 id="' . get_theme_mod('contact_form_id', '') . '"]'); ?>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>

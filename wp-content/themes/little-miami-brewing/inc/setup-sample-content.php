<?php
/**
 * Sample Content Setup for Little Miami Brewing Company
 * 
 * This file creates sample beers and events
 */

// Create sample beers
$sample_beers = array(
    array(
        'post_title' => 'Hoppy Trail IPA',
        'post_content' => 'A hop-forward IPA featuring notes of citrus and pine, with a smooth malt backbone. Perfect for craft beer enthusiasts.',
        'post_status' => 'publish',
        'post_type' => 'beer',
        'meta_input' => array(
            'beer_style' => 'India Pale Ale',
            'beer_abv' => '6.8',
            'beer_ibu' => '65'
        )
    ),
    array(
        'post_title' => 'River Valley Lager',
        'post_content' => 'A crisp, clean lager that pays homage to our location along the Little Miami River. Light-bodied with a subtle hop presence.',
        'post_status' => 'publish',
        'post_type' => 'beer',
        'meta_input' => array(
            'beer_style' => 'German-style Lager',
            'beer_abv' => '5.2',
            'beer_ibu' => '25'
        )
    ),
    array(
        'post_title' => 'Sunset Red Ale',
        'post_content' => 'A balanced red ale with caramel malts and a touch of roasted barley. Medium-bodied with a smooth finish.',
        'post_status' => 'publish',
        'post_type' => 'beer',
        'meta_input' => array(
            'beer_style' => 'American Red Ale',
            'beer_abv' => '5.8',
            'beer_ibu' => '35'
        )
    )
);

foreach ($sample_beers as $beer) {
    wp_insert_post($beer);
}

// Create sample events
$sample_events = array(
    array(
        'post_title' => 'Live Music Friday',
        'post_content' => 'Join us for live acoustic music every Friday night. This week featuring local artist John Smith playing your favorite covers and originals.',
        'post_status' => 'publish',
        'post_type' => 'event',
        'meta_input' => array(
            'event_date' => '2025-05-24',
            'event_time' => '19:00'
        )
    ),
    array(
        'post_title' => 'Beer & Pizza Pairing',
        'post_content' => 'Experience the perfect combination of our craft beers paired with specially crafted pizzas from our kitchen.',
        'post_status' => 'publish',
        'post_type' => 'event',
        'meta_input' => array(
            'event_date' => '2025-05-28',
            'event_time' => '18:30'
        )
    ),
    array(
        'post_title' => 'Brewery Tour & Tasting',
        'post_content' => 'Get a behind-the-scenes look at our brewing process and enjoy a guided tasting of our latest releases.',
        'post_status' => 'publish',
        'post_type' => 'event',
        'meta_input' => array(
            'event_date' => '2025-06-01',
            'event_time' => '14:00'
        )
    )
);

foreach ($sample_events as $event) {
    wp_insert_post($event);
}

// Create Contact Form 7 form
$contact_form = array(
    'post_title' => 'Contact Us',
    'post_status' => 'publish',
    'post_type' => 'wpcf7_contact_form',
    'post_content' => '[text* your-name placeholder "Your Name"]
[email* your-email placeholder "Your Email"]
[tel your-phone placeholder "Phone Number"]
[select* inquiry "General Inquiry" "Event Booking" "Private Party" "Feedback"]
[textarea* your-message placeholder "Your Message"]
[submit "Send Message"]'
);

$form_id = wp_insert_post($contact_form);

// Save form settings
if ($form_id) {
    update_post_meta($form_id, '_form', $contact_form['post_content']);
    update_post_meta($form_id, '_mail', array(
        'subject' => '[Little Miami Brewing] New Contact Form Submission',
        'sender' => '[your-name] <[your-email]>',
        'body' => "From: [your-name]\nEmail: [your-email]\nPhone: [your-phone]\nInquiry Type: [inquiry]\n\nMessage:\n[your-message]",
        'recipient' => get_option('admin_email'),
        'additional_headers' => 'Reply-To: [your-email]'
    ));
}

// Add theme customizer default values
$customizer_defaults = array(
    'hero_title' => 'CINCINNATI BREWERY',
    'hero_subtitle' => 'PIZZA & EVENT CENTER',
    'brewery_address' => "123 River Valley Road\nCincinnati, OH 45202",
    'brewery_hours' => "Monday-Thursday: 11am-10pm\nFriday-Saturday: 11am-12am\nSunday: 11am-9pm",
    'contact_form_id' => $form_id,
    // Social Media Links
    'facebook_url' => 'https://facebook.com/littlemiamibrewing',
    'instagram_url' => 'https://instagram.com/littlemiamibrewing',
    'twitter_url' => 'https://twitter.com/littlemiamibrewing',
    // Video URLs
    'taproom_video_url' => 'https://www.youtube.com/watch?v=example1',
    'elegance_video_url' => 'https://www.youtube.com/watch?v=example2',
    // Sample review data
    'reviews_enabled' => true,
    'reviews_per_page' => 3
);

foreach ($customizer_defaults as $key => $value) {
    set_theme_mod($key, $value);
}

echo "Sample content has been created successfully!\n";
echo "Please activate Contact Form 7 and WP Reviews plugins through the WordPress admin panel.\n";
echo "Don't forget to customize the theme through the WordPress Customizer.\n";

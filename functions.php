<?php
function my_custom_theme_setup() {
    // Add support for the title tag
    add_theme_support('title-tag');

    // Register navigation menus
    register_nav_menus(array(
        'header-menu' => __('Header Menu', 'my-custom-theme'),
        'footer-menu' => __('Footer Menu', 'my-custom-theme'), // Register Footer Menu
    ));
}
add_action('after_setup_theme', 'my_custom_theme_setup');

// Enqueue styles and scripts
function my_custom_theme_scripts() {
    wp_enqueue_style('main-style', get_stylesheet_uri());
    wp_enqueue_style('custom-style', get_template_directory_uri() . '/assets/css/main.css');
    wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/js/main.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'my_custom_theme_scripts');

// Static categories function
function get_static_categories() {
    return [
        [
            'name' => 'Decor',
            'slug' => 'decor',
            'image' => get_template_directory_uri() . '/assets/images/decor.jpg'
        ],
        [
            'name' => 'Lifestyle',
            'slug' => 'lifestyle',
            'image' => get_template_directory_uri() . '/assets/images/lifestyle.jpg'
        ],
        [
            'name' => 'Food',
            'slug' => 'food',
            'image' => get_template_directory_uri() . '/assets/images/food.jpg'
        ],
        [
            'name' => 'Travel',
            'slug' => 'travel',
            'image' => get_template_directory_uri() . '/assets/images/travel.jpg'
        ],
        [
            'name' => 'Interior',
            'slug' => 'interior',
            'image' => get_template_directory_uri() . '/assets/images/interior.jpg'
        ],
        [
            'name' => 'Design',
            'slug' => 'design',
            'image' => get_template_directory_uri() . '/assets/images/design.jpg'
        ]
    ];
}

function my_custom_theme_customizer($wp_customize) {
    // Add a section for blog categories
    $wp_customize->add_section('blog_categories', array(
        'title'    => __('Blog Categories', 'my-custom-theme'),
        'priority' => 30,
    ));

    // Add settings for each category (limit to 6 categories for simplicity)
    for ($i = 1; $i <= 6; $i++) {
        // Category Name
        $wp_customize->add_setting("category_{$i}_name", array(
            'default'           => "Category {$i}",
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("category_{$i}_name", array(
            'label'   => __("Category {$i} Name", 'my-custom-theme'),
            'section' => 'blog_categories',
            'type'    => 'text',
        ));

        // Category Image
        $wp_customize->add_setting("category_{$i}_image", array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "category_{$i}_image", array(
            'label'    => __("Category {$i} Image", 'my-custom-theme'),
            'section'  => 'blog_categories',
            'settings' => "category_{$i}_image",
        )));

        // Category Slug
        $wp_customize->add_setting("category_{$i}_slug", array(
            'default'           => 'category-' . $i,
            'sanitize_callback' => 'sanitize_title',
        ));
        $wp_customize->add_control("category_{$i}_slug", array(
            'label'   => __("Category {$i} Slug", 'my-custom-theme'),
            'section' => 'blog_categories',
            'type'    => 'text',
        ));
    }
}
add_action('customize_register', 'my_custom_theme_customizer');


// Create subscribers table
function create_subscribers_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'subscribers';

    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            email varchar(100) NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";
        
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}
add_action('after_setup_theme', 'create_subscribers_table');

function get_configured_categories() {
    $categories = [];
    for ($i = 1; $i <= 6; $i++) {
        $name = get_theme_mod("category_{$i}_name", '');
        $image = get_theme_mod("category_{$i}_image", '');
        $slug = get_theme_mod("category_{$i}_slug", '');

        if ($name && $image && $slug) {
            $categories[] = [
                'name'  => $name,
                'image' => $image,
                'slug'  => $slug,
            ];
        }
    }
    return $categories;
}


// Handle form submission
// Handle subscription form submission
function handle_subscription_form() {
    if (isset($_POST['subscriber_email']) && is_email($_POST['subscriber_email'])) {
        $email = sanitize_email($_POST['subscriber_email']);

        // Send subscription confirmation email
        $subject = "Subscription Confirmation";
        $message = "Thank you for subscribing to our blog! You will receive updates about our latest posts.";
        $headers = ['Content-Type: text/html; charset=UTF-8'];

        wp_mail($email, $subject, $message, $headers);

        // Redirect to home page or show a success message
        wp_redirect(home_url('/?subscription=success'));
        exit;
    }
}
add_action('admin_post_nopriv_subscribe_user', 'handle_subscription_form');
add_action('admin_post_subscribe_user', 'handle_subscription_form');

// Add customizable options for the subscribe section
function customize_subscribe_section($wp_customize) {
    $wp_customize->add_section('subscribe_settings', [
        'title' => __('Subscribe Section Settings', 'my-custom-theme'),
        'priority' => 30,
    ]);

    // Heading text
    $wp_customize->add_setting('subscribe_heading', [
        'default' => 'Join',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('subscribe_heading', [
        'label' => __('Subscribe Heading', 'my-custom-theme'),
        'section' => 'subscribe_settings',
        'type' => 'text',
    ]);

    // Email placeholder
    $wp_customize->add_setting('subscribe_email_placeholder', [
        'default' => 'Email',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('subscribe_email_placeholder', [
        'label' => __('Email Placeholder', 'my-custom-theme'),
        'section' => 'subscribe_settings',
        'type' => 'text',
    ]);

    // Button text
    $wp_customize->add_setting('subscribe_button_text', [
        'default' => 'Subscribe',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('subscribe_button_text', [
        'label' => __('Subscribe Button Text', 'my-custom-theme'),
        'section' => 'subscribe_settings',
        'type' => 'text',
    ]);

    // Social media links
    $social_links = ['facebook', 'twitter', 'instagram', 'pinterest'];
    foreach ($social_links as $link) {
        $wp_customize->add_setting("{$link}_url", [
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ]);
        $wp_customize->add_control("{$link}_url", [
            'label' => ucfirst($link) . ' URL',
            'section' => 'subscribe_settings',
            'type' => 'url',
        ]);
    }
}
add_action('customize_register', 'customize_subscribe_section');


// Notify subscribers of new posts
function notify_subscribers_on_new_post($post_ID) {
    if (get_post_status($post_ID) != 'publish') {
        return;
    }

    global $wpdb;
    $table_name = $wpdb->prefix . 'subscribers';
    $subscribers = $wpdb->get_results("SELECT email FROM $table_name");

    if ($subscribers) {
        $post_title = get_the_title($post_ID);
        $post_url = get_permalink($post_ID);
        $subject = "New Blog Post: $post_title";
        $message = "Read our new blog post: $post_title \n$post_url";

        foreach ($subscribers as $subscriber) {
            wp_mail($subscriber->email, $subject, $message);
        }
    }

    return $post_ID;
}
add_action('publish_post', 'notify_subscribers_on_new_post');
function my_theme_customize_register($wp_customize) {
    // Add Section for Blog Categories
    $wp_customize->add_section('blog_categories_section', array(
        'title'    => __('Blog Categories', 'my-custom-theme'),
        'priority' => 30,
    ));

    // Add Setting for Blog Categories
    $wp_customize->add_setting('custom_blog_categories', array(
        'default'           => json_encode([]),
        'sanitize_callback' => 'sanitize_blog_categories',
    ));

    // Add Control for Blog Categories
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'custom_blog_categories',
        array(
            'label'       => __('Configure Categories', 'my-custom-theme'),
            'description' => __('Add categories with their images. Use the category ID, name, and image URL.', 'my-custom-theme'),
            'section'     => 'blog_categories_section',
            'settings'    => 'custom_blog_categories',
            'type'        => 'textarea',
        )
    ));
}
add_action('customize_register', 'my_theme_customize_register');

// Sanitize Categories Input
function sanitize_blog_categories($input) {
    $categories = json_decode($input, true);
    if (!is_array($categories)) {
        return json_encode([]);
    }

    $sanitized_categories = [];
    foreach ($categories as $category) {
        $sanitized_categories[] = array(
            'id'    => intval($category['id']),
            'name'  => sanitize_text_field($category['name']),
            'image' => esc_url_raw($category['image']),
        );
    }
    return json_encode($sanitized_categories);
}

// Load Categories Option
function get_custom_blog_categories() {
    $categories_json = get_theme_mod('custom_blog_categories', '[]');
    return json_decode($categories_json, true);
}

function custom_upload_dir($dirs) {
    $dirs['path'] = ABSPATH . 'wp-content/uploads';
    $dirs['url'] = site_url() . '/wp-content/uploads';
    $dirs['subdir'] = ''; // No subdirectory for simplicity
    return $dirs;
}
add_filter('upload_dir', 'custom_upload_dir');

function enqueue_font_awesome() {
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'enqueue_font_awesome');

function my_custom_theme_customize_register($wp_customize) {
    // Add Feature Section Settings
    $wp_customize->add_section('feature_section', array(
        'title' => __('Feature Section', 'my-custom-theme'),
        'priority' => 30,
    ));
    
    $wp_customize->add_setting('feature_text', array(
        'default' => 'Why Choose Our Theme?',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('feature_text', array(
        'label' => __('Feature Section Heading', 'my-custom-theme'),
        'section' => 'feature_section',
        'type' => 'text',
    ));
}
add_action('customize_register', 'my_custom_theme_customize_register');

?>

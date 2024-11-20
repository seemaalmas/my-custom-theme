<main class="landing-page">
    <div class="welcome-section">
        <div class="text-content">
            <h1>Welcome to the Future of Blogging</h1>
            <p>Create visually stunning blogs and websites with ease.</p>
            <button class="recent-posts-btn">Explore Features</button>
        </div>
        <div class="image-content">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/landing-image.jpg" alt="Amanda">
        </div>
    </section>

    <div class="join-section">
        <div class="join-container">
            <h2><?php echo esc_html(get_theme_mod('subscribe_heading', 'Join')); ?></h2>
            <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                <input type="hidden" name="action" value="subscribe_user">
                <input type="email" name="subscriber_email" placeholder="<?php echo esc_attr(get_theme_mod('subscribe_email_placeholder', 'Email')); ?>" required>
                <button type="submit" class="subscribe-btn"><?php echo esc_html(get_theme_mod('subscribe_button_text', 'Subscribe')); ?></button>
            </form>
            <div class="social-icons">
                <?php if (get_theme_mod('facebook_url')): ?>
                    <a href="<?php echo esc_url(get_theme_mod('facebook_url')); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <?php endif; ?>
                <?php if (get_theme_mod('twitter_url')): ?>
                    <a href="<?php echo esc_url(get_theme_mod('twitter_url')); ?>" target="_blank"><i class="fab fa-twitter"></i></a>
                <?php endif; ?>
                <?php if (get_theme_mod('instagram_url')): ?>
                    <a href="<?php echo esc_url(get_theme_mod('instagram_url')); ?>" target="_blank"><i class="fab fa-instagram"></i></a>
                <?php endif; ?>
                <?php if (get_theme_mod('pinterest_url')): ?>
                    <a href="<?php echo esc_url(get_theme_mod('pinterest_url')); ?>" target="_blank"><i class="fab fa-pinterest"></i></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<section class="features-section">
    <h2><?php echo get_theme_mod('feature_text', 'Why Choose Our Theme?'); ?></h2>
    <div class="features-container">
        <div class="feature-item">
            <i class="dashicons dashicons-smartphone"></i>
            <h3>Responsive Design</h3>
            <p>Your website will look great on all devices—mobile, tablet, and desktop.</p>
        </div>
        <div class="feature-item">
            <i class="dashicons dashicons-admin-customizer"></i>
            <h3>Customizable Layouts</h3>
            <p>Personalize your website with easy-to-use customization tools.</p>
        </div>
        <div class="feature-item">
            <i class="dashicons dashicons-performance"></i>
            <h3>Optimized for Performance</h3>
            <p>Lightweight and fast-loading to ensure optimal user experience.</p>
        </div>
        <div class="feature-item">
            <i class="dashicons dashicons-chart-line"></i>
            <h3>SEO Friendly</h3>
            <p>Boost your site's visibility with built-in SEO optimizations.</p>
        </div>
    </div>
</section>
<section class="preview-section">
    <h2><?php echo get_theme_mod('preview_text', 'See It in Action'); ?></h2>
    <div class="preview-container">
        <!-- Preview Blog -->
        <div class="preview-item" onclick="openWidget('<?php echo site_url('/?page=blogs/'); ?>')">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/preview-blogs.png" alt="Preview Blog">
            <p>Preview Blog</p>
        </div>
        
        <!-- Preview Slider -->
        <div class="preview-item" onclick="openWidget('<?php echo site_url('/?page=blogs/'); ?>')">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/preview-slider.png" alt="Preview Slider">
            <p>Preview Slider</p>
        </div>
        
        <!-- Preview Categories -->
        <div class="preview-item" onclick="openWidget('<?php echo site_url('/?page=blogs/'); ?>')">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/preview-categories.png" alt="Preview Categories">
            <p>Preview Categories</p>
        </div>
    </div>

    <!-- Full Page Widget -->
    <div id="fullPageWidget" class="full-page-widget">
        <div class="widget-content">
            <span class="close-widget" onclick="closeWidget()">×</span>
            <iframe id="widgetIframe" src="" frameborder="0"></iframe>
        </div>
    </div>
</section>



<section class="testimonials-section">
    <h2><?php echo get_theme_mod('testimonials_text', 'What Our Users Say'); ?></h2>
    <blockquote>
        <p>"This theme has completely transformed my website. Highly recommended!"</p>
        <footer>- Jane Doe</footer>
    </blockquote>
    <blockquote>
        <p>"Beautifully designed and easy to use. Perfect for bloggers!"</p>
        <footer>- John Smith</footer>
    </blockquote>
</section>


</main>

<footer class="site-footer">
    <div class="footer-content">
        <h2><?php echo esc_html(get_theme_mod('footer_heading', 'Bharat Hive\'s Spot')); ?></h2>

        <!-- Navigation Menu in Footer -->
        <nav class="footer-nav">
            <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer-menu',
                    'container' => false,
                    'menu_class' => 'footer-menu',
                ));
            ?>
        </nav>

        <!-- Subscription Form -->
        <div class="subscription-form">
            <form id="subscription-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST">
                <input type="email" name="subscriber_email" placeholder="<?php echo esc_attr(get_theme_mod('footer_email_placeholder', 'Email')); ?>" required>
                <button type="submit" class="subscribe-btn"><?php echo esc_html(get_theme_mod('footer_subscribe_button', 'Subscribe')); ?></button>
                <input type="hidden" name="action" value="subscribe_user">
            </form>
        </div>

        <!-- Social Media Links -->
        <div class="social-icons">
            <?php if (get_theme_mod('facebook_url')): ?>
                <a href="<?php echo esc_url(get_theme_mod('facebook_url')); ?>" target="_blank">
                    <span class="dashicons dashicons-facebook-alt"></span>
                </a>
            <?php endif; ?>
            <?php if (get_theme_mod('twitter_url')): ?>
                <a href="<?php echo esc_url(get_theme_mod('twitter_url')); ?>" target="_blank">
                    <span class="dashicons dashicons-twitter"></span>
                </a>
            <?php endif; ?>
            <?php if (get_theme_mod('pinterest_url')): ?>
                <a href="<?php echo esc_url(get_theme_mod('pinterest_url')); ?>" target="_blank">
                    <span class="dashicons dashicons-pinterest"></span>
                </a>
            <?php endif; ?>
            <?php if (get_theme_mod('instagram_url')): ?>
                <a href="<?php echo esc_url(get_theme_mod('instagram_url')); ?>" target="_blank">
                    <span class="dashicons dashicons-instagram"></span>
                </a>
            <?php endif; ?>
        </div>

        <!-- Copyright Text -->
        <p>&copy; <?php echo date('Y'); ?> <?php echo esc_html(get_theme_mod('footer_copyright_text', 'Company Name')); ?></p>
    </div>
    <div class="footer-bottom">
        <p><?php echo esc_html(get_theme_mod('footer_bottom_text', 'Designed by Bharat Hive')); ?></p>
        <div class="bottom-icons">
            <?php if (get_theme_mod('footer_facebook_url')): ?>
                <a href="<?php echo esc_url(get_theme_mod('footer_facebook_url')); ?>" target="_blank">
                    <span class="dashicons dashicons-facebook"></span>
                </a>
            <?php endif; ?>
            <?php if (get_theme_mod('footer_twitter_url')): ?>
                <a href="<?php echo esc_url(get_theme_mod('footer_twitter_url')); ?>" target="_blank">
                    <span class="dashicons dashicons-twitter"></span>
                </a>
            <?php endif; ?>
            <?php if (get_theme_mod('footer_rss_url')): ?>
                <a href="<?php echo esc_url(get_theme_mod('footer_rss_url')); ?>" target="_blank">
                    <span class="dashicons dashicons-rss"></span>
                </a>
            <?php endif; ?>
        </div>
    </div>
    <?php wp_footer(); ?>
</footer>

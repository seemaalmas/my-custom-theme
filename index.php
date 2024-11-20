<?php get_template_part('template-parts/header'); ?>

<main class="site-main">
    <div id="dynamic-content">
        <?php
        // Check if the 'category' parameter is set in the URL
        if (!empty($_GET['category'])) {
            $category_slug = sanitize_text_field($_GET['category']);
            $category = get_category_by_slug($category_slug);

            // Check if the category exists
            if ($category) {
                ?>
                <section class="category-posts">
                    <h2><?php echo esc_html($category->name); ?> Posts</h2>
                    <div class="posts-list">
                        <?php
                        // Query posts from the specified category
                        $query = new WP_Query([
                            'category_name' => $category_slug,
                            'posts_per_page' => -1 // Fetch all posts
                        ]);

                        if ($query->have_posts()):
                            while ($query->have_posts()): $query->the_post();
                                ?>
                                <div class="post-item">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php if (has_post_thumbnail()): ?>
                                            <div class="post-thumbnail">
                                                <?php the_post_thumbnail('medium'); ?>
                                            </div>
                                        <?php endif; ?>
                                        <h3><?php the_title(); ?></h3>
                                        <p><?php the_excerpt(); ?></p>
                                    </a>
                                </div>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                        else:
                            echo '<p>No posts found in this category.</p>';
                        endif;
                        ?>
                    </div>
                </section>
                <?php
            } else {
                echo '<p>Category not found. Please try again.</p>';
            }
        }
        // Check if the 'page' parameter is set in the URL and is not empty
        elseif (!empty($_GET['page'])) {
            $page = sanitize_text_field($_GET['page']);

            // Ensure the page name is valid and corresponds to an existing template
            $file_path = locate_template("template-parts/sections/{$page}.php");

            if ($file_path && file_exists($file_path)) {
                include $file_path;
            } else {
                echo '<p>Content could not be loaded. Please try again.</p>';
            }
        } else {
            // Load the default landing content if 'page' is not set or empty
            $landing_file = locate_template('template-parts/sections/landing.php');
            if ($landing_file && file_exists($landing_file)) {
                include $landing_file;
            } else {
                echo '<p>Landing content could not be loaded. Please try again.</p>';
            }
        }
        ?>
    </div>
</main>

<?php get_template_part('template-parts/footer'); ?>

<?php
get_header();

// Check if the 'category' query parameter is set
if (isset($_GET['category'])) {
    $category_slug = sanitize_text_field($_GET['category']);
    $category = get_category_by_slug($category_slug);

    // Check if the category exists
    if ($category):
?>
        <main class="site-main">
            <section class="category-posts">
                <h2><?php echo esc_html($category->name); ?> Posts</h2>
                <div class="posts-list">
                    <?php
                    // Fetch posts from the selected category
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
                    ?>
                        <p>No posts found in this category.</p>
                    <?php endif; ?>
                </div>
            </section>
        </main>
<?php
    else:
        echo '<p>Invalid category.</p>';
    endif;
} else {
    echo '<p>No category specified.</p>';
}

get_footer();

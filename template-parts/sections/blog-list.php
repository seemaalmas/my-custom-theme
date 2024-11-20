<?php
// Fetch the latest blog posts
$args = array(
    'posts_per_page' => 6, // Number of posts to display
    'post_status'    => 'publish',
);
$latest_posts = new WP_Query($args);
?>

<section class="blog-section">
    <div class="blog-container">
        <?php
        // Query for the latest blog posts
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 3, // Change this number to display more posts
        );
        $blog_query = new WP_Query($args);

        // Loop through the posts
        if ($blog_query->have_posts()) :
            while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                <div class="blog-item">
                    <div class="blog-image">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('full'); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="blog-content">
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <p class="blog-date"><?php echo get_the_date(); ?></p>
                        <p class="blog-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                        <a class="read-more" href="<?php the_permalink(); ?>">read more</a>
                    </div>
                </div>
            <?php endwhile;
        else : ?>
            <p>No blog posts found.</p>
        <?php endif; ?>

        <?php wp_reset_postdata(); ?>
    </div>
</section>


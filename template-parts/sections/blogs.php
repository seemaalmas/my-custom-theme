<main class="site-main">
    <section class="blog-categories">
        <h2>Blog</h2>
        <div>
            <input type="text" class="search-box" placeholder="Search">
        </div>
        <div class="category-list">
            <?php 
            $categories = get_configured_categories();
            if (!empty($categories)) :
                foreach ($categories as $category):
                    $category_link = site_url('/blog-category.php?category=' . $category['slug']);
                    $image_url = $category['image'];
            ?>
                    <div class="category-item">
                        <a href="<?php echo esc_url($category_link); ?>">
                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($category['name']); ?>">
                            <h3><?php echo esc_html($category['name']); ?></h3>
                        </a>
                    </div>
            <?php 
                endforeach;
            else:
                echo '<p>No categories configured.</p>';
            endif;
            ?>
        </div>
    </section>
    <?php get_template_part('template-parts/sections/blog-slider'); ?>
    <?php get_template_part('template-parts/sections/blog-list'); ?>
</main>

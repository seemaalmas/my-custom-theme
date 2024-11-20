<?php
/* Template Name: Custom Page */
get_header();
?>

<main class="main-content">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <h1><?php the_title(); ?></h1>
        <div class="page-content">
            <?php the_content(); ?>
        </div>
        <?php get_template_part('template-parts/sections/section'); ?>
    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>

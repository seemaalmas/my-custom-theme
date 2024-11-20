<section class="blog-slider">
    <div class="slider-container">
        <?php
        // Fetch latest comments from WordPress
        $comments_query = new WP_Comment_Query([
            'number' => 5, // Limit to the latest 5 comments
            'status' => 'approve', // Only approved comments
        ]);

        $comments = $comments_query->comments;

        if (!empty($comments)) {
            foreach ($comments as $index => $comment):
                $post_id = $comment->comment_post_ID;
                $post = get_post($post_id); // Fetch the post associated with the comment
                $background_image = has_post_thumbnail($post_id) ? get_the_post_thumbnail_url($post_id, 'large') : 'https://via.placeholder.com/1200x800';
        ?>
                <div class="slide" style="background-image: url('<?php echo esc_url($background_image); ?>');" data-index="<?php echo $index; ?>">
                    <div class="slide-overlay">
                        <div class="slide-content">
                            <h2><?php echo esc_html(get_the_title($post_id)); ?></h2>
                            <p class="post-meta">
                                by <?php echo esc_html($comment->comment_author); ?> | 
                                <?php echo esc_html(get_the_date('F j, Y', $post_id)); ?> | 
                                <?php echo esc_html(get_the_category_list(', ', '', $post_id)); ?>
                            </p>
                            <p><?php echo esc_html(wp_trim_words($comment->comment_content, 20)); ?></p>
                            <a href="<?php echo esc_url(get_permalink($post_id)); ?>" class="read-more">Read More</a>
                        </div>
                    </div>
                </div>
        <?php
            endforeach;
        } else {
            echo '<p>No recent comments available.</p>';
        }
        ?>
    </div>

    <!-- Navigation Arrows -->
    <div class="slider-nav prev" onclick="prevSlide()">&#10094;</div>
    <div class="slider-nav next" onclick="nextSlide()">&#10095;</div>

    <!-- Pagination Indicators -->
    <div class="slider-pagination">
        <?php if (!empty($comments)): ?>
            <?php foreach ($comments as $index => $comment): ?>
                <span class="dot" onclick="currentSlide(<?php echo $index; ?>)"></span>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function() {
    let currentSlideIndex = 0;
    const slides = document.querySelectorAll(".slide");
    const dots = document.querySelectorAll(".dot");

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.style.display = (i === index) ? "block" : "none";
        });
        dots.forEach(dot => dot.classList.remove("active"));
        if (dots[index]) {
            dots[index].classList.add("active");
        }
    }

    function nextSlide() {
        currentSlideIndex = (currentSlideIndex + 1) % slides.length;
        showSlide(currentSlideIndex);
    }

    function prevSlide() {
        currentSlideIndex = (currentSlideIndex - 1 + slides.length) % slides.length;
        showSlide(currentSlideIndex);
    }

    function currentSlide(index) {
        currentSlideIndex = index;
        showSlide(currentSlideIndex);
    }

    // Auto-play every 5 seconds
    setInterval(nextSlide, 5000);

    // Initial display
    showSlide(currentSlideIndex);

    // Attach functions to the global scope for arrow and dot navigation
    window.nextSlide = nextSlide;
    window.prevSlide = prevSlide;
    window.currentSlide = currentSlide;
});
</script>

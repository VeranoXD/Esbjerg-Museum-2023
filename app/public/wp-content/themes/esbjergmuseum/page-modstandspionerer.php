<?php
// Page 3: Custom query for slider items
$slider_args_page3 = array(
    'post_type' => 'slider_item',
    'posts_per_page' => 1, // Retrieve two posts
    'offset' => 1, // Skip the first post to get the second post
    // Add other query parameters specific to Page 3
);

$slider_items_page3 = new WP_Query($slider_args_page3);

// Output the header for Page 3
get_header();
?>

<div class="container">
    <?php if ($slider_items_page3->have_posts()) : while ($slider_items_page3->have_posts()) : $slider_items_page3->the_post(); ?>
            <?php
            $title_page3 = get_field('slider_title');
            $description_page3 = get_field('slider_description');
            ?>
            <div class="">
                <h1 class="event-header"><?php echo esc_html($title_page3); ?></h1>
                <?php if ($description_page3) : ?>
                    <p class="slider-description"><?php echo esc_html($description_page3); ?></p>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    <?php else : ?>
        <p>No slider items found.</p>
    <?php endif; ?>

    <?php
    // Restore global post data for Page 3
    wp_reset_postdata();
    ?>

    <!-- Page 3 content goes here -->
</div>

<?php
get_footer();
?>
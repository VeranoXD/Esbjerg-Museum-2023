<?php
// Page 1: Custom query for slider items
$slider_args_page1 = array(
    'post_type' => 'slider_item',
    'posts_per_page' => 1,
    // Add other query parameters specific to Page 1
);

$slider_items_page1 = new WP_Query($slider_args_page1);

// Output the header for Page 1
get_header();
?>

<div class="container">
    <?php if ($slider_items_page1->have_posts()) : while ($slider_items_page1->have_posts()) : $slider_items_page1->the_post(); ?>
            <?php
            $title_page1 = get_field('slider_title');
            $description_page1 = get_field('slider_description');
            ?>
            <div class="">
                <h1 class="event-header"><?php echo esc_html($title_page1); ?></h1>
                <?php if ($description_page1) : ?>
                    <p class="slider-description"><?php echo esc_html($description_page1); ?></p>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    <?php else : ?>
        <p>No slider items found.</p>
    <?php endif; ?>

    <?php
    // Restore global post data for Page 1
    wp_reset_postdata();
    ?>

    <!-- Page 1 content goes here -->
</div>

<?php
get_footer();
?>

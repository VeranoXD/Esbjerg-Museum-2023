<?php
// Function to retrieve and display slider item
function display_slider_item($page_slug) {
    // Customize the query based on the page slug
    $page_offsets = array(
        'page1' => 0,
        'page2' => 1,
        'page3' => 3,
        'page4' => 5,
        // Add more pages and offsets as needed
    );

    $offset = isset($page_offsets[$page_slug]) ? $page_offsets[$page_slug] : 0;

    $slider_args = array(
        'post_type'      => 'slider_item',
        'posts_per_page' => 1,
        'offset'         => $offset,
        // Add other common query parameters here
    );

    $slider_items = new WP_Query($slider_args);

    if ($slider_items->have_posts()) {
        while ($slider_items->have_posts()) {
            $slider_items->the_post();
            $title = get_field('slider_title');
            $description = get_field('slider_description');
            ?>
            <div class="">
                <h1 class="event-header"><?php echo esc_html($title); ?></h1>
                <?php if ($description) : ?>
                    <p class="slider-description"><?php echo esc_html($description); ?></p>
                <?php endif; ?>
            </div>
            <?php
        }
    } else {
        echo '<p>No slider items found.</p>';
    }

    wp_reset_postdata();
}

// Output the header for Page 3
get_header();
?>

<div class="container">
    <?php
    // Display slider item based on the page slug
    $current_page_slug = 'page3'; // Change this to the actual page slug
    display_slider_item($current_page_slug);
    ?>

    <!-- Page content goes here -->
</div>

<?php
get_footer();
?>

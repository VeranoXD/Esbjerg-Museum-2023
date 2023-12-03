<?php
// Assuming you have a custom query to get slider items
$slider_args = array(
    // Your query parameters go here
    'post_type' => 'slider_item', // Change 'your_post_type' to the actual post type
    'posts_per_page' => -1, // Retrieve all posts
);

$slider_items = new WP_Query($slider_args);

// Debugging: Check if the custom query returns results
if (!$slider_items->have_posts()) {
    echo 'No slider items found.';
}

get_header();
?>
<div class="container">
    <div class="">
        <h1 class="event-header"><?php pll_e("Aktuelle") ?></h1>
    </div>
    <?php if ($slider_items->have_posts()) : ?>
        <div class="slider-wrapper">
            <?php while ($slider_items->have_posts()) : $slider_items->the_post(); ?>
                <?php
                $image_url = get_field('slider_image');
                $title = get_field('slider_title');
                $description = get_field('slider_description');
                $page_url = get_field('slider_page_url');
                ?>
                <div class="">
                    <div class=""></div>
                    <div class="eventbox px-4 py-5 mb-5 mx-auto"> <!-- Use Flexbox for vertical centering -->
                        <div class="row gx-4 gy-8 justify-content-lg-between">
                            <div class="col-lg-6 d-lg-flex">
                                <?php if ($image_url) : ?>
                                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($title); ?>" class="slider-image img-fluid">
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6 d-flex align-items-center">
                                <div class="texts"> <!-- Center text horizontally -->
                                    <h1 class="slider-title hei mb-2 mt-2 text-xxl fw-extrabold tracking-tight leading-none md:text-2xl xl:text-3xl"><?php echo esc_html($title); ?></h1>
                                    <?php if ($description) : ?>
                                        <div class="description-container">
                                            <p class="mb-5 text-muted slider-description full-description" style="display: none;">
                                                <?php echo esc_html($description); ?>
                                            </p>
                                            <p class="mb-5 text-muted slider-description truncated-description">
                                                <?php echo esc_html(wp_trim_words($description, 75)); ?>
                                            </p>
                                            <button class="show-all-btn" onclick="showAll(this)"><?php pll_e('Read More'); ?></button>
                                            <button class="show-less-btn" onclick="showLess(this)" style="display: none;"><?php pll_e('Read Less'); ?></button>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
<?php endif; ?>

<?php
// Restore global post data
wp_reset_postdata();

get_footer();
?>

<script>
    function showAll(button) {
        var descriptionContainer = button.parentNode;
        var truncatedDescription = descriptionContainer.querySelector('.truncated-description');
        var fullDescription = descriptionContainer.querySelector('.full-description');
        var showAllBtn = descriptionContainer.querySelector('.show-all-btn');
        var showLessBtn = descriptionContainer.querySelector('.show-less-btn');

        truncatedDescription.style.display = 'none';
        fullDescription.style.display = 'block';
        showAllBtn.style.display = 'none';
        showLessBtn.style.display = 'inline-block';
    }

    function showLess(button) {
        var descriptionContainer = button.parentNode;
        var truncatedDescription = descriptionContainer.querySelector('.truncated-description');
        var fullDescription = descriptionContainer.querySelector('.full-description');
        var showAllBtn = descriptionContainer.querySelector('.show-all-btn');
        var showLessBtn = descriptionContainer.querySelector('.show-less-btn');

        truncatedDescription.style.display = 'block';
        fullDescription.style.display = 'none';
        showAllBtn.style.display = 'inline-block';
        showLessBtn.style.display = 'none';
    }
</script>

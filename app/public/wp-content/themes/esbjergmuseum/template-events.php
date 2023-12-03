<?php
/*
 * Template Name: Events Template
 */

get_header();

$args = array(
    'post_type' => 'event',
);

$query = new WP_Query($args);

$post_counter = 0; // Initialize the post counter

if ($query->have_posts()) :
    while ($query->have_posts()) : $query->the_post();
        $event_header_text = pll__(get_field('event_header_text'));
        $event_description = pll__(get_field('event_description'));
        $event_date = pll__(get_field('event_date'));
        $event_image = get_field('event_image');

        // Check if the post is even or odd
        $even_post = ($post_counter % 2 == 0);

        ?>
        <div class="container">
            <div class="eventbox px-4 py-5 mb-5 mx-auto <?php echo $even_post ? 'even-post' : 'odd-post'; ?>">
                <div class="row gx-4 gy-8 justify-content-lg-between">
                    <div class="col-md-6 d-md-flex">
                        <img src="<?php echo esc_url($event_image['url']); ?>" alt="<?php echo esc_attr($event_header_text); ?>" class="img-fluid">
                    </div>
                    <div class="col-md-6 align-items-center">
                        <h1 class="hei mb-2 mt-2 text-xxl fw-extrabold tracking-tight leading-none md:text-2xl xl:text-3xl">
                            <?php echo esc_html($event_header_text); ?>
                        </h1>
                        <p class="dato mb-4 text-muted md:text-lg lg:text-xl dark:text-gray-400">
                            Dato: <?php echo esc_html($event_date); ?>
                        </p>
                        <div class="description-container">
                            <p class="mb-5 text-muted md:text-lg lg:text-xl dark:text-gray-400 full-description" style="display: none;">
                                <?php echo esc_html($event_description); ?>
                            </p>
                            <p class="mb-5 text-muted md:text-lg lg:text-xl dark:text-gray-400 truncated-description">
                                <?php echo esc_html(wp_trim_words($event_description, 75)); ?>
                            </p>
                            <button class="show-all-btn" onclick="showAll(this)"><?php pll_e('Læs mere'); ?></button>
                            <button class="show-less-btn" onclick="showLess(this)" style="display: none;"><?php pll_e('Læs mindre'); ?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        $post_counter++; // Increment the post counter
    endwhile;
    wp_reset_postdata();
else : ?>
    <p><?php esc_html_e('No posts found', 'textdomain'); ?></p>
<?php endif;

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

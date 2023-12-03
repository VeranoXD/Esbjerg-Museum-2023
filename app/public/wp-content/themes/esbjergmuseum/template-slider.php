<?php
$args = array(
    'post_type' => 'slider_item',
    'posts_per_page' => -1,
);

$slider_items = new WP_Query($args);

if ($slider_items->have_posts()) :
    ?>
    <div class="block-slider">
        <div class="slider-wrapper">
            <?php while ($slider_items->have_posts()) : $slider_items->the_post(); ?>
                <?php
                $image_url = get_field('slider_image');
                $title = pll__(get_field('slider_title')); // Translate the slider title
                $description = pll__(get_field('slider_description')); // Translate the slider description
                $page_url = get_field('slider_page_url'); // Replace 'slider_page_url' with the actual name of your custom field
                ?>

                <a href="<?php echo esc_url($page_url); ?>" class="slider-item">
                    <div class="slider-content">
                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($title); ?>" class="slider-image">
                        <div class="overlay-text">
                            <h2 class="slider-title"><?php echo esc_html($title); ?></h2>
                        </div>
                    </div>
                </a>
            <?php endwhile; ?>
        </div>
    </div>

    <style>
        .slider-content {
            position: relative;
        }

        .overlay-text {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px; /* Adjust the padding as needed */
            box-sizing: border-box;
            text-align: center;
        }

        .overlay-text h2{
            font-size: 1.2rem;
            font-weight: 700;
        }

        .slider-title,
        .slider-description {
            margin: 0;
        }
    </style>

    <script>
        jQuery(document).ready(function($) {
            $('.slider-wrapper').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                dots: true,
                responsive: [
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1,
                        }
                    }
                ]
            });
        });
    </script>

    <?php
    wp_reset_postdata();
endif;
?>

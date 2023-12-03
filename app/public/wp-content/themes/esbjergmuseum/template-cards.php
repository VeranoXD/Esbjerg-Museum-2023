<?php

$args = array(
    'post_type'      => 'custom-cards',
    'posts_per_page' => 3,
);

$cards_query = new WP_Query($args);

if ($cards_query->have_posts()):
    ?>
    <div class="card-container">
        <?php
        $card_styles = array(
            array('background' => '#e83838', 'text' => '#F3EBD6'),
            array('background' => '#4d4d4d', 'text' => '#F3EBD6'),
            array('background' => '#4d4d4d', 'text' => '#F3EBD6')
        );

        $index = 0;
        while ($cards_query->have_posts()):
            $cards_query->the_post();

            // Get ACF field values
            $title       = pll__(get_field('card-title'));
            $subtitle    = pll__(get_field('card-subtitle'));
            $description = pll__(get_field('card-text'));
            $price       = pll__(get_field('price'));
            $info        = pll__(get_field('info'));

            ?>
            <div class="card container"
                 style="max-width: 400px; /* Adjust the max-width as per your preference */
                        background-color: <?php echo esc_attr($card_styles[$index]['background']); ?>;
                        color: <?php echo esc_attr($card_styles[$index]['text']); ?>;
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Adjust the shadow as needed */">

                <div class="col">
                    <h3 style="font-size: 1rem; font-weight: 700">
                        <?php echo esc_html($subtitle); ?>
                    </h3>

                    <h2 style="color: <?php echo esc_attr($card_styles[$index]['text']); ?>;
                           font-size: 2rem; font-weight: 700">
                        <?php echo esc_html($title); ?>
                    </h2>

                    <p style="font-size: 1rem; color: <?php echo esc_attr($card_styles[$index]['text']); ?>">
                        <?php echo esc_html($description); ?>
                    </p>

                    <p style="font-size: 2rem; font-weight: 700; color: <?php echo esc_attr($card_styles[$index]['text']); ?>">
                        <?php echo esc_html($price); ?><span> DKK</span>
                    </p>

                    <p style="font-size: 1rem; font-weight: 500; color: <?php echo esc_attr($card_styles[$index]['text']); ?>">
                        <?php echo esc_html($info); ?>
                    </p>
                </div>
            </div>
            <?php

            $index = ($index + 1) % count($card_styles);
        endwhile;
        ?>
    </div>
    <?php
    wp_reset_postdata();
else:
    echo 'No cards found';
endif;
?>

<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package EsbjergMuseum
 */

get_header();
?>

<?php if (have_posts()): ?>
    <?php while (have_posts()):
        the_post(); ?>
        <div class="container">
            <div class="row">
                <div class="col leftinfo">
                    <h1 class="event-header">
                        <?php pll_e("Information") ?>
                    </h1>
                    <?php echo do_shortcode('[mbhi_hours location="Esbjerg Museum"]'); ?>
                    <h1 class="event-header">
                        <?php pll_e("Access") ?>
                    </h1>
                    <p class="AccessText">
                        <?php pll_e("AccessText") ?>
                    </p>
                </div>
                <div class="col">
                    <h1 class="event-header">
                        <?php pll_e("Map") ?>
                    </h1>

                    <?php
                    // Get the base URL for uploads
                    $upload_dir = wp_upload_dir();

                    // Construct the relative URL
                    $image_url = $upload_dir['baseurl'] . '/2023/11/snazzy-image-1.png';

                    // Get the attachment ID based on the relative URL
                    $image_attachment_id = attachment_url_to_postid($image_url);

                    // Display the image
                    echo wp_get_attachment_image($image_attachment_id, 'large');
                    ?>
                </div>
            </div>
            <div class="col">
            <h1 class="event-header">
                        <?php pll_e("valg") ?>
                    </h1>
                <?php get_template_part('template-cards'); ?>
            </div>
     
        </div>
    <?php endwhile; ?>
<?php endif; ?>

<?php
get_footer();
?>
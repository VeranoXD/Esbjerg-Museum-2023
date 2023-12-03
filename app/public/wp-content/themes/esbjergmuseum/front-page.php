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
            <div class="hero-section text-center" style="position: relative; overflow: hidden;">
                <video autoplay muted loop style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 100%; height: auto; filter: brightness(70%);">
                    <source src="http://esbjerg-museum.local/wp-content/uploads/2023/11/yt5s.io-Scener-fra-Esbjerg-Statsskole-1963-1965_1.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
             <!--    <div class="dark-overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);"></div> -->
                <div class="hero-content" style="position: relative; z-index: 1;">
                    <h1 class="fw-bold ge">
                        <?php the_field('header'); ?>
                    </h1>
                    <p class="pe">
                        <?php the_field('description'); ?>
                    </p>
                    <div class="lc-block mb-6">
                        <?php
                        $permalink = '';
                        if (pll_current_language() == 'da') {
                            $permalink = get_permalink(get_page_by_path("billetter"));
                        } elseif (pll_current_language() == 'en') {
                            $permalink = get_permalink(get_page_by_path("tickets"));
                        }
                        ?>
                        <a href="<?php echo $permalink ?>" class="" role="button">
                            <button class="btn px-4 me-md-2 btn-lg" style="background-color: #F3EBD6; color: #0c0c0c; font-size: 14px;" name="planlæg">
                                <?php pll_e("Planlaeg") ?>
                            </button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="maggi">
                <h1 class="aktuelle"><?php pll_e("Aktuelle") ?></h1>
            </div>
            <?php get_template_part('template-slider'); ?>

            <div class="news">
    <div class="newsletter">
        <div class="col w-75 flex justify-center items-center mx-auto">
            <?php echo do_shortcode('[contact-form-7 id="0cf73ae" title="Newsletter"]'); ?>
        </div>
    </div>
</div>
        </div>
    <?php endwhile; ?>
<?php endif; ?>

<?php
get_footer();
?>

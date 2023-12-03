
<?php
get_header();
?>

<?php if (have_posts()): ?>
    <?php while (have_posts()): the_post(); ?>
        <div class="container">
        <div class="row">
            <div class="col">
            <h1 class="event-header">
                        <?php pll_e("Kontakt") ?>
                    </h1>
            <?php echo do_shortcode('[contact-form-7 id="7a7eddc" title="Konktakt Os"]'); ?>
            </div>
            <div class="col">
            <h1 class="event-header">
                        <?php pll_e("Kontaktoplysninger") ?>
                    </h1>
                    <p><?php pll_e("Kontaktoplysningerinfo") ?></p>

                    <div class="row">
                        <div class="col">
                            <h3><?php pll_e("hverdag") ?></h3>
                            <p><?php pll_e("telehver") ?></p>
                            <p><?php pll_e("mailhver") ?></p>
                        </div>

                        <div class="col">
                        <h3><?php pll_e("weekend") ?></h3>
                        <p><?php pll_e("teleweek") ?></p>
                            <p><?php pll_e("mailweek") ?></p>
                        </div>

                        <div class="col">
                        <h1 class="event-header">
                        <?php pll_e("Information") ?>
                    </h1>
                    <?php echo do_shortcode('[mbhi_hours location="Esbjerg Museum"]'); ?>
                        </div>
                    </div>
            </div>
        </div>
      
        </div>
    <?php endwhile; ?>
<?php endif; ?>

<?php
get_footer();




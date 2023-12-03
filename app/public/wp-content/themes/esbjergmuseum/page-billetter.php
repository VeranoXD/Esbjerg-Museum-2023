<?php
get_header();
?>

<?php if (have_posts()): ?>
    <?php while (have_posts()): the_post(); ?>
        <div class="container">
            <?php $image = get_field("billet-hero"); ?>
            <div class="image-container" style="background-image: url('<?php echo esc_url($image['url']); ?>');">
                <h2 class="event-header">
                    <?php the_field('billet-sub'); ?>
                </h2>
                <h1 class="ge fw-bold">
                    <?php the_field('billet-title'); ?>
                </h1>
                <p class="pe">
                    <?php the_field('billet-desc'); ?>
                </p>
            </div>
		    <h1 class="valg">
                    <?php the_field('billetvalg'); ?>
                </h1>
                <?php get_template_part('template-cards'); ?>
        </div>
    <?php endwhile; ?>
<?php endif; ?>

<?php
get_footer();
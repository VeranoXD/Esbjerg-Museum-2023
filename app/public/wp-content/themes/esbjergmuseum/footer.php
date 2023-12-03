<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package EsbjergMuseum
 */

?>

<footer id="footer" class="site-footer">
    <div class="container">
        <div class="footer-widgets">
            <div class="widget-area">
                <?php dynamic_sidebar('footer-widget-area'); ?>
            </div>
        </div>

        <div class="footer-info">
            <p>&copy; <?php echo date('Y'); ?> Esbjerg Museum</p>
        </div>
    </div>
</footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package EsbjergMuseum
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="page" class="site">
        <a class="skip-link screen-reader-text" href="#primary">
            <?php esc_html_e('Skip to content', 'esbjergmuseum'); ?>
        </a>
        <header id="masthead" class="site-header">
            <div class="container bar pt-2 pb-2">
                <div class="row align-items-center">
                    <div class="col-6 col-md-1 site-header__logo text-left logo-smaller">
                        <?php
                        $logo = '';
                        if (pll_current_language() == 'da') {
                            $logo = get_theme_mod('custom_logo_da'); // Assuming you have a custom logo setting for Danish
                        } elseif (pll_current_language() == 'en') {
                            $logo = get_theme_mod('custom_logo_en'); // Assuming you have a custom logo setting for English
                        }
                        if (!empty($logo)) {
                            echo '<img src="' . esc_url($logo) . '" alt="' . esc_attr(get_bloginfo('name')) . '">';
                        } else {
                            the_custom_logo();
                        }
                        ?>
                    </div>
                    <div class="col-6 col-md-2">
                        <?php echo '<div class="openingHours">' . do_shortcode('[mbhi location="Esbjerg Museum"]') . '</div>'; ?>
                    </div>
                    <div class="col-md-6 text-center flex">
                        <nav id="site-navigation" class="main-navigation ">
                            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                                <?php esc_html_e('Primary Menu', 'esbjergmuseum'); ?>
                            </button>
                            <?php
                            wp_nav_menu(
                                array(
                                    'theme_location' => 'menu-1',
                                    'container_class' => 'menu-center',
                                    'menu_class' => 'nav justify-content-center',
                                )
                            );
                            ?>
                        </nav><!-- #site-navigation -->
                    </div>
                    <div class="col-md-2 language-switcher-flex">
                        <div class="language-switcher justify-end">
                            <?php echo do_shortcode('[POLYLANG]'); ?>
                        </div>
                    </div>

                    <div class="flex col-6 col-md-1 buyTickets text-center align-items-center">
                        <!-- Button -->
                        <?php
                        $permalink = '';
                        if (pll_current_language() == 'da') {
                            $permalink = get_permalink(get_page_by_path("billetter"));
                        } elseif (pll_current_language() == 'en') {
                            $permalink = get_permalink(get_page_by_path("tickets"));
                        }
                        ?>
                        <a href="<?php echo $permalink ?>" class="" role="button">
                            <button class="btn billetbtn btn-lg"
                                style="background-color: #e83838; color: #F3EBD6; font-size: 14px;" name="planlæg">
                                <?php pll_e("Billetter") ?>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </header><!-- #masthead -->

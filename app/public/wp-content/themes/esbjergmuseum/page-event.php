<?php
/*
 * Template Name: Event Page
 */

get_header();

// Your custom code for the event page can go here...
?>
<div class="container">
<h1 class="event-header"><?php pll_e('Alle events'); ?></h1>
</div>


<?php
// Include the events template
get_template_part('template-events');

get_footer();
?>
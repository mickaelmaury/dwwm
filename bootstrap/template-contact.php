<?php 
/* Template name: Contact */

get_header();

/* Start the Loop */
while ( have_posts() ) :
	the_post();

    $horaires_douverture = get_field('horaires_douverture');

    echo $horaires_douverture;
endwhile; // End of the loop.

get_footer();

<?php

get_header();

/* Start the Loop */
while ( have_posts() ) :
	the_post();

?>
    <!-- Post preview-->
    <div class="post-preview">
        <?php the_post_thumbnail('large'); ?>
        <?php 
            if(!is_single()):
        ?>
            <a href="<?php the_permalink(); ?>">
                <h2 class="post-title"><?php the_title(); ?></h2>
                <!--<h3 class="post-subtitle">Many say exploration is part of our destiny, but it’s actually our duty to future generations.</h3>-->
            </a>
        <?php 
            endif;
        ?>
        <p class="post-meta">
            <?php _e('Posted by', 'bootstrap-child'); ?>
            <a href="<?php get_the_author_link(); ?>"><?php the_author(); ?></a>
            <?php _e('on', 'bootstrap-child'); ?> <?php echo get_the_date(); ?>
        </p>
    </div>
    <!-- Divider-->
    <hr class="my-4" />
<?php
endwhile; // End of the loop.

get_footer();

?>                    
<!-- Pager-->
<!-- <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="#!">Older Posts →</a></div>-->
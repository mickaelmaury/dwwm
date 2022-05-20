<?php

/*
Template Name: Stats
*/

get_header();

?>
<div class="main page">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <div class="post">
                <?php the_content(); ?>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
    <div class="post-content">
        <p><?php _e('Posts number :', 'start-bootstrap'); ?> <strong><?php echo wp_count_posts()->publish; ?></strong></p>
        <p><?php _e('Pages number :', 'start-bootstrap'); ?> <strong><?php echo wp_count_posts('page')->publish; ?></strong></p>
        <p><?php _e('Published comments :', 'start-bootstrap'); ?> <strong><?php echo wp_count_comments()->approved; ?></strong></p>
    </div>
</div>

<?php
get_footer();

<?php

get_header();

?>
<div class="error-template">
    <h2><?php _e('404 Not Found', 'bootstrap-child'); ?></h2>
    <div class="error-details"><?php _e('Sorry, an error has occured, Requested page not found !', 'bootstrap-child'); ?></div>
    <div class="error-actions">
        <a href="<?php echo get_home_url(); ?>" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home"></span><?php _e('Take Me Home', 'bootstrap-child'); ?></a>
    </div>
    <p><?php _e('Do you want to do a search ?', 'bootstrap-child'); ?></p>
    <?php get_search_form(); ?>
</div>
<?php

get_footer();

?>
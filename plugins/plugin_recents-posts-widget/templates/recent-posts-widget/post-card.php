<?php 
/**
 * The template for our posts in our recent posts widgets
 */
?>
<div class="card mb-1 mt-1">
    <div class="card-body">
        <?php if(has_post_thumbnail()) : ?>
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('large'); ?>
            </a>
        <?php endif; ?>
        <h2 class="post-title card-title h4"><?php the_title(); ?></h2>
        <div class="recent-posts-widget-card-content"><?php the_excerpt(); ?></div>
        <?php echo '<a class="btn btn-primary" href="' . get_the_permalink() . '">' . __('Read more →', 'recents-posts-widget') . '</a>'; ?>
    </div>
</div>
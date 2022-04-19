<?php

get_header();

if(have_posts()):
    /* Start the Loop */
    while (have_posts()) :
        the_post();

    ?>
        <!-- Post preview-->
        <div class="post-preview">
            <!-- Blog post-->
            <div class="card mb-4">
                <?php the_post_thumbnail('large', ['class' => 'card-img-top', 'title' => get_the_title()]); ?>
                <div class="card-body">
                    <?php
                    if ((!is_single()) && (!is_page())) :
                    ?>
                        <a href="<?php the_permalink(); ?>">
                            <h2 class="post-title card-title h4"><?php the_title(); ?></h2>
                            <!--<h3 class="post-subtitle">Many say exploration is part of our destiny, but it’s actually our duty to future generations.</h3>-->
                        </a>
                    <?php
                    endif;
                    ?>
                    <?php
                    if (!is_page()) :
                    ?>
                    <div class="small text-muted">
                        <p class="post-meta">
                            <?php _e('Posted by', 'bootstrap-child'); ?>
                            <a href="<?php get_the_author_link(); ?>"><?php the_author(); ?></a>
                            <?php _e('on', 'bootstrap-child'); ?> <?php echo get_the_date(); ?>
                        </p>
                    </div>
                    <?php
                    endif;
                    ?>
                    <?php
                    if ((!is_single()) && (!is_page())) :
                        the_excerpt();

                        echo '<a class="btn btn-primary" href="'. get_the_permalink() . '">' . __('Read more →', 'bootstrap-child') . '</a>';
                    else :
                        the_content();
                    endif;

                    if(is_single()){
                        if (comments_open() || get_comments_number()) :
                            comments_template();
                        endif;
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
        if ((!is_single()) && (!is_page())) :
        ?>
            <!-- Divider-->
            <hr class="my-4" />
        <?php
        endif;
    endwhile; // End of the loop.
else :
    get_template_part( 'content', 'none' );
endif;

get_footer();

?>
<!-- Pager-->
<!-- <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="#!">Older Posts →</a></div>-->
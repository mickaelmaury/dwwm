<?php

get_header();

if (have_posts()) :
    /* Start the Loop */
    while (have_posts()) :
        the_post();

?>
        <!-- Post preview-->
        <div class="post-preview">
            <!-- Blog post-->
            <div class="card mb-4">
                <?php the_post_thumbnail('original', ['class' => 'card-img-top img-responsive rounded', 'title' => get_the_title()]); ?>
                <div class="card-body">
                    <!-- Post categories-->
                    <?php
                    if (!is_page()) :
                        $categories = get_the_category();

                        if ($categories) {
                            foreach ($categories as $cat) {

                    ?>
                                <a class="badge bg-secondary text-decoration-none link-light" href="<?php echo get_category_link($cat->term_id); ?>">
                                    <?php echo $cat->name; ?>
                                </a>
                    <?php
                            }
                        }
                    endif;
                    ?>
                    <?php
                    if ((!is_single()) && (!is_page())) :
                    ?>

                        <h2 class="post-title card-title h4"><?php the_title(); ?></h2>
                    <?php
                    endif;
                    ?>
                    <?php
                    if (!is_page()) :
                    ?>
                        <div class="small text-muted">
                            <p class="post-meta">
                                <?php _e('Posted by', 'bootstrap'); ?>
                                <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php the_author(); ?></a>
                                <?php _e('on', 'bootstrap'); ?> <?php echo get_the_date(); ?>
                            </p>
                            <p>
                                <?php
                                $comment_count = get_comments_number(); // Nombre de commentaires

                                if ($comment_count != 0) {
                                    printf(
                                        _n(
                                            '%s comment',
                                            '%s comments',
                                            $comment_count,
                                            'bootstrap'
                                        ),
                                        number_format_i18n($comment_count)
                                    );
                                }
                                ?>
                            </p>
                        </div>
                    <?php
                    endif;
                    ?>
                    <?php
                    if ((!is_single()) && (!is_page())) :
                        the_excerpt();

                        echo '<a class="btn btn-primary" href="' . get_the_permalink() . '">' . __('Read more →', 'bootstrap') . '</a>';
                    else :
                        the_content();
                    endif;

                    if (is_single()) {
                        if (comments_open() || get_comments_number()) :
                            comments_template();
                        endif;
                    }
                    ?>

                    <?php
                    if (is_single()) {
                    ?>
                        <?php if (is_single()) : ?>
                            <div class="btn-group btn-group-justified hidden-sm hidden-xs" role="group" aria-label="..." id="nextpreviouslinks">
                                <div class="btn-group" role="group">
                                    <?php if (strlen(get_previous_post()->post_title) > 0) { ?>
                                        <button type="button" class="btn btn-default btn-sm"> <?php _e('Previous Post :', 'bootstrap'); ?> <?php previous_post_link('%link', '%title'); ?></button>
                                    <?php } ?>
                                </div>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-default btn-sm"><a href="<?php bloginfo('url') ?>"><i class="fa fa-th" aria-hidden="true"></i></a></button>
                                </div>
                                <div class="btn-group" role="group">
                                    <?php if (strlen(get_next_post()->post_title) > 0) { ?>
                                        <button type="button" class="btn btn-default btn-sm"> <?php _e('Next Post :', 'bootstrap'); ?> <?php next_post_link('%link', '%title'); ?></button>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php
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
    ?>
    <div class="row">
        <?php
        if (((!is_single()) && (!is_page()) && (!is_404())) && (get_post_type() != 'projet')) :
            wp_boostrap_4_pagination();
        endif;
        ?>
    </div>
<?php
else :
    get_template_part('content', 'none');
endif;

get_footer();

?>
<!-- Pager-->
<!-- <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="#!">Older Posts →</a></div>-->
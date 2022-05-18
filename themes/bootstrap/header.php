<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <meta name="description" content="<?php bloginfo('description'); ?>" />
    <meta name="author" content="" />
    <title>
        <?php
        bloginfo('name');

        if (is_home() || is_front_page()) {
        ?>
            &mdash; <?php bloginfo('description');
                } else {
                    ?>
            &mdash; <?php wp_title('', true);
                }
                    ?>
    </title>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="<?php echo home_url(); ?>">
                <?php
                if (has_custom_logo()) :
                    $custom_logo_id = get_theme_mod('custom_logo');
                    $image = wp_get_attachment_image_src($custom_logo_id, 'logo-thumb');
                else :
                    bloginfo('name');
                endif;
                ?>
                <img src="<?php echo $image[0]; ?>" alt="<?php bloginfo('name'); ?>">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <?php _e('Menu', 'bootstrap'); ?>
                <i class="fas fa-bars"></i>
            </button>
            <!-- Menu principal -->
            <?php if (has_nav_menu('primary_menu')) : ?>
                <?php
                wp_nav_menu(array(
                    'theme_location'    => 'primary_menu',
                    'depth'             => 2, // 1 = no dropdowns, 2 = with dropdowns.
                    'container'         => 'div',
                    'container_class'   => 'collapse navbar-collapse',
                    'container_id'      => 'navbarResponsive',
                    'menu_class'        => 'navbar-nav ms-auto py-4 py-lg-0',
                    'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                    'walker'            => new WP_Bootstrap_Navwalker(),
                )); ?>
            <?php endif; ?>

            <!--<a class="nav-link px-lg-3 py-3 py-lg-4" href="index.html">Home</a>-->
        </div>
    </nav>

    <!-- Page Header-->
    <header class="masthead" style="background-image: url('<?php header_image(); ?>')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <?php
                        if (is_home()) :
                        ?>
                            <h1><?php bloginfo('name'); ?></h1>
                        <?php
                        else :
                        ?>
                            <?php if (is_archive()) : ?>
                                <?php if (get_post_type() != 'proprojectjet') : ?>
                                    <h1><?php echo get_the_archive_title(); ?></h1>
                                <?php else : ?>
                                    <h1><?php echo get_post_type_object('project')->labels->name; ?></h1>
                                <?php endif; ?>
                            <?php else : ?>
                                <?php if (is_404()) : ?>
                                    <h1><?php _e('Oopss ! Request page not found !', 'bootstrap'); ?></h1>
                                <?php else : ?>
                                    <?php if (is_search()) : ?>
                                        <h1><?php printf(__('Search results for: %s', 'bootstrap'), get_search_query()); ?></h1>
                                    <?php else : ?>
                                        <h1><?php the_title(); ?></h1>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if (is_category()) :
                    ?>
                        <div class="text-center subheading">
                            <h2>
                                <?php
                                // Affichage de la description des catégories et mots-clés
                                echo category_description();
                                ?>
                            </h2>
                        </div>
                    <?php
                    endif;
                    ?>
                        <?php
                        endif;
                        ?>
                        <span class="subheading"><?php echo get_field('sous-titre'); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <?php if ((get_post_type() != 'project') && (!is_search() && !is_404() && !is_page() && !is_single() && !is_category() && !is_author())) : ?>
        <div class="container" id="highlight">
            <div class="row mb-2">
                <?php

                $original_query = $wp_query;
                $wp_query = null;

                $args = array(
                    'posts_per_page' => 2,
                    'tag' => 'highlight'
                );

                $wp_query = new WP_Query($args);

                if (have_posts()) :
                    ?>
                    <h2><?php _e('Hightlight Posts', 'bootstrap') ?></h2>
                    <?php
                    while (have_posts()) : the_post(); ?>
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <?php the_post_thumbnail('original', ['class' => 'card-img-top img-responsive rounded', 'title' => get_the_title()]); ?>
                                <div class="card-body">
                                    <?php 
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
                                    ?>
                                    <h2 class="post-title card-title h4"><?php the_title(); ?></h2>
                                    <div class="small text-muted">
                                        <p class="post-meta">
                                            <?php _e('Posted by', 'bootstrap'); ?>
                                            <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a>
                                            <?php _e('on', 'bootstrap'); ?> <?php echo get_the_date(); ?>
                                        </p>
                                        <p>
                                            <?php 
                                                $comment_count = get_comments_number(); // Nombre de commentaires

                                                if($comment_count != 0){
                                                    printf(
                                                        _n(
                                                            '%s comment',
                                                            '%s comments',
                                                            $comment_count,
                                                            'bootstrap'
                                                        ),
                                                        number_format_i18n( $comment_count )
                                                    );
                                                }
                                            ?>
                                        </p>
                                    </div>
                                    <?php the_excerpt(); ?>
                                    <?php echo '<a class="btn btn-primary" href="' . get_the_permalink() . '">' . __('Read more →', 'bootstrap') . '</a>'; ?>
                                </div>
                            </div>
                        </div>
                <?php endwhile;
                endif;

                $wp_query = null;
                $wp_query = $original_query;
                wp_reset_postdata();
                ?>
            </div> <!-- /div.row mb-2 -->
            <hr class="mt-2 mb-3"/>
        </div>
    <?php endif; ?>
    <!-- Main Content-->
    <div class="container" id="maincontent">
        <div class="row">
            <?php if ((get_post_type() != 'project') && (!is_404()) && (!is_page()) || (is_search()) || (is_single())) : ?>
                <div class="col-lg-8">
                <?php else : ?>
                    <div class="col-lg-12">
                    <?php endif; ?>
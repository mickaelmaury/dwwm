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
    <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="<?php echo home_url(); ?>">
                <?php
                if (has_custom_logo()) :
                    $custom_logo_id = get_theme_mod('custom_logo');
                    $image = wp_get_attachment_image_src($custom_logo_id, 'full');
                else :
                    bloginfo('name');
                endif;
                ?>
                <img src="<?php echo $image[0]; ?>" alt="<?php bloginfo('name'); ?>" width=150 height=150>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <?php _e('Menu', 'bootstrap-child'); ?>
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

            <!--<li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="index.html">Home</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="about.html">About</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="post.html">Sample Post</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="contact.html">Contact</a></li>-->
        </div>
    </nav>

    <!-- Page Header-->
    <header class="masthead" style="background-image: url('<?php header_image(); ?>')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <?php 
                            if(is_home()):
                        ?>
                            <h1><?php bloginfo('name'); ?></h1>
                        <?php 
                            else :
                        ?>
                            <h1><?php the_title(); ?></h1>
                        <?php 
                            endif;
                        ?>
                        <span class="subheading"><?php echo get_field('sous-titre'); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content-->
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
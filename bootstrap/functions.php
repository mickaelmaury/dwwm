<?php

require_once(get_stylesheet_directory() . '/inc/post-types.php');

/* Chargement des styles du parent / enfant. */
add_action('wp_enqueue_scripts', 'wpchild_enqueue_styles');

function wpchild_enqueue_styles()
{
  // Enfant
  wp_enqueue_style('twentytwentyone-style-child', get_stylesheet_directory_uri() . '/style.css');

  wp_enqueue_style('bootstrap-css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css');

  wp_enqueue_style('font-awesome-css', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css');

  wp_enqueue_script('jquery');

  wp_enqueue_script('bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js', array('jquery'));
}

/* Chargement des fichiers de langue. */
function bootstrap_child_setup()
{
  $child_path = get_stylesheet_directory() . '/languages';

  load_child_theme_textdomain('bootstrap-child', $child_path);
}

add_action('after_setup_theme', 'bootstrap_child_setup');
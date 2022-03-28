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

// Laisser WordPress s'occuper des titres, sans ce soucier d'ajouter une balise <title></title>
add_theme_support('title-tag');

// Permettre de paramétrer un logo personnalisé (récupérée par the_custom_logo())
add_theme_support('custom-logo', array(
  'height' => 150,
  'width' => 150
));

// Permettre de paramétrer une image d'en-tête personnalisée (récupérée par header_image())
add_theme_support('custom-header');

// Permettre de paramétrer l'image à la une
add_theme_support('post-thumbnails');

// Permettre de paramétrer les menus
add_theme_support('menus');

// Permettre de paramétrer les widgets
add_theme_support('widgets');

if (!function_exists('bootstrap_register_nav_menu')) {

  function bootstrap_register_nav_menu()
  {
    register_nav_menus(array(
      'primary_menu' => __('Primary Menu', 'bootstrap-child'),
      'footer_menu'  => __('Footer Menu', 'bootstrap-child'),
    ));

    // On ajoute une classe php permettant de gérer les menus Bootstrap
    require_once get_template_directory() . '/assets/class-wp-bootstrap-navwalker.php';
  }

  add_action('after_setup_theme', 'bootstrap_register_nav_menu', 0);
}
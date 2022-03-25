<?php

require_once(get_stylesheet_directory() . '/inc/post-types.php');

/* Chargement des styles du parent / enfant. */
add_action( 'wp_enqueue_scripts', 'wpchild_enqueue_styles');

function wpchild_enqueue_styles(){
  // Enfant (utilisation d'une dépendance de style : twenty-twenty-one-style)
  wp_enqueue_style( 'twentytwentytwo-style-child', get_stylesheet_directory_uri() . '/style.css', 
    array('twenty-twenty-two-style'));
}

function localisation_child_theme(){
    load_child_theme_textdomain('twentytwentytwo-child', get_stylesheet_directory() . '/languages');
}

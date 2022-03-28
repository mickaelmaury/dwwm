<?php

require_once(get_stylesheet_directory() . '/inc/post-types.php');

/* Chargement des styles du parent / enfant. */
add_action( 'wp_enqueue_scripts', 'wpchild_enqueue_styles');

function wpchild_enqueue_styles(){
  // Enfant (utilisation d'une dépendance de style : twenty-twenty-one-style)
  wp_enqueue_style( 'twentytwentyone-style-child', get_stylesheet_directory_uri() . '/style.css', 
    array('twenty-twenty-one-style'));
}

/* Chargement des fichiers de langue. */
function twentytwentyone_child_setup() {
  $child_path = get_stylesheet_directory().'/languages';
  
  load_child_theme_textdomain( 'twentytwentyone-child', $child_path );
}

add_action( 'after_setup_theme', 'twentytwentyone_child_setup' );

<?php

/* Chargement des styles du parent / enfant. */
add_action( 'wp_enqueue_scripts', 'wpchild_enqueue_styles');

function wpchild_enqueue_styles(){
  // Enfant (utilisation d'une dépendance de style : twenty-twenty-one-style)
  wp_enqueue_style( 'twentytwentyone-style-child', get_stylesheet_directory_uri() . '/style.css', 
    array('twenty-twenty-two-style'));
}

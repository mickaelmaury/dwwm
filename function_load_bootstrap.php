<?php 

    /* Chargement de Bootstrap */
    function montheme_load_bootstrap(){
        wp_enqueue_style('style', get_stylesheet_uri());

        wp_enqueue_style('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css');
        
        wp_enqueue_script('jquery');

        wp_enqueue_script('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js', array('jquery'));
    }

    add_action('wp_enqueue_scripts', 'montheme_load_bootstrap');

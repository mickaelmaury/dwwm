<?php

/**
 * Plugin Name:       VWF Button Shortcode
 * Description:       Affichage de boutons sociaux
 * Version:           1.0
 * Author:            Mickaël Maury
 * Author URI:        https://mickael-maury.fr
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       button-shortcodes
 * Domain Path:       /languages/
 */
defined('ABSPATH') || die();

add_action( 'init', 'vmf_load_textdomain' );

/**
 * Load translations
 */
function vmf_load_textdomain() {
    load_plugin_textdomain( 'button-shortcodes', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}

function button_shortcode($atts, $content = null )
{
    extract(shortcode_atts(
        array(
            'type' => '',
        ), $atts ) );

    $output = '';

    // check what type user entered
    switch ($type) {
        case 'twitter':
            $output = '<a href="https://twitter.com/_mickaelmaury_" target="_blank" title="' . $content . '"><i class="fab fa-twitter"></i></a>';
            break;

        case 'linkedin':
            $output = '<a href="https://www.linkedin.com/company/votre-consultant-digital/" target="_blank" title="' . $content . '"><i class="fab fa-linkedin-in"></i></a>';
            break;

        case 'facebook':
            $output = '<a href="https://www.facebook.com/votreconsultantdigital/" target="_blank" title="' . $content . '"><i class="fab fa-facebook"></i></a>';
            break;

        case 'instagram':
            $output = '<a href="https://www.instagram.com/votreconsultantdigital/" target="_blank" title="' . $content . '"><i class="fab fa-instagram"></i></a>';
            break;
        
        case 'rss':
            $output = '<a href="https://mickael-maury.fr/feed" target="_blank" title="' . $content . '"><i class="fa fa-rss"></i></a>';
            break;
    }

    return $output;
}

add_shortcode('button', 'button_shortcode');

add_action( 'wp_enqueue_scripts', 'enqueue_load_fa' );

function enqueue_load_fa() {
    wp_register_style( 'fontawesome', 'https://use.fontawesome.com/releases/v6.1.0/js/all.js', array(), '6.1.0' );
    wp_enqueue_style( 'fontawesome' );
}

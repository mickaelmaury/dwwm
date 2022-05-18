<?php
/**
 * Plugin Name:       VMF Loading CSS and JS
 * Description:       Chargement de ressources JS et CSS dans un plugin.
 * Version:           1.0
 * Author:            Mickaël Maury
 * Author URI:        https://mickael-maury.fr
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       loading-css-js
 * Domain Path:       /languages/
 */
defined( 'ABSPATH' ) || die();


add_shortcode( 'vmf_title' , 'vmf_title' );

/**
 * Ajout d'un shortcode pour afficher une table
 * 
 * @param  string  $atts  shortcode attributes
 */
function vmf_title( $atts, $content, $tag ){

    // Chargement des scripts
    $stylesheet_url = plugins_url( 'assets/css/custom-title.css', __FILE__ ); 
    
    wp_enqueue_style( 'custom-title-styles', esc_url($stylesheet_url), array(), null );
    wp_enqueue_script( 'custom-title-script', plugins_url('assets/js/custom-title.js', __FILE__ ), array(), time(), true );

    $defaults = array(
        'title' => __( 'Default title', 'loading-css-js' ),
        'data-title' => __( 'Default data title', 'loading-css-js' ),
    );

    $atts = shortcode_atts( $defaults, $atts, $tag );

    // Afficher le titre personnalisé.
    ob_start();

    ?>
        <h2 class="custom-title" data-title="<?php echo esc_html( $atts['data-title'] ); ?>"><?php echo esc_html( $atts['title'] ); ?></h2>
    <?php

    return ob_get_clean();
}
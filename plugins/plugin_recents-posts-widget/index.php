<?php
/**
 * Plugin Name:       VWF - Recent Posts Widgets
 * Description:       Création d'un widget d'affichage des derniers articles
 * Version:           1.0
 * Author:            Mickaël Maury
 * Author URI:        https://mickael-maury.fr
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wvf_recent_posts
 * Domain Path:       /languages/
 */
defined( 'ABSPATH' ) || die();

define( 'WIDGETS_PATH', plugin_dir_path( __FILE__ ) );

add_action( 'widgets_init', 'vwf_register_widget' );

// Déclarer un nouveau widget
function vwf_register_widget(){
    include 'inc/class-vwf-recent-posts-widget.php';
	register_widget( 'VWF_Recent_Posts_Widgets' );
};

// Renvoyer le chemin d'accès au répertoire des templates
function vwf_locate_template( $template_name ) {
    $located = '';
    
    if ( file_exists( WIDGETS_PATH . '/templates/' . $template_name ) ) {
        $located = WIDGETS_PATH . '/templates/' . $template_name;
    }

    return $located;
}
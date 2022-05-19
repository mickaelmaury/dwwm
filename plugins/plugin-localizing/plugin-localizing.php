<?php
/**
 * Plugin Name:       VMF - Localizing
 * Description:       Example de chargement de fichiers de langue
 * Version:           1.0
 * Author:            Mickaël Maury
 * Author URI:        https://mickael-maury.fr
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       localizing
 * Domain Path:       /languages/
 */
defined( 'ABSPATH' ) || die();


add_action( 'init', 'vmf_load_textdomain' );

/**
 * Charger les traductions
 */
function vmf_load_textdomain() {
    load_plugin_textdomain( 'localizing', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}


add_action( 'wp_footer', 'vmf_footer_message' );

/**
 * Affichage d'un message dans le pied de page.
 */
function vmf_footer_message(){
    ?>
        <p class="small text-center"><?php esc_html_e( 'Made with love with WordPress', 'localizing'); ?></p>
    <?php
}

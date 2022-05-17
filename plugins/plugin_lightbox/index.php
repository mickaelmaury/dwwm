<?php
/*
  Plugin Name: VWF Lightbox
  Description: Votre Webmaster Freelance - Affichage des images en effet Lightbox au clic
  Author: Mickaël Maury
  Author URI:        https://mickael-maury.fr/
  License:           GPL v2 or later
  License URI:       https://mickael-maury.fr/
  Version: 1.0.0
 */

defined( 'ABSPATH' ) || die();

function vwm_load_files_lightbox()
{
    wp_enqueue_script('jquery');

    // Mettre en file d'attente la feuille de style CSS
    wp_register_style('lightbox_style', plugin_dir_url(__FILE__) . 'lightbox.css');
    wp_enqueue_style('lightbox_style');

    // Mettre en file d'attente le script JavaScript
    wp_register_script('lightbox_script', plugin_dir_url(__FILE__) . 'lightbox.js');
    wp_enqueue_script('lightbox_script');
}

add_action('wp_enqueue_scripts', 'vwm_load_files_lightbox');

// Ajouter une page de menu permettant de gérer les réglages
function vwm_lightbox_settings_menu()
{
    add_menu_page('Réglages Lightbox', 'Lightbox', 'administrator', 'lightbox_settings', 'lightbox_settings_page', 'dashicons-admin-generic');
}

add_action('admin_menu', 'vwm_lightbox_settings_menu');

// Page des réglages
function lightbox_settings_page()
{
?>
    <h2>Réglages de l'effet Lightbox</h2>
    <form method="post" action="options.php">
        <?php settings_fields('lightbox_settings_group'); ?>
        <?php do_settings_sections('lightbox_settings_group'); ?>
        <label>Taille de la bordure de l'image en pixels</label>
        <input type="text" id="border_size" name="border_size" value="<?php echo get_option('border_size'); ?>">px<br>
        <label>Hauteur de l'image en pourcentage de la fenêtre</label>
        <input type="text" id="image_size_height" name="image_size_height" value="<?php echo get_option('image_size_height'); ?>">%
        <?php submit_button(); ?>
    </form>
<?php }

function vwm_lightbox_settings()
{
    register_setting('lightbox_settings_group', 'border_size');
    register_setting('lightbox_settings_group', 'image_size_height');
}

// Enregistrement des réglages dans wp_options
add_action('admin_init', 'vwm_lightbox_settings');

// Chargement des modifications CSS
function image_style()
{
?>
    <style>
        .lightbox img {
            border-width: <?php echo get_option('border_size'); ?>px;
            max-height: <?php echo get_option('image_size_height'); ?>%;
        }
    </style>
<?php
}

add_action('wp_head', 'image_style');

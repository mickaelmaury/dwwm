<?php
 /*
  Plugin Name: VWF Lightbox
  Description: Votre Webmaster Freelance - Affichage des images en effet Lightbox au clic
  Author: Mickaël Maury
  Version: 1.0.0
 */

function vwm_load_files_lightbox() {
    wp_enqueue_script('jquery');
  
    // Mettre en file d'attente la feuille de style CSS
    wp_register_style('lightbox_style', plugin_dir_url( __FILE__ ) . 'lightbox.css');
    wp_enqueue_style('lightbox_style');
  
    // Mettre en file d'attente le script JavaScript
    wp_register_script('lightbox_script', plugin_dir_url( __FILE__ ) . 'lightbox.js');
    wp_enqueue_script('lightbox_script');
    
}

add_action('wp_enqueue_scripts','vwm_load_files_lightbox');

// Ajouter une page de menu permettant de gérer les réglages
function vwm_lightbox_settings_menu() {
    add_menu_page('Réglages Lightbox', 'Lightbox', 'administrator', 'lightbox_settings', 'lightbox_settings_page', 'dashicons-admin-generic');
}

add_action('admin_menu', 'vwm_lightbox_settings_menu');

// Page des réglages
function vwm_lightbox_settings() {
?>
<h2>Réglages de l'effet Lightbox</h2>
<form method="post" action="options.php">
    <?php settings_fields('lightbox_settings_group'); ?>
    <?php do_settings_sections('lightbox_settings_group'); ?>
    <label>Taille de la bordure de l'image en pixels</label>
    <input type="text" id="border_size" name="border_size"  value="<?php echo get_option('border_size'); ?>">px<br>
    <label>Hauteur de l'image en pourcentage de la fenêtre</label>
    <input type="text" id="image_size_height" name="image_size_height"  value="<?php echo get_option('image_size_height'); ?>">%
    <?php submit_button(); ?>
</form>
<?php } 

function vwm_lightbox_settings() {
    register_setting('lightbox_settings_group', 'border_size');
    register_setting('lightbox_settings_group', 'image_size_height');
}

// Enregistrement des réglages dans wp_options
add_action('admin_init', 'vwm_lightbox_settings');

// Chargement des modifications CSS
function image_style() {
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

/*

--- lightbox.css ---

.lightbox {
    position: fixed;
    z-index: 1000;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background-color: rgba(0, 0, 0, 0.4);
    cursor: pointer;
    display: none;
    align-items: center;
    justify-content: center;
}

.lightbox img {
    max-height: 90%;
    border: 4px white solid;
    border-radius: 5px;
}

*/

/*

--- lightbox.js ---

function resize(source) {
    jQuery(".lightbox").html("<img src='" + source + "'>");
    jQuery(".lightbox").fadeIn("slow").css("display", "flex");
}


// Quand la page est prête
jQuery(function($) {
    // Ajout d'une balise <div> vide dans le <body>
    $('<div class="lightbox"></div>').prependTo('body');
    
    $('img').click(function(){
        var srcImage = $(this).attr('src');

        resize(srcImage);

        return false;
      });

    $(".lightbox").click(function () {
        $(".lightbox").fadeOut("fast");
    });
});

*/

// Fichier à renommer en index.php et à placer dans un répertoire lightbox-effect situé dans /wp-content/plugins/ pour pouvoir l'activer en tant qu'extension WordPress //

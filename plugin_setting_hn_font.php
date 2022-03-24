<?php
/*
  Plugin Name: VWF Hn Font
  Description: Votre Webmaster Freelance - Configuration des polices d'écriture des titres Hn
  Author: Mickaël Maury
  Version: 1.0.0
 */

function vwf_hn_fonts_head(){
  // get_option() permet de récupérer des valeurs de réglages enregistrés dans la table wp_options.
 ?>
<style>
    @import url('https://fonts.googleapis.com/css?family=Lato|Open+Sans|Roboto');

    h1 {
        font-family: <?php echo get_option('h1_font');
        ?> !important;
    }

    h2 {
        font-family: <?php echo get_option('h2_font');
        ?> !important;
    }

    h3 {
        font-family: <?php echo get_option('h3_font');
        ?> !important;
    }

</style>
<?php 
}

// On place du CSS directement dans le <head> du code source HTML
add_action('wp_head', 'vwf_hn_fonts_head');

// Créer une nouvelle page de réglages dans le Tableau de bord WordPress
function vwf_hn_fonts_page_menu() {
    // add_menu_page() permet d'ajouter la nouvelle page
    // Paramètres :
    // - titre de la page
    // - titre du menu
    // - rôle utilisateur autorisé à accéder à la page
    // - fonction pour l'enregistrement des réglages
    // fonction pour l'affichage de la page des réglages
    // - icône du menu
    add_menu_page('Réglages des polices de menu', 'Hn Fonts', 'administrator', 'hn_fonts_settings', 'hn_fonts_page_settings', 'dashicons-editor-textcolor');
}

add_action('admin_menu', 'vwf_hn_fonts_page_menu');

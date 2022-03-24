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

function hn_fonts_settings() {
    // Enregistrement de nouvelles options de réglages
    register_setting('hn_setting_group', 'h1_font');
    register_setting('hn_setting_group', 'h2_font');
    register_setting('hn_setting_group', 'h3_font');
}

add_action('admin_init', 'hn_fonts_settings');

function hn_fonts_page_settings(){
  ?>
  <h2>Réglages des polices</h2>
  <form method="post" action="options.php">
      <?php settings_fields('hn_setting_group'); ?>
      <?php do_settings_sections('hn_setting_group'); ?>
      <label>h1</label>
      <select id="h1_font" name="h1_font">
          <option <?php if(get_option('h1_font')=="Open Sans" ) echo "selected" ?> value="Open Sans">Open Sans</option>
          <option <?php if(get_option('h1_font')=="Lato" ) echo "selected" ?> value="Lato">Lato</option>
          <option <?php if(get_option('h1_font')=="Roboto" ) echo "selected" ?> value="Roboto">Roboto</option>
      </select><br>
      <label>h2</label>
      <select id="h2_font" name="h2_font">
          <option <?php if(get_option('h2_font')=="Open Sans" ) echo "selected" ?> value="Open Sans">Open Sans</option>
          <option <?php if(get_option('h2_font')=="Lato" ) echo "selected" ?> value="Lato">Lato</option>
          <option <?php if(get_option('h2_font')=="Roboto" ) echo "selected" ?> value="Roboto">Roboto</option>
      </select><br>
      <label>h3</label>
      <select id="h3_font" name="h3_font">
          <option <?php if(get_option('h3_font')=="Open Sans" ) echo "selected" ?> value="Open Sans">Open Sans</option>
          <option <?php if(get_option('h3_font')=="Lato" ) echo "selected" ?> value="Lato">Lato</option>
          <option <?php if(get_option('h3_font')=="Roboto" ) echo "selected" ?> value="Roboto">Roboto</option>
      </select>
      <?php submit_button(); ?>
  </form>
  <?php
}

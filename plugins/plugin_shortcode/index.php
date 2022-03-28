<?php
/*
  Plugin Name: VWF Mes shortcodes
  Description: Votre Webmaster Freelance - Mes shortcodes
  Author: Mickaël Maury
  Version: 1.0.0
 */

function shortcode_bienvenue($atts, $content){   
  // Extraire les paramètres
  extract(shortcode_atts(
      array(
        'langue' => 'FR',
        'color' => 'black'
  ), $atts));

  if($langue == "EN"){
    $prefix = "Welcome to ";
  }else{
    $prefix = "Bienvenue chez ";
  }
    
  return '<h2 style="color:' . $color . ';">' . $prefix . $content . '</h2>'; 
} 

// Paramètres :
// - Nom du shortcoe pour son appel : [bienvenue langue="EN" color="red"]Votre Webmaster Freelance ![/bienvenue]
// - Fonction callback appelée pour traiter le rendu

add_shortcode('bienvenue', 'shortcode_bienvenue');

// Fichier à renommer en index.php et à placer dans un répertoire mes-shortcodes situé dans /wp-content/plugins/ pour pouvoir l'activer en tant qu'extension WordPress //

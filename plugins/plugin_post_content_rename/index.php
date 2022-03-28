<?php
  /*
  Plugin Name: VWF Renommage
  Description: Votre Webmaster Freelance - Renommage
  Author: Mickaël Maury
  Version: 1.0.0
 */

  function vwf_wordpress_post_content_rename($text) {
    $wrong = ['facebook', 'google', 'wordpress'];
    $right = ['Facebook', 'Google', 'Wordpress'];
    
    return str_replace($wrong, $right, $text);
  }

  add_filter('the_content', 'vwf_wordpress_post_content_rename');

// Fichier à renommer en index.php et à placer dans un répertoire post-content-rename situé dans /wp-content/plugins/ pour pouvoir l'activer en tant qu'extension WordPress //

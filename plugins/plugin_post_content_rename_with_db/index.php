<?php
  /*
  Plugin Name: VWF Renommage DB
  Description: Votre Webmaster Freelance - Renommage avec base de données
  Author: Mickaël Maury
  Version: 1.0.0
 */

  function vwf_wordpress_post_content_rename($text) {
    // $wpdb contient le pointeur de base de données
    global $wpdb;

    // Récupération de la table en base de données en se basant sur le préfixe de tables ($wpdb->prefix)
    $tableName = $wpdb->prefix . "words";
    
    // Récupération de tous les champs de la table dans un tableau
    $request = "SELECT * FROM " . $tableName;

    $results = $wpdb->get_results($request);

    $wrong = [];
    $right = [];

    // Parcours du tableau de résultats
    foreach ($results as $r) {
        $wrong[] = $r->wrongword;
        $right[] = $r->rightword;
    }
    
    return str_replace($wrong, $right, $text);
  }

  function vwf_install_plugin() {
      // $wpdb contient le pointeur de base de données
      global $wpdb;

      // Création d'une nouvelle table en base de données en se basant sur le préfixe de tables ($wpdb->prefix)
      $tableName = $wpdb->prefix . "words";
    
      $sql = "CREATE TABLE IF NOT EXISTS `".$tableName."` ( `id` INT NOT NULL AUTO_INCREMENT , `wrongword` VARCHAR(150) NOT NULL , `rightword` VARCHAR(150) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";

      // Import du fichier permettant de communiquer avec la base de données
      require_once( ABSPATH . "/wp-admin/includes/upgrade.php");
    
      // Appel de la fonction permettant d'exécuter notre requête SQL
      dbDelta($sql);
  }

  // Ajout de l'appel à la fonction à l'activation du plugin
  register_activation_hook(__FILE__, 'vwf_install_plugin');

  add_filter('the_content', 'vwf_wordpress_post_content_rename');

// Fichier à renommer en index.php et à placer dans un répertoire post-content-rename situé dans /wp-content/plugins/ pour pouvoir l'activer en tant qu'extension WordPress //

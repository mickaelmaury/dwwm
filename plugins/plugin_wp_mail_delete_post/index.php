<?php
/*
  Plugin Name: VWF Alerte admin on delete post
  Description: Votre Webmaster Freelance - Alerte administrateur en cas de suppression d'une publication
  Author: Mickaël Maury
  Version: 1.0.0
 */

//Fonction qui envoie par email les infos d'un email supprimé
function vwf_wp_mail_delete_post($post_id) {
    //Récupére les informations de l'article supprimé
    $post = get_post($post_id);
  
    // Sujet
    $sujet = "Une publication a été supprimée :" . $post->post_title;
  
    //Contenu
    $message = "Contenu de la publication : " . $post->post_content;
  
    $admin_email = get_bloginfo('admin_email');
  
    //Envoi de l'email à l'administrateur du site
    wp_mail($admin_email, $sujet, $message);
}

add_action('delete_post', 'vwf_wp_mail_delete_post');


// Fichier à renommer en index.php et à placer dans un répertoire wp-mail-delete-post situé dans /wp-content/plugins/ pour pouvoir l'activer en tant qu'extension WordPress //

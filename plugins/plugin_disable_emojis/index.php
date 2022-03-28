<?php
 /*
  Plugin Name: VWF Désactiver les emojis
  Description: Votre Webmaster Freelance - Désactiver l'utilisation des emojis
  Author: Mickaël Maury
  Version: 1.0.0
 */

defined( 'ABSPATH' ) || die();

function vmf_disable_emojis() {
  // remove_action() permet de supprimer un hook d'action
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('admin_print_styles', 'print_emoji_styles');
}

add_action( 'init', 'vmf_disable_emojis' );

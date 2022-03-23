<?php
  /*
  Plugin Name: VWF Renommage
  Description: Votre Webmaster Freelance - Renommage
  Author: Mickaël Maury
  Version: 1.0.0
 */

  function vwf_wordpress_post_content_rename($text) {
    $wrong = ['facbeook', 'google', 'wordpress'];
    $right = ['Facebook', 'Google', 'Wordpress'];
    
    return str_replace($wrong, $right, $text);
  }

  add_filter('the_content', 'vwf_wordpress_post_content_rename');

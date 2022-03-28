<?php
  
  function recent_list_by_post_type_callback($atts, $content = null) {
      //récupèrer les paramètres (avec des valeurs par défaut)
      $atts = shortcode_atts(
        array(
            'post_type' => 'post',
            'limit' => 10
        ), $atts);
  
      //transformer les paramètres en variables
      extract($atts);

      //créer la requête
      $query =  array(
          'post_status' => 'publish',
          'post_type' => $post_type,
          'posts_per_page' => $limit,
          'orderby' => 'date',
          'order' => 'DESC',
      );
      
  	  $post = query_posts($query);
  
      // stocker temporairement la valeur affichée par echo, sans l'afficher
      ob_start();
  
      echo '<div id="recent-list">';
  
      while (have_posts()): the_post();
			echo '<div class="grid one-third">';

  			// le contenu 	
  
			echo '</div>';
	  endwhile;					

      // réinitialiser les paramètres de la requête personnalisée
	  wp_reset_query();
  
      echo '</div>';
  
      return ob_get_clean();
  }

  add_shortcode('recent_list_by_post_type_shortcode','recent_list_by_post_type_callback');

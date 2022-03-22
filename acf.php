<?php

  // Affichage de la valeur d'un champ ACF
  function show_acf_age_minimal_field() { 
    if(get_field('age_minimal')) {
      the_field('age_minimal'); 
    }
  }

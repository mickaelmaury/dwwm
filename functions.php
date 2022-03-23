<?php

/* Déclarer une sidebar : register_sidebar() */

add_action( 'widgets_init', 'vwf_register_sidebars' );

function vwf_register_sidebars() {
    register_sidebar(
        array(
            'id'            => 'primary',
            'name'          => __( 'Primary Sidebar' ),
            'description'   => __( 'A short description of the sidebar.' ),
            'before_widget' => '<div class="p-3 widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="font-italic">',
            'after_title'   => '</h4>',
        )
    );
}

/* WooCommerce : filtre pour changer le titre des "Produits apparentés" */

add_filter('gettext', 'wc_change_related_products_title', 10, 3 );

function wc_change_related_products_title($translated, $text, $domain) {
    // On recherche la chaîne de traduction de l'extension WooCommerce, pour en altérer l'affichage
    if($text === 'Related products' && $domain === 'woocommerce'){
        $translated = esc_html__( 'Our customers have also bought', 'oceanwp-child' ); // à traduire avec Loco Translate, Poedit, ...
    }

    return $translated;
}

/* WooCommerce : filtre pour ajouter un champ personnalisé dans le tunnel de commande */

function wc_add_edit_address_fields($fields) {
  $new_fields = array(
    'date_of_birth' => array(
      'label' => __( 'Date of birth', 'oceanwp-child' ), // à traduire avec Loco Translate, Poedit, ...
      'required' => false,
      'class' => array( 'form-row' ),
    ),
  );

  // Fusionner le tableau de nouveaux champs de saisie avec l'actuel
  $fields = array_merge($fields, $new_fields);

  return $fields;
}

add_filter( 'woocommerce_default_address_fields', 'wc_add_edit_address_fields' );

/* WooCommerce : action pour ajouter un texte avant le bouton d'ajout au panier */

function wc_before_add_to_cart_form(){
	echo __( '<b>1 year warranty</b>', 'oceanwp-child'); // à traduire avec Loco Translate, Poedit, ...
}

add_action('woocommerce_before_add_to_cart_form','wc_before_add_to_cart_form');

/* WooCommerce : filtre pour modifier le texte du bouton d'ajout au panier */
 
function wc_edit_text_add_cart() {
  return __( 'I want it !', 'oceanwp-child'); // à traduire avec Loco Translate, Poedit, ...
}

add_filter( 'woocommerce_product_add_to_cart_text', 'wc_edit_text_add_cart');  

/* WooCommerce : filtre pour remplacer le texte "Promo" par une image */

function wc_change_flash_sale_badge($html) {
    return "<img class='badge-promo' src='" . get_stylesheet_directory_uri() . "/img/promo-img.png'>"; // image à charger dans le répertoire du thème
}

add_filter( 'woocommerce_sale_flash', 'wc_change_flash_sale_badge' );

/* WooCommerce : filtre pour supprimer les blocs d'informations onglets sur la fiche produit */

function wc_remove_product_tabs( $tabs ) {
    unset( $tabs['description'] );      	// Supprime le bloc "Description"
    unset( $tabs['reviews'] ); 			// Supprime le bloc "Avis"
    unset( $tabs['additional_information'] );  	// Supprime le bloc "Information complémentaires"

    return $tabs;
}

add_filter( 'woocommerce_product_tabs', 'wc_remove_product_tabs', 98 );

/* WooCommerce : filtre pour modifier le nom des blocs d'informations sur la fiche produit */

function wc_rename_tabs( $tabs ) {
   $tabs['description']['title'] = __( 'Learn more about this product', 'oceanwp-child' );		// Renomme le bloc "Description"
   $tabs['reviews']['title'] = __( 'Our clients opinions', 'oceanwp-child' );				// Renomme le bloc "Avis"
   $tabs['additional_information']['title'] = __( 'More informations', 'oceanwp-child' );	// Renomme le bloc "Informations complémentaires"

   return $tabs;
}

add_filter( 'woocommerce_product_tabs', 'wc_rename_tabs', 98 );

/* WooCommerce : filtre pour réordonner les blocs d'informations sur la fiche produit */

function wc_reorder_tabs( $tabs ) {
	$tabs['reviews']['priority'] = 5;			// On affiche les avis en 1er
	$tabs['description']['priority'] = 10;			// ensuite le bloc "Description" en deuxieme
	$tabs['additional_information']['priority'] = 15;	// Et enfin les informations complémentaires

	return $tabs;
}

add_filter( 'woocommerce_product_tabs', 'wc_reorder_tabs', 98 );

/* WooCommerce : ajouter un bloc d'informations sur la fiche produit */

function wc_new_product_tab( $tabs ) {
	// On ajoute un nouveau bloc
	$tabs['nouveau_bloc'] = array(
		'title' 	=> __( 'Delivery details', 'oceanwp-child' ), // à traduire avec Loco Translate, Poedit, ...
		'priority' 	=> 50,
		'callback' 	=> 'wc_new_product_tab_content'
	);

	return $tabs;
}

add_filter( 'woocommerce_product_tabs', 'wc_new_product_tab' );

function wc_new_product_tab_content() {
	// Insérez ici le contenu de votre nouveau bloc
	echo '<h2>' . __( 'Delivery details', 'oceanwp-child' ) . '<h2>'; // à traduire avec Loco Translate, Poedit, ...
	echo '<p> ... </p>';
}

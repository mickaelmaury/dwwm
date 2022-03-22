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
    return "<img class='badge-promo' src='" . get_stylesheet_directory_uri() . "/img/promo-img.png'>";
}

add_filter( 'woocommerce_sale_flash', 'wc_change_flash_sale_badge' );

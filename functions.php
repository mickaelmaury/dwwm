/* WooCommerce : filtre pour changer le titre des "Produits apparentés" */

add_filter('gettext', 'wc_change_related_products_title', 10, 3 );

function wc_change_related_products_title($translated, $text, $domain) {
    // On recherche la chaîne de traduction de l'extension WooCommerce, pour en altérer l'affichage
    if($text === 'Related products' && $domain === 'woocommerce'){
        $translated = esc_html__( 'Our customers have also bought', 'oceanwp-child' );
    }

    return $translated;
}

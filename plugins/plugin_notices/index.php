<?php
/**
 * Plugin Name:       VWF Notices
 * Description:       Ajout de notices dans le Tableau de bord WordPress
 * Version:           1.0
 * Author:            Mickaël Maury
 * Author URI:        https://mickael-maury.fr/
 * License:           GPL v2 or later
 * License URI:       https://mickael-maury.fr/
 * Text Domain:       notices
 * Domain Path:       /languages/
 */
defined( 'ABSPATH' ) || die();


add_action( 'init', 'vwf_load_notices_textdomain' );

/**
 * Chargement des traductions
 */

 function vwf_load_notices_textdomain() {
    load_plugin_textdomain( 'notices', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}

/**
 * Ajouter des notices sur l'écran de l'administrateur
 */
function vwf_notices(){
    ?>
        <div class="notice"> 
            <p><strong><?php esc_html_e('This is a basic notice.', 'notices' ); ?></strong></p>
        </div>
        <div class="notice notice-success"> 
            <p><strong><?php esc_html_e('This is a SUCCESS notice.', 'notices' ); ?></strong></p>
        </div>
        <div class="notice notice-error"> 
            <p><strong><?php esc_html_e('This is an ERROR notice.', 'notices' ); ?></strong></p>
        </div>
        <div class="notice notice-warning"> 
            <p><strong><?php esc_html_e('This is a WARNING notice.', 'notices' ); ?></strong></p>
        </div>
        <div class="notice notice-info"> 
            <p><strong><?php esc_html_e('This is an INFO notice.', 'notices' ); ?></strong></p>
        </div>
        <div class="notice notice-success is-dismissible"> 
            <p><strong><?php esc_html_e('This is a DISMISSABLE notice.', 'notices' ); ?></strong></p>
        </div>
    <?php
}

add_action( 'admin_notices', 'vwf_user_notices' );

/**
 * Ajouter une notice sur l'écran de l'administrateur
 */
function vwf_user_notices(){
    // Récupération de l'identifiant de l'utilisateur actif
    $user_id = (int) get_current_user_id();

    // Suppression manuelle de la valeur pour effectuer un test
    //delete_user_meta( $user_id, '_vwf_dismiss_notice' );
    
    // Vérifier la décision de l'administrateur d'afficher ou masquer la notice
    $dismiss = get_user_meta( $user_id, '_vwf_dismiss_notice', true );
    
    $name = "vwf_user_${user_id}_reminder";
    
    if( $dismiss || get_transient( $name ) ){
        // Si l'internaute ne souhaitait plus voir la notice
        return;
    }

    // Récupération de la description dans le profil utilisateur
    $user_description = get_user_meta( $user_id, 'description', true );

    if( empty( $user_description ) ){
        // Affichage d'une alerte si la description est vide
        ?>
            <div class="notice notice-warning is-dismissible"> 
                <p>
                    <?php 
                        printf( 
                            __( 'It looks like your profile description is empty. We highly recommend you fill it in. You can do so by visiting <a href="%s">your profile page.</a>. If you do not wish to enter a description, <a href="%s">click to never be bothered again</a>.', 'notices' ),
                            esc_url( get_edit_profile_url() ),
                            '?vwf-dismiss-notice=true'
                        );
                    ?>
                </p>
            </div>
        <?php
        // Mise en cache de la donnée pour 20 secondes
        set_transient( $name, true, 20 );
    }  
}

add_action( 'admin_init', 'vwf_dismiss_notice' );

/**
 * Enregistrer une métadonnée si l'internaute décide de masquer la notice
 */
function vwf_dismiss_notice(){
    if ( isset( $_GET['vwf-dismiss-notice'] ) && 'true' === $_GET['vwf-dismiss-notice'] ) {
        $user_id = get_current_user_id();
		update_user_meta( $user_id, '_vwf_dismiss_notice', true );
	}
}


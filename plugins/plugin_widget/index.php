<?php
/*
  Plugin Name: VWF Mes widgets
  Description: Votre Webmaster Freelance - Mes widgets
  Author: Mickaël Maury
  Version: 1.0.0
 */

add_action( 'widgets_init', 'register_vmw_hello_world' );

function register_vmw_hello_world() {
    register_widget( 'vmw_hello_world' );
}

class vmw_hello_world extends WP_Widget {
    function __construct() {
        parent::__construct(
            'vmw_hello_world',
            esc_html__( 'Hello World by Votre Webmaster Freelance', 'vwf_widget' ),
            array( 'description' => esc_html__( 'Hello World !', 'vwf_widget' ), )
        );
    }  
    
    public function widget( $args, $instance ) {
        echo $args['before_widget'];

        echo "<h2>Hello World !</h2>";
        
        echo $args['after_widget'];
    }   
}

// Fichier à renommer en index.php et à placer dans un répertoire mes-widgets situé dans /wp-content/plugins/ pour pouvoir l'activer en tant qu'extension WordPress //

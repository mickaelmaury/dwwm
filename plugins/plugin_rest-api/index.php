<?php

/**
 * Plugin Name: REST API Widget Articles
 * Plugin URI: https://mickael-maury.fr
 * Description: Récupèrer des articles à l'aide de l'API REST 
 * Version: 1.0
 * Author: Mickaël Maury
 * Author URI: https://mickael-maury.fr
 */
class REST_Articles_Widget extends WP_Widget {
    public function __construct() {
        $widget_details = array(
            'classname' => 'widget-rest-api',
            'description' => 'Widget qui récupère des articles via l\'API REST depuis un autre site'
        );
        parent::__construct( 'widget-rest-api', 'REST API Widget', $widget_details );
    }

    public function form( $instance ) {
        $title = ( !empty( $instance['title'] ) ) ? $instance['title'] : '';
        ?>
        <p>
            <label for="<?php echo $this->get_field_name( 'title' ); ?>">Title: </label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <?php
    }

    public function widget( $args, $instance ) {
        $response = wp_remote_get( 'https://mickael-maury.fr/wp-json/wp/v2/posts/' );

        if( is_wp_error( $response ) ) {
            return;
        }

        $posts = json_decode( wp_remote_retrieve_body( $response ) );

        if( empty( $posts ) ) {
            return;
        }    

        echo $args['before_widget'];

        if( !empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $args['after_title'];
        }

        if( !empty( $posts ) ) {
            echo '<ul>';
            foreach( $posts as $post ) {
                echo '<li><a href="' . $post->link. '">' . $post->title->rendered . '</a></li>';
            }
            echo '</ul>';
        }

        echo $args['after_widget'];
    }
}

add_action( 'widgets_init', function(){
     register_widget( 'REST_Articles_Widget' );
});
<?php

    add_action('init', 'team_register');  
   
    function team_register() {  
        add_image_size('team_thumbnail', 150, 150, true); // Crop mode  

        $args = array(  
            'label' => __('Team', 'bootstrap'),  
            'singular_label' => __('Team', 'bootstrap'),  
            'public' => true,  
            'show_ui' => true,  
            'capability_type' => 'post',  
            'hierarchical' => false,  
            'rewrite' => true,  
            'supports' => array('title', 'editor', 'thumbnail'),
            'register_meta_box_cb' => 'team_meta_boxes', // Callback function for custom metaboxes  
        );  
    
        register_post_type( 'team' , $args );  
    }

    function team_meta_boxes() {
        add_meta_box( 'team-form',  __('Team detail', 'bootstrap'), 'team_form_callback', 'team', 'normal', 'high' );
    }
     
    function team_form_callback() {
        $post_id = get_the_ID();
        $team_data = get_post_meta( $post_id, '_team', true );
        $team_function = ( empty( $team_data['team_function'] ) ) ? '' : $team_data['team_function'];

        wp_nonce_field( 'team_nonce', 'team_nonce' );
        ?>
        <p>
            <label><?php echo __('Team function');?></label><br />
            <input type="text" value="<?php echo $team_function; ?>" id="team_function" name="team_function" size="40" />
        </p>
        <?php
    }

    function team_save_post( $post_id ) {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
            return;
    
        if ( ! empty( $_POST['team_function'] ) && ! wp_verify_nonce( $_POST['team_nonce'], 'team_nonce' ) )
            return;
    
        if ( ! empty( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_page', $post_id ) )
                return;
        } else {
            if ( ! current_user_can( 'edit_post', $post_id ) )
                return;
        }
        
        if ( ! empty( $_POST['team_function'] ) ) {
            $team_data['team_function'] = ( empty( $_POST['team_function'] ) ) ? '' : sanitize_text_field( $_POST['team_function'] );

            update_post_meta( $post_id, '_team', $team_data );
        } else {
            delete_post_meta( $post_id, '_team' );
        }
    }

    add_action( 'save_post', 'team_save_post' );

    function remove_team_wp_seo_meta_box() {
        remove_meta_box('wpseo_meta', 'team', 'normal');
    }

    add_action('add_meta_boxes', 'remove_team_wp_seo_meta_box', 100);
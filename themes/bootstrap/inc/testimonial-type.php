<?php

    add_action('init', 'testimonial_register');  
   
    function testimonial_register() {  
        $args = array(  
            'label' => __('Testimonial', 'bootstrap'),  
            'singular_label' => __('Testimonial', 'bootstrap'),  
            'public' => true,  
            'show_ui' => true,  
            'capability_type' => 'post',  
            'hierarchical' => false,  
            'rewrite' => true,  
            'supports' => array('title', 'editor'),
            //'register_meta_box_cb' => 'testimonial_meta_boxes', // Callback function for custom metaboxes
        );  
    
        register_post_type( 'testimonial' , $args );  
    }

    function testimonial_meta_boxes() {
        add_meta_box( 'testimonial-form',  __('Testimonial detail', 'bootstrap'), 'testimonial_form_callback', 'testimonial', 'normal', 'high' );
    }
     
    function testimonial_form_callback() {
        $post_id = get_the_ID();
        $testimonial_data = get_post_meta( $post_id, '_testimonial', true );
        $client_name = ( empty( $testimonial_data['testimonial_client_name'] ) ) ? '' : $testimonial_data['testimonial_client_name'];

        wp_nonce_field( 'testimonial_nonce', 'testimonial_nonce' );
        ?>
        <p>
            <label><?php echo __('Client name');?></label><br />
            <input type="text" value="<?php echo $client_name; ?>" id="testimonial_client_name" name="testimonial_client_name" size="40" />
        </p>
        <?php
    }

    function testimonial_save_post( $post_id ) {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
            return;
    
        if ( ! empty( $_POST['testimonial_client_name'] ) && ! wp_verify_nonce( $_POST['testimonial_nonce'], 'testimonial_nonce' ) )
            return;
    
        if ( ! empty( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_page', $post_id ) )
                return;
        } else {
            if ( ! current_user_can( 'edit_post', $post_id ) )
                return;
        }
        
        if ( ! empty( $_POST['testimonial_client_name'] ) ) {
            $testimonial_data['testimonial_client_name'] = ( empty( $_POST['testimonial_client_name'] ) ) ? '' : sanitize_text_field( $_POST['testimonial_client_name'] );

            update_post_meta( $post_id, '_testimonial', $testimonial_data );
        } else {
            delete_post_meta( $post_id, '_testimonial' );
        }
    }

    add_action( 'save_post', 'testimonial_save_post' );

    function testimonial_remove_wp_seo_meta_box() {
        remove_meta_box('wpseo_meta', 'testimonial', 'normal');
    }

    add_action('add_meta_boxes', 'testimonial_remove_wp_seo_meta_box', 100);
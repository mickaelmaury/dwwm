<?php

    add_action('init', 'portfolio_register');  
   
    function portfolio_register() {  
        $args = array(  
            'label' => __('Portfolio', 'bootstrap'),  
            'singular_label' => __('Project', 'bootstrap'),  
            'public' => true,  
            'show_ui' => true,  
            'capability_type' => 'post',  
            'hierarchical' => false,  
            // Possède une page regroupant l'ensemble des CPT
            'has_archive' => true,
            'rewrite'   => array( 'slug' => 'project'),  
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
            'register_meta_box_cb' => 'project_meta_boxes', // Callback function for custom metaboxes 
        );  
    
        register_post_type( 'project' , $args );  
    }

    register_taxonomy("project-type", array("project"), array("hierarchical" => true, "label" => __('Project Types', 'bootstrap'), "singular_label" => __('Project Type', 'bootstrap'), "rewrite" => true));

    function project_meta_boxes() {
        add_meta_box( 'project-form',  __('Project detail', 'bootstrap'), 'project_form_callback', 'project', 'normal', 'high' );
    }
     
    function project_form_callback() {
        $post_id = get_the_ID();
        $project_data = get_post_meta( $post_id, '_project', true );
        $client_name = ( empty( $project_data['project_client_name'] ) ) ? '' : $project_data['project_client_name'];

        wp_nonce_field( 'project_nonce', 'project_nonce' );
        ?>
        <p>
            <label><?php echo __('Client name');?></label><br />
            <input type="text" value="<?php echo $client_name; ?>" id="project_client_name" name="project_client_name" size="40" />
        </p>
        <?php
    }

    function project_save_post( $post_id ) {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
            return;
    
        if ( ! empty( $_POST['project_client_name'] ) && ! wp_verify_nonce( $_POST['project_nonce'], 'project_nonce' ) )
            return;
    
        if ( ! empty( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_page', $post_id ) )
                return;
        } else {
            if ( ! current_user_can( 'edit_post', $post_id ) )
                return;
        }
        
        if ( ! empty( $_POST['project_client_name'] ) ) {
            $project_data['project_client_name'] = ( empty( $_POST['project_client_name'] ) ) ? '' : sanitize_text_field( $_POST['project_client_name'] );

            update_post_meta( $post_id, '_project', $project_data );
        } else {
            delete_post_meta( $post_id, '_project' );
        }
    }

    add_action( 'save_post', 'project_save_post' );

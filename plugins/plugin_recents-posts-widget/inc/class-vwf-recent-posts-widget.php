<?php

class VWF_Recent_Posts_Widgets extends WP_Widget {
	public function __construct() {
        parent::__construct( 
            'vwf-recent-posts', 
            __( 'VWF Recent Posts', 'recents-posts-widget' ),
            array(
                'classname' => 'widget_vwf-recent-posts',   // Default value
                'description' => __( 'Displays attractive recent post cards', 'recents-posts-widget' ),
            )
        );
    }
	
	public function widget( $args, $instance ) {
        echo $args['before_widget'];
        
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $args['after_title'];
        }

        $query_args = array(
            'post_type' => 'post',
            'posts_per_page' => ! empty( $instance['number_posts'] ) ? (int) $instance['number_posts'] : 3,
        );

        $query = new WP_Query($query_args);
        
        if( $query->have_posts() ){
            echo '<div class="card-body">';
            while ( $query->have_posts() ){
                $query->the_post();
                include vwf_locate_template( 'recent-posts-widget/post-card.php' );
            }
            echo '<div>';
        }

        wp_reset_postdata();
        
        echo $args['after_widget'];
    }

	public function form( $instance ) {
        $title = ! empty($instance['title']) ? $instance['title'] : '';
        $number_posts = ! empty($instance['number_posts']) ? (int) $instance['number_posts'] : 3;
        ?>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title :', 'recents-posts-widget'); ?></label>
                <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($title); ?>">
            </p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('number_posts')); ?>"><?php esc_html_e( 'Number of posts to display :', 'recents-posts-widget'); ?></label>
                <input type="number" id="<?php echo esc_attr($this->get_field_id('number_posts')); ?>" name="<?php echo esc_attr($this->get_field_name('number_posts')); ?>" value="<?php echo esc_attr( $number_posts ); ?>">
            </p>
        <?php
    }

    
	public function update( $new_instance, $old_instance ) {
        
        if( $new_instance === $old_instance ){
            return false;
        }

        $instance = array(
            'title' => ! empty( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) : '',
            'number_posts' => ! empty( $new_instance['number_posts'] ) ? (int) $new_instance['number_posts']  : 3,
        );

        return $instance;
    }
}
<?php $loop = new WP_Query( array( 'post_type' => 'testimonial', 'posts_per_page' => '3' ) ); ?>
<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
    <?php 
        $testimonial_data = get_post_meta( get_the_ID(), '_testimonial', true ); 
        $client_name = ( empty( $testimonial_data['testimonial_client_name'] ) ) ? '' : $testimonial_data['testimonial_client_name'];
    ?>
    <div class="card mb-4">
        <div class="card-body p-4">
            <div class="d-flex">
                <div class="flex-shrink-0"><i class="bi bi-chat-right-quote-fill text-primary fs-1"></i></div>
                <div class="ms-4">
                    <div class="mb-1"><?php the_content() ?></div>
                    <div class="small text-muted">
                        <?php echo $client_name;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endwhile; wp_reset_query(); ?>
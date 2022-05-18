<?php $loop = new WP_Query( array( 'post_type' => 'team', 'posts_per_page' => '4' ) ); ?>
<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
    <?php 
        $team_data = get_post_meta( get_the_ID(), '_team', true ); 
        $team_function = ( empty( $team_data['team_function'] ) ) ? '' : $team_data['team_function'];
    ?>
    <div class="col mb-5 mb-5 mb-xl-0">
        <div class="text-center">
            <?php the_post_thumbnail( 'team_thumbnail', array(
                    'class' => 'img-fluid rounded-circle mb-4 px-4'
            ) );?>
            <h5 class="fw-bolder"><?php the_title();?></h5>
            <div class="fst-italic text-muted"><?php echo $team_function;?></div>
        </div>
    </div>
<?php endwhile; wp_reset_query(); ?>
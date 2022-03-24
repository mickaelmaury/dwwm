<?php
  /*
  * Template Name: Réalisations
  */
?>

<?php
  get_header();

  $page = (get_query_var('paged')) ? get_query_var('paged') : 1;

  $custom_args = array(
    'post_type' => 'portfolio', // filtre sur le CPT
    'post_per_page' => 5,
    'post_status' => 'published',
    'order_by' => 'post_date',
    'order' => 'desc',
    'page' => $paged
  );

  $custom_query = new WP_Query($custom_args);

  if($custom_query->have_posts()) :
    while($custom_query->have_posts()) : $custom_query->the_post();?>
      <header class='page-header'>
        <h3 class='entry-title'>
          <a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title();?></a>
        </h3>
      </header>
      <div class='entry-content'>
        <?php the_excerpt(); ?>
      </div>
    <?php
    endwhile;
  endif;

  wp_reset_postdata();

  get_footer();
?>

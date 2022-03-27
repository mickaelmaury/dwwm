<!-- Boucle WordPress -->
<?php if ( have_posts() ) :?>
<?php while ( have_posts() ) : the_post(); ?>
  <!-- Titre --> 
  <h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3> 
  <!-- contenu -->
  <?php the_content(); ?>
<?php endwhile; else: ?> 
  <p>Aucun resultat</p>
<?php endif; ?>
<!--Fin Boucle WordPress-->

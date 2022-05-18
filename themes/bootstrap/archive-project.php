<?php

get_header();

?>
<!-- Portfolio Grid-->
<section class="page-section bg-light py-5" id="portfolio">
	<div class="container">
		<?php if (get_theme_mod('voir_texte_boite_alerte') == true) { ?>
			<div class="card text-white bg-secondary my-5 py-4" id="page_full_width_card">
				<div class="card-body">
					<p class="text-white m-0"><?php echo get_theme_mod('texte_boite_alerte', 'Bienvenue'); ?></p>
				</div>
			</div>
		<?php } ?>
		<div class="row mb-3 text-center">
			<div id="filters" class="button-group">
				<a class="btn btn-dark text-white is-checked" role="button" data-filter="*"><?php _e('ALL', 'bootstrap'); ?></a>
                <?php $filters = get_terms( 'project-type' );
                foreach ($filters as $filter ) {
                    echo '<a class="btn btn-dark text-white" role="button" data-filter="'.$filter->slug.'">'.$filter->name.'</a>';
                } ?>
            </div>
		</div>
		<div class="row">
			<?php $paged = get_query_var('paged') ? get_query_var('paged') : 1; ?>
			<?php $loop = new WP_Query(array('post_type' => 'project', 'posts_per_page' => 3, 'paged' => $paged)); ?>
			<?php $cpt = 0; ?>
			<?php while ($loop->have_posts()) : $loop->the_post(); ?>
				<div class="col-lg-4 col-sm-6 mb-4">
					<!-- Portfolio item -->
					<div class="portfolio-item">
						<a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal<?php echo $cpt; ?>">
							<div class="portfolio-hover">
								<div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
							</div>
							<img class="img-fluid" src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>" alt="<?php echo get_the_title(); ?>" />
						</a>
						<div class="portfolio-caption">
							<div class="portfolio-caption-heading"><?php the_title(); ?></div>
							<?php
							$categories = strip_tags(get_the_term_list(get_the_ID(), 'project-type', ' ', ', '));
							?>
							<div class="portfolio-caption-subheading text-muted"><?php echo $categories; ?></div>
						</div>
					</div>
				</div>
				<!-- Portfolio item modal popup-->
				<div class="portfolio-modal modal fade" id="portfolioModal<?php echo $cpt; ?>" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="close-modal" data-bs-dismiss="modal"><img class="close-modal-icon" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/close-icon.svg" alt="Close modal" /></div>
							<div class="container">
								<div class="row justify-content-center">
									<div class="col-lg-8">
										<div class="modal-body">
											<!-- Project details-->
											<h2 class="text-uppercase"><?php the_title(); ?></h2>
											<img class="img-fluid d-block mx-auto" src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>" alt="<?php the_title(); ?>" />
											<?php the_content(); ?>
											<ul class="list-inline">
												<li>
													<strong><?php _e('Category :', 'bootstrap'); ?></strong>
													<?php echo $categories; ?>
												</li>
											</ul>
											<button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
												<i class="fas fa-xmark me-1"></i>
												<?php _e('Close Project', 'bootstrap'); ?>
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php $cpt++; ?>
			<?php endwhile; ?>

			<?php
			wp_reset_postdata();
			?>

			<?php
			if (function_exists('wp_pagenavi')) :
				wp_pagenavi(array('query' => $loop));
			endif;
			?>
		</div>
	</div>
</section>

<?php

get_footer();

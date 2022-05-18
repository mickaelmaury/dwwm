</div>
<?php if ((get_post_type() != 'project') && (!is_404())  && (!is_page()) || (is_search()) || (is_single())) : ?>
	<!-- Side widgets-->
	<div class="col-lg-4">
		<!-- Search widget-->
		<div class="card mb-4">
			<div class="card-header"><?php _e('Search', 'bootstrap'); ?></div>
			<div class="card-body">
				<?php get_search_form(); ?>
			</div>
		</div>
		<!-- Categories widget-->
		<div class="card mb-4">
			<div class="card-header"><?php _e('Categories', 'bootstrap'); ?></div>
			<div class="card-body">
				<div class="row">
					<?php
					$all_categories = get_categories(array(
						'orderby' => 'name',
						'parent'  => 0
					));
					echo "<div class='col-sm-6'>
							<ul class='list-unstyled mb-0'>";
					foreach ($all_categories as $categories_item) {
						echo "<li>";
						printf(
							'<a href="%1$s">%2$s</a><br />',
							esc_url(get_category_link($categories_item->term_id)),
							esc_html($categories_item->name)
						);
						echo "</li>";
					}
					echo "</ul>
						</div>";
					?>
				</div>
			</div>
		</div>
		<!-- Side widget-->
		<?php if (is_active_sidebar('sidebar-content')) :
			dynamic_sidebar('sidebar-content');
		endif;
		?>
	</div>
<?php endif; ?>
</div>
</div>
<!-- Footer-->
<footer class="border-top py-5 bg-dark">
	<div class="container px-5 my-5 px-5">
		<div class="text-center mb-5">
			<h2 class="fw-bolder text-white"><?php _e('Customer testimonials', 'bootstrap'); ?></h2>
			<p class="lead mb-0 text-white"><?php _e('Our customers love working with us', 'bootstrap'); ?></p>
		</div>
		<div class="row gx-5 justify-content-center">
			<div class="col-lg-6">
				<?php $loop = new WP_Query(array('post_type' => 'testimonial')); ?>
				<?php while ($loop->have_posts()) : $loop->the_post(); ?>
					<!-- Testimonial 1-->
					<div class="card mb-4">
						<div class="card-body p-4">
							<div class="d-flex">
								<div class="flex-shrink-0"><i class="bi bi-chat-right-quote-fill text-primary fs-1"></i></div>
								<div class="ms-4">
									<p class="mb-1"><?php the_content() ?></p>
									<div class="small text-muted">- <?php echo get_field('nom_du_client') . ', ' . get_field('ville'); ?></div>
								</div>
							</div>
						</div>
					</div>
				<?php endwhile;
				wp_reset_query(); ?>
			</div>
		</div>
	</div>
	<div class="container px-5 my-5 px-5">
		<div class="text-center mb-5">
			<h2 class="fw-bolder text-white"><?php _e('Our team', 'bootstrap'); ?></h2>
			<p class="lead mb-0 text-white"><?php _e('Specialists at your service.', 'bootstrap'); ?></p>
		</div>
		<div class="row gx-5 justify-content-center">
			<div class="col-lg-12">
				<section class="py-5 bg-light">
					<div class="container px-5 my-5">
						<div class="row gx-5 row-cols-1 row-cols-sm-2 row-cols-xl-4 justify-content-center">
							<?php
							get_template_part('inc/team');
							?>
						</div>
					</div>
				</section>
			</div>
		</div>
	</div>
	<!-- Contact-->
	<div class="container px-4 px-lg-5 mb-4">
		<div class="row gx-4 gx-lg-5">
			<div class="col-md-4 mb-3 mb-md-0">
				<div class="card py-4 h-100">
					<div class="card-body text-center">
						<i class="fas fa-map-marked-alt text-primary mb-2"></i>
						<h4 class="text-uppercase m-0"><?php _e('Address', 'bootstrap'); ?></h4>
						<hr class="my-4 mx-auto" />
						<div class="small text-black-50"><?php echo get_theme_mod('adresse_postale'); ?></div>
					</div>
				</div>
			</div>
			<div class="col-md-4 mb-3 mb-md-0">
				<div class="card py-4 h-100">
					<div class="card-body text-center">
						<i class="fas fa-envelope text-primary mb-2"></i>
						<h4 class="text-uppercase m-0"><?php _e('Email', 'bootstrap'); ?></h4>
						<hr class="my-4 mx-auto" />
						<div class="small text-black-50"><a href="mailto:<?php echo get_theme_mod('adresse_email'); ?>"><?php echo get_theme_mod('adresse_email'); ?></a></div>
					</div>
				</div>
			</div>
			<div class="col-md-4 mb-3 mb-md-0">
				<div class="card py-4 h-100">
					<div class="card-body text-center">
						<i class="fas fa-mobile-alt text-primary mb-2"></i>
						<h4 class="text-uppercase m-0"><?php _e('Phone', 'bootstrap'); ?></h4>
						<hr class="my-4 mx-auto" />
						<div class="small text-black-50"><?php echo get_theme_mod('numero_telephone'); ?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container px-4 px-lg-5">
		<!-- Map-->
		<div class="map mb-4" id="contact">
			<iframe src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=fr&amp;geocode=&amp;q=<?php echo get_theme_mod('adresse_postale'); ?>&amp;aq=0&amp;oq=twitter&amp;sll=28.659344,-81.187888&amp;sspn=0.128789,0.264187&amp;ie=UTF8&amp;hq=Twitter,+Inc.,+Market+Street,+San+Francisco,+CA&amp;t=m&amp;z=15&amp;iwloc=A&amp;output=embed"></iframe>
			<br />
			<small><a href="https://maps.google.com/maps?f=q&amp;source=embed&amp;hl=fr&amp;geocode=&amp;q=<?php echo get_theme_mod('adresse_postale'); ?>&amp;aq=0&amp;oq=twitter&amp;sll=28.659344,-81.187888&amp;sspn=0.128789,0.264187&amp;ie=UTF8&amp;hq=Twitter,+Inc.,+Market+Street,+San+Francisco,+CA&amp;t=m&amp;z=15&amp;iwloc=A"></a></small>
		</div>
		<div class="row gx-4 gx-lg-5 justify-content-center">
			<div class="col-md-10 col-lg-8 col-xl-7">
				<ul class="list-inline text-center">
					<li class="list-inline-item">
						<a target="_blank" href="<?php echo get_theme_mod('twitter'); ?>">
							<span class="fa-stack fa-lg">
								<i class="fas fa-circle fa-stack-2x"></i>
								<i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
							</span>
						</a>
					</li>
					<li class="list-inline-item">
						<a target="_blank" href="<?php echo get_theme_mod('facebook'); ?>">
							<span class="fa-stack fa-lg">
								<i class="fas fa-circle fa-stack-2x"></i>
								<i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
							</span>
						</a>
					</li>
					<li class="list-inline-item">
						<a target="_blank" href="<?php echo get_theme_mod('github'); ?>">
							<span class="fa-stack fa-lg">
								<i class="fas fa-circle fa-stack-2x"></i>
								<i class="fab fa-github fa-stack-1x fa-inverse"></i>
							</span>
						</a>
					</li>
				</ul>
				<div class="small text-center text-muted fst-italic text-white"><?php _e('Copyright', 'bootstrap'); ?> &copy; <?php echo bloginfo('name'); ?> <?php echo date('Y'); ?></div>
			</div>
		</div>
	</div>
	<div class="container px-4 px-lg-5">
		<!-- Menu principal -->
		<?php if (has_nav_menu('footer_menu')) : ?>
			<?php
			wp_nav_menu(array(
				'theme_location'  => 'footer_menu',
				'depth'             => 2, // 1 = no dropdowns, 2 = with dropdowns.
				'container'         => 'div',
				'container_class'   => 'h-100 text-center my-auto',
				'container_id'      => '',
				'menu_class'        => 'list-inline mb-2',
				'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
				'walker'            => new WP_Bootstrap_Navwalker(),
			));

			?>
		<?php endif; ?>
	</div>
</footer>


<?php wp_footer(); ?>
</body>

</html>
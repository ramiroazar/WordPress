<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package _s
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">

		<section>

			<h2 class="footer-title"><?php _e( 'Footer', '_s' ); ?></h2>

			<section id="associations" class="section">

				<div>

					<h2 class="section-title"><?php _e( 'Associations', '_s' ); ?></h2>

					<?php echo do_shortcode("[carousel category='associations' placeholder='true' dynamic='true']"); ?>

				</div>

			</section><!-- .section -->

			<div class="section-group">

				<div>

					<section id="reviews" class="section">

						<div>

							<h2 class="section-title"><?php _e( 'Reviews', '_s' ); ?></h2>

							<?php echo do_shortcode("[review limit='2' carousel='true']"); ?>

						</div>

					</section><!-- .section -->

					<section id="galleries" class="section">

						<div>

							<h2 class="section-title"><?php _e( 'Gallery', '_s' ); ?></h2>

							<?php echo _s_query(array('arguements' => 'post_type=post&posts_per_page=1&category_name=featured&post_format=post-format-gallery', 'markup' => 'partials/gallery')); ?>

						</div>

					</section><!-- .section -->

				</div>

			</div><!-- .section-group -->

			<div class="section-group">

				<div>

					<nav id="site-sitemap" class="site-sitemap section" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">

						<div>

							<h3 class="section-title"><?php _e( 'Sitemap', '_s' ); ?></h3>

							<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_id' => 'secondary-menu' ) ); ?>
						</div>

					</nav><!-- .section -->

					<nav id="site-sitemap-featured" class="site-sitemap-featured section" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">

						<div>

							<h3 class="section-title"><?php _e( 'Sitemap Featured', '_s' ); ?></h3>

							<?php wp_nav_menu( array( 'theme_location' => 'tertiary', 'menu_id' => 'tertiary-menu' ) ); ?>

						</div>

					</nav><!-- .section -->

					<section class="site-contact section">

						<div>

							<h3 class="section-title"><?php _e( 'Contact Details', '_s' ); ?></h3>

							<?php get_template_part( 'partials/contact' ); ?>

							<?php if (!is_page('contact')) : ?>

								<a href="<?php echo get_the_permalink(get_theme_mod('page_display_contact')); ?>" id="form-contact-toggle" class="toggle-lightbox" data-mfp-src="#form-contact"><?php _e( 'Contact', '_s' ); ?></a>

								<div id="form-contact" class="mfp-hide">
									<?php echo do_shortcode("[contact-form-7 id='1']"); ?>
								</div>

							<?php endif; ?>

						</div>

					</section><!-- .section -->

				</div>

			</div><!-- .section-group -->

		</section>

		<div id="copyright" class="section">

			<div>

				<p class="source-org copyright">

					<span class="copyrightMark">
						&copy;
					</span>

					<span itemprop="copyrightYear">
						<?php echo date('Y'); ?>
					</span>

					<span itemprop="copyrightHolder" itemscope itemtype="http://schema.org/Organization">
						<span itemprop="name">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a>.
						</span>
					</span>

					<?php printf(
						__( 'Website Designed & Developed by %2$s.', '_s' ),
						'_s',
						'<span itemscope itemtype="http://schema.org/Organization"><span itemprop="name"><a href="http://www.insightdigital.com.au" rel="designer" itemprop="url">Insight Digital Marketing</a></span></span>'
					); ?>

				</p>

			</div>

		</div><!-- #copyright -->

	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

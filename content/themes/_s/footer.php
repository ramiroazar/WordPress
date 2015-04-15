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
		<section class="section">
			<h2 class="footer-title">Footer</h2>
			<nav id="site-sitemap" class="site-sitemap" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
				<div>
					<h3>Sitemap</h3>
					<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_id' => 'secondary-menu' ) ); ?>
				</div>
			</nav><!-- .site-sitemap -->
			<nav id="site-sitemap-featured" class="site-sitemap-featured" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
				<div>
					<h3>Sitemap Featured</h3>
					<?php wp_nav_menu( array( 'theme_location' => 'tertiary', 'menu_id' => 'tertiary-menu' ) ); ?>
				</div>
			</nav><!-- .site-sitemap-featured -->
			<div class="site-contact">
				<div>
					<h3>Contact Details</h3>

					<?php get_template_part( 'partials/contact' ); ?>
					
					<?php if (!is_page('contact')) : ?>
						<a id="form-contact-toggle" class="toggle-lightbox" href="#form-contact">Contact</a>
						<div id="form-contact" class="mfp-hide">
							<?php echo do_shortcode("[contact-form-7 id='1']"); ?>
						</div>
					<?php endif; ?>
				</div>
			</div><!-- .site-contact -->
		</section>

		<div id="copyright">
			<div>
				<p class="source-org copyright">
					&copy; 
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
						'<span itemscope itemtype="http://schema.org/Organization"><span itemprop="name"><a href="http://www.insightdigital.com.au" rel="designer" itemprop="url">Insight Digital</a></span></span>'
					); ?>
				</p>
			</div>
		</div><!-- #copyright -->

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

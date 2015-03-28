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

	<footer id="colophon" class="site-footer" role="contentinfo">
		<section>
			<h2>Footer</h2>
			<nav id="site-sitemap" class="site-sitemap" role="navigation">
				<div>
					<h3>Sitemap</h3>
					<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_id' => 'secondary-menu' ) ); ?>
				</div>
			</nav><!-- .site-sitemap -->
			<nav id="site-sitemap-featured" class="site-sitemap-featured" role="navigation">
				<div>
					<h3>Sitemap Featured</h3>
					<?php wp_nav_menu( array( 'theme_location' => 'tertiary', 'menu_id' => 'tertiary-menu' ) ); ?>
				</div>
			</nav><!-- .site-sitemap-featured -->
			<div class="site-contact">
				<div>
					<h3>Contact Details</h3>
					<?php get_template_part( 'partials/contact' ); ?>
				</div>
			</div><!-- .site-contact -->
		</section>

		<div id="copyright">
			<div>
				<p class="source-org copyright">
					&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>. 
					<?php printf( __( 'Website Designed & Developed by %2$s.', '_s' ), '_s', '<a href="http://www.insightdigital.com.au" rel="designer">Insight Digital</a>' ); ?>
				</p>
			</div>
		</div><!-- #copyright -->

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

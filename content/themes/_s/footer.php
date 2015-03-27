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
		<div>
			<nav id="site-sitemap" class="site-sitemap" role="navigation">
				<div>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
				</div>
			</nav><!-- .site-sitemap -->
			<div class="site-contact">
				<div>
				</div>
			</div><!-- .site-contact -->
			<div class="site-info">
				<div>
					<a href="<?php echo esc_url( __( 'http://wordpress.org/', '_s' ) ); ?>"><?php printf( __( 'Proudly powered by %s', '_s' ), 'WordPress' ); ?></a>
					<span class="sep"> | </span>
					<?php printf( __( 'Website by %2$s.', '_s' ), '_s', '<a href="http://www.insightdigital.com.au" rel="designer">Insight Digital</a>' ); ?>
				</div>
			</div><!-- .site-info -->
		</div>

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

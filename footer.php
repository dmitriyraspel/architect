<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Architect
 */

?>

	<footer id="colophon" class="site-footer">
		
		<div class="footer__nav-wrap">
		
		<?php
		if ( has_nav_menu( 'footer' ) ) : ?>
		<nav class="footer-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Navigation', 'architect' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'footer',
					'menu_class'     => 'footer-menu reset-list-style',
					'depth'          => 1,
				)
			);
			?>
		</nav><!-- .footer-navigation -->
		<?php endif; ?>

		<?php
		if ( has_nav_menu( 'social' ) ) : 
			get_template_part( 'template-parts/social-nav' );
		endif; 
		?>

		</div><!-- /.footer__nav-wrap -->
		
		<?php get_sidebar() ?>
		
		<div class="site-info">
			
			<span class="site-name"><?php get_bloginfo( 'name' ); ?></span>
			<span class="copyright">&copy; <?php echo esc_html( date_i18n( __( 'Y', 'architect' ) ) ); ?></span>
			<?php
			if ( function_exists( 'the_privacy_policy_link' ) ) {
				the_privacy_policy_link();
			}
			?>

			<span class="sep"> | </span>
			<?php
			/* translators: 1: Theme name, 2: Theme author. */
			printf( esc_html__( 'Architect by %2$s', 'architect' ), 'architect', '<a class="theme-author" href="http://raspel.ru">Raspel</a>' );
			?>
			
		</div><!-- .site-info -->

		<!-- <div class="arrow-top">
			<a class="arrow-top__link" href="#">top</a>
		</div> -->

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

<?php

/**
 * Displays header site branding
 *
 * @package Architect
 *
 */

$blog_info    		= get_bloginfo('name');
$description 		= get_bloginfo('description');
$show_title   		= get_theme_mod('site_logo_and_title');
$show_description	= get_theme_mod('site_title_and_description');

?>

<div class="site-branding">

	<?php
	/* Show site logo ---------------------------------------------------- */
	if (has_custom_logo()) : ?>
		<div class="site-logo"><?php the_custom_logo(); ?></div>
	<?php endif; ?>


	<?php if ( ( ! empty( $blog_info ) && $show_title ) || ( $description && $show_description ) ) : ?>
	<div class="site-branding__inner">
		<?php
		/* 
		*	Show site title
		*/
		if ( ! empty( $blog_info ) && $show_title ) : ?>
			<?php if ( is_front_page() && !is_paged() ) : ?>
				<h1 class="site-title"><?php bloginfo('name'); ?></h1>
			<?php elseif ( is_front_page() || is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url('/') ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url('/') ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php endif; ?>
		<?php endif; ?>


		<?php
		/* 
		*	Show site description
		*/
		if ( $description && $show_description ) : ?>
			<p class="site-description">
				<?php echo $description; ?>
			</p>
		<?php endif; ?>
	</div><!-- /.site-branding__inner -->
	<?php endif; ?>

	

</div><!-- .site-branding -->
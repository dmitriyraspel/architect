<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Architect
 */
$has_primary_nav = has_nav_menu( 'primary' );
$wrapper_classes  = 'site-header';
$wrapper_classes .= has_custom_logo() ? ' has-logo' : '';
$wrapper_classes .= true === get_theme_mod( 'site_logo_and_title', true ) ? ' has-logo-and-title' : '';
$wrapper_classes .= true === get_theme_mod( 'site_title_and_description', true ) ? ' has-title-and-tagline' : '';
$wrapper_classes .= $has_primary_nav ? ' has-menu' : '';
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'architect'); ?></a>

		<header id="masthead" class="<?php echo $wrapper_classes; ?>">
			<div class="header__inner">

				<?php get_template_part('template-parts/header/site-branding'); ?>

				<div class="header-navigation-wrapper">

					<nav id="site-navigation" class="main-navigation">
						<button id="menu-toggle" class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
							<span class="screen-reader-text"><?php esc_html_e('Primary Menu', 'architect'); ?></span>
							<div class="burger">
								<div class="burger__inner">
								</div>
							</div>
						</button>

						<?php
						wp_nav_menu(
							array(
								'theme_location'  => 'primary',
								'container_class' => 'primary-menu-container',
								'menu_class'     	=> 'primary-menu reset-list-style',
								// 'depth'          => '2',
							)
						);
						?>
					</nav><!-- #site-navigation -->

					<!-- <nav class="social-navigation reset-list-style" role="navigation" aria-label="Social Links Menu">
						<ul id="menu-soczialnoe-menyu" class="menu">
							<li id="menu-item-7" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-7"><a href="#"><span class="screen-reader-text">телега</span><svg class="svg-icon" width="26" height="26" aria-hidden="true" role="img" focusable="false" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg">
										<path d="M15.364 16.718l1.688-7.955c0.149-0.7-0.253-0.976-0.712-0.804l-9.918 3.823c-0.677 0.264-0.666 0.643-0.115 0.815l2.537 0.792 5.889-3.708c0.275-0.184 0.528-0.080 0.321 0.103l-4.764 4.305-0.184 2.617c0.264 0 0.379-0.115 0.517-0.253l1.24-1.194 2.571 1.894c0.471 0.264 0.804 0.126 0.93-0.436zM22.286 12c0 5.682-4.603 10.286-10.286 10.286s-10.286-4.603-10.286-10.286 4.603-10.286 10.286-10.286 10.286 4.603 10.286 10.286z"></path>
									</svg></a></li>
						</ul>
					</nav> -->
				</div><!-- /.header-navigation-wrapper -->

			</div><!-- /.header__inner -->
		</header><!-- #masthead -->
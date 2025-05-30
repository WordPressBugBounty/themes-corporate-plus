<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Acme Themes
 * @subpackage Corporate Plus
 */
get_header();
$corporate_plus_customizer_all_values = corporate_plus_get_theme_options();
?>
	<div class="wrapper inner-main-title">
		<?php if ( is_home() && ! is_front_page() ) : ?>
			<header>
				<h1 class="page-title"><?php single_post_title(); ?></h1>
			</header>
		<?php endif; ?>
	</div>
	<div id="content" class="site-content">
		<?php
		if ( 1 == $corporate_plus_customizer_all_values['corporate-plus-show-breadcrumb'] ) {
			corporate_plus_breadcrumbs();
		}
		$sidebar_layout = corporate_plus_sidebar_selection( get_the_ID() );
		if ( 'both-sidebar' == $sidebar_layout ) {
			echo '<div id="primary-wrap" class="clearfix">';
		}
		?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
				<?php
				if ( have_posts() ) :
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();
						/*
						* Include the Post-Format-specific template for the content.
						* If you want to override this in a child theme, then include a file
						* called content-___.php (where ___ is the Post Format name) and that will be used instead.
						*/
						get_template_part( 'template-parts/content', get_post_format() );

					endwhile;
					the_posts_navigation();
				else :
					get_template_part( 'template-parts/content', 'none' );
				endif;
				?>
			</main><!-- #main -->
		</div><!-- #primary -->
		<?php
		get_sidebar( 'left' );
		get_sidebar();
		if ( 'both-sidebar' == $sidebar_layout ) {
			echo '</div>';
		}
		?>
	</div><!-- #content -->
<?php
get_footer();

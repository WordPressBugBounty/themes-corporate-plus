<?php
/**
 * Setting global variables for all theme options saved values
 *
 * @since Corporate Plus 1.0.0
 *
 * @param null
 * @return null
 */
if ( ! function_exists( 'corporate_plus_set_global' ) ) :
	function corporate_plus_set_global() {
		/*Getting saved values start*/
		$corporate_plus_saved_theme_options              = corporate_plus_get_theme_options();
		$GLOBALS['corporate_plus_customizer_all_values'] = $corporate_plus_saved_theme_options;
		/*Getting saved values end*/
	}
endif;
add_action( 'corporate_plus_action_before_head', 'corporate_plus_set_global', 0 );

/**
 * Doctype Declaration
 *
 * @since Corporate Plus 1.0.0
 *
 * @param null
 * @return null
 */
if ( ! function_exists( 'corporate_plus_doctype' ) ) :
	function corporate_plus_doctype() {
		?><!DOCTYPE html><html <?php language_attributes(); ?>>
		<?php
	}
endif;
add_action( 'corporate_plus_action_before_head', 'corporate_plus_doctype', 10 );

/**
 * Code inside head tage but before wp_head funtion
 *
 * @since Corporate Plus 1.0.0
 *
 * @param null
 * @return null
 */
if ( ! function_exists( 'corporate_plus_before_wp_head' ) ) :

	function corporate_plus_before_wp_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php
	}
endif;
add_action( 'corporate_plus_action_before_wp_head', 'corporate_plus_before_wp_head', 10 );

/**
 * Add body class
 *
 * @since Corporate Plus 1.0.0
 *
 * @param null
 * @return null
 */
if ( ! function_exists( 'corporate_plus_body_class' ) ) :

	function corporate_plus_body_class( $corporate_plus_body_classes ) {
		$corporate_plus_customizer_all_values = corporate_plus_get_theme_options();

		if ( 'no-image' == $corporate_plus_customizer_all_values['corporate-plus-blog-archive-layout'] ) {
			$corporate_plus_body_classes[] = 'blog-no-image';
		}
		$corporate_plus_body_classes[] = corporate_plus_sidebar_selection();

		return $corporate_plus_body_classes;
	}
endif;
add_action( 'body_class', 'corporate_plus_body_class', 10, 1 );

/**
 * Start site div
 *
 * @since Corporate Plus 1.0.0
 *
 * @param null
 * @return null
 */
if ( ! function_exists( 'corporate_plus_site_start' ) ) :

	function corporate_plus_site_start() {
		?>
		<div class="site" id="page">
		<?php
	}
endif;
add_action( 'corporate_plus_action_before', 'corporate_plus_site_start', 20 );

/**
 * Skip to content
 *
 * @since Corporate Plus 1.0.0
 *
 * @param null
 * @return null
 */
if ( ! function_exists( 'corporate_plus_skip_to_content' ) ) :

	function corporate_plus_skip_to_content() {
		?>
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'corporate-plus' ); ?></a>
		<?php
	}
endif;
add_action( 'corporate_plus_action_before_header', 'corporate_plus_skip_to_content', 10 );

/**
 * Main header
 *
 * @since Corporate Plus 1.0.0
 *
 * @param null
 * @return null
 */
if ( ! function_exists( 'corporate_plus_header' ) ) :
	function corporate_plus_header() {
		$corporate_plus_customizer_all_values = corporate_plus_get_theme_options();

		$inner_nav = '';
		if ( ! is_front_page() || ( is_front_page() && 'posts' == get_option( 'show_on_front' ) ) ) {
			$inner_nav = ' at-inner-nav';
		}
		$corporate_plus_enable_feature = $corporate_plus_customizer_all_values['corporate-plus-enable-feature'];
		if ( 1 != $corporate_plus_enable_feature ) {
			$inner_nav .= ' navbar-no-fs';
		}
		$corporate_plus_enable_sticky_menu = $corporate_plus_customizer_all_values['corporate-plus-enable-sticky-menu'];
		$navbar_remove_fixed_top           = '';
		if ( 1 != $corporate_plus_enable_sticky_menu ) {
			$navbar_remove_fixed_top = ' navbar-remove-fixed-top';
		}
		$corporate_plus_is_woocommerce_active = corporate_plus_is_woocommerce_active();
		if ( 1 == $corporate_plus_is_woocommerce_active && 1 == $corporate_plus_customizer_all_values['corporate-plus-enable-woo-menu'] ) {
			$inner_nav .= ' at-woo';
		}
		?>
		<div class="navbar navbar-fixed-top <?php echo esc_attr( $inner_nav ); ?> <?php echo esc_attr( $navbar_remove_fixed_top ); ?>" id="navbar" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><i class="fa fa-bars"></i></button>
					<?php
					if ( 'disable' != $corporate_plus_customizer_all_values['corporate-plus-header-id-display-opt'] ) :
						if ( 'logo-only' == $corporate_plus_customizer_all_values['corporate-plus-header-id-display-opt'] ) :
							if ( function_exists( 'the_custom_logo' ) ) :
									the_custom_logo();
							else :
								if ( ! empty( $corporate_plus_customizer_all_values['corporate-plus-header-logo'] ) ) :
									$corporate_plus_header_alt = get_bloginfo( 'name' );
									?>
									<a class="navbar-brand animated" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
											<img src="<?php echo esc_url( $corporate_plus_customizer_all_values['corporate-plus-header-logo'] ); ?>" alt="<?php echo esc_attr( $corporate_plus_header_alt ); ?>" />
										</a>
									<?php
								endif;/*corporate-plus-header-logo*/
							endif;
						else : /*else is title-only or title-and-tagline*/
							if ( is_front_page() && is_home() ) :
								?>
								<h1 class="site-title">
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
								</h1>
							<?php else : ?>
								<p class="site-title">
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
								</p>
								<?php
							endif;
							if ( 'title-and-tagline' == $corporate_plus_customizer_all_values['corporate-plus-header-id-display-opt'] ) :
								$description = get_bloginfo( 'description', 'display' );
								if ( $description || is_customize_preview() ) :
									?>
									<p class="site-description"><?php echo esc_html( $description ); ?></p>
									<?php
								endif;
							endif;
						endif;
					endif;
					?>
				</div>
				<div class="main-navigation navbar-collapse collapse">
					<?php
					if ( 1 == $corporate_plus_is_woocommerce_active && 1 == $corporate_plus_customizer_all_values['corporate-plus-enable-woo-menu'] ) {
						$link = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : WC()->cart->get_cart_url();
						?>
						<div class="user-login">
							<a class="cart-contents cart-customlocation" href="<?php echo esc_url( $link ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'corporate-plus' ); ?>"><?php printf( _n( '%d item', '%d items', WC()->cart->cart_contents_count, 'corporate-plus' ), WC()->cart->cart_contents_count ); ?> - <i class="fa fa-shopping-cart"></i> <?php echo WC()->cart->get_cart_total(); ?></a>
							<?php if ( is_user_logged_in() ) { ?>
								<a class="button" href="<?php echo get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ); ?>" title="<?php esc_attr_e( 'My Account', 'corporate-plus' ); ?>"><?php esc_html_e( 'My Account', 'corporate-plus' ); ?></a>
								<?php
							} else {
								?>
								<a class="button" href="<?php echo get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ); ?>" title="<?php esc_attr_e( 'Login / Register', 'corporate-plus' ); ?>"><?php esc_html_e( 'Login / Register', 'corporate-plus' ); ?></a>
							<?php } ?>
						</div>
						<div class='clearfix'></div>
						<?php
					}
					if ( is_front_page() && ! is_home() && has_nav_menu( 'one-page' ) ) {
						wp_nav_menu(
							array(
								'theme_location' => 'one-page',
								'menu_id'        => 'primary-menu',
								'menu_class'     => 'nav navbar-nav navbar-right animated acme-one-page',
							)
						);
					} else {
						wp_nav_menu(
							array(
								'theme_location' => 'primary',
								'menu_id'        => 'primary-menu',
								'menu_class'     => 'nav navbar-nav navbar-right animated acme-normal-page',
							)
						);
					}
					?>
				</div>
				<!--/.nav-collapse -->
			</div>
		</div>
		<?php
		if ( 1 != $corporate_plus_enable_feature ) {
			echo "<div class='no-fs-clearfix'></div>";
		}
	}
endif;
add_action( 'corporate_plus_action_header', 'corporate_plus_header', 10 );

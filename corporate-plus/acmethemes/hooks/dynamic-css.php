<?php
/**
 * Dynamic css
 *
 * @since Corporate Plus 1.0.0
 *
 * @param null
 * @return null
 */
if ( ! function_exists( 'corporate_plus_dynamic_css' ) ) :

	function corporate_plus_dynamic_css() {

		$corporate_plus_customizer_all_values = corporate_plus_get_theme_options();
		/*Color options */
		$corporate_plus_primary_color = esc_attr( $corporate_plus_customizer_all_values['corporate-plus-primary-color'] );
		/*animation*/
		$corporate_plus_enable_animation = $corporate_plus_customizer_all_values['corporate-plus-enable-animation'];
		$custom_css                      = '';

		/*background*/
		if ( get_header_image() ) {
			$bg_image_url = get_header_image();
		} else {
			$bg_image_url = get_template_directory_uri() . '/assets/img/startup-slider.jpg';
		}
		$custom_css .= "
              .inner-main-title {
                background-image:url('{$bg_image_url}');
                background-repeat:no-repeat;
                background-size:cover;
                background-attachment:fixed;
            }";
		/*color*/
		$custom_css .= "
            a:hover,
            a:active,
            a:focus,
            .btn-primary:hover,
            .widget li a:hover,
            .posted-on a:hover,
            .cat-links a:hover,
            .comments-link a:hover,
            .edit-link a:hover,
            .tags-links a:hover,
            .byline a:hover,
            .nav-links a:hover,
            .bx-controls-direction a:hover i,
            .scroll-wrap.arrow:hover span,
             .at-woo .cart-contents:hover,
            .btn-primary:focus,
            .widget li a:focus,
            .posted-on a:focus,
            .cat-links a:focus,
            .comments-link a:focus,
            .edit-link a:focus,
            .tags-links a:focus,
            .byline a:focus,
            .nav-links a:focus,
            .bx-controls-direction a:focus i{
                color: {$corporate_plus_primary_color};
            }";

		/*background color*/
		$custom_css .= "
            .navbar .navbar-toggle:hover,
            .navbar .navbar-toggle:focus,
            .main-navigation .acme-normal-page .current_page_item > a:before,
            .main-navigation .acme-normal-page .current-menu-item > a:before,
            .main-navigation .active > a:before,
            .main-navigation .current_page_ancestor > a:before,
            .comment-form .form-submit input,
            .read-more,
            .btn-primary,
            .circle,
            .line > span,
            .wpcf7-form input.wpcf7-submit,
            .wpcf7-form input.wpcf7-submit:hover,
            .wpcf7-form input.wpcf7-submit:focus,
            .breadcrumb,
         .woocommerce #content #primary  ul.products li.product .button,
         .woocommerce ul.products li.product .onsale,
         .woocommerce span.onsale,
         .woocommerce #respond input#submit.alt,
         .woocommerce a.button.alt,
         .woocommerce button.button.alt,
         .woocommerce input.button.alt,
         .woocommerce #respond input#submit,
         .woocommerce a.button,
         .woocommerce button.button,
         .woocommerce input.button,
         .at-woo .user-login .button{
                background-color: {$corporate_plus_primary_color};
            }";

		/*borders*/
		$custom_css .= "
            .blog article.sticky,
            .btn-primary:before{
                border: 2px solid {$corporate_plus_primary_color};
            }";

		$custom_css .= "
            .comment-form .form-submit input,
            .read-more,
            .at-woo .user-login .button,
            .at-woo .cart-contents{
                border: 1px solid {$corporate_plus_primary_color};
            }";

		$custom_css .= "
            .wpcf7-form input.wpcf7-submit::before {
                border: 4px solid {$corporate_plus_primary_color};
            }";

		$custom_css .= "
             .breadcrumb::after {
                border-left: 5px solid {$corporate_plus_primary_color};
            }";

		$custom_css .= "
            .rtl .breadcrumb::after {
                border-right: 5px solid {$corporate_plus_primary_color};
                border-left: medium none;
            }";

		/*animation*/
		if ( 1 == $corporate_plus_enable_animation ) {
			$custom_css .= '
            .init-animate {
                visibility: visible;
            }
            ';
		}
		/*custom css*/
		$corporate_plus_custom_css = wp_strip_all_tags( $corporate_plus_customizer_all_values['corporate-plus-custom-css'] );
		if ( ! empty( $corporate_plus_custom_css ) ) {
			$custom_css .= $corporate_plus_custom_css;
		}
		wp_add_inline_style( 'corporate-plus-style', $custom_css );
	}
endif;
add_action( 'wp_enqueue_scripts', 'corporate_plus_dynamic_css', 99 );

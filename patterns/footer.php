<?php
/**
 * Title: Footer
 * Slug: bubbledew/footer
 * Categories: footer
 * Block Types: core/template-part/footer
 * Description: Site footer on a leaf band: brand, tagline, a quiet row of links, then copyright, credit and a back-to-top link.
 * Viewport Width: 1280
 *
 * @package bubbledew
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$bubbledew_credit = sprintf(
	/* translators: %s: WordPress. */
	esc_html__( 'Proudly powered by %s', 'bubbledew' ),
	'<a href="' . esc_url( __( 'https://wordpress.org/', 'bubbledew' ) ) . '" rel="nofollow">WordPress</a>'
);

$bubbledew_credit_tags = array(
	'a' => array(
		'href' => array(),
		'rel'  => array(),
	),
);

?>
<!-- wp:group {"metadata":{"name":"Footer band"},"className":"bubbledew-band bubbledew-band--footer","style":{"spacing":{"padding":{"top":"var:preset|spacing|xl","bottom":"var:preset|spacing|l"},"blockGap":"var:preset|spacing|l"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group bubbledew-band bubbledew-band--footer" style="padding-top:var(--wp--preset--spacing--xl);padding-bottom:var(--wp--preset--spacing--l)"><!-- wp:group {"metadata":{"name":"Footer top"},"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|m"}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group alignwide"><!-- wp:group {"metadata":{"name":"Footer brand"},"className":"bubbledew-footer__brand","style":{"spacing":{"blockGap":"var:preset|spacing|xs"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group bubbledew-footer__brand"><!-- wp:site-logo {"width":48,"shouldSyncIcon":false,"className":"is-style-pebble"} /-->

<!-- wp:site-title {"level":2,"className":"is-style-highlight","fontSize":"l"} /-->

<!-- wp:site-tagline {"fontSize":"s"} /--></div>
<!-- /wp:group -->

<!-- wp:navigation {"overlayMenu":"never","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"right"},"style":{"spacing":{"blockGap":"var:preset|spacing|m"}},"fontSize":"s"} /--></div>
<!-- /wp:group -->

<!-- wp:separator {"align":"wide","backgroundColor":"contrast-medium"} -->
<hr class="wp-block-separator alignwide has-text-color has-contrast-medium-color has-alpha-channel-opacity has-contrast-medium-background-color has-background"/>
<!-- /wp:separator -->

<!-- wp:group {"metadata":{"name":"Footer meta"},"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|xs"},"typography":{"fontWeight":"700"}},"textColor":"contrast-dark","fontSize":"xs","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group alignwide has-contrast-dark-color has-text-color has-xs-font-size" style="font-weight:700"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|xs"}},"layout":{"type":"flex","flexWrap":"wrap","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:paragraph -->
<p>© <?php echo esc_html( gmdate( 'Y' ) ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:site-title {"level":0,"isLink":false} /-->

<!-- wp:paragraph {"className":"dot-before"} -->
<p class="dot-before"><?php echo wp_kses( $bubbledew_credit, $bubbledew_credit_tags ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"fontSize":"xs"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-xs-font-size has-custom-font-size wp-element-button" href="#"><?php esc_html_e( 'Back to top', 'bubbledew' ); ?> ↑</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

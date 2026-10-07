<?php
/**
 * Title: Footer
 * Slug: bubbledew/footer
 * Categories: footer
 * Block Types: core/template-part/footer
 * Description: Site footer on a leaf band: brand, tagline, footer navigation, then copyright, credit and a back-to-top link.
 * Viewport Width: 1280
 *
 * @package bubbledew
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<!-- wp:group {"metadata":{"name":"Footer band"},"className":"bubbledew-band bubbledew-band--footer","style":{"spacing":{"padding":{"top":"var:preset|spacing|xl","bottom":"var:preset|spacing|l"},"blockGap":"var:preset|spacing|l"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group bubbledew-band bubbledew-band--footer" style="padding-top:var(--wp--preset--spacing--xl);padding-bottom:var(--wp--preset--spacing--l)"><!-- wp:group {"metadata":{"name":"Footer top"},"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|m"}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"top"}} -->
<div class="wp-block-group alignwide"><!-- wp:group {"metadata":{"name":"Footer brand"},"className":"bubbledew-footer__brand","style":{"spacing":{"blockGap":"var:preset|spacing|xs"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group bubbledew-footer__brand"><!-- wp:site-logo {"width":48,"shouldSyncIcon":false,"className":"bubbledew-brand__mark"} /-->

<!-- wp:site-title {"level":2,"className":"is-style-highlight","fontSize":"l"} /-->

<!-- wp:site-tagline {"fontSize":"s"} /--></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Footer navigation"},"className":"bubbledew-footer__nav","style":{"spacing":{"blockGap":"var:preset|spacing|xs"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group bubbledew-footer__nav"><!-- wp:heading {"level":2,"className":"is-style-highlight","fontSize":"s"} -->
<h2 class="wp-block-heading is-style-highlight has-s-font-size"><?php esc_html_e( 'Around the site', 'bubbledew' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:navigation {"className":"bubbledew-pills","overlayMenu":"never","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"right"},"fontSize":"s"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:separator {"className":"bubbledew-footer__rule","align":"wide","style":{"color":{"background":"#d9cdbe"}}} -->
<hr class="wp-block-separator alignwide has-text-color has-alpha-channel-opacity has-background bubbledew-footer__rule" style="background-color:#d9cdbe;color:#d9cdbe"/>
<!-- /wp:separator -->

<!-- wp:group {"metadata":{"name":"Footer meta"},"align":"wide","className":"bubbledew-meta bubbledew-footer__meta","style":{"spacing":{"blockGap":"var:preset|spacing|xs"}},"textColor":"contrast-dark","fontSize":"xs","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group alignwide bubbledew-meta bubbledew-footer__meta has-contrast-dark-color has-text-color has-xs-font-size"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|xs"}},"layout":{"type":"flex","flexWrap":"wrap","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:paragraph -->
<p>© <?php echo esc_html( gmdate( 'Y' ) ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:site-title {"level":0,"isLink":false} /-->

<!-- wp:paragraph {"className":"dot-before"} -->
<p class="dot-before"><?php
printf(
	/* translators: %s: WordPress. */
	esc_html__( 'Proudly powered by %s', 'bubbledew' ),
	'<a href="' . esc_url( __( 'https://wordpress.org/', 'bubbledew' ) ) . '" rel="nofollow">WordPress</a>'
);
?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:paragraph -->
<p><a href="#" class="bubbledew-footer__top"><?php esc_html_e( 'Back to top', 'bubbledew' ); ?> ↑</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

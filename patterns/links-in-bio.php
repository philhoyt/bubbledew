<?php
/**
 * Title: Links in bio
 * Slug: bubbledew/links-in-bio
 * Categories: about, buttons
 * Block Types: core/buttons
 * Description: A speech-bubble card with the site logo, title and tagline, a stack of pill buttons and social icons. Made for the Page without title template.
 * Viewport Width: 600
 *
 * @package bubbledew
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<!-- wp:group {"metadata":{"name":"Links in bio"},"className":"is-style-speech-bubble","style":{"spacing":{"blockGap":"var:preset|spacing|s","margin":{"top":"var:preset|spacing|l","bottom":"var:preset|spacing|xl"},"padding":{"top":"var:preset|spacing|l","right":"var:preset|spacing|l","bottom":"var:preset|spacing|l","left":"var:preset|spacing|l"}}},"layout":{"type":"constrained","contentSize":"420px"}} -->
<div class="wp-block-group is-style-speech-bubble" style="margin-top:var(--wp--preset--spacing--l);margin-bottom:var(--wp--preset--spacing--xl);padding-top:var(--wp--preset--spacing--l);padding-right:var(--wp--preset--spacing--l);padding-bottom:var(--wp--preset--spacing--l);padding-left:var(--wp--preset--spacing--l)"><!-- wp:site-logo {"width":96,"shouldSyncIcon":false,"align":"center","className":"is-style-pebble"} /-->

<!-- wp:site-title {"level":1,"textAlign":"center","className":"is-style-highlight"} /-->

<!-- wp:site-tagline {"textAlign":"center","fontSize":"s"} /-->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|m"}}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch"}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--m)"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button"><?php esc_html_e( 'Read the latest post', 'bubbledew' ); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"backgroundColor":"secondary"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-secondary-background-color has-background wp-element-button"><?php esc_html_e( 'Subscribe to the newsletter', 'bubbledew' ); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"backgroundColor":"tertiary"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-tertiary-background-color has-background wp-element-button"><?php esc_html_e( 'Say hello', 'bubbledew' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:social-links {"className":"is-style-logos-only","style":{"spacing":{"margin":{"top":"var:preset|spacing|s"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
<ul class="wp-block-social-links is-style-logos-only" style="margin-top:var(--wp--preset--spacing--s)"><!-- wp:social-link {"url":"#","service":"instagram"} /-->

<!-- wp:social-link {"url":"#","service":"mastodon"} /-->

<!-- wp:social-link {"url":"#","service":"youtube"} /-->

<!-- wp:social-link {"url":"#","service":"feed"} /--></ul>
<!-- /wp:social-links --></div>
<!-- /wp:group -->

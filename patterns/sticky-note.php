<?php
/**
 * Title: Sticky note
 * Slug: bubbledew/sticky-note
 * Categories: text, about
 * Block Types: core/group
 * Description: A butter-yellow note with a strip of tape, a highlighted heading and a short paragraph. Good for what you are up to right now.
 * Viewport Width: 400
 *
 * @package bubbledew
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<!-- wp:group {"metadata":{"name":"Sticky note"},"className":"is-style-sticky-note","style":{"spacing":{"blockGap":"var:preset|spacing|xs"}},"layout":{"type":"default"}} -->
<div class="wp-block-group is-style-sticky-note"><!-- wp:heading {"className":"is-style-highlight","fontSize":"m"} -->
<h2 class="wp-block-heading is-style-highlight has-m-font-size"><?php esc_html_e( 'Right now', 'bubbledew' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"s"} -->
<p class="has-s-font-size"><?php esc_html_e( 'What you are reading, making or thinking about this week.', 'bubbledew' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

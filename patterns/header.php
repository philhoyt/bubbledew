<?php
/**
 * Title: Header
 * Slug: bubbledew/header
 * Categories: header
 * Block Types: core/template-part/header
 * Description: Site header on a sky band: logo, highlighted title, speech-bubble tagline and pill navigation.
 * Viewport Width: 1280
 *
 * @package bubbledew
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<!-- wp:group {"metadata":{"name":"Header band"},"className":"bubbledew-band bubbledew-band--header","style":{"spacing":{"padding":{"top":"var:preset|spacing|l","bottom":"var:preset|spacing|m"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group bubbledew-band bubbledew-band--header" style="padding-top:var(--wp--preset--spacing--l);padding-bottom:var(--wp--preset--spacing--m)"><!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|m"}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group alignwide"><!-- wp:group {"metadata":{"name":"Brand"},"className":"bubbledew-brand","style":{"spacing":{"blockGap":"var:preset|spacing|s"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group bubbledew-brand"><!-- wp:site-logo {"width":56,"shouldSyncIcon":false,"className":"bubbledew-brand__mark"} /-->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|xs"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group"><!-- wp:site-title {"className":"is-style-highlight"} /-->

<!-- wp:site-tagline {"className":"is-style-speech-bubble","fontSize":"xs"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Navigation and hooked blocks"},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:navigation {"className":"bubbledew-pills","layout":{"type":"flex","setCascadingProperties":true,"justifyContent":"right","orientation":"horizontal"},"style":{"spacing":{"margin":{"top":"0"}}}} -->
<!-- wp:page-list /-->
<!-- /wp:navigation --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

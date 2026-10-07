<?php
/**
 * Title: Keep reading
 * Slug: bubbledew/keep-reading
 * Categories: query, posts
 * Block Types: core/query
 * Description: The three most recent posts, not counting the one being read, as a short list under a highlighted heading.
 * Viewport Width: 800
 *
 * @package bubbledew
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<!-- wp:group {"metadata":{"name":"Keep reading"},"style":{"spacing":{"blockGap":"var:preset|spacing|s","margin":{"top":"var:preset|spacing|xl"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--xl)"><!-- wp:heading {"className":"is-style-highlight","fontSize":"l"} -->
<h2 class="wp-block-heading is-style-highlight has-l-font-size"><?php esc_html_e( 'Keep reading', 'bubbledew' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:query {"queryId":30,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"exclude","inherit":false,"taxQuery":null,"parents":[],"excludeCurrent":true},"layout":{"type":"default"}} -->
<div class="wp-block-query"><!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|xs"}},"layout":{"type":"default"}} -->
<!-- wp:group {"metadata":{"name":"Recent post"},"style":{"spacing":{"blockGap":"var:preset|spacing|xs"}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:post-title {"level":3,"isLink":true,"fontSize":"m"} /-->

<!-- wp:post-date {"isLink":true,"textColor":"contrast-dark","fontSize":"xs"} /--></div>
<!-- /wp:group -->
<!-- /wp:post-template -->

<!-- wp:query-no-results -->
<!-- wp:paragraph -->
<p><?php echo esc_html_x( 'Nothing else to read yet.', 'Shown under a post when there are no other posts.', 'bubbledew' ); ?></p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results --></div>
<!-- /wp:query --></div>
<!-- /wp:group -->

<?php
/**
 * Title: Author card
 * Slug: bubbledew/hidden-author-card
 * Inserter: no
 * Description: Avatar, "Written by" line, author name and biography in a card under a post, with three more posts by the same author.
 * Viewport Width: 800
 *
 * @package bubbledew
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<!-- wp:group {"metadata":{"name":"Author card"},"className":"is-style-card","style":{"spacing":{"padding":{"top":"var:preset|spacing|m","right":"var:preset|spacing|m","bottom":"var:preset|spacing|m","left":"var:preset|spacing|m"},"blockGap":"var:preset|spacing|m","margin":{"top":"var:preset|spacing|xl"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group is-style-card" style="margin-top:var(--wp--preset--spacing--xl);padding-top:var(--wp--preset--spacing--m);padding-right:var(--wp--preset--spacing--m);padding-bottom:var(--wp--preset--spacing--m);padding-left:var(--wp--preset--spacing--m)"><!-- wp:group {"metadata":{"name":"Author"},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group"><!-- wp:avatar {"size":64,"isLink":true} /-->

<!-- wp:group {"metadata":{"name":"Author details"},"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"700","textTransform":"uppercase","letterSpacing":"0.08em"}},"textColor":"contrast-dark","fontSize":"xs"} -->
<p class="has-contrast-dark-color has-text-color has-xs-font-size" style="font-weight:700;letter-spacing:0.08em;text-transform:uppercase"><?php esc_html_e( 'Written by', 'bubbledew' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:post-author-name {"isLink":true,"style":{"typography":{"fontWeight":"700"}},"fontSize":"l","fontFamily":"heading"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:post-author-biography {"fontSize":"s"} /-->

<!-- wp:group {"metadata":{"name":"More from this author"},"style":{"spacing":{"blockGap":"var:preset|spacing|xs"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><?php // A heading, not a paragraph like "Written by": the post titles under it are h3s and must follow an h2. ?>
<!-- wp:heading {"style":{"typography":{"fontWeight":"700","textTransform":"uppercase","letterSpacing":"0.08em"}},"textColor":"contrast-dark","fontSize":"xs"} -->
<h2 class="wp-block-heading has-contrast-dark-color has-text-color has-xs-font-size" style="font-weight:700;letter-spacing:0.08em;text-transform:uppercase"><?php esc_html_e( 'More from this author', 'bubbledew' ); ?></h2>
<!-- /wp:heading -->

<?php // The author is filled in at render time by Bubbledew\Setup\author_posts_query_context(); see inc/setup.php. ?>
<!-- wp:query {"queryId":32,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"ignore","inherit":false,"taxQuery":null,"parents":[],"excludeCurrent":true},"namespace":"bubbledew/author-posts","layout":{"type":"default"}} -->
<div class="wp-block-query"><!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|xs"}},"layout":{"type":"default"}} -->
<!-- wp:group {"metadata":{"name":"Author post"},"style":{"spacing":{"blockGap":"var:preset|spacing|xs"}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:post-title {"level":3,"isLink":true,"fontSize":"m"} /-->

<!-- wp:post-date {"isLink":true,"textColor":"contrast-dark","fontSize":"xs"} /--></div>
<!-- /wp:group -->
<!-- /wp:post-template -->

<!-- wp:query-no-results -->
<!-- wp:paragraph {"fontSize":"s"} -->
<p class="has-s-font-size"><?php echo esc_html_x( 'This is their first post.', 'Shown in the author card when the author has written nothing else.', 'bubbledew' ); ?></p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results --></div>
<!-- /wp:query --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

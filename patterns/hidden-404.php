<?php
/**
 * Title: 404
 * Slug: bubbledew/hidden-404
 * Inserter: no
 *
 * @package bubbledew
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<!-- wp:group {"metadata":{"name":"Not found"},"className":"is-style-speech-bubble bubbledew-404","style":{"spacing":{"blockGap":"var:preset|spacing|s","margin":{"top":"var:preset|spacing|l","bottom":"var:preset|spacing|xl"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group is-style-speech-bubble bubbledew-404" style="margin-top:var(--wp--preset--spacing--l);margin-bottom:var(--wp--preset--spacing--xl)"><!-- wp:heading {"level":1,"className":"is-style-highlight"} -->
<h1 class="wp-block-heading is-style-highlight"><?php echo esc_html_x( 'Page not found', '404 error page heading', 'bubbledew' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php echo esc_html_x( 'The page you are looking for doesn\'t exist, or it has been moved. Please try searching using the form below.', '404 error page body text', 'bubbledew' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:pattern {"slug":"bubbledew/hidden-search"} /--></div>
<!-- /wp:group -->

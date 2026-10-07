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
<!-- wp:group {"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading"><?php echo esc_html_x( 'Page not found', '404 error page heading', 'bubbledew' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php echo esc_html_x( 'The page you are looking for doesn\'t exist, or it has been moved. Please try searching using the form below.', '404 error page body text', 'bubbledew' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:pattern {"slug":"bubbledew/hidden-search"} /--></div>
<!-- /wp:group -->

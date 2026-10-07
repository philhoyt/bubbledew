<?php
/**
 * Clear the active theme's pattern cache and report how many patterns register.
 *
 * WordPress caches the files under patterns/ in a site transient keyed to the
 * theme version, so a new or renamed pattern file does not register until
 * Version changes. Run through WP-CLI:
 *
 *   npm run patterns:flush
 *   bin/wp.sh eval-file bin/flush-patterns.php
 *
 * Defining WP_DEVELOPMENT_MODE as 'theme' on the dev site turns the cache off.
 *
 * @package bubbledew
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$bubbledew_theme = wp_get_theme();

if ( is_callable( array( $bubbledew_theme, 'delete_pattern_cache' ) ) ) {
	$bubbledew_theme->delete_pattern_cache();
} else {
	// Not public in every release inside the supported range.
	$bubbledew_method = new ReflectionMethod( $bubbledew_theme, 'delete_pattern_cache' );
	$bubbledew_method->setAccessible( true );
	$bubbledew_method->invoke( $bubbledew_theme );
}

WP_CLI::success(
	sprintf(
		'%d patterns registered for %s.',
		count( $bubbledew_theme->get_block_patterns() ),
		$bubbledew_theme->get_stylesheet()
	)
);

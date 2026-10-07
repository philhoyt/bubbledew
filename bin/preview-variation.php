<?php
/**
 * Applies a theme style variation to the site's user global styles record, the
 * way choosing it in the Styles panel does, or resets the record. For looking at
 * a preset on the dev site; run through bin/wp.sh with a user, or WordPress
 * cannot attach the theme term and creates an orphan record on every call:
 *
 *   bin/wp.sh eval-file bin/preview-variation.php sakura --user=admin
 *   bin/wp.sh eval-file bin/preview-variation.php reset --user=admin
 *
 * @package bubbledew
 */

$bubbledew_name    = $args[0] ?? 'reset';
$bubbledew_post_id = WP_Theme_JSON_Resolver::get_user_global_styles_post_id();

if ( 'reset' === $bubbledew_name ) {
	wp_update_post(
		array(
			'ID'           => $bubbledew_post_id,
			'post_content' => wp_slash(
				wp_json_encode(
					array(
						'version'                     => 3,
						'isGlobalStylesUserThemeJSON' => true,
					)
				)
			),
		)
	);
	WP_CLI::success( 'Global styles reset.' );
	return;
}

foreach ( WP_Theme_JSON_Resolver::get_style_variations() as $bubbledew_variation ) {
	if ( strtolower( $bubbledew_variation['title'] ) !== strtolower( $bubbledew_name ) ) {
		continue;
	}
	$bubbledew_variation['isGlobalStylesUserThemeJSON'] = true;
	unset( $bubbledew_variation['title'], $bubbledew_variation['slug'] );
	wp_update_post(
		array(
			'ID'           => $bubbledew_post_id,
			'post_content' => wp_slash( wp_json_encode( $bubbledew_variation ) ),
		)
	);
	WP_CLI::success( "Applied {$bubbledew_name}." );
	return;
}

WP_CLI::error( "No style variation called {$bubbledew_name}." );

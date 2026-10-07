<?php
/**
 * Export Site Editor copies of the active theme's templates and parts back to
 * the theme files, so the repository stays the source of truth.
 *
 * A template or part saved in the Site Editor is stored as a wp_template or
 * wp_template_part post and shadows the file of the same slug from then on.
 * This script reports each copy against its file, can write the copy to
 * templates/<slug>.html or parts/<slug>.html (dropping the "theme":"<slug>"
 * attribute the editor adds to template-part references), and can then delete
 * the database copies so the files render again.
 *
 * Usage (the words are positional because WP-CLI rejects unknown --flags on
 * eval-file):
 *   npm run export:templates          # report only (default)
 *   npm run export:templates:write    # write the files, then validate:blocks
 *   npm run export:templates:delete   # validate:blocks, then delete copies whose file matches
 *
 * Exported markup is database content: read the diff before committing it. A
 * copy that inlines a pattern ("patternName") or points a block at a database
 * id ("ref") is flagged, because the file would lose the pattern reference
 * (and its translations) or depend on one site's post ids.
 *
 * Global Styles edits (wp_global_styles) and navigation menus (wp_navigation)
 * are counted but not exported; they are content, not theme files.
 *
 * No declare( strict_types=1 ): `wp eval-file` runs the file through eval(),
 * where the declaration is not the first statement and is a fatal error.
 *
 * @package bubbledew
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$bubbledew_args   = isset( $args ) && is_array( $args ) ? array_map( fn( $a ) => ltrim( (string) $a, '-' ), $args ) : array();
$bubbledew_write  = in_array( 'write', $bubbledew_args, true );
$bubbledew_delete = in_array( 'delete', $bubbledew_args, true );

$bubbledew_theme = wp_get_theme();
$bubbledew_slug  = $bubbledew_theme->get_stylesheet();
$bubbledew_dir   = get_stylesheet_directory();

$bubbledew_posts = get_posts(
	array(
		'post_type'   => array( 'wp_template', 'wp_template_part' ),
		'post_status' => array( 'publish', 'draft', 'auto-draft' ),
		'numberposts' => -1,
		'orderby'     => 'post_type',
		'order'       => 'ASC',
		'tax_query'   => array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query -- one-off maintenance run.
			array(
				'taxonomy' => 'wp_theme',
				'field'    => 'name',
				'terms'    => $bubbledew_slug,
			),
		),
	)
);

WP_CLI::log( sprintf( 'Theme %s (%s)', $bubbledew_theme->get( 'Name' ), $bubbledew_dir ) );

if ( empty( $bubbledew_posts ) ) {
	WP_CLI::success( 'No Site Editor copies of templates or parts. The files are what renders.' );
} else {
	$bubbledew_written = 0;
	$bubbledew_deleted = 0;
	$bubbledew_kept    = 0;

	foreach ( $bubbledew_posts as $bubbledew_post ) {
		$bubbledew_subdir = 'wp_template' === $bubbledew_post->post_type ? 'templates' : 'parts';
		$bubbledew_file   = $bubbledew_dir . '/' . $bubbledew_subdir . '/' . $bubbledew_post->post_name . '.html';
		$bubbledew_label  = $bubbledew_subdir . '/' . $bubbledew_post->post_name . '.html';

		$bubbledew_content = str_replace(
			array( '"theme":"' . $bubbledew_slug . '",', ',"theme":"' . $bubbledew_slug . '"' ),
			'',
			$bubbledew_post->post_content
		);
		$bubbledew_content = rtrim( $bubbledew_content ) . "\n";

		$bubbledew_same = false;
		if ( file_exists( $bubbledew_file ) ) {
			$bubbledew_existing = (string) file_get_contents( $bubbledew_file ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents -- theme file on disk.
			$bubbledew_same     = rtrim( $bubbledew_existing ) === rtrim( $bubbledew_content );
			$bubbledew_state    = $bubbledew_same
				? 'same as the file'
				: sprintf( 'differs from the file (%d lines on disk, %d in the editor copy)', count( explode( "\n", $bubbledew_existing ) ), count( explode( "\n", $bubbledew_content ) ) );
		} else {
			$bubbledew_state = 'new; no file yet';
		}

		WP_CLI::log( sprintf( '- %s (post %d, %s, saved %s): %s', $bubbledew_label, $bubbledew_post->ID, $bubbledew_post->post_status, $bubbledew_post->post_modified, $bubbledew_state ) );

		if ( false !== strpos( $bubbledew_content, '"patternName"' ) ) {
			WP_CLI::warning( sprintf( '%s inlines a pattern ("patternName"). Put the <!-- wp:pattern {"slug":"…"} /--> reference back instead of committing the inlined markup.', $bubbledew_label ) );
		}
		if ( preg_match( '/"ref":\d+/', $bubbledew_content ) ) {
			WP_CLI::warning( sprintf( '%s points a block at a database id ("ref"). That id only exists on this site; remove it before committing.', $bubbledew_label ) );
		}

		if ( $bubbledew_write && ! $bubbledew_same ) {
			if ( ! is_dir( dirname( $bubbledew_file ) ) ) {
				wp_mkdir_p( dirname( $bubbledew_file ) );
			}
			if ( false === file_put_contents( $bubbledew_file, $bubbledew_content ) ) { // phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_operations_file_put_contents -- theme file on disk.
				WP_CLI::error( sprintf( 'Could not write %s', $bubbledew_file ), false );
				continue;
			}
			++$bubbledew_written;
		}

		// Only a copy that the file already matches is deleted, so nothing that
		// has not been written (and validated) is lost.
		if ( $bubbledew_delete ) {
			if ( $bubbledew_same ) {
				wp_delete_post( $bubbledew_post->ID, true );
				++$bubbledew_deleted;
			} else {
				++$bubbledew_kept;
			}
		}
	}

	if ( $bubbledew_write ) {
		WP_CLI::success( sprintf( '%d file(s) written to %s. Review the diff; the database copies still shadow the files.', $bubbledew_written, $bubbledew_dir ) );
	} elseif ( $bubbledew_delete ) {
		WP_CLI::success( sprintf( '%d database cop%s deleted; the files render now.', $bubbledew_deleted, 1 === $bubbledew_deleted ? 'y' : 'ies' ) );
		if ( $bubbledew_kept ) {
			WP_CLI::warning( sprintf( '%d cop%s kept because the file differs. Write them first.', $bubbledew_kept, 1 === $bubbledew_kept ? 'y' : 'ies' ) );
		}
	} else {
		WP_CLI::log( 'Report only: nothing written. npm run export:templates:write writes the files.' );
	}
}

$bubbledew_styles = get_posts(
	array(
		'post_type'   => 'wp_global_styles',
		'post_status' => 'any',
		'numberposts' => -1,
		'tax_query'   => array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query -- one-off maintenance run.
			array(
				'taxonomy' => 'wp_theme',
				'field'    => 'name',
				'terms'    => $bubbledew_slug,
			),
		),
	)
);
foreach ( $bubbledew_styles as $bubbledew_style ) {
	$bubbledew_style_data = json_decode( $bubbledew_style->post_content, true );
	if ( is_array( $bubbledew_style_data ) && ( ! empty( $bubbledew_style_data['styles'] ) || ! empty( $bubbledew_style_data['settings'] ) ) ) {
		WP_CLI::warning( sprintf( 'Global Styles were customised in the editor (post %d, saved %s). Not exported: move the changes into theme.json or a styles/*.json variation by hand, then reset Global Styles in the editor.', $bubbledew_style->ID, $bubbledew_style->post_modified ) );
	}
}

$bubbledew_menus = get_posts(
	array(
		'post_type'   => 'wp_navigation',
		'post_status' => 'publish',
		'numberposts' => -1,
	)
);
if ( ! empty( $bubbledew_menus ) ) {
	WP_CLI::log( sprintf( '%d navigation menu(s) in the database (wp_navigation); menus are content and stay there.', count( $bubbledew_menus ) ) );
}

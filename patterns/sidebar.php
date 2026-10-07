<?php
/**
 * Title: Sidebar
 * Slug: bubbledew/sidebar
 * Categories: text
 * Block Types: core/template-part/sidebar
 * Inserter: no
 * Description: About card, search, categories, latest posts, a sticky note and archives.
 * Viewport Width: 360
 *
 * @package bubbledew
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<!-- wp:group {"metadata":{"name":"Sidebar"},"className":"bubbledew-sidebar","style":{"spacing":{"blockGap":"var:preset|spacing|l"}},"layout":{"type":"default"}} -->
<div class="wp-block-group bubbledew-sidebar"><!-- wp:group {"metadata":{"name":"About"},"className":"is-style-speech-bubble bubbledew-about","style":{"spacing":{"blockGap":"var:preset|spacing|xs"}},"layout":{"type":"default"}} -->
<div class="wp-block-group is-style-speech-bubble bubbledew-about"><!-- wp:image {"width":"104px","height":"auto","sizeSlug":"full","align":"center","className":"is-style-pebble"} -->
<figure class="wp-block-image aligncenter size-full is-resized is-style-pebble"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/avatar-placeholder.svg' ) ); ?>" alt="<?php esc_attr_e( 'A round pastel blob with a leaf sprouting from its head', 'bubbledew' ); ?>" style="width:104px;height:auto"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"textAlign":"center","fontSize":"l"} -->
<h2 class="wp-block-heading has-text-align-center has-l-font-size"><?php esc_html_e( 'Hello there', 'bubbledew' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","fontSize":"s"} -->
<p class="has-text-align-center has-s-font-size"><?php esc_html_e( 'A few lines about who writes here and what the blog is for. Swap the picture for your own.', 'bubbledew' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"fontSize":"s"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-s-font-size has-custom-font-size wp-element-button"><?php esc_html_e( 'More about me', 'bubbledew' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Search"},"className":"is-style-card","style":{"spacing":{"padding":{"top":"var:preset|spacing|m","right":"var:preset|spacing|m","bottom":"var:preset|spacing|m","left":"var:preset|spacing|m"},"blockGap":"var:preset|spacing|s"}},"layout":{"type":"default"}} -->
<div class="wp-block-group is-style-card" style="padding-top:var(--wp--preset--spacing--m);padding-right:var(--wp--preset--spacing--m);padding-bottom:var(--wp--preset--spacing--m);padding-left:var(--wp--preset--spacing--m)"><!-- wp:heading {"className":"is-style-highlight","fontSize":"m"} -->
<h2 class="wp-block-heading is-style-highlight has-m-font-size"><?php esc_html_e( 'Search', 'bubbledew' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:search {"label":"<?php esc_attr_e( 'Search', 'bubbledew' ); ?>","showLabel":false,"placeholder":"<?php esc_attr_e( 'Search posts', 'bubbledew' ); ?>","buttonText":"<?php esc_attr_e( 'Go', 'bubbledew' ); ?>"} /--></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Categories"},"className":"is-style-card","style":{"spacing":{"padding":{"top":"var:preset|spacing|m","right":"var:preset|spacing|m","bottom":"var:preset|spacing|m","left":"var:preset|spacing|m"},"blockGap":"var:preset|spacing|s"}},"layout":{"type":"default"}} -->
<div class="wp-block-group is-style-card" style="padding-top:var(--wp--preset--spacing--m);padding-right:var(--wp--preset--spacing--m);padding-bottom:var(--wp--preset--spacing--m);padding-left:var(--wp--preset--spacing--m)"><!-- wp:heading {"className":"is-style-highlight","fontSize":"m"} -->
<h2 class="wp-block-heading is-style-highlight has-m-font-size"><?php esc_html_e( 'Categories', 'bubbledew' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:categories {"showPostCounts":true,"className":"is-style-pills"} /--></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Latest posts"},"className":"is-style-card","style":{"spacing":{"padding":{"top":"var:preset|spacing|m","right":"var:preset|spacing|m","bottom":"var:preset|spacing|m","left":"var:preset|spacing|m"},"blockGap":"var:preset|spacing|s"}},"layout":{"type":"default"}} -->
<div class="wp-block-group is-style-card" style="padding-top:var(--wp--preset--spacing--m);padding-right:var(--wp--preset--spacing--m);padding-bottom:var(--wp--preset--spacing--m);padding-left:var(--wp--preset--spacing--m)"><!-- wp:heading {"className":"is-style-highlight","fontSize":"m"} -->
<h2 class="wp-block-heading is-style-highlight has-m-font-size"><?php esc_html_e( 'Latest posts', 'bubbledew' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:latest-posts {"postsToShow":4,"displayPostDate":true,"className":"is-style-blob-bullets"} /--></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Right now"},"className":"is-style-sticky-note","style":{"spacing":{"blockGap":"var:preset|spacing|xs"}},"layout":{"type":"default"}} -->
<div class="wp-block-group is-style-sticky-note"><!-- wp:heading {"className":"is-style-highlight","fontSize":"m"} -->
<h2 class="wp-block-heading is-style-highlight has-m-font-size"><?php esc_html_e( 'Right now', 'bubbledew' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"s"} -->
<p class="has-s-font-size"><?php esc_html_e( 'What you are reading, making or thinking about this week.', 'bubbledew' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Archives"},"className":"is-style-card","style":{"spacing":{"padding":{"top":"var:preset|spacing|m","right":"var:preset|spacing|m","bottom":"var:preset|spacing|m","left":"var:preset|spacing|m"},"blockGap":"var:preset|spacing|s"}},"layout":{"type":"default"}} -->
<div class="wp-block-group is-style-card" style="padding-top:var(--wp--preset--spacing--m);padding-right:var(--wp--preset--spacing--m);padding-bottom:var(--wp--preset--spacing--m);padding-left:var(--wp--preset--spacing--m)"><!-- wp:heading {"className":"is-style-highlight","fontSize":"m"} -->
<h2 class="wp-block-heading is-style-highlight has-m-font-size"><?php esc_html_e( 'Archives', 'bubbledew' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:archives {"showPostCounts":true,"className":"is-style-blob-bullets"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

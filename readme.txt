=== Bubbledew ===
Contributors: philhoyt
Requires at least: 6.6
Tested up to: 7.1
Requires PHP: 7.4
Stable tag: 1.2.1
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Tags: blog, two-columns, right-sidebar, wide-blocks, custom-colors, custom-logo, custom-menu, editor-style, featured-images, threaded-comments, block-patterns, block-styles, style-variations, full-site-editing, rtl-language-support, translation-ready

A whimsical pastel blog theme: pebble-shaped post cards, name-tag category badges, pill navigation and a sidebar, built from core blocks

== Description ==

Bubbledew is a block theme for personal blogs. The posts list sits in a narrow column on the left with a sidebar on the right, and every post is a tilted card on the surface colour with its category on a name tag across the top edge. Single posts and pages are a single reading column; under each post come an author card with avatar and biography, a Keep reading list of three other posts, and comments as speech bubbles. Headings are set in Fredoka and body text in Nunito, both shipped with the theme. Pages crossfade in browsers that support cross-document view transitions.

The theme is core blocks and theme.json, so the Site Editor can edit its templates, parts and styles. Each look is a block style you can switch on or off per block in the editor: Card (Group: the tilted post cards and sidebar widgets), Name tag (Post Terms: the category badge across a card's top edge), Pebble (Image, Featured Image, Site Logo), Pills (Navigation, Categories, Post Terms), Blob bullets (Latest Posts, Archives, List), Speech bubble (Group, Paragraph, Site Tagline, Comment Content), Sticky note (Group) and Highlight (Heading, Site Title, Query Title). The header menu uses Pills; a menu without it is a row of plain text links, which is what the footer uses.

The sidebar is a template part. Replace the picture in its about card with your own and edit the text; the Categories and Archives blocks fill themselves. There is no Latest Posts widget, since the feed beside it already shows those posts.

Three colour presets besides the default (Sakura, Dusk and Seaside) share the same palette slugs, so switching between them keeps saved content intact, and each preset is checked against the same contrast table. A Nunito typography preset swaps the Fredoka headings for heavier Nunito ones.

Patterns in the inserter: Keep reading (the three most recent posts, excluding the one being read), Posts grid (two columns of cards), Links in bio (a speech-bubble card with stacked buttons and social icons, for the Page without title template) and Sticky note.

== Installation ==

1. In your admin panel, go to Appearance > Themes and click Add New Theme.
2. Click Upload Theme, choose the Bubbledew zip and click Install Now.
3. Click Activate.

== Frequently Asked Questions ==

= How do I change the colours or the fonts? =

Open the Site Editor, choose Styles, then Colors for the Sakura, Dusk and Seaside presets or Typography for the Nunito preset. Every colour in the palette can also be changed by hand.

= Can a post card be a particular colour? =

Cards all sit on the surface colour. The name-tag badge and the pills take one of four pastels by position in the list, so a post's badge colour depends on where it falls; the theme does not assign colours to categories.

= Why does a sticky post have a star? =

The star marks a post you have pinned with the Stick to the top of the blog setting. It is the only sticker in the theme.

= How do I turn off the tilt and animation? =

The theme honours the reduced motion setting of the operating system or browser. With it on, nothing on the page animates or moves on hover.

== Changelog ==

= 1.2.1 =
* Fix: The newest and oldest posts no longer show an empty pill where the missing previous or next link would be.
* Fix: A previous or next link whose post has no title now reads "Previous post" or "Next post" instead of an empty link; an untitled post gets its date in the browser tab.
* Fix: Previous and next links stack on phones instead of breaking words.
* Fix: Code and preformatted boxes can be reached and scrolled from the keyboard.
* Change: Featured images in the posts list and the Posts grid link to the post.
* Change: Archive titles drop the "Category:" style prefix.
* Change: Quotes are lavender cards with a sticker quote mark; code and preformatted blocks sit in a cream box; classic tables get cell rules.
* Change: The Playground blueprint and demo content moved to _playground/; the README has a Playground badge.

= 1.2.0 =
* Add: Crossfade between pages in browsers that support view transitions. Skipped for people who prefer reduced motion.

= 1.1.0 =
* Add: Author card under every post, with the avatar, a Written by line, the author name and biography.

= 1.0.0 =
* First release for the theme directory.
* Add: Three colour presets (Sakura, Dusk, Seaside) and a Nunito typography preset, each checked against the same contrast table.
* Add: Block styles for each look: Card, Name tag, Pebble, Pills, Blob bullets, Speech bubble, Sticky note and Highlight.
* Add: Keep reading (also under every post), Posts grid, Links in bio and Sticky note patterns.
* Add: Footer with brand, plain text links, copyright, credit and a back-to-top button.
* Change: Cards stay on the surface colour; the sidebar no longer repeats the latest posts.
* Add: Demo content and a Playground blueprint that imports it.

= 0.1.0 =
* Initial release.

== Copyright ==

Bubbledew WordPress Theme, (C) 2026 philhoyt
Bubbledew is distributed under the terms of the GNU GPL.

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 2 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

Bubbledew bundles the following third-party resources:

Fredoka Font
Copyright 2016 The Fredoka Project Authors (https://github.com/hafontia/Fredoka-One)
License: SIL Open Font License, Version 1.1
License URI: https://openfontlicense.org
Source: https://fonts.google.com/specimen/Fredoka

Nunito Font
Copyright 2014 The Nunito Project Authors (https://github.com/googlefonts/nunito)
License: SIL Open Font License, Version 1.1
License URI: https://openfontlicense.org
Source: https://fonts.google.com/specimen/Nunito

The star, avatar placeholder and screenshot artwork were drawn for this theme and are released under the GPL with it.

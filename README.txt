=== Plugin Name ===
Contributors: (this should be a list of wordpress.org userid's)
Donate link: http://www.nightworldonline.com
Tags: comments, spam
Requires at least: 3.0.1
Tested up to: 3.4
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Here is a short description of the plugin.  This should be no more than 150 characters.  No markup here.

== Description ==

This a development Wordpress plugin designed to merge & compress CSS and JS files in a way that doesn't require user supervising.

== Goal ==

1.) Merge and minify CSS files
2.) Merge and minify JS files
3.) Do it in a way that is not requiring user action after changes

== How it works? ==

The plugin automatically detects file changes in enqueued styles and scripts, and if any of them is newer than the merged file, it generates a new one. If everything is up to date, just loads the merged file.
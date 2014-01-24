=== WP RSS Retriever ===
Contributors: tjtaylor
Donate link: http://travistaylor.com/
Tags: rss, rss retriever, wp rss retriever, rss aggregator, rss feed, rss fetch feed, rss fetch, fetch feed
Requires at least: 2.8
Tested up to: 3.8.1
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A lightweight RSS fetch plugin which uses the shortcode [wp_rss_retriever] to fetch and display an RSS feed in an unordered list.

== Description ==

This is a lightweight plugin with no CSS which fetchs an RSS feed and echos it on the page in an unordered list.

Example:

[wp_rss_retriever url="http://travistaylor.com/feed/" items="10" excerpt="50" read_more ="false" new_window="false"]

Properties:

<strong>url</strong>
The URL of the feed you wish to fetch from

<strong>items</strong>
Number of items from the feed you wish to fetch

<strong>excerpt</strong>
How many words you want to display for each item
<em>Default is 0 or infinite</em>

<strong>read_more</strong>
Whether to display a read more link or not
<em>true or false, defaults to true</em>

<strong>new_window</strong>
Whether to open the title link and read more link in a new window
<em>true or false, defaults to true</em>

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload `wp-rss-retriever.zip` to the `/wp-content/plugins/` directory
2. Unzip the file
3. Activate the plugin through the 'Plugins' menu in WordPress
4. Use the shortcode [wp_rss_retriever] anywhere in your content


== Changelog ==

= 1.0 =
* Initial release

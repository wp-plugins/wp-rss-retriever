=== RSS Retriever ===
Contributors: tjtaylor
Donate link: http://travistaylor.com/
Tags: rss, rss retriever, wp rss retriever, rss aggregator, rss feed, rss fetch feed, rss fetch, fetch feed
Requires at least: 2.8
Tested up to: 3.8.1
Stable tag: 3.8.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A simple, lightweight RSS aggregator plugin which uses shortcode to fetch and display a RSS feed.

== Description ==

Note: This plugin does not include CSS. It was created so you could easily style the list to match your website. If you would like to see more features for the plugin, let me know.

<h4>Example:</h4>
<p>[wp_rss_retriever url="http://travistaylor.com/feed/" items="10" excerpt="50" read_more ="false" new_window="false"]</p>

<h4>Properties:</h4>
<ul>
	<li><strong>url</strong> - The url of the feed you wish to fetch from</li>

	<li><strong>items</strong> - Number of items from the feed you wish to fetch <em>(Default is 10)</em></li>

	<li><strong>excerpt</strong> - How many words you want to display for each item</br>
	<em>(Default is 0 or infinite)</em></li>

	<li><strong>read_more</strong> - Whether to display a read more link or not</br>
	<em>(true or false, defaults to true)</em></li>

	<li><strong>new_window</strong> - Whether to open the title link and read more link in a new window</br>
	<em>(true or false, defaults to true)</em></li>
</ul>

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload `wp-rss-retriever.zip` to the `/wp-content/plugins/` directory
2. Unzip the file
3. Activate the plugin through the 'Plugins' menu in WordPress
4. Use the shortcode [wp_rss_retriever] anywhere in your content


== Changelog ==

= 1.0 =
* Initial release

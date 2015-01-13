=== RSS Retriever ===
Contributors: tjtaylor
Donate link: http://travistaylor.com/wp-rss-retriever-demo/
Tags: rss, rss retriever, wp rss retriever, rss aggregator, rss feed, rss fetch feed, rss fetch, fetch feed
Requires at least: 2.8
Tested up to: 4.1
Stable tag: 1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A simple, lightweight RSS aggregator plugin which uses shortcode to fetch and display an RSS feed.

== Description ==

This plugin fetchs an RSS feed and displays it in an unordered list using shortcode.

<h4>Features:</h4>
<ul>
	<li>Fetch as many RSS feeds as you want</li>
	<li>Display the RSS feed wherever you want using shortcode</li>
	<li>Control whether to display the entire RSS feeds content or just an excerpt</li>
	<li>Control how many words display in the excerpt</li>
	<li>Control whether it has a Read more link or not</li>
	<li>Control whether links open in a new window or not</li>
	<li>Simple, lightweight, and fast</li>
	<li>Easy to setup</li>
	<li><strong>*NEW*</strong> Fetch thumbnail or first image</li>
	<li><strong>*NEW*</strong> Control size of thumbnail</li>
	<li><strong>*NEW*</strong> Set cache time (in seconds)</li>
</ul>

<h4>Live Demo:</h4>
<p><a href="http://travistaylor.com/wp-rss-retriever-demo/" target="_blank">http://travistaylor.com/wp-rss-retriever-demo/</a></p>

<h4>Example:</h4>
<pre><code>[wp_rss_retriever url="http://feeds.feedburner.com/TechCrunch/" items="10" excerpt="50" read_more="true" new_window="true" thumbnail="200" cache="7200"]</code></pre>

<h4>Properties:</h4>
<ul>
	<li><strong>url</strong> - The url of the feed you wish to fetch from</li>

	<li><strong>items</strong> - Number of items from the feed you wish to fetch <em>(Default is 10)</em></li>

	<li><strong>excerpt</strong> - How many words you want to display for each item	<em>(Default is 0 or infinite)</em></li>

	<li><strong>read_more</strong> - Whether to display a read more link or not	<em>(true or false, defaults to true)</em></li>

	<li><strong>new_window</strong> - Whether to open the title link and read more link in a new window	<em>(true or false, defaults to true)</em></li>

	<li><strong>thumbnail</strong> - Whether or not you want to display a thumbnail, and if so, what size you want it to be<em>(true or false, defaults to true. Inserting a number will change the size, default is 150)</em></li>

	<li><strong>cache</strong> - How long you want the feed to cache the results in seconds <em>(Default is 43200)</em></li>
</ul>

Note: If you would like to see more features for the plugin, let me know.

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload `wp-rss-retriever.zip` to the `/wp-content/plugins/` directory
2. Unzip the file
3. Activate the plugin through the 'Plugins' menu in WordPress
4. Use the shortcode [wp_rss_retriever] anywhere in your content


== Changelog ==

= 1.0 =
* Initial release

= 1.0.1 =
* Fixes bug where excerpt included html and broken images

= 1.0.2 =
* Pulls images & html in when excerpt is not enabled

= 1.1 =
* Fixed several bugs
* Fetch thumbnail or first image
* Control size of thumbnail
* Set cache time (in seconds)
* Now includes small CSS file, required for thumbnail support

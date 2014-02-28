=== WP Flot ===
Contributors: YSH
Tags: chart, flot, shortcode
Requires at least: 2.5
Tested up to: 3.8.1
Stable tag: 0.1.1
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Adds shortcodes to easily add line and pie charts to your pages using the Flot library.

== Description ==
This plugin adds shortcodes for line charts and pie charts, created with the Flot javascript library.

For more information on Flot: http://www.flotcharts.org/

= Usage =

Set a custom field 'flot' to 'yes', so the plugin knows to load the required javascript. If you wish you can add these files to your theme on all pages, so this step is not needed. It isn't automatically loaded to reduce page size.

Use either the [linechart] or [piechart] shortcodes, with the data enclosed between the tags (see example).

Linechart example:

`[linechart minx="1950" maxx="1965" miny="0" maxy="100" steps="false" fill="true" points="false" legend="true"]
	       { label: "Series 1",
		data:	[[1963, 43],
				[1959, 48],
				[1956, 50],
				[1952, 30]]
},
	{
		label: "Series 2",							
		data:
			[[1952, 30],
			[1956, 49],
			[1959, 49],
			[1963, 50]] }
[/linechart]`

Pie chart example:
`[piechart donut="0.5"]
{ label: "Series1",  data: 10},
		{ label: "Series2",  data: 30},
		{ label: "Series3",  data: 90},
		{ label: "Series4",  data: 70},
		{ label: "Series5",  data: 80},
		{ label: "Series6",  data: 110}
[/piechart]`

== Installation ==
Upload the plugin to your /wp-contents/plugins/ directory.

== Frequently Asked Questions ==

= My chart doesn't show up =

* Make sure your data doesn't contain any errors, such as a misplaced comma. The web inspector of your browser can help you with this.
* Check the source of the page, if the javascript contains an html tags, such as p or br, there probably is a problem with the wpautop filter.

== Changelog ==
0.1 - First version
0.1.1 - Problems with the style of the legend fixed.
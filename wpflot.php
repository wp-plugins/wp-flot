<?php
/*
Plugin Name: WP Flot
Plugin URI: http://www.youssouhaagsman.nl/wpflot/
Description: Shortcodes for Flot
Version: 0.1
Author: Youssou Haagsman
Author URI: http://www.youssouhaagsman.nl
License: GPLv2
*/

/*  Copyright 2014 Youssou Haagsman

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Script
	
	function flot_scripts() {
	
	$flot = get_post_meta( get_the_ID(), 'flot', true );
	
	if($flot == 'yes') {
	
		wp_register_script('flot', plugins_url( 'js/jquery.flot.min.js', __FILE__ ) ,array('jquery'));
		wp_register_script('flot-stacking', plugins_url( 'js/jquery.flot.stacking.min.js', __FILE__ ) ,array('jquery'));
		wp_register_script('flot-resize', plugins_url( 'js/jquery.flot.resize.min.js', __FILE__ ),array('jquery', 'flot'));
		wp_register_script('flot-pie', plugins_url( 'js/jquery.flot.pie.min.js', __FILE__ ) ,array('jquery', 'flot'));
	
		wp_enqueue_script('flot');
		wp_enqueue_script('flot-resize');
		wp_enqueue_script('flot-pie');
		wp_enqueue_script('flot_data');
		
	}
	
	}

add_action('wp_enqueue_scripts', 'flot_scripts');

// Shortcodes

function linechart_shortcode( $atts, $content ) {
	extract( shortcode_atts( array(
		'name' => 'Chart',
		'height' => '400px',
		'width' => '100%',
		'points' => 'true',
		'fill' => 'false',
		'steps' => 'false',
		'maxx' => 'null',
		'maxy' => 'null',
		'minx' => 'null',
		'miny' => 'null',
		'legend' => 'true'
	), $atts ) );
		
	static $number = 0;
	$number++;
	
	$content = strip_tags($content);
		
	return <<<HTML
	<div id="plotarea$number" style="height: {$height}; width: {$width};">
	</div>
	<script type="text/javascript">
jQuery(document).ready(function($){
	var dataseries$number = [
		$content
	];

	var options = {
			series: {
				points: {
					show: {$points},
					radius: 3
				},
				lines: {
					show: true,
					fill: {$fill},
					fillColor: { colors: [ { opacity: 0.6 }, { opacity: 0.3 } ] },
					steps: {$steps},
					lineWidth: 1
				},
			},
			legend: {
				show: {$legend},
				backgroundOpacity: 0.7
			},
			grid: {
				backgroundColor: null
			},
			yaxis: {
				min: {$miny},
				max: {$maxy},
			},
			xaxis: {
				min: {$minx},
				max: {$maxx}
			},
	};
	
	var plotarea$number = $("#plotarea$number");  
	var plot$number = $.plot( plotarea$number , dataseries$number, options ); 

});
</script>
HTML;
}

function piechart_shortcode( $atts, $content ) {
	extract( shortcode_atts( array(
		'name' => 'Chart',
		'height' => '300px',
		'width' => '100%',
		'legend' => 'false',
		'donut' => '0',
		'combine' => '0'
	), $atts ) );
		
	static $number = 0;
	$number++;
	
	$content = strip_tags($content);
		
	return <<<HTML
	<div id="piearea$number" style="height: {$height}; width: {$width};">
	</div>
	<script type="text/javascript">
jQuery(document).ready(function($){
	var dataseries$number = [
		$content
	];

	var options$number = {
			series: {
				pie: {
					show: true,
					innerRadius: {$donut},
					combine: {
						color: '#999',
						threshold: {$combine},
						label: 'Other'
					},
				}
			},
			legend: {
				show: {$legend},
				backgroundOpacity: 0.7
			},
			grid: {
				backgroundColor: null
			},
	};
	
	var piearea$number = $("#piearea$number");  
	var pieplot$number = $.plot( piearea$number , dataseries$number, options$number ); 

});
</script>
HTML;
}
add_shortcode( 'linechart', 'linechart_shortcode' );
add_shortcode( 'piechart', 'piechart_shortcode' );

add_filter( 'no_texturize_shortcodes', 'shortcodes_to_exempt_from_wptexturize' );
function shortcodes_to_exempt_from_wptexturize($shortcodes){
    $shortcodes = array('linechart', 'piechart');
    return $shortcodes;
};

?>
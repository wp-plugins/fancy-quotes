<?php
/********************************************************************************
Plugin Name: Fancy Quotes
Plugin URI: 
Description: Makes blockquotes look nice.
Author: Nima Yousefi
Author URI: http://equinox-of-insanity.com
Version: 0.90

MIT Expat License
Copyright (c) 2008 Nima Yousefi

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.

********************************************************************************/
add_filter('the_content', 'make_fancy', 1, 1);
add_action('wp_head', 'add_fancy_css');

// Hit the moving plugin folder target
// see: http://striderweb.com/nerdaphernalia/2008/09/hit-a-moving-target-in-your-wordpress-plugin/
if ( ! defined( 'WP_CONTENT_URL' ) )
	define( 'WP_CONTENT_URL', get_option( 'siteurl' ) . '/wp-content' );
if ( ! defined( 'WP_CONTENT_DIR' ) )
	define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
if ( ! defined( 'WP_PLUGIN_URL' ) )
	define( 'WP_PLUGIN_URL', WP_CONTENT_URL. '/plugins' );
if ( ! defined( 'WP_PLUGIN_DIR' ) )
	define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );


function make_fancy($text) {
	$pattern = '/<blockquote class="fancy"([^<>]*?)>(.*?)<\/blockquote>/s';
   	$replace = '<div class="fancy-quote"><div><blockquote>\2</blockquote></div></div>';
   	$text = preg_replace($pattern, $replace, $text);	
	
	return $text;
}

function add_fancy_css() {
    // add a link to the fancy_quotes.css file
   $file = WP_PLUGIN_URL . "/fancy-quotes/fancy_quotes.css";
      
   ob_start();
   echo '<link rel="stylesheet" type="text/css" media="screen" href="' . $file . '"/>' . "\n";
   ob_end_flush();
}

?>
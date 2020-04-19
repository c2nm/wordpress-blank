<?php
// add composer
require_once(get_template_directory().'/vendor/autoload.php');

// environment
function is_production()
{
    return (strpos($_SERVER['HTTP_HOST'], '.local') === false && strpos($_SERVER['HTTP_HOST'], '192.168.178') === false);
}

/* disable email bug alerts */
add_filter( 'recovery_mode_email', function( $email, $url ) {
    $email['to'] = 'unknown@local';
    return $email;
}, 10, 2 );

// hide toolbar in frontend
add_filter('show_admin_bar', '__return_false');

// load js (in header, because we use async)
add_action('wp_enqueue_scripts', function()
{
    wp_enqueue_script( 'script', get_bloginfo('template_directory').'/_build/bundle.js', [], false, false );
});

// basic loading of css/js
/*
add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style('style',get_bloginfo('template_directory').'/bundle.css');
    wp_enqueue_script('script',get_bloginfo('template_directory').'/bundle.js', ['jquery']);
    wp_enqueue_script('jquery');
});
*/

/* further delay js loading (only use for highly optimized pages) */
/*
add_action('wp_footer', function()
{
    echo '<script>
        window.addEventListener(\'load\', function() {
            var delay = 1500;
            if( window.innerWidth >= 768 ) { delay = 0; }
            setTimeout(function() {
                var script = document.createElement(\'script\');
                script.src = \''.get_bloginfo('template_directory').'/_build/bundle.js\';
                document.head.appendChild(script);
            }, delay);
        });
    </script>';
});
*/

// add async defer to javascript files
add_filter( 'script_loader_tag', function ( $tag, $handle ) {    
    if( is_admin() )
    {
        return $tag;
    }
    return str_replace( ' src', ' async defer src', $tag );
}, 10, 2 );

// remove text/javascript for validation
add_filter('script_loader_tag', function($tag, $handle)
{
    $tag = str_replace('script type=\'text/javascript\'', 'script', $tag);
    return $tag;
}, 10, 2);

// disable jquery and other scripts added by plugins
add_action('wp_enqueue_scripts', function()
{
    wp_deregister_script('jquery');
    wp_deregister_style( 'wp-block-library' ); // gutenberg
});
add_action('wp_footer', function()
{
    wp_deregister_script('wp-embed');
});
if( !is_admin() )
{
    define('WPFC_HIDE_TOOLBAR', true);
}

// load css (critical)
add_action('wp_head', function()
{
    if( file_exists( get_template_directory().'/_build/bundle-critical.css' ) && is_production() )
    {
        echo '<style>';
            $stylesheet = file_get_contents(get_template_directory().'/_build/bundle-critical.css');
            // replace relative paths
            $stylesheet = str_replace('url(\'../_','url(\''.get_bloginfo('template_directory').'/_', $stylesheet);
            $stylesheet = str_replace('url(../_','url('.get_bloginfo('template_directory').'/_', $stylesheet);
            echo $stylesheet;
        echo '</style>';
    }
});

// load css (non-critical)
add_action('wp_footer', function()
{
    // https://github.com/filamentgroup/loadCSS
    echo '<link rel="preload" href="'.get_bloginfo('template_directory').'/_build/bundle.css'.((!is_production())?('?ver='.mt_rand(1000,9999)):('')).'" as="style" onload="this.onload=null;this.rel=\'stylesheet\'">';
    echo '<noscript><link rel="stylesheet" href="'.get_bloginfo('template_directory').'/_build/bundle.css"></noscript>';
    echo '<script>';
    echo '(function(a){"use strict";a.loadCSS||(a.loadCSS=function(){});var b=loadCSS.relpreload={};if(b.support=function(){var d;try{d=a.document.createElement("link").relList.supports("preload")}catch(f){d=!1}return function(){return d}}(),b.bindMediaToggle=function(d){function f(){d.media=g}var g=d.media||"all";d.addEventListener?d.addEventListener("load",f):d.attachEvent&&d.attachEvent("onload",f),setTimeout(function(){d.rel="stylesheet",d.media="only x"}),setTimeout(f,3e3)},b.poly=function(){if(!b.support())for(var g,d=a.document.getElementsByTagName("link"),f=0;f<d.length;f++)g=d[f],"preload"!==g.rel||"style"!==g.getAttribute("as")||g.getAttribute("data-loadcss")||(g.setAttribute("data-loadcss",!0),b.bindMediaToggle(g))},!b.support()){b.poly();var c=a.setInterval(b.poly,500);a.addEventListener?a.addEventListener("load",function(){b.poly(),a.clearInterval(c)}):a.attachEvent&&a.attachEvent("onload",function(){b.poly(),a.clearInterval(c)})}"undefined"==typeof exports?a.loadCSS=loadCSS:exports.loadCSS=loadCSS})("undefined"==typeof global?this:global);';
    echo '</script>';
});

// theme support for basic features
add_theme_support( 'title-tag' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );

// add favicon
add_action('wp_head', function()
{
    echo '<link rel="icon" type="image/png" sizes="32x32" href="/favicon.png">';
});

// add menus
add_action('init', function()
{
  register_nav_menus([
    'main-menu' => 'Main menu',
    'sub-menu' => 'Sub menu'
  ]);
});

// disable auto p
remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );
remove_filter( 'acf_the_content', 'wpautop' );

// remove automatically added wordpress version from script
function wp_remove_version($src)
{	
    if(strpos($src, 'ver='))
    {
        $src = remove_query_arg( 'ver', $src );
    }
    // reload on every request on localhost
    if( !is_production() )
    {
        $src = add_query_arg('ver', mt_rand(1000,9999), $src);
    }	
    return $src;	
}
add_filter( 'style_loader_src', 'wp_remove_version', 9999 );
add_filter( 'script_loader_src', 'wp_remove_version', 9999 );

// disable user-sniffing (source: https://www.wp-tweaks.com/hackers-can-find-your-wordpress-username)
function redirect_to_home_if_author_parameter() {
    $is_author_set = get_query_var( 'author', '' );
    if ( $is_author_set != '' && !is_admin()) {
        wp_redirect( home_url(), 301 );
        exit;
    }
}
add_action( 'template_redirect', 'redirect_to_home_if_author_parameter' );
function disable_rest_endpoints ( $endpoints ) {
    if ( isset( $endpoints['/wp/v2/users'] ) ) {
        unset( $endpoints['/wp/v2/users'] );
    }
    if ( isset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] ) ) {
        unset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] );
    }
    return $endpoints;
}
add_filter( 'rest_endpoints', 'disable_rest_endpoints');

// disable category / tag / date / author / archive / attachments
function disable_uneeded_archives() {
    if( is_category() || is_tag() || is_date() || is_author() || is_attachment() )
    {
		header('Status: 404 Not Found');
		global $wp_query;
		$wp_query->set_404();
		status_header(404);
		nocache_headers();
	}
}
add_action('template_redirect', 'disable_uneeded_archives');

// make urls available in js
add_action('wp_head', function()
{
	echo '<script>var baseurl = \''.get_bloginfo('url').'\', tplurl = \''.get_bloginfo('template_directory').'\';</script>';
}, -9999);

// disable password protected on localhost
if( !is_production() )
{
	require_once(ABSPATH.'wp-admin/includes/plugin.php');
	deactivate_plugins([
		'password-protected/password-protected.php'
	]);
}

// remove emojis
function disable_emojis()
{
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}
add_action( 'init', 'disable_emojis' );

// remove wordpress version number
remove_action('wp_head', 'wp_generator');

// remove text content editors on all pages (to fully use acf fields) #wordpress
add_action('admin_init', function()
{
    remove_post_type_support( 'post', 'editor' );
    remove_post_type_support( 'page', 'editor' );
});

// reenable custom meta box in posts removed by acf
add_filter('acf/settings/remove_wp_meta_box', '__return_false');

// enable svg upload
add_filter( 'upload_mimes', function($existing_mimes = [])
{
    $existing_mimes['vcf'] = 'text/x-vcard';
    $existing_mimes['svg'] = 'image/svg+xml';
    return $existing_mimes;
});
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes)
{
  $filetype = wp_check_filetype( $filename, $mimes );
  return [
      'ext' => $filetype['ext'],
      'type' => $filetype['type'],
      'proper_filename' => $data['proper_filename']
  ];
}, 10, 4 );

// ascii art
function ascii_art()
{
    echo <<<EOD
<!--
____________/\\\\\\_______/\\\\\\\\\\\\\\\\\\_____________
___________/\\\\\\\\\\_____/\\\\\\///////\\\\\\__________
__________/\\\\\\/\\\\\\____\\///______\\//\\\\\\________
_________/\\\\\\/\\/\\\\\\______________/\\\\\\/________
________/\\\\\\/__\\/\\\\\\___________/\\\\\\//_________
_______/\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\_____/\\\\\\//___________
_______\\///////////\\\\\\//____/\\\\\\/_____________
__________________\\/\\\\\\_____/\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\__
___________________\\///_____\\///////////////__
-->

EOD;
}

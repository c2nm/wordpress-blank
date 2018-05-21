<?php
// add composer
require_once(get_template_directory().'/vendor/autoload.php');

// environment
function is_production()
{
    return (strpos($_SERVER['HTTP_HOST'], '.local') === false && strpos($_SERVER['HTTP_HOST'], '192.168.178') === false);
}

/* google analytics */
add_action('wp_head', function()
{
    $property = 'UA-12350231-1';
    ?><script>
        if(navigator.userAgent.indexOf('Speed Insights') === -1)
        {
            /* opt out */
            var disableStr = 'ga-disable-<?php echo $property; ?>';
            if( document.cookie.indexOf(disableStr + '=true') > -1 ) { window[disableStr] = true; }
            document.addEventListener('DOMContentLoaded', function() { document.addEventListener('click', function(e) { if( e.target.tagName === 'A' && e.target.textContent === 'Google Analytics deaktivieren' ) { alert('Google Analytics wurde deaktiviert'); document.cookie = disableStr + '=true; expires=Thu, 31 Dec 2099 23:59:59 UTC; path=/'; window[disableStr] = true; e.preventDefault(); } }, true); });

            document.addEventListener('DOMContentLoaded', function()
            {
                var script = null;

                script = document.createElement('script');
                script.src = 'https://www.googletagmanager.com/gtag/js?id=<?php echo $property; ?>';
                document.head.appendChild(script);

                script = document.createElement('script');
                script.innerHTML += 'window.dataLayer = window.dataLayer || [];';
                script.innerHTML += 'var gtag = function() { dataLayer.push(arguments); };';
                script.innerHTML += 'gtag(\'js\', new Date());';
                // track page view
                script.innerHTML += 'gtag(\'config\', \'<?php echo $property; ?>\', { \'anonymize_ip\': true });';
                document.head.appendChild(script);
            });
        }
    </script><?php
});

// load js
add_action('wp_enqueue_scripts', function()
{
    wp_enqueue_script( 'script', get_bloginfo('template_directory').'/_build/bundle.js', [], false, true );
});

/* remove text/javascript for validation */
add_filter('script_loader_tag', function($tag, $handle)
{
    $tag = str_replace('script type=\'text/javascript\'', 'script', $tag);
    return $tag;
}, 10, 2);

// disable jquery and other scripts added by plugins
add_action('wp_enqueue_scripts', function()
{
    wp_deregister_script('jquery');
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
    /* https://github.com/filamentgroup/loadCSS */
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
    echo '<link rel="shortcut icon" href="'.get_bloginfo('template_directory').'/_assets/favicon.png" />';
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
});

// disable password protected on localhost
if( !is_production() )
{
	require_once(ABSPATH.'wp-admin/includes/plugin.php');
	deactivate_plugins([
		'password-protected/password-protected.php'
	]);
}

/* remove emojis */
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

/* remove wordpress version number */
remove_action('wp_head', 'wp_generator');
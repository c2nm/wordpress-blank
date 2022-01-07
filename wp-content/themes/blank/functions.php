<?php
// add composer
require_once(get_template_directory().'/vendor/autoload.php');
require_once(get_template_directory().'/_php/_load.php');

// disable frontend/backend on testing
if( strpos($_SERVER['HTTP_HOST'], 'close2dev') !== false ) {
    // frontend redirect to backend
    if( !is_admin() && !in_array($GLOBALS['pagenow'], ['wp-login.php', 'wp-register.php']) ) { 
        //wp_redirect(get_admin_url()); die();
    }
    // disable backend also
    else {
        //die();
    }
}

// environment
function is_production()
{
    return (strpos($_SERVER['HTTP_HOST'], '.local') === false && strpos($_SERVER['HTTP_HOST'], 'close2dev') === false && strpos($_SERVER['HTTP_HOST'], '192.168.178') === false);
}

// detect pagespeed insights
add_action(
    'wp_head',
    function () {
        echo '<script>window.pagespeed = navigator.userAgent.indexOf(\'Speed Insights\') > -1 || navigator.userAgent.indexOf(\'Chrome-Lighthouse\') > -1;</script>';
    },
    -9999
);

// modify spam blocklist (wpcf7): add more whitelisted keywords
add_filter('option_disallowed_keys', function($input) {
    if( $input != '' ) {
        foreach(['online.de'] as $whitelist__value) {
            $input = str_replace($whitelist__value, 'MANUALLY_DISABLED_KEYWORD', $input);
        }
    }
    return $input;
}, PHP_INT_MAX);

// block subscribers from admin
add_action('init', function () {
    if (is_admin() && !defined('DOING_AJAX') && current_user_can('read') && !current_user_can('edit_posts')) {
        wp_redirect(home_url());
        die();
    }
});

// disable oembed links in frontend (ryte gives otherwise errors)
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );

// always enable "show hidden characters" in tinymce
add_filter('tiny_mce_before_init', function($settings) {
    $settings['visualchars_default_state'] = true;
    return $settings;
});

// disable email bug alerts
add_filter( 'recovery_mode_email', function( $email, $url ) {
    $email['to'] = 'unknown@local';
    return $email;
}, 10, 2 );

// always send mails on production to developer
if (!is_production()) {
    add_filter( 'wp_mail', function($data) {
        $data['to'] = isset($_SERVER['SERVER_ADMIN']) && $_SERVER['SERVER_ADMIN'] != '' && strpos($_SERVER['SERVER_ADMIN'], 'webmaster@') === false
            ? $_SERVER['SERVER_ADMIN']
            : 'support@close2.de';
        return $data;
    });
}

// add custom yoast separator
add_filter('wpseo_separator_options', function ($separators) {
    return array_merge($separators, [
        'sc-doubleslash' => '//'
    ]);
});

// remove privacy policy link from login form
add_filter('the_privacy_policy_link', '__return_empty_string');

// hide toolbar in frontend
add_filter('show_admin_bar', '__return_false');

// prevent resize of big images >2k (wp >= 5.3 by default creates -scaled versions when higher)
add_filter('big_image_size_threshold', '__return_false');

// increase image quality of resized images
//add_filter('jpeg_quality', function($arg) { return 100; });

// force the use imagemagick (wp uses it by default when installed; check with site health > report)
//add_filter('wp_image_editors', function() { return array('WP_Image_Editor_Imagick'); });

// don't strip exif/iptc data from images
// only works with imagemagick enabled and when no other plugins interfer or reset it
// also never strips copyright information when set to true(!)
//add_filter('image_strip_meta', false);

// add async defer to javascript files (be careful when using this!)
add_filter( 'script_loader_tag', function ( $tag, $handle ) {    
    if( is_admin() || $GLOBALS['pagenow'] == 'wp-login.php' )
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

// disable jquery and other scripts added by plugins (be careful when using this!)
// if you really need them bundle them locally(!) in your package.json
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
/* this is a more strict variant: deregister all scripts/styles in frontend (disabled) */
/*
add_action('wp_enqueue_scripts', function() {
    global $wp_styles;
    foreach ($wp_styles->queue as $style_handle) {
        wp_dequeue_style($style_handle);
    }
    global $wp_scripts;
    foreach ($wp_scripts->queue as $script_handle) {
        wp_dequeue_script($script_handle);
    }
});
*/

// make strings available in js without specific registered script (access with window.settings.***)
/*
add_action('wp_head', function () {
    ?>
    <script>
    var settings = <?php echo json_encode([
        'baseurl' => gtbabel__(get_bloginfo('url')),
        'tplurl' => gtbabel__(get_bloginfo('template_directory')),
        'resturl' => gtbabel__(rest_url())
    ]); ?>;
    </script>
    <?php
});
*/

/* js */
// load js (in header, because we use async)
if(1==1) {
    add_action('wp_enqueue_scripts', function()
    {
        wp_enqueue_script( 'script', get_bloginfo('template_directory').'/_build/bundle.js', [], false, false );
        // make urls available in js (access with window.settings.***)
        wp_localize_script('script', 'settings', [
            'baseurl' => get_bloginfo('url'),
            'tplurl' => get_bloginfo('template_directory'),
            'resturl' => rest_url(),
            'lng' => defined( 'ICL_LANGUAGE_CODE' ) ? ICL_LANGUAGE_CODE : 'en',
            'nonce' => wp_create_nonce('wp_rest')
        ]);
    });
}
/* further delay js loading (only use for highly optimized pages) */
if(1==0) {
    add_action('wp_footer', function()
    {
        echo '<script>
            var script = document.createElement(\'script\');
            script.src = \''.get_bloginfo('template_directory').'/_build/bundle.js\';
            if( window.pagespeed ) {
                document.addEventListener(\'DOMContentLoaded\', function() {
                    // do some lighthouse specific stuff
                    let slider = document.querySelector(\'.intro-slider\');
                    if( slider !== null ) { slider.remove(); }                    
                });
                window.addEventListener(\'load\', function() {
                    // delay loading
                    setTimeout(function() {
                        document.head.appendChild(script);
                    }, 2500);
                });
            }
            else {
                document.head.appendChild(script);
            }
        </script>';
    });
}
// basic loading
if(1==0) {
    add_action('wp_enqueue_scripts', function() {
        wp_enqueue_script('script',get_bloginfo('template_directory').'/_build/bundle.js', ['jquery']);
        wp_enqueue_script('jquery');
    });
}

/* css */

/* option 1: fully embed css */
if(1==1) {
    add_action('wp_head', function () {
        if (file_exists(get_template_directory() . '/_build/bundle.css')) {
            echo '<style>';
            $stylesheet = file_get_contents(get_template_directory() . '/_build/bundle.css');
            // replace relative paths
            $stylesheet = str_replace('url("../_', 'url("' . get_bloginfo('template_directory') . '/_', $stylesheet);
            $stylesheet = str_replace('url(\'../_', 'url(\'' . get_bloginfo('template_directory') . '/_', $stylesheet);
            $stylesheet = str_replace('url(../_', 'url(' . get_bloginfo('template_directory') . '/_', $stylesheet);
            echo $stylesheet;
            // this is how to embed adobe fonts (typekit)
            /*
            echo PHP_EOL;
            $stylesheet = file_get_contents('https://use.typekit.net/xxxxxxx.css');
            echo $stylesheet;
            */
            echo '</style>';
        }
    });
}
/* option 2: split in critical/non-critical */
if(1==0) {
    // load css (critical)
    add_action('wp_head', function()
    {
        if( file_exists( get_template_directory().'/_build/bundle-critical.css' ) && is_production() )
        {
            echo '<style>';
                $stylesheet = file_get_contents(get_template_directory().'/_build/bundle-critical.css');
                // replace relative paths
                $stylesheet = str_replace('url("../_','url("'.get_bloginfo('template_directory').'/_', $stylesheet);
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
}
/* option 3: basic embedding */
if(1==0) {
    add_action('wp_enqueue_scripts', function() {
        wp_enqueue_style('style',get_bloginfo('template_directory').'/_build/bundle.css');
    });
}

// theme support for basic features
add_theme_support( 'title-tag' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'html5', ['comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script'] );

// add more thumbnail sizes
// besides default ones:
// - "thumbnail": 150x150
// - "medium": 300x300
// - "large": 1024x1024
function getCommonScreenResolutions()
{
    return [360, 375, 414, 768, 1024, 1280, 1366, 1440, 1536, 1600, 1680, 1920, 2048, 2560, 4096];
}
function getMediaBreakpoints()
{
    return [768, 1024];
}
add_action('after_setup_theme', function () {
    foreach (getCommonScreenResolutions() as $resolutions__value) {
        add_image_size($resolutions__value . 'x', $resolutions__value, 0, false);
    }
});
// picture img render helper
function renderImage($image, $class = null, $ratio_large = 1, $ratio_medium = 1, $ratio_small = 1, $lazy = true)
{
    echo '<picture>';
    for (
        $i = floor(getCommonScreenResolutions()[0] / 100) * 100;
        $i <= ceil(array_reverse(getCommonScreenResolutions())[0] / 100) * 100;
        $i = $i + 200
    ) {
        $size = null;
        if ($i >= getMediaBreakpoints()[1]) { $ratio = $ratio_large; }
        elseif ($i >= getMediaBreakpoints()[0]) { $ratio = $ratio_medium; }
        else { $ratio = $ratio_small; }
        foreach (array_reverse(getCommonScreenResolutions()) as $resolutions__value) {
            if ($resolutions__value >= $i * $ratio) {
                $size = $resolutions__value;
            }
        }
        echo '<source media="(max-width: ' . $i . 'px)" srcset="' . $image['sizes'][$size . 'x'] . '" data-size="' . $size . 'x' . '">';
    }
    $default_size = null;
    foreach(getCommonScreenResolutions() as $resolutions__value) {
        if( $resolutions__value <= getMediaBreakpoints()[0] ) { $default_size = $resolutions__value; }
        else { break; }
    }
    echo '<img' .
        ($class !== null ? ' class="' . $class . '"' : '') .
        ($lazy === true ? ' loading="lazy"' : '') .
        ' width="'.$image['sizes'][$default_size.'x-width'].'"'.
        ' height="'.$image['sizes'][$default_size.'x-height'].'"'.
        ' src="' . $image['url'] . '"'.
        ' alt="' . $image['alt'] . '"'.
    ' />';
    echo '</picture>';
}

// enable custom editor style
add_editor_style();

// add favicon
add_action('wp_head', function()
{
    echo '<link rel="icon" type="image/png" sizes="32x32" href="' . site_url() . '/favicon.png">';
});
add_action('admin_head', function()
{
    echo '<link rel="icon" type="image/png" sizes="32x32" href="' . site_url() . '/favicon.png">';
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

// disable category / tag / date / author / archive / attachments / search route
function disable_uneeded_archives() {
    if( is_category() || is_tag() || is_date() || is_author() || is_attachment() || is_search() )
    {
		header('Status: 404 Not Found');
		global $wp_query;
		$wp_query->set_404();
		status_header(404);
		nocache_headers();
	}
}
add_action('template_redirect', 'disable_uneeded_archives');

// disable media slugs from taking away page slugs
add_filter( 'wp_unique_post_slug_is_bad_attachment_slug', '__return_true' );

// disable password protected on localhost
if( !is_production() )
{
	require_once(ABSPATH.'wp-admin/includes/plugin.php');
	deactivate_plugins([
		'password-protected/password-protected.php'
	]);
}

/* disable quote conversion in blog posts (WordPress e.g. auto converts "" into „“ */
//add_filter('run_wptexturize', '__return_false');

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

// disable in plugin "Enable Media Replace" second option "Datei ersetzen, aber neuen Dateinamen verwenden und alle Links automatisch aktualisieren"
add_filter('emr_enable_replace_and_search', function() {
    return false;
}, 10, 0);

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

<?php
namespace WP;

class Core
{
    public function __construct()
    {
        $this->init();
    }

    private function init()
    {
        /* general */
        $this->addMenus();
        $this->addFavicon();
        $this->removeEmojis();
        $this->enableSvgUpload();
        $this->removeAllDashboardWidgets();
        $this->detectPageSpeedInsights();
        $this->removeBulkHeaderLinks();
        $this->alwaysEnableShowHiddenCharactersInTinyMce();
        $this->disableEmailBugAlerts();
        $this->sendMailsNotOnProductionToDeveloper();
        $this->removePrivacyPolicyLinkFromLogin();
        $this->resetWordPressLoginFormLayout();
        $this->hideToolbarInFrontend();
        $this->addThemeSupportForBasicFeatures();
        $this->enableCustomEditorStyle();
        $this->disableBackendLanguageSwitcher();
        $this->disableAutoParagraph();
        $this->disableUnneededArchives();
        $this->disableMediaSlugsFromTakingAwayPageSlugs();
        $this->disableWelcomeEmailsOnMultisiteRegistrations();
        //$this->disableFrontendBackendOnTesting();
        //$this->disableAutoQuoteConversion();

        /* js */
        $this->loadJsBasicWithLocalize();
        //$this->loadJsAdvanced();
        //$this->loadJsWithJQuery();
        //$this->makeStringsAvailableInJsWithoutLocalizeScript();

        /* css */
        $this->loadCssInline();
        //$this->loadCssAdvanced();
        //$this->loadCssBasic();

        /* media */
        $this->addBasicImageSizes();
        $this->preventResizeOfBigImages();
        //$this->forceUseOfImageMagick();
        //$this->disableStripExifIptcFromImages();
        //$this->increaseImageQualityOfResizedImages();
        //$this->addVariousImageSizesForRenderHelper();

        /* security */
        $this->disableUserSniffing();
        $this->blockSubscribersFromAdmin();
        $this->removeAutoVersionFromScripts();
        $this->removeWordPressVersionInHead();

        /* performance */
        $this->addAsyncDeferToJsFiles();
        $this->removeTypeTextJavaScriptForValidation();
        $this->disableGlobalGutenbergStylesInFrontend();
        $this->disablejQueryAndOtherScriptsAddedByPlugins();
        //$this->disableAllScriptsStylesinFrontend();

        /* plugins */
        $this->yoastAddCustomSeparator();
        $this->yoastShowEmptyCategoriesInSitemap();
        $this->enableMediaReplaceDisableOption();
        $this->advancedCustomFieldsRemoveEditorsOnAllPages();
        $this->advancedCustomFieldsReenableCustomMetaBox();
        $this->advancedCustomFieldsReduceWysiwygHeight();
        $this->webPConverterAndCropThumbnailsFixPluginConflict();
        $this->autoClearCacheForWpFastestCache();
        $this->cropThumbnailsOnlyShowNeededSize();
        $this->blockListUpdaterModifySpamlist();
    }

    /* public functions */

    public static function isProduction()
    {
        return strpos($_SERVER['HTTP_HOST'], '.local') === false &&
            strpos($_SERVER['HTTP_HOST'], 'close2dev') === false &&
            strpos($_SERVER['HTTP_HOST'], '192.168.178') === false;
    }

    public static function renderImage(
        $image,
        $class = null,
        $ratio_large = 1,
        $ratio_medium = 1,
        $ratio_small = 1,
        $lazy = true
    ) {
        /* example call inside template:
        echo \WP\Core::renderImage(
            get_field('image', 2),
            'test-class',
            1,
            1,
            1,
            true
        );
        */
        echo '<picture>';
        for (
            $i = floor(self::getCommonScreenResolutions()[0] / 100) * 100;
            $i <= ceil(array_reverse(self::getCommonScreenResolutions())[0] / 100) * 100;
            $i = $i + 200
        ) {
            $size = null;
            if ($i >= self::getMediaBreakpoints()[1]) {
                $ratio = $ratio_large;
            } elseif ($i >= self::getMediaBreakpoints()[0]) {
                $ratio = $ratio_medium;
            } else {
                $ratio = $ratio_small;
            }
            foreach (array_reverse(self::getCommonScreenResolutions()) as $resolutions__value) {
                if ($resolutions__value >= $i * $ratio) {
                    $size = $resolutions__value;
                }
            }
            echo '<source media="(max-width: ' .
                $i .
                'px)" srcset="' .
                $image['sizes'][$size . 'x'] .
                '" data-size="' .
                $size .
                'x' .
                '">';
        }
        $default_size = null;
        foreach (self::getCommonScreenResolutions() as $resolutions__value) {
            if ($resolutions__value <= self::getMediaBreakpoints()[0]) {
                $default_size = $resolutions__value;
            } else {
                break;
            }
        }
        echo '<img' .
            ($class !== null ? ' class="' . $class . '"' : '') .
            ($lazy === true ? ' loading="lazy"' : '') .
            ' width="' .
            $image['sizes'][$default_size . 'x-width'] .
            '"' .
            ' height="' .
            $image['sizes'][$default_size . 'x-height'] .
            '"' .
            ' src="' .
            $image['url'] .
            '"' .
            ' alt="' .
            $image['alt'] .
            '"' .
            ' />';
        echo '</picture>';
    }

    public static function asciiArt()
    {
        $rand = [
            '____________/\\\\\\_______/\\\\\\\\\\\\\\\\\\_____________
___________/\\\\\\\\\\_____/\\\\\\///////\\\\\\__________
__________/\\\\\\/\\\\\\____\\///______\\//\\\\\\________
_________/\\\\\\/\\/\\\\\\______________/\\\\\\/________
________/\\\\\\/__\\/\\\\\\___________/\\\\\\//_________
_______/\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\_____/\\\\\\//___________
_______\\///////////\\\\\\//____/\\\\\\/_____________
__________________\\/\\\\\\_____/\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\__
___________________\\///_____\\///////////////__',
            ' __   __       # _____       #
/__/\/__/\     #/_____/\     #
\  \ \: \ \__  #\:::_:\ \    #
 \::\_\::\/_/\ #    _\:\|    #
  \_:::   __\/ #   /::_/__   #
       \::\ \  #   \:\____/\ #
        \__\/  #    \_____\/ #
               #             #',
            '➖➖➖➖➖➖➖➖➖➖➖➖➖➖➖
➖🟩🟩➖➖🟩🟩➖🟩🟩🟩🟩🟩🟩➖
➖🟩🟩➖➖🟩🟩➖🟩🟩🟩🟩🟩🟩➖
➖🟩🟩➖➖🟩🟩➖➖➖➖➖🟩🟩➖
➖🟩🟩➖➖🟩🟩➖➖➖➖➖🟩🟩➖
➖🟩🟩🟩🟩🟩🟩➖🟩🟩🟩🟩🟩🟩➖
➖🟩🟩🟩🟩🟩🟩➖🟩🟩🟩🟩🟩🟩➖
➖➖➖➖➖🟩🟩➖🟩🟩➖➖➖➖➖
➖➖➖➖➖🟩🟩➖🟩🟩➖➖➖➖➖
➖➖➖➖➖🟩🟩➖🟩🟩🟩🟩🟩🟩➖
➖➖➖➖➖🟩🟩➖🟩🟩🟩🟩🟩🟩➖
➖➖➖➖➖➖➖➖➖➖➖➖➖➖➖',
            '██╗  ██╗██████╗ 
██║  ██║╚════██╗
███████║ █████╔╝
╚════██║██╔═══╝ 
     ██║███████╗
     ╚═╝╚══════╝',
            '                      
  _/  _/      _/_/    
 _/  _/    _/    _/   
_/_/_/_/      _/      
   _/      _/         
  _/    _/_/_/_/      
                      ',
            '       _              _       
   _  /\ \          /\ \      
  /\_\\ \ \        /  \ \     
 / / / \ \ \      / /\ \ \    
/ / /   \ \ \     \/_/\ \ \   
\ \ \____\ \ \        / / /   
 \ \________\ \      / / /    
  \/________/\ \    / / /  _  
            \ \ \  / / /_/\_\ 
             \ \_\/ /_____/ / 
              \/_/\________/  
                              ',
        ];
        $rand = $rand[mt_rand(0, count($rand) - 1)];
        echo "<!--
$rand
-->
";
    }

    /* TODO! */

    /* private functions */

    private function removeAllDashboardWidgets()
    {
        add_action(
            'wp_dashboard_setup',
            function () {
                global $wp_meta_boxes;
                // remove specific widget
                //unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
                // remove all widgets
                unset($wp_meta_boxes['dashboard']);
            },
            PHP_INT_MAX
        );
    }

    private function disableFrontendBackendOnTesting()
    {
        if (strpos($_SERVER['HTTP_HOST'], 'close2dev') !== false) {
            // frontend redirect to backend
            if (!is_admin() && !in_array($GLOBALS['pagenow'], ['wp-login.php', 'wp-register.php'])) {
                wp_redirect(get_admin_url());
                die();
            }
            // disable backend also
            else {
                die();
            }
        }
    }

    private function detectPageSpeedInsights()
    {
        add_action(
            'wp_head',
            function () {
                echo '<script>window.pagespeed = navigator.userAgent.indexOf(\'Speed Insights\') > -1 || navigator.userAgent.indexOf(\'Chrome-Lighthouse\') > -1;</script>';
            },
            -9999
        );
    }

    private function blockListUpdaterModifySpamlist()
    {
        // add more whitelisted keywords
        add_filter(
            'option_disallowed_keys',
            function ($input) {
                if ($input != '') {
                    foreach (['online.de'] as $whitelist__value) {
                        $input = str_replace($whitelist__value, 'MANUALLY_DISABLED_KEYWORD', $input);
                    }
                }
                return $input;
            },
            PHP_INT_MAX
        );
    }

    private function blockSubscribersFromAdmin()
    {
        add_action('init', function () {
            if (is_admin() && !defined('DOING_AJAX') && current_user_can('read') && !current_user_can('edit_posts')) {
                wp_redirect(home_url());
                die();
            }
        });
    }

    private function disableBackendLanguageSwitcher()
    {
        add_filter('login_display_language_dropdown', '__return_false');
    }

    private function removeBulkHeaderLinks()
    {
        // remove oembed links in header (ryte gives otherwise errors)
        remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
        // remove wp-json rest api links in header (ryte gives otherwise errors)
        remove_action('wp_head', 'rest_output_link_wp_head', 10);
        // remove windows live writer manifest in header
        remove_action('wp_head', 'wlwmanifest_link');
        // remove rsd link in header
        remove_action('wp_head', 'rsd_link');
    }

    private function alwaysEnableShowHiddenCharactersInTinyMce()
    {
        add_filter('tiny_mce_before_init', function ($settings) {
            $settings['visualchars_default_state'] = true;
            return $settings;
        });
    }

    private function disableEmailBugAlerts()
    {
        add_filter(
            'recovery_mode_email',
            function ($email, $url) {
                $email['to'] = 'unknown@local';
                return $email;
            },
            10,
            2
        );
    }

    private function sendMailsNotOnProductionToDeveloper()
    {
        if (!self::isProduction()) {
            add_filter('wp_mail', function ($data) {
                $data['to'] =
                    isset($_SERVER['SERVER_ADMIN']) &&
                    $_SERVER['SERVER_ADMIN'] != '' &&
                    strpos($_SERVER['SERVER_ADMIN'], 'webmaster@') === false
                        ? $_SERVER['SERVER_ADMIN']
                        : 'support@close2.de';
                return $data;
            });
        }
    }

    private function yoastAddCustomSeparator()
    {
        add_filter('wpseo_separator_options', function ($separators) {
            return array_merge($separators, [
                'sc-doubleslash' => '//',
            ]);
        });
    }

    private function removePrivacyPolicyLinkFromLogin()
    {
        add_filter('the_privacy_policy_link', '__return_empty_string');
    }

    private function resetWordPressLoginFormLayout()
    {
        add_action('login_enqueue_scripts', function () {
            if (isset($GLOBALS['pagenow']) && $GLOBALS['pagenow'] === 'wp-login.php') { ?>
                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        if( document.querySelector('input[name="rememberme"]') !== null ) {
                            document.querySelector('input[name="rememberme"]').checked = true;
                        }
                    });
                </script>
                <style>
                body {
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    align-items:center;
                    min-height: 100vh;
                }
                #login {
                    padding: 0 !important;
                }
                .login form {
                    margin-top: 0 !important;
                }
                h1, #nav, #backtoblog {
                    display:none;
                }
                </style>
            <?php }
        });
    }

    private function hideToolbarInFrontend()
    {
        add_filter('show_admin_bar', '__return_false');
    }

    private function preventResizeOfBigImages()
    {
        // >2k (wp >= 5.3 by default creates -scaled versions when higher)
        add_filter('big_image_size_threshold', '__return_false');
    }

    private function increaseImageQualityOfResizedImages()
    {
        add_filter('jpeg_quality', function ($arg) {
            return 100;
        });
    }

    private function forceUseOfImageMagick()
    {
        // wp uses it by default when installed, so this is only needed in special environments; check with site health > report
        add_filter('wp_image_editors', function () {
            return ['WP_Image_Editor_Imagick'];
        });
    }

    private function disableStripExifIptcFromImages()
    {
        // don't strip exif/iptc data from images
        // only works with imagemagick enabled and when no other plugins interfer or reset it
        // also never strips copyright information when set to true(!)
        add_filter('image_strip_meta', false);
    }

    private function addAsyncDeferToJsFiles()
    {
        // be careful when using this!
        add_filter(
            'script_loader_tag',
            function ($tag, $handle) {
                if (is_admin() || $GLOBALS['pagenow'] == 'wp-login.php') {
                    return $tag;
                }
                return str_replace(' src', ' async defer src', $tag);
            },
            10,
            2
        );
    }

    private function removeTypeTextJavaScriptForValidation()
    {
        add_filter(
            'script_loader_tag',
            function ($tag, $handle) {
                $tag = str_replace('script type=\'text/javascript\'', 'script', $tag);
                return $tag;
            },
            10,
            2
        );
    }

    private function disableGlobalGutenbergStylesInFrontend()
    {
        add_action('wp_enqueue_scripts', function () {
            wp_dequeue_style('global-styles');
        });
    }

    private function disablejQueryAndOtherScriptsAddedByPlugins()
    {
        // disable jquery and other scripts added by plugins (be careful when using this!)
        // if you really need them bundle them locally(!) in your package.json
        add_action('wp_enqueue_scripts', function () {
            wp_deregister_script('jquery');
            wp_deregister_style('wp-block-library'); // gutenberg
        });
        add_action('wp_footer', function () {
            wp_deregister_script('wp-embed');
        });
        if (!is_admin()) {
            define('WPFC_HIDE_TOOLBAR', true);
        }
    }

    private function disableAllScriptsStylesinFrontend()
    {
        /* this is a more strict variant: deregister all scripts/styles in frontend */
        add_action('wp_enqueue_scripts', function () {
            global $wp_styles;
            foreach ($wp_styles->queue as $style_handle) {
                wp_dequeue_style($style_handle);
            }
            global $wp_scripts;
            foreach ($wp_scripts->queue as $script_handle) {
                wp_dequeue_script($script_handle);
            }
        });
    }

    private function makeStringsAvailableInJsWithoutLocalizeScript()
    {
        // make strings available in js without specific registered script (access with window.settings.***)
        add_action('wp_head', function () {
            ?>
            <script>
            var settings = <?php echo json_encode([
                'baseurl' => get_bloginfo('url'),
                'tplurl' => get_bloginfo('template_directory'),
                'resturl' => rest_url(),
            ]); ?>
            </script>
            <?php
        });
    }

    private function loadJsBasicWithLocalize()
    {
        // in header, because we use async
        add_action('wp_enqueue_scripts', function () {
            wp_enqueue_script('script', get_bloginfo('template_directory') . '/_build/bundle.js', [], false, false);
            // make urls available in js (access with window.settings.***)
            wp_localize_script('script', 'settings', [
                'baseurl' => get_bloginfo('url'),
                'tplurl' => get_bloginfo('template_directory'),
                'resturl' => rest_url(),
                'lng' => defined('ICL_LANGUAGE_CODE') ? ICL_LANGUAGE_CODE : 'en',
                'nonce' => wp_create_nonce('wp_rest'),
            ]);
        });
    }

    private function loadJsAdvanced()
    {
        /* further delay js loading (only use for highly optimized pages) */
        add_action('wp_footer', function () {
            echo '<script>
                var script = document.createElement(\'script\');
                script.src = \'' .
                get_bloginfo('template_directory') .
                '/_build/bundle.js\';
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

    private function loadJsWithJQuery()
    {
        add_action('wp_enqueue_scripts', function () {
            wp_enqueue_script('script', get_bloginfo('template_directory') . '/_build/bundle.js', ['jquery']);
            wp_enqueue_script('jquery');
        });
    }

    private function loadCssInline()
    {
        // fully embed css
        add_action('wp_head', function () {
            if (file_exists(get_template_directory() . '/_build/bundle.css')) {
                echo '<style>';
                $stylesheet = file_get_contents(get_template_directory() . '/_build/bundle.css');
                // replace relative paths
                $stylesheet = str_replace(
                    'url("../_',
                    'url("' . get_bloginfo('template_directory') . '/_',
                    $stylesheet
                );
                $stylesheet = str_replace(
                    'url(\'../_',
                    'url(\'' . get_bloginfo('template_directory') . '/_',
                    $stylesheet
                );
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

    private function loadCssAdvanced()
    {
        // split in critical/non-critical
        // load css (critical)
        add_action('wp_head', function () {
            if (file_exists(get_template_directory() . '/_build/bundle-critical.css') && self::isProduction()) {
                echo '<style>';
                $stylesheet = file_get_contents(get_template_directory() . '/_build/bundle-critical.css');
                // replace relative paths
                $stylesheet = str_replace(
                    'url("../_',
                    'url("' . get_bloginfo('template_directory') . '/_',
                    $stylesheet
                );
                $stylesheet = str_replace(
                    'url(\'../_',
                    'url(\'' . get_bloginfo('template_directory') . '/_',
                    $stylesheet
                );
                $stylesheet = str_replace('url(../_', 'url(' . get_bloginfo('template_directory') . '/_', $stylesheet);
                echo $stylesheet;
                echo '</style>';
            }
        });
        // load css (non-critical)
        add_action('wp_footer', function () {
            // https://github.com/filamentgroup/loadCSS
            echo '<link rel="preload" href="' .
                get_bloginfo('template_directory') .
                '/_build/bundle.css' .
                (!self::isProduction() ? '?ver=' . mt_rand(1000, 9999) : '') .
                '" as="style" onload="this.onload=null;this.rel=\'stylesheet\'">';
            echo '<noscript><link rel="stylesheet" href="' .
                get_bloginfo('template_directory') .
                '/_build/bundle.css"></noscript>';
            echo '<script>';
            echo '(function(a){"use strict";a.loadCSS||(a.loadCSS=function(){});var b=loadCSS.relpreload={};if(b.support=function(){var d;try{d=a.document.createElement("link").relList.supports("preload")}catch(f){d=!1}return function(){return d}}(),b.bindMediaToggle=function(d){function f(){d.media=g}var g=d.media||"all";d.addEventListener?d.addEventListener("load",f):d.attachEvent&&d.attachEvent("onload",f),setTimeout(function(){d.rel="stylesheet",d.media="only x"}),setTimeout(f,3e3)},b.poly=function(){if(!b.support())for(var g,d=a.document.getElementsByTagName("link"),f=0;f<d.length;f++)g=d[f],"preload"!==g.rel||"style"!==g.getAttribute("as")||g.getAttribute("data-loadcss")||(g.setAttribute("data-loadcss",!0),b.bindMediaToggle(g))},!b.support()){b.poly();var c=a.setInterval(b.poly,500);a.addEventListener?a.addEventListener("load",function(){b.poly(),a.clearInterval(c)}):a.attachEvent&&a.attachEvent("onload",function(){b.poly(),a.clearInterval(c)})}"undefined"==typeof exports?a.loadCSS=loadCSS:exports.loadCSS=loadCSS})("undefined"==typeof global?this:global);';
            echo '</script>';
        });
    }

    private function loadCssBasic()
    {
        add_action('wp_enqueue_scripts', function () {
            wp_enqueue_style('style', get_bloginfo('template_directory') . '/_build/bundle.css');
        });
    }

    private function addThemeSupportForBasicFeatures()
    {
        add_theme_support('title-tag');
        add_theme_support('automatic-feed-links');
        add_theme_support('post-thumbnails');
        add_theme_support('html5', [
            'comment-list',
            'comment-form',
            'search-form',
            'gallery',
            'caption',
            'style',
            'script',
        ]);
    }

    private function addVariousImageSizesForRenderHelper()
    {
        // add more thumbnail sizes
        // besides default ones:
        // - "thumbnail": 150x150
        // - "medium": 300x300
        // - "large": 1024x1024
        add_action('after_setup_theme', function () {
            foreach ($this->getCommonScreenResolutions() as $resolutions__value) {
                add_image_size($resolutions__value . 'x', $resolutions__value, 0, false);
            }
        });
    }

    private function getMediaBreakpoints()
    {
        return [768, 1024];
    }

    private function getCommonScreenResolutions()
    {
        return [360, 375, 414, 768, 1024, 1280, 1366, 1440, 1536, 1600, 1680, 1920, 2048, 2560, 4096];
    }

    private function addBasicImageSizes()
    {
        // add cropped image sizes
        add_action('after_setup_theme', function () {
            add_image_size('300x300', 300, 300, true);
            add_image_size('400x500', 400, 500, true);
            add_image_size('400x800', 400, 800, true);
        });
    }

    private function cropThumbnailsOnlyShowNeededSize()
    {
        // plugin "Crop-Thumbnails": only show only size that is needed in acf field (with e.g. "300x300" in description field)
        add_action('admin_footer', function () {
            ?>
            <script>
            document.addEventListener('click', (e) => {
                if( e.target.closest('.acf-field-image') ) {
                    if( e.target.matches('.acf-button') || e.target.matches('.acf-icon.-pencil') ) {
                        let size = e.target.closest('.acf-field-image').querySelector('.description').innerText;
                        if( size.match(/[0-9]+x[0-9]+/) ) {
                            let opened = false;
                            let t1 = setInterval(() => {
                                if( opened === false && document.querySelector('.media-modal-content') !== null ) {
                                    opened = true;
                                    document.head.insertAdjacentHTML('beforeend',`<style class="hide-crop-images">
                                        .cptImageSizelist li:not(.cptImageSize-${size}) { display:none !important; }
                                    </style>`);
                                }
                                if( opened === true && document.querySelector('.media-modal-content') === null ) {
                                    opened = false;
                                    if( document.querySelector('.hide-crop-images') !== null ) {
                                        document.querySelector('.hide-crop-images').remove();
                                    }
                                    clearInterval(t1);
                                }
                            },1000);
                        }
                    }
                }
            });
            </script>
            <?php
        });
    }

    private function enableCustomEditorStyle()
    {
        add_editor_style();
    }

    private function addFavicon()
    {
        add_action('wp_head', function () {
            echo '<link rel="icon" type="image/png" sizes="32x32" href="' . site_url() . '/favicon.png">';
        });
        add_action('admin_head', function () {
            echo '<link rel="icon" type="image/png" sizes="32x32" href="' . site_url() . '/favicon.png">';
        });
    }

    private function addMenus()
    {
        add_action('init', function () {
            register_nav_menus([
                'main-menu' => 'Main menu',
                'sub-menu' => 'Sub menu',
            ]);
        });
    }

    private function disableAutoParagraph()
    {
        remove_filter('the_content', 'wpautop');
        remove_filter('the_excerpt', 'wpautop');
        remove_filter('acf_the_content', 'wpautop');
    }

    private function removeAutoVersionFromScripts()
    {
        add_filter(
            'style_loader_src',
            function ($src) {
                return $this->removeAutoVersionFromScriptsFn($src);
            },
            9999
        );
        add_filter(
            'script_loader_src',
            function ($src) {
                return $this->removeAutoVersionFromScriptsFn($src);
            },
            9999
        );
    }

    private function removeAutoVersionFromScriptsFn($src)
    {
        if (strpos($src, 'ver=')) {
            $src = remove_query_arg('ver', $src);
        }
        // reload on every request on localhost
        if (!self::isProduction()) {
            $src = add_query_arg('ver', mt_rand(1000, 9999), $src);
        }
        return $src;
    }

    private function disableUserSniffing()
    {
        // source: https://www.wp-tweaks.com/hackers-can-find-your-wordpress-username
        add_action('template_redirect', function () {
            // redirect_to_home_if_author_parameter
            $is_author_set = get_query_var('author', '');
            if ($is_author_set != '' && !is_admin()) {
                wp_redirect(home_url(), 301);
                exit();
            }
        });

        add_filter('rest_endpoints', function ($endpoints) {
            // disable_rest_endpoints
            if (isset($endpoints['/wp/v2/users'])) {
                unset($endpoints['/wp/v2/users']);
            }
            if (isset($endpoints['/wp/v2/users/(?P<id>[\d]+)'])) {
                unset($endpoints['/wp/v2/users/(?P<id>[\d]+)']);
            }
            return $endpoints;
        });
    }

    private function disableUnneededArchives()
    {
        // disable category / tag / date / author / archive / attachments / search route
        add_action('template_redirect', function () {
            if (is_category() || is_tag() || is_date() || is_author() || is_attachment() || is_search()) {
                header('Status: 404 Not Found');
                global $wp_query;
                $wp_query->set_404();
                status_header(404);
                nocache_headers();
            }
        });
    }

    private function disableMediaSlugsFromTakingAwayPageSlugs()
    {
        add_filter('wp_unique_post_slug_is_bad_attachment_slug', '__return_true');
    }

    private function disableAutoQuoteConversion()
    {
        /* WordPress e.g. auto converts "" into „“ */
        add_filter('run_wptexturize', '__return_false');
    }

    private function removeEmojis()
    {
        add_action('init', function () {
            remove_action('wp_head', 'print_emoji_detection_script', 7);
            remove_action('admin_print_scripts', 'print_emoji_detection_script');
            remove_action('wp_print_styles', 'print_emoji_styles');
            remove_action('admin_print_styles', 'print_emoji_styles');
            remove_filter('the_content_feed', 'wp_staticize_emoji');
            remove_filter('comment_text_rss', 'wp_staticize_emoji');
            remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
        });
    }

    private function removeWordPressVersionInHead()
    {
        remove_action('wp_head', 'wp_generator');
    }

    private function disableWelcomeEmailsOnMultisiteRegistrations()
    {
        add_filter('wpmu_welcome_notification', '__return_false');
    }

    private function advancedCustomFieldsRemoveEditorsOnAllPages()
    {
        add_action('admin_init', function () {
            remove_post_type_support('post', 'editor');
            remove_post_type_support('page', 'editor');
        });
    }

    private function advancedCustomFieldsReduceWysiwygHeight()
    {
        // reduce wysiwyg editor height
        add_action('admin_head', function () {
            ?>
            <style>
                .acf-editor-wrap iframe {
                    min-height:100px;
                }
            </style>
            <?php
        });
        add_filter('acf/render_field/type=wysiwyg', [$this, 'preRenderWysiwygField'], 0, 1);
    }

    public function preRenderWysiwygField()
    {
        ob_start();
        add_filter('acf/render_field/type=wysiwyg', [$this, 'afterRenderWysiwygField'], 20, 1);
    }

    public function afterRenderWysiwygField()
    {
        remove_filter('acf/render_field/type=wysiwyg', [$this, 'afterRenderWysiwygField'], 20, 1);
        $output = ob_get_contents();
        $output = str_replace('height:300px;', 'height:100px;', $output);
        ob_end_clean();
        echo $output;
    }

    private function advancedCustomFieldsReenableCustomMetaBox()
    {
        add_filter('acf/settings/remove_wp_meta_box', '__return_false');
    }

    private function enableSvgUpload()
    {
        add_filter('upload_mimes', function ($existing_mimes = []) {
            $existing_mimes['vcf'] = 'text/x-vcard';
            $existing_mimes['svg'] = 'image/svg+xml';
            return $existing_mimes;
        });
        add_filter(
            'wp_check_filetype_and_ext',
            function ($data, $file, $filename, $mimes) {
                $filetype = wp_check_filetype($filename, $mimes);
                return [
                    'ext' => $filetype['ext'],
                    'type' => $filetype['type'],
                    'proper_filename' => $data['proper_filename'],
                ];
            },
            10,
            4
        );
    }

    private function enableMediaReplaceDisableOption()
    {
        // disable in plugin "Enable Media Replace" second option "Datei ersetzen, aber neuen Dateinamen verwenden und alle Links automatisch aktualisieren"
        add_filter(
            'emr_enable_replace_and_search',
            function () {
                return false;
            },
            10,
            0
        );
    }

    private function webPConverterAndCropThumbnailsFixPluginConflict()
    {
        // plugin "WebP Converter for Media": serve original image instead of webp-version for "Crop Featured Image" because webp-conversion is not yet ready at time of request
        add_filter(
            'webpc_htaccess_mod_rewrite',
            function ($rules, $path) {
                $rules = str_replace(
                    'RewriteCond %{HTTP_ACCEPT} image/webp',
                    "RewriteCond %{HTTP_ACCEPT} image/webp\n  # exclude resize in backend\n  RewriteCond %{QUERY_STRING} !cacheBreak=",
                    $rules
                );
                return $rules;
            },
            10,
            2
        );
    }

    private function autoClearCacheForWpFastestCache()
    {
        // clear cache for "WP Fastest Cache" programmatically every hour
        add_action('init', function () {
            $task = 'wp_fastest_cache_clear_cache';
            $frequency = 'daily'; // hourly|twicedaily|daily
            add_action($task, function () {
                if (function_exists('wpfc_clear_all_cache')) {
                    wpfc_clear_all_cache(true);
                }
            });
            if (!wp_next_scheduled($task)) {
                wp_schedule_event(strtotime(date('Y-m-d H:00:00', strtotime('now + 1 hour'))), $frequency, $task);
            }
        });
    }

    private static function yoastShowEmptyCategoriesInSitemap()
    {
        add_filter(
            'wpseo_sitemap_exclude_empty_terms',
            function () {
                return false;
            },
            10,
            2
        );
    }
}
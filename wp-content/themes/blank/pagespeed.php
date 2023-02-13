<?php
require_once __DIR__ . '/vendor/autoload.php';

// test with https://tld.com/?pagespeed=1&device=desktop|mobile

class Pagespeed
{
    private $cache_time = '4 weeks';

    private $data = [
        'delete' => [
            '*' => [
                '/html/body//footer',
                '/html/*//script'
            ],
            'desktop' => [],
            'mobile' => [
                '/html/body//img',
                '/html/body//picture',
                '/html/body//svg'
            ]
        ],
        'css' => [
            '*' => '',
            'desktop' => '',
            'mobile' => '
                body, html, .font-custom, header {
                    font-family: Arial;
                }
            '
        ],
        'js' => [
            '*' => '',
            'desktop' => '',
            'mobile' => ''
        ]
    ];

    function init()
    {
        $device = preg_match('/(Mobile.+Lighthouse)/', @$_SERVER['HTTP_USER_AGENT']) ? 'mobile' : 'desktop';
        if (isset($_GET['device']) && in_array($_GET['device'], ['desktop', 'mobile'])) {
            $device = $_GET['device'];
        }

        $baseurl =
            'http' .
            (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 's' : '') .
            '://' .
            $_SERVER['HTTP_HOST'];
        $cache_path = __DIR__ . '/../../cache/pagespeed';
        $path = isset($_GET['path']) ? strip_tags($_GET['path']) : '';
        $url = $baseurl . '/' . $path . '?no_cache=1';
        $filename = md5($url . '_' . $device) . '.html';
        $cache_file = $cache_path . '/' . $filename;

        if (
            @$_GET['pagespeed'] != '1' &&
            file_exists($cache_file) &&
            filemtime($cache_file) >= strtotime('now - ' . $this->cache_time)
        ) {
            $html = file_get_contents($cache_file);
        } else {
            $basic_auth = [];
            if( @$_SERVER['PHP_AUTH_USER'] != '' && @$_SERVER['PHP_AUTH_PW'] != '' ) {
                $basic_auth[$_SERVER['PHP_AUTH_USER']] = $_SERVER['PHP_AUTH_PW'];
            }
            $result = __curl($url, [], 'GET', [], false, false, 60, $basic_auth, [], true);
            $html = $result->result;

            $domdocument = __str_to_dom($html);
            $domxpath = new \DOMXPath($domdocument);

            foreach (['*', 'desktop', 'mobile'] as $types__value) {
                if ($types__value !== '*' && $types__value !== $device) {
                    continue;
                }
                foreach ($this->data['delete'][$types__value] as $selectors__value) {
                    $nodes = $domxpath->query($selectors__value);
                    foreach ($nodes as $nodes__value) {
                        $nodes__value->parentNode->removeChild($nodes__value);
                    }
                }
            }
            foreach (['*', 'desktop', 'mobile'] as $types__value) {
                if ($types__value !== '*' && $types__value !== $device) {
                    continue;
                }
                if ($this->data['css'][$types__value] == '') {
                    continue;
                }
                $style = $domdocument->createElement('style', '');
                $style->appendChild($domdocument->createTextNode($this->data['css'][$types__value]));
                $domxpath->query('/html/head')[0]->appendChild($style);
            }
            foreach (['*', 'desktop', 'mobile'] as $types__value) {
                if ($types__value !== '*' && $types__value !== $device) {
                    continue;
                }
                if ($this->data['js'][$types__value] == '') {
                    continue;
                }
                $script = $domdocument->createElement('script', '');
                $script->appendChild($domdocument->createTextNode($this->data['js'][$types__value]));
                $domxpath->query('/html/head')[0]->appendChild($script);
            }

            $html = __dom_to_str($domdocument);

            if (!is_dir($cache_path)) {
                mkdir($cache_path, 0777, true);
            }
            file_put_contents($cache_file, $html);
        }

        echo $html;
    }
}

$p = new Pagespeed();
$p->init();

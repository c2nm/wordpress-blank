<?php
namespace WP;

class Helper
{
    public function __construct()
    {
        $this->init();
    }

    private function init()
    {
        //$this->setModulePadding();
    }

    public static function setModulePadding($module_padding_top, $module_padding_bottom)
    {
        $module_padding = '';

        switch ($module_padding_top) {
            case 'null':
                $module_padding .= ' pt-0';
                break;
            case 'small':
                $module_padding .= ' pt-6 md:pt-12';
                break;
            case 'medium':
                $module_padding .= ' pt-10 md:pt-20';
                break;
            case 'large':
                $module_padding .= ' pt-14 md:pt-28';
                break;
        }

        switch ($module_padding_bottom) {
            case 'null':
                $module_padding .= ' pb-0';
                break;
            case 'small':
                $module_padding .= ' pb-6 md:pb-12';
                break;
            case 'medium':
                $module_padding .= ' pb-10 md:pb-20';
                break;
            case 'large':
                $module_padding .= ' pb-14 md:pb-28';
                break;
        }
        return $module_padding;
    }

    public static function getThumbnailUrl($id, $type)
    {
        $filename = md5($id) . '.jpg';
        $fallback = 'https://placehold.co/600x400';
        $folder_name = 'youtube-thumbnail';
        $folder_public = wp_upload_dir()['baseurl'] . '/' . $folder_name;
        $folder_path = wp_upload_dir()['basedir'] . '/' . $folder_name;
        $content = '';
        if (!file_exists($folder_path)) {
            mkdir($folder_path);
        }
        if (file_exists($folder_path . '/' . $filename)) {
            return $folder_public . '/' . $filename;
        }
        if ($type === 'youtube') {
            $content = @file_get_contents('https://img.youtube.com/vi/' . $id . '/0.jpg');
        }
        if ($content == '') {
            return $fallback;
        }
        file_put_contents($folder_path . '/' . $filename, $content);
        return $folder_public . '/' . $filename;
    }
}

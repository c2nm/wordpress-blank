<?php
namespace WP;

class Acf
{
    public function __construct()
    {
        $this->registerFields();
    }

    private function registerFields()
    {
        if (function_exists('acf_add_local_field_group')) {
            acf_add_local_field_group([
                'key' => 'group_' . md5('group_blocks'),
                'title' => 'Blocks',
                'fields' => [
                    [
                        'key' => 'field_' . md5('field_blocks'),
                        'label' => 'Blocks',
                        'name' => 'blocks',
                        'type' => 'flexible_content',
                        'layouts' => [
                            'layout_' . md5('field_blocks_image') => [
                                'key' => 'layout_' . md5('field_blocks_image'),
                                'name' => 'image',
                                'label' => 'Bild',
                                'display' => 'block',
                                'sub_fields' => [
                                    [
                                        'key' => 'field_' . md5('field_blocks_image_file'),
                                        'label' => 'Datei',
                                        'name' => 'image',
                                        'type' => 'image',
                                        'instructions' => '1600x1200',
                                        'return_format' => 'array'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
                'location' => [
                    [
                        [
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'page'
                        ]
                    ]
                ]
            ]);
        }
    }
}

<?php

namespace WP;

class Acf
{
    public function __construct()
    {
        $this->registerFields();
        $this->registerThemeSettings();
        $this->registerRecurringGroup();
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
                            'layout_' . md5('field_blocks_accordion_start') => [
                                'key' => 'layout_' . md5('field_blocks_accordion_start'),
                                'name' => 'accordion-start',
                                'label' => 'Accordion Start',
                                'display' => 'row',
                                'sub_fields' => [
                                    [
                                        'key' => 'field_' . md5('field_blocks_accordion_start_message'),
                                        'label' => 'Info',
                                        'name' => '',
                                        'type' => 'message',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => [
                                            'width' => '',
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'message' => 'Bitte platzieren Sie dieses Modul am Anfang des Accordions.',
                                        'new_lines' => 'wpautop',
                                        'esc_html' => 0
                                    ]
                                ],
                                'min' => '',
                                'max' => ''
                            ],
                            'layout_' . md5('field_blocks_accordion_item') => [
                                'key' => 'layout_' . md5('field_blocks_accordion_item'),
                                'name' => 'accordion-item',
                                'label' => 'Accordion Element',
                                'display' => 'row',
                                'sub_fields' => [
                                    [
                                        'key' => 'field_' . md5('field_blocks_accordion_item_title'),
                                        'label' => 'Überschrift',
                                        'name' => 'title',
                                        'type' => 'text',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => [
                                            'width' => '',
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'default_value' => '',
                                        'placeholder' => '',
                                        'prepend' => '',
                                        'append' => '',
                                        'maxlength' => ''
                                    ],
                                    [
                                        'key' => 'field_' . md5('field_blocks_accordion_item_message'),
                                        'label' => 'Info',
                                        'name' => '',
                                        'type' => 'message',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => [
                                            'width' => '',
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'message' => 'Bitte platzieren Sie dieses Modul vor jedem Element innerhalb des Accordions.',
                                        'new_lines' => 'wpautop',
                                        'esc_html' => 0
                                    ]
                                ],
                                'min' => '',
                                'max' => ''
                            ],
                            'layout_' . md5('field_blocks_accordion_end') => [
                                'key' => 'layout_' . md5('field_blocks_accordion_end'),
                                'name' => 'accordion-end',
                                'label' => 'Accordion Ende',
                                'display' => 'row',
                                'sub_fields' => [
                                    [
                                        'key' => 'field_' . md5('field_blocks_accordion_message'),
                                        'label' => 'Info',
                                        'name' => '',
                                        'type' => 'message',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => [
                                            'width' => '',
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'message' => 'Bitte platzieren Sie dieses Modul am Ende des Accordions.',
                                        'new_lines' => 'wpautop',
                                        'esc_html' => 0
                                    ]
                                ],
                                'min' => '',
                                'max' => ''
                            ],
                            'layout_' . md5('field_blocks_hero') => [
                                'key' => 'layout_' . md5('field_blocks_hero'),
                                'name' => 'hero',
                                'label' => 'Hero',
                                'display' => 'row',
                                'sub_fields' => [
                                    [
                                        'key' => 'field_' . md5('field_blocks_hero_padding'),
                                        'label' => 'Innere Abstände',
                                        'name' => 'module_padding',
                                        'type' => 'clone',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => [
                                            'width' => '',
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'clone' => [
                                            0 => 'field_' . md5('group_recurring_padding')
                                        ],
                                        'display' => 'seamless',
                                        'layout' => 'block',
                                        'prefix_label' => 0,
                                        'prefix_name' => 0
                                    ],
                                    [
                                        'key' => 'field_' . md5('field_blocks_hero_headline'),
                                        'label' => 'Headline',
                                        'name' => 'module_headline',
                                        'type' => 'clone',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => [
                                            'width' => '',
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'clone' => [
                                            0 => 'field_' . md5('group_recurring_headline')
                                        ],
                                        'display' => 'seamless',
                                        'layout' => 'block',
                                        'prefix_label' => 0,
                                        'prefix_name' => 0
                                    ],
                                    [
                                        'key' => 'field_' . md5('field_blocks_hero_media'),
                                        'label' => 'Medien',
                                        'name' => 'media',
                                        'type' => 'group',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => [
                                            'width' => '',
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'layout' => 'row',
                                        'sub_fields' => [
                                            [
                                                'key' => 'field_' . md5('field_blocks_hero_media_image'),
                                                'label' => 'Bild',
                                                'name' => 'image',
                                                'type' => 'image',
                                                'instructions' => '1920x600',
                                                'required' => 0,
                                                'conditional_logic' => 0,
                                                'wrapper' => [
                                                    'width' => '',
                                                    'class' => '',
                                                    'id' => ''
                                                ],
                                                'return_format' => 'array',
                                                'preview_size' => 'thumbnail',
                                                'library' => 'all',
                                                'min_width' => '',
                                                'min_height' => '',
                                                'min_size' => '',
                                                'max_width' => '',
                                                'max_height' => '',
                                                'max_size' => '',
                                                'mime_types' => ''
                                            ],
                                            [
                                                'key' => 'field_' . md5('field_blocks_hero_media_focus_points'),
                                                'label' => 'Fokuspunkte',
                                                'name' => 'focus_points',
                                                'type' => 'select',
                                                'instructions' => '',
                                                'required' => 0,
                                                'conditional_logic' => 0,
                                                'wrapper' => [
                                                    'width' => '',
                                                    'class' => '',
                                                    'id' => ''
                                                ],
                                                'choices' => [
                                                    'object-left-top' => 'links/oben',
                                                    'object-left' => 'links/zentriert',
                                                    'object-left-bottom' => 'links/unten',
                                                    'object-top' => 'zentriert/oben',
                                                    'object-center' => 'zentriert/zentriert',
                                                    'object-bottom' => 'zentriert/unten',
                                                    'object-right-top' => 'rechts/oben',
                                                    'object-right' => 'rechts/zentriert',
                                                    'object-right-bottom' => 'rechts/unten'
                                                ],
                                                'default_value' => 'object-center',
                                                'allow_null' => 0,
                                                'multiple' => 0,
                                                'ui' => 0,
                                                'return_format' => 'value',
                                                'ajax' => 0,
                                                'placeholder' => ''
                                            ]
                                        ]
                                    ],
                                    [
                                        'key' => 'field_' . md5('field_blocks_hero_content'),
                                        'label' => 'Inhalt',
                                        'name' => 'content',
                                        'type' => 'group',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => [
                                            'width' => '',
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'layout' => 'row',
                                        'sub_fields' => [
                                            [
                                                'key' => 'field_' . md5('field_blocks_hero_content_title'),
                                                'label' => 'Überschrift',
                                                'name' => 'title',
                                                'type' => 'text',
                                                'instructions' => '',
                                                'required' => 0,
                                                'conditional_logic' => 0,
                                                'wrapper' => [
                                                    'width' => '',
                                                    'class' => '',
                                                    'id' => ''
                                                ],
                                                'default_value' => '',
                                                'placeholder' => '',
                                                'prepend' => '',
                                                'append' => '',
                                                'maxlength' => ''
                                            ],
                                            [
                                                'key' => 'field_' . md5('field_blocks_hero_content_text'),
                                                'label' => 'Text',
                                                'name' => 'text',
                                                'type' => 'wysiwyg',
                                                'instructions' => '',
                                                'required' => 0,
                                                'conditional_logic' => 0,
                                                'wrapper' => [
                                                    'width' => '50',
                                                    'class' => '',
                                                    'id' => ''
                                                ],
                                                'default_value' => '',
                                                'tabs' => 'all',
                                                'toolbar' => 'full',
                                                'media_upload' => 0,
                                                'delay' => 0
                                            ],
                                            [
                                                'key' => 'field_' . md5('field_blocks_hero_content_layout'),
                                                'label' => 'Layout',
                                                'name' => 'text_layout',
                                                'type' => 'select',
                                                'instructions' => '',
                                                'required' => 0,
                                                'conditional_logic' => 0,
                                                'wrapper' => [
                                                    'width' => '50',
                                                    'class' => '',
                                                    'id' => ''
                                                ],
                                                'choices' => [
                                                    'left-top' => 'links/oben',
                                                    'left-bottom' => 'links/unten',
                                                    'left-center' => 'links/zentriert',
                                                    'right-top' => 'rechts/oben',
                                                    'right-bottom' => 'rechts/unten',
                                                    'right-center' => 'rechts/zentriert'
                                                ],
                                                'default_value' => false,
                                                'allow_null' => 0,
                                                'multiple' => 0,
                                                'ui' => 0,
                                                'return_format' => 'value',
                                                'ajax' => 0,
                                                'placeholder' => ''
                                            ]
                                        ]
                                    ]
                                ],
                                'min' => '',
                                'max' => ''
                            ],
                            'layout_' . md5('field_blocks_image') => [
                                'key' => 'layout_' . md5('field_blocks_image'),
                                'name' => 'image',
                                'label' => 'Bild',
                                'display' => 'block',
                                'sub_fields' => [
                                    [
                                        'key' => 'field_' . md5('field_blocks_image_padding'),
                                        'label' => 'Innere Abstände',
                                        'name' => 'module_padding',
                                        'type' => 'clone',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => [
                                            'width' => '',
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'clone' => [
                                            0 => 'field_' . md5('group_recurring_padding')
                                        ],
                                        'display' => 'seamless',
                                        'layout' => 'block',
                                        'prefix_label' => 0,
                                        'prefix_name' => 0
                                    ],
                                    [
                                        'key' => 'field_' . md5('field_blocks_image_headline'),
                                        'label' => 'Headline',
                                        'name' => 'module_headline',
                                        'type' => 'clone',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => [
                                            'width' => '',
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'clone' => [
                                            0 => 'field_' . md5('group_recurring_headline')
                                        ],
                                        'display' => 'seamless',
                                        'layout' => 'block',
                                        'prefix_label' => 0,
                                        'prefix_name' => 0
                                    ],
                                    [
                                        'key' => 'field_' . md5('field_blocks_image_file'),
                                        'label' => 'Bild',
                                        'name' => 'image',
                                        'type' => 'image',
                                        'instructions' => '',
                                        'return_format' => 'array',
                                    ],
                                ],
                            ],
                            'layout_' . md5('field_blocks_iframe') => [
                                'key' => 'layout_' . md5('field_blocks_iframe'),
                                'name' => 'iframe',
                                'label' => 'Iframe',
                                'display' => 'row',
                                'sub_fields' => [
                                    [
                                        'key' => 'field_' . md5('field_blocks_iframe_padding'),
                                        'label' => 'Innere Abstände',
                                        'name' => 'module_padding',
                                        'type' => 'clone',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => [
                                            'width' => '',
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'clone' => [
                                            0 => 'field_' . md5('group_recurring_padding')
                                        ],
                                        'display' => 'seamless',
                                        'layout' => 'block',
                                        'prefix_label' => 0,
                                        'prefix_name' => 0
                                    ],
                                    [
                                        'key' => 'field_' . md5('field_blocks_iframe_headline'),
                                        'label' => 'Headline',
                                        'name' => 'module_headline',
                                        'type' => 'clone',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => [
                                            'width' => '',
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'clone' => [
                                            0 => 'field_' . md5('group_recurring_headline')
                                        ],
                                        'display' => 'seamless',
                                        'layout' => 'block',
                                        'prefix_label' => 0,
                                        'prefix_name' => 0
                                    ],
                                    [
                                        'key' => 'field_' . md5('field_blocks_iframe_code'),
                                        'label' => 'HTML-Code',
                                        'name' => 'iframe',
                                        'type' => 'textarea',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => [
                                            'width' => '',
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'default_value' => '',
                                        'placeholder' => '',
                                        'maxlength' => '',
                                        'rows' => '',
                                        'new_lines' => ''
                                    ],
                                    [
                                        'key' => 'field_' . md5('field_blocks_iframe_text'),
                                        'label' => 'Fließtext',
                                        'name' => 'text',
                                        'type' => 'wysiwyg',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => [
                                            'width' => '',
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'default_value' => '',
                                        'tabs' => 'all',
                                        'toolbar' => 'full',
                                        'media_upload' => 1,
                                        'delay' => 0
                                    ]
                                ],
                                'min' => '',
                                'max' => ''
                            ],
                            'layout_' . md5('field_blocks_teasers') => [
                                'key' => 'layout_' . md5('field_blocks_teasers'),
                                'name' => 'teasers',
                                'label' => 'Teasers',
                                'display' => 'row',
                                'sub_fields' => [
                                    [
                                        'key' => 'field_' . md5('field_blocks_teasers_padding'),
                                        'label' => 'Innere Abstände',
                                        'name' => 'module_padding',
                                        'type' => 'clone',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => [
                                            'width' => '',
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'clone' => [
                                            0 => 'field_' . md5('group_recurring_padding')
                                        ],
                                        'display' => 'seamless',
                                        'layout' => 'block',
                                        'prefix_label' => 0,
                                        'prefix_name' => 0
                                    ],
                                    [
                                        'key' => 'field_' . md5('field_blocks_teasers_headline'),
                                        'label' => 'Headline',
                                        'name' => 'module_headline',
                                        'type' => 'clone',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => [
                                            'width' => '',
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'clone' => [
                                            0 => 'field_' . md5('group_recurring_headline')
                                        ],
                                        'display' => 'seamless',
                                        'layout' => 'block',
                                        'prefix_label' => 0,
                                        'prefix_name' => 0
                                    ],
                                    [
                                        'key' => 'field_' . md5('field_blocks_teasers_boxes'),
                                        'label' => 'Teasers',
                                        'name' => 'teasers',
                                        'type' => 'repeater',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => [
                                            'width' => '',
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'collapsed' => '',
                                        'min' => 0,
                                        'max' => 0,
                                        'layout' => 'row',
                                        'button_label' => '',
                                        'sub_fields' => [
                                            [
                                                'key' => 'field_' . md5('field_blocks_teasers_boxes_image'),
                                                'label' => 'Bild',
                                                'name' => 'image',
                                                'type' => 'image',
                                                'instructions' => '',
                                                'required' => 0,
                                                'conditional_logic' => 0,
                                                'wrapper' => [
                                                    'width' => '',
                                                    'class' => '',
                                                    'id' => ''
                                                ],
                                                'return_format' => 'array',
                                                'preview_size' => 'thumbnail',
                                                'library' => 'all',
                                                'min_width' => '',
                                                'min_height' => '',
                                                'min_size' => '',
                                                'max_width' => '',
                                                'max_height' => '',
                                                'max_size' => '',
                                                'mime_types' => ''
                                            ],
                                            [
                                                'key' => 'field_' . md5('field_blocks_teasers_boxes_content'),
                                                'label' => 'Inhalt',
                                                'name' => 'content',
                                                'type' => 'group',
                                                'instructions' => '',
                                                'required' => 0,
                                                'conditional_logic' => 0,
                                                'wrapper' => [
                                                    'width' => '',
                                                    'class' => '',
                                                    'id' => ''
                                                ],
                                                'layout' => 'block',
                                                'sub_fields' => [
                                                    [
                                                        'key' => 'field_' . md5('field_blocks_teasers_boxes_content_title'),
                                                        'label' => 'Überschrift',
                                                        'name' => 'title',
                                                        'type' => 'text',
                                                        'instructions' => '',
                                                        'required' => 0,
                                                        'conditional_logic' => 0,
                                                        'wrapper' => [
                                                            'width' => '',
                                                            'class' => '',
                                                            'id' => ''
                                                        ],
                                                        'default_value' => '',
                                                        'placeholder' => '',
                                                        'prepend' => '',
                                                        'append' => '',
                                                        'maxlength' => ''
                                                    ],
                                                    [
                                                        'key' => 'field_' . md5('field_blocks_teasers_boxes_content_text'),
                                                        'label' => 'Text',
                                                        'name' => 'text',
                                                        'type' => 'wysiwyg',
                                                        'instructions' => '',
                                                        'required' => 0,
                                                        'conditional_logic' => 0,
                                                        'wrapper' => [
                                                            'width' => '',
                                                            'class' => '',
                                                            'id' => ''
                                                        ],
                                                        'default_value' => '',
                                                        'tabs' => 'all',
                                                        'toolbar' => 'full',
                                                        'media_upload' => 0,
                                                        'delay' => 0
                                                    ]
                                                ]
                                            ]
                                        ]
                                    ]
                                ],
                                'min' => '',
                                'max' => ''
                            ],
                            'layout_' . md5('field_blocks_anchor_link') => [
                                'key' => 'layout_' . md5('field_blocks_anchor_link'),
                                'name' => 'anchor-link',
                                'label' => 'Sprunganker-Link',
                                'display' => 'row',
                                'sub_fields' => [
                                    [
                                        'key' => 'field_' . md5('field_blocks_anchor_slug'),
                                        'label' => 'Beschriftung',
                                        'name' => 'slug',
                                        'type' => 'text',
                                        'instructions' => '',
                                        'required' => 1,
                                        'conditional_logic' => 0,
                                        'wrapper' => [
                                            'width' => '',
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'default_value' => '',
                                        'placeholder' => '',
                                        'prepend' => '',
                                        'append' => '',
                                        'maxlength' => ''
                                    ],
                                    [
                                        'key' => 'field_' . md5('field_blocks_anchor_link_hide'),
                                        'label' => 'Nicht in Navigation anzeigen',
                                        'name' => 'hide_anchor_link',
                                        'type' => 'true_false',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => [
                                            'width' => '',
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'message' => '',
                                        'default_value' => 0,
                                        'ui' => 0,
                                        'ui_on_text' => '',
                                        'ui_off_text' => ''
                                    ]
                                ],
                                'min' => '',
                                'max' => ''
                            ],
                            'layout_' . md5('field_blocks_anchor_navigation') => [
                                'key' => 'layout_' . md5('field_blocks_anchor_navigation'),
                                'name' => 'anchor-navigation',
                                'label' => 'Sprunganker-Navigation',
                                'display' => 'row',
                                'sub_fields' => [
                                    [
                                        'key' => 'field_' . md5('field_blocks_anchor_navigation_message'),
                                        'label' => 'Info',
                                        'name' => '',
                                        'type' => 'message',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => [
                                            'width' => '',
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'message' => 'Inhalt wird automatisch erzeugt.',
                                        'new_lines' => 'wpautop',
                                        'esc_html' => 0
                                    ]
                                ],
                                'min' => '',
                                'max' => ''
                            ],
                            'layout_' . md5('field_blocks_spacer') => [
                                'key' => 'layout_' . md5('field_blocks_spacer'),
                                'name' => 'spacer',
                                'label' => 'Trenner',
                                'display' => 'row',
                                'sub_fields' => [
                                    [
                                        'key' => 'field_' . md5('field_blocks_spacer_height'),
                                        'label' => 'Trenner Höhe',
                                        'name' => 'spacer_height',
                                        'type' => 'select',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => [
                                            'width' => '',
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'choices' => [
                                            'small' => 'Klein',
                                            'medium' => 'Medium',
                                            'large' => 'Groß'
                                        ],
                                        'default_value' => 'small',
                                        'allow_null' => 0,
                                        'multiple' => 0,
                                        'ui' => 0,
                                        'return_format' => 'value',
                                        'ajax' => 0,
                                        'placeholder' => ''
                                    ],
                                    [
                                        'key' => 'field_' . md5('field_blocks_spacer_border'),
                                        'label' => 'Trennlinie anzeigen',
                                        'name' => 'spacer_border',
                                        'type' => 'true_false',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => [
                                            'width' => '',
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'message' => '',
                                        'default_value' => 0,
                                        'ui' => 0,
                                        'ui_on_text' => '',
                                        'ui_off_text' => ''
                                    ]
                                ],
                                'min' => '',
                                'max' => ''
                            ],
                            'layout_' . md5('field_blocks_table') => [
                                'key' => 'layout_' . md5('field_blocks_table'),
                                'name' => 'table',
                                'label' => 'Tabelle',
                                'display' => 'row',
                                'sub_fields' => [
                                    [
                                        'key' => 'field_' . md5('field_blocks_table_padding'),
                                        'label' => 'Innere Abstände',
                                        'name' => 'module_padding',
                                        'type' => 'clone',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => [
                                            'width' => '',
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'clone' => [
                                            0 => 'field_' . md5('group_recurring_padding')
                                        ],
                                        'display' => 'seamless',
                                        'layout' => 'block',
                                        'prefix_label' => 0,
                                        'prefix_name' => 0
                                    ],
                                    [
                                        'key' => 'field_' . md5('field_blocks_table_headline'),
                                        'label' => 'Headline',
                                        'name' => 'module_headline',
                                        'type' => 'clone',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => [
                                            'width' => '',
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'clone' => [
                                            0 => 'field_' . md5('group_recurring_headline')
                                        ],
                                        'display' => 'seamless',
                                        'layout' => 'block',
                                        'prefix_label' => 0,
                                        'prefix_name' => 0
                                    ],
                                    [
                                        'key' => 'field_' . md5('field_blocks_table_table'),
                                        'label' => 'Tabelle',
                                        'name' => 'table',
                                        'type' => 'wysiwyg',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => [
                                            'width' => '',
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'default_value' => '',
                                        'tabs' => 'all',
                                        'toolbar' => 'full',
                                        'media_upload' => 0,
                                        'delay' => 0
                                    ]
                                ],
                                'min' => '',
                                'max' => ''
                            ],
                            'layout_' . md5('field_blocks_text') => [
                                'key' => 'layout_' . md5('field_blocks_text'),
                                'name' => 'text',
                                'label' => 'Text',
                                'display' => 'row',
                                'sub_fields' => [
                                    [
                                        'key' => 'field_' . md5('field_blocks_text_padding'),
                                        'label' => 'Innere Abstände',
                                        'name' => 'module_padding',
                                        'type' => 'clone',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => [
                                            'width' => '',
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'clone' => [
                                            0 => 'field_' . md5('group_recurring_padding')
                                        ],
                                        'display' => 'seamless',
                                        'layout' => 'block',
                                        'prefix_label' => 0,
                                        'prefix_name' => 0
                                    ],
                                    [
                                        'key' => 'field_' . md5('field_blocks_text_headline'),
                                        'label' => 'Headline',
                                        'name' => 'module_headline',
                                        'type' => 'clone',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => [
                                            'width' => '',
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'clone' => [
                                            0 => 'field_' . md5('group_recurring_headline')
                                        ],
                                        'display' => 'seamless',
                                        'layout' => 'block',
                                        'prefix_label' => 0,
                                        'prefix_name' => 0
                                    ],
                                    [
                                        'key' => 'field_' . md5('field_blocks_text_text'),
                                        'label' => 'Text',
                                        'name' => 'text',
                                        'type' => 'wysiwyg',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => [
                                            'width' => '',
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'default_value' => '',
                                        'tabs' => 'all',
                                        'toolbar' => 'full',
                                        'media_upload' => 0,
                                        'delay' => 0
                                    ]
                                ],
                                'min' => '',
                                'max' => ''
                            ],
                            'layout_' . md5('field_blocks_text_image') => [
                                'key' => 'layout_' . md5('field_blocks_text_image'),
                                'name' => 'text-image',
                                'label' => 'Text + Bild',
                                'display' => 'row',
                                'sub_fields' => [
                                    [
                                        'key' => 'field_' . md5('field_blocks_text_image_padding'),
                                        'label' => 'Innere Abstände',
                                        'name' => 'module_padding',
                                        'type' => 'clone',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => [
                                            'width' => '',
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'clone' => [
                                            0 => 'field_' . md5('group_recurring_padding')
                                        ],
                                        'display' => 'seamless',
                                        'layout' => 'block',
                                        'prefix_label' => 0,
                                        'prefix_name' => 0
                                    ],
                                    [
                                        'key' => 'field_' . md5('field_blocks_text_image_headline'),
                                        'label' => 'Headline',
                                        'name' => 'module_headline',
                                        'type' => 'clone',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => [
                                            'width' => '',
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'clone' => [
                                            0 => 'field_' . md5('group_recurring_headline')
                                        ],
                                        'display' => 'seamless',
                                        'layout' => 'block',
                                        'prefix_label' => 0,
                                        'prefix_name' => 0
                                    ],
                                    [
                                        'key' => 'field_' . md5('field_blocks_text_image_order'),
                                        'label' => 'Reihenfolge',
                                        'name' => 'order',
                                        'type' => 'select',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => [
                                            'width' => '',
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'choices' => [
                                            'text_image' => 'Text + Bild',
                                            'image_text' => 'Bild + Text'
                                        ],
                                        'default_value' => 'text_image',
                                        'allow_null' => 0,
                                        'multiple' => 0,
                                        'ui' => 0,
                                        'return_format' => 'value',
                                        'ajax' => 0,
                                        'placeholder' => ''
                                    ],
                                    [
                                        'key' => 'field_' . md5('field_blocks_text_image_image'),
                                        'label' => 'Bild',
                                        'name' => 'image',
                                        'type' => 'image',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => [
                                            'width' => '50',
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'return_format' => 'array',
                                        'preview_size' => 'thumbnail',
                                        'library' => 'all',
                                        'min_width' => '',
                                        'min_height' => '',
                                        'min_size' => '',
                                        'max_width' => '',
                                        'max_height' => '',
                                        'max_size' => '',
                                        'mime_types' => ''
                                    ],
                                    [
                                        'key' => 'field_' . md5('field_blocks_text_image_image_caption'),
                                        'label' => 'Bildbeschreibung',
                                        'name' => 'image_caption',
                                        'type' => 'wysiwyg',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => [
                                            'width' => '50',
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'default_value' => '',
                                        'tabs' => 'all',
                                        'toolbar' => 'full',
                                        'media_upload' => 1,
                                        'delay' => 0,
                                        'height' => 65
                                    ],
                                    [
                                        'key' => 'field_' . md5('field_blocks_text_image_text'),
                                        'label' => 'Text',
                                        'name' => 'text',
                                        'type' => 'wysiwyg',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => [
                                            'width' => '50',
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'default_value' => '',
                                        'tabs' => 'all',
                                        'toolbar' => 'full',
                                        'media_upload' => 1,
                                        'delay' => 0
                                    ],
                                ],
                                'min' => '',
                                'max' => ''
                            ],
                            'layout_' . md5('field_blocks_text_two_cols') => [
                                'key' => 'layout_' . md5('field_blocks_text_two_cols'),
                                'name' => 'text-two-cols',
                                'label' => 'Text + Text',
                                'display' => 'row',
                                'sub_fields' => [
                                    [
                                        'key' => 'field_' . md5('field_blocks_text_two_cols_padding'),
                                        'label' => 'Innere Abstände',
                                        'name' => 'module_padding',
                                        'type' => 'clone',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => [
                                            'width' => '',
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'clone' => [
                                            0 => 'field_' . md5('group_recurring_padding')
                                        ],
                                        'display' => 'seamless',
                                        'layout' => 'block',
                                        'prefix_label' => 0,
                                        'prefix_name' => 0
                                    ],
                                    [
                                        'key' => 'field_' . md5('field_blocks_text_two_cols_headline'),
                                        'label' => 'Headline',
                                        'name' => 'module_headline',
                                        'type' => 'clone',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => [
                                            'width' => '',
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'clone' => [
                                            0 => 'field_' . md5('group_recurring_headline')
                                        ],
                                        'display' => 'seamless',
                                        'layout' => 'block',
                                        'prefix_label' => 0,
                                        'prefix_name' => 0
                                    ],
                                    [
                                        'key' => 'field_' . md5('field_blocks_text_two_cols_text_left'),
                                        'label' => 'Text (links)',
                                        'name' => 'text_left',
                                        'type' => 'wysiwyg',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => [
                                            'width' => '50',
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'default_value' => '',
                                        'tabs' => 'all',
                                        'toolbar' => 'full',
                                        'media_upload' => 1,
                                        'delay' => 0
                                    ],
                                    [
                                        'key' => 'field_' . md5('field_blocks_text_two_cols_text_right'),
                                        'label' => 'Text (rechts)',
                                        'name' => 'text_right',
                                        'type' => 'wysiwyg',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => [
                                            'width' => '50',
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'default_value' => '',
                                        'tabs' => 'all',
                                        'toolbar' => 'full',
                                        'media_upload' => 1,
                                        'delay' => 0
                                    ],
                                ],
                                'min' => '',
                                'max' => ''
                            ],
                            'layout_' . md5('field_blocks_video') => [
                                'key' => 'layout_' . md5('field_blocks_video'),
                                'name' => 'video',
                                'label' => 'Video',
                                'display' => 'row',
                                'sub_fields' => [
                                    [
                                        'key' => 'field_' . md5('field_blocks_video_padding'),
                                        'label' => 'Innere Abstände',
                                        'name' => 'module_padding',
                                        'type' => 'clone',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => [
                                            'width' => '',
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'clone' => [
                                            0 => 'field_' . md5('group_recurring_padding')
                                        ],
                                        'display' => 'seamless',
                                        'layout' => 'block',
                                        'prefix_label' => 0,
                                        'prefix_name' => 0
                                    ],
                                    [
                                        'key' => 'field_' . md5('field_blocks_video_headline'),
                                        'label' => 'Headline',
                                        'name' => 'module_headline',
                                        'type' => 'clone',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => [
                                            'width' => '',
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'clone' => [
                                            0 => 'field_' . md5('group_recurring_headline')
                                        ],
                                        'display' => 'seamless',
                                        'layout' => 'block',
                                        'prefix_label' => 0,
                                        'prefix_name' => 0
                                    ],
                                    [
                                        'key' => 'field_' . md5('field_blocks_video_video'),
                                        'label' => 'Video',
                                        'name' => 'video',
                                        'type' => 'clone',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => [
                                            'width' => '',
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'clone' => [
                                            0 => 'field_' . md5('group_recurring_video')
                                        ],
                                        'display' => 'seamless',
                                        'layout' => 'block',
                                        'prefix_label' => 0,
                                        'prefix_name' => 0
                                    ]
                                ],
                                'min' => '',
                                'max' => ''
                            ],
                            'layout_' . md5('field_blocks_quote') => [
                                'key' => 'layout_' . md5('field_blocks_quote'),
                                'name' => 'quote',
                                'label' => 'Zitat',
                                'display' => 'row',
                                'sub_fields' => [
                                    [
                                        'key' => 'field_' . md5('field_blocks_quote_padding'),
                                        'label' => 'Innere Abstände',
                                        'name' => 'module_padding',
                                        'type' => 'clone',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => [
                                            'width' => '',
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'clone' => [
                                            0 => 'field_' . md5('group_recurring_padding')
                                        ],
                                        'display' => 'seamless',
                                        'layout' => 'block',
                                        'prefix_label' => 0,
                                        'prefix_name' => 0
                                    ],
                                    [
                                        'key' => 'field_' . md5('field_blocks_quote_headline'),
                                        'label' => 'Headline',
                                        'name' => 'module_headline',
                                        'type' => 'clone',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => [
                                            'width' => '',
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'clone' => [
                                            0 => 'field_' . md5('group_recurring_headline')
                                        ],
                                        'display' => 'seamless',
                                        'layout' => 'block',
                                        'prefix_label' => 0,
                                        'prefix_name' => 0
                                    ],
                                    [
                                        'key' => 'field_' . md5('field_blocks_quote_quote'),
                                        'label' => 'Zitat',
                                        'name' => 'quote',
                                        'type' => 'group',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => [
                                            'width' => '',
                                            'class' => '',
                                            'id' => ''
                                        ],
                                        'layout' => 'row',
                                        'sub_fields' => [
                                            [
                                                'key' => 'field_' . md5('field_blocks_quote_quote_content'),
                                                'label' => 'Inhalt',
                                                'name' => 'content',
                                                'type' => 'textarea',
                                                'instructions' => '',
                                                'required' => 0,
                                                'conditional_logic' => 0,
                                                'wrapper' => [
                                                    'width' => '',
                                                    'class' => '',
                                                    'id' => ''
                                                ],
                                                'default_value' => '',
                                                'placeholder' => '',
                                                'maxlength' => '',
                                                'rows' => '',
                                                'new_lines' => ''
                                            ],
                                            [
                                                'key' => 'field_' . md5('field_blocks_quote_quote_author'),
                                                'label' => 'Autor',
                                                'name' => 'author',
                                                'type' => 'text',
                                                'instructions' => '',
                                                'required' => 0,
                                                'conditional_logic' => 0,
                                                'wrapper' => [
                                                    'width' => '',
                                                    'class' => '',
                                                    'id' => ''
                                                ],
                                                'default_value' => '',
                                                'placeholder' => '',
                                                'prepend' => '',
                                                'append' => '',
                                                'maxlength' => ''
                                            ]
                                        ]
                                    ]
                                ],
                                'min' => '',
                                'max' => ''
                            ],
                        ],
                    ],
                ],
                'location' => [
                    [
                        [
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'page',
                        ],
                    ],
                    [
                        [
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'post',
                        ],
                    ],
                ],
            ]);
        }
    }

    private function registerThemeSettings()
    {
        add_action('acf/init', function () {
            acf_add_options_page([
                'page_title' => 'Website-Einstellungen',
                'menu_title' => 'Website-Einstellungen',
                'menu_slug' => 'theme-settings',
                'capability' => 'edit_posts',
                'redirect' => false,
                'position' => 4
            ]);
        });

        acf_add_local_field_group([
            'key' => 'group_' . md5('group_page_settings'),
            'title' => 'Website-Einstellungen',
            'fields' => [
                [
                    'key' => 'field_' . md5('group_page_settings_header'),
                    'label' => 'Header',
                    'name' => '',
                    'type' => 'tab',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => ''
                    ],
                    'placement' => 'top',
                    'endpoint' => 0
                ],
                [
                    'key' => 'field_' . md5('group_page_settings_header_logo'),
                    'label' => 'Logo',
                    'name' => 'logo',
                    'type' => 'image',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => ''
                    ],
                    'return_format' => 'array',
                    'preview_size' => 'thumbnail',
                    'library' => 'all',
                    'min_width' => '',
                    'min_height' => '',
                    'min_size' => '',
                    'max_width' => '',
                    'max_height' => '',
                    'max_size' => '',
                    'mime_types' => ''
                ],
                [
                    'key' => 'field_' . md5('group_page_settings_footer'),
                    'label' => 'Footer',
                    'name' => '',
                    'type' => 'tab',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => ''
                    ],
                    'placement' => 'top',
                    'endpoint' => 0
                ],
                [
                    'key' => 'field_' . md5('group_page_settings_footer_logo'),
                    'label' => 'Footer-Logo',
                    'name' => 'footer_logo',
                    'type' => 'image',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => ''
                    ],
                    'return_format' => 'array',
                    'preview_size' => 'thumbnail',
                    'library' => 'all',
                    'min_width' => '',
                    'min_height' => '',
                    'min_size' => '',
                    'max_width' => '',
                    'max_height' => '',
                    'max_size' => '',
                    'mime_types' => ''
                ],
                [
                    'key' => 'field_' . md5('group_page_settings_footer_copyright'),
                    'label' => 'Copyright Text',
                    'name' => 'footer_copyright',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => ''
                    ],
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => ''
                ],
                [
                    'key' => 'field_' . md5('group_page_settings_banner'),
                    'label' => 'Störer',
                    'name' => '',
                    'type' => 'tab',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => ''
                    ],
                    'placement' => 'top',
                    'endpoint' => 0
                ],
                [
                    'key' => 'field_' . md5('group_page_settings_banner_active'),
                    'label' => 'Störer aktivieren',
                    'name' => 'banner_active',
                    'type' => 'true_false',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => ''
                    ],
                    'message' => '',
                    'default_value' => 0,
                    'ui' => 0,
                    'ui_on_text' => '',
                    'ui_off_text' => ''
                ],
                [
                    'key' => 'field_' . md5('group_page_settings_banner_title'),
                    'label' => 'Überschrift',
                    'name' => 'banner_title',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => ''
                    ],
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => ''
                ],
                [
                    'key' => 'field_' . md5('group_page_settings_banner_text'),
                    'label' => 'Text',
                    'name' => 'banner_text',
                    'type' => 'wysiwyg',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => ''
                    ],
                    'default_value' => '',
                    'tabs' => 'all',
                    'toolbar' => 'full',
                    'media_upload' => 1,
                    'delay' => 0
                ],
                [
                    'key' => 'field_' . md5('group_page_settings_social_media'),
                    'label' => 'Social-Media',
                    'name' => '',
                    'type' => 'tab',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => ''
                    ],
                    'placement' => 'top',
                    'endpoint' => 0
                ],
                [
                    'key' => 'field_' . md5('group_page_settings_social_media_facebook'),
                    'label' => 'Facebook',
                    'name' => 'sm_facebook',
                    'type' => 'url',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => ''
                    ],
                    'default_value' => '',
                    'placeholder' => ''
                ],
                [
                    'key' => 'field_' . md5('group_page_settings_social_media_twitter'),
                    'label' => 'Twitter',
                    'name' => 'sm_twitter',
                    'type' => 'url',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => ''
                    ],
                    'default_value' => '',
                    'placeholder' => ''
                ],
                [
                    'key' => 'field_' . md5('group_page_settings_social_media_instagram'),
                    'label' => 'Instagram',
                    'name' => 'sm_instagram',
                    'type' => 'url',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => ''
                    ],
                    'default_value' => '',
                    'placeholder' => ''
                ],
                [
                    'key' => 'field_' . md5('group_page_settings_social_media_pinterest'),
                    'label' => 'Pinterest',
                    'name' => 'sm_pinterest',
                    'type' => 'url',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => ''
                    ],
                    'default_value' => '',
                    'placeholder' => ''
                ],
                [
                    'key' => 'field_' . md5('group_page_settings_social_media_youtube'),
                    'label' => 'YouTube',
                    'name' => 'sm_youtube',
                    'type' => 'url',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => ''
                    ],
                    'default_value' => '',
                    'placeholder' => ''
                ],
                [
                    'key' => 'field_' . md5('group_page_settings_popups'),
                    'label' => 'Popups',
                    'name' => '',
                    'type' => 'tab',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => ''
                    ],
                    'placement' => 'top',
                    'endpoint' => 0
                ],
                [
                    'key' => 'field_' . md5('group_page_settings_popups_newsletter'),
                    'label' => 'Newsletter Popup',
                    'name' => 'newsletter_popup',
                    'type' => 'group',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => [
                        'width' => '50',
                        'class' => '',
                        'id' => ''
                    ],
                    'layout' => 'row',
                    'sub_fields' => [
                        [
                            'key' => 'field_' . md5('group_page_settings_popups_newsletter_active'),
                            'label' => 'Newsletter Popup aktivieren',
                            'name' => 'newsletter_popup_active',
                            'type' => 'true_false',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => [
                                'width' => '',
                                'class' => '',
                                'id' => ''
                            ],
                            'message' => '',
                            'default_value' => 0,
                            'ui' => 0,
                            'ui_on_text' => '',
                            'ui_off_text' => ''
                        ],
                        [
                            'key' => 'field_' . md5('group_page_settings_popups_newsletter_title'),
                            'label' => 'Title',
                            'name' => 'newsletter_popup_title',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => [
                                'width' => '',
                                'class' => '',
                                'id' => ''
                            ],
                            'default_value' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'maxlength' => ''
                        ],
                        [
                            'key' => 'field_' . md5('group_page_settings_popups_newsletter_text'),
                            'label' => 'Text',
                            'name' => 'newsletter_popup_text',
                            'type' => 'wysiwyg',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => [
                                'width' => '',
                                'class' => '',
                                'id' => ''
                            ],
                            'default_value' => '',
                            'tabs' => 'all',
                            'toolbar' => 'full',
                            'media_upload' => 1,
                            'delay' => 0
                        ]
                    ]
                ],
                [
                    'key' => 'field_' . md5('group_page_settings_404'),
                    'label' => '404 Seite',
                    'name' => '',
                    'type' => 'tab',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => ''
                    ],
                    'placement' => 'top',
                    'endpoint' => 0
                ],
                [
                    'key' => 'field_' . md5('group_page_settings_404_text'),
                    'label' => 'Text',
                    'name' => '404_text',
                    'type' => 'wysiwyg',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => ''
                    ],
                    'default_value' => '',
                    'tabs' => 'all',
                    'toolbar' => 'full',
                    'media_upload' => 1,
                    'delay' => 0
                ],
                [
                    'key' => 'field_' . md5('group_page_settings_text'),
                    'label' => 'Hilfetext',
                    'name' => 'help_text',
                    'type' => 'wysiwyg',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => ''
                    ],
                    'default_value' => '',
                    'tabs' => 'all',
                    'toolbar' => 'full',
                    'media_upload' => 0,
                    'delay' => 0
                ]
            ],
            'location' => [
                [
                    [
                        'param' => 'options_page',
                        'operator' => '==',
                        'value' => 'theme-settings'
                    ]
                ]
            ],
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
            'description' => '',
            'show_in_rest' => 0
        ]);
    }

    private function registerRecurringGroup()
    {
        acf_add_local_field_group([
            'key' => 'group_' . md5('group_recurring'),
            'title' => 'Wiederkehrende',
            'fields' => [
                [
                    'key' => 'field_' . md5('group_recurring_padding'),
                    'label' => 'Innere Abstände',
                    'name' => 'module_padding',
                    'type' => 'group',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => ''
                    ],
                    'layout' => 'row',
                    'sub_fields' => [
                        [
                            'key' => 'field_' . md5('group_recurring_padding_top'),
                            'label' => 'Abstand oben',
                            'name' => 'module_padding_top',
                            'type' => 'select',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => [
                                'width' => '',
                                'class' => '',
                                'id' => ''
                            ],
                            'choices' => [
                                'null' => 'Kein',
                                'small' => 'Klein',
                                'medium' => 'Medium (Standardwert)',
                                'large' => 'Groß'
                            ],
                            'default_value' => 'medium',
                            'allow_null' => 0,
                            'multiple' => 0,
                            'ui' => 0,
                            'return_format' => 'value',
                            'ajax' => 0,
                            'placeholder' => ''
                        ],
                        [
                            'key' => 'field_' . md5('group_recurring_padding_bottom'),
                            'label' => 'Abstand unten',
                            'name' => 'module_padding_bottom',
                            'type' => 'select',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => [
                                'width' => '',
                                'class' => '',
                                'id' => ''
                            ],
                            'choices' => [
                                'null' => 'Kein',
                                'small' => 'Klein',
                                'medium' => 'Medium (Standardwert)',
                                'large' => 'Groß'
                            ],
                            'default_value' => 'medium',
                            'allow_null' => 0,
                            'multiple' => 0,
                            'ui' => 0,
                            'return_format' => 'value',
                            'ajax' => 0,
                            'placeholder' => ''
                        ]
                    ]
                ],
                [
                    'key' => 'field_' . md5('group_recurring_headline'),
                    'label' => 'Headline',
                    'name' => 'module_headline',
                    'type' => 'group',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => ''
                    ],
                    'layout' => 'row',
                    'sub_fields' => [
                        [
                            'key' => 'field_' . md5('group_recurring_headline_title'),
                            'label' => 'Überschrift',
                            'name' => 'title',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => [
                                'width' => '',
                                'class' => '',
                                'id' => ''
                            ],
                            'default_value' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'maxlength' => ''
                        ],
                        [
                            'key' => 'field_' . md5('group_recurring_headline_subtitle'),
                            'label' => 'Unterüberschrift',
                            'name' => 'subtitle',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => [
                                'width' => '',
                                'class' => '',
                                'id' => ''
                            ],
                            'default_value' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'maxlength' => ''
                        ]
                    ]
                ],
                [
                    'key' => 'field_' . md5('group_recurring_video'),
                    'label' => 'Video',
                    'name' => 'video',
                    'type' => 'group',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => ''
                    ],
                    'layout' => 'row',
                    'sub_fields' => [
                        [
                            'key' => 'field_' . md5('group_recurring_video_type'),
                            'label' => 'Typ',
                            'name' => 'video_type',
                            'type' => 'select',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => [
                                'width' => '',
                                'class' => '',
                                'id' => ''
                            ],
                            'choices' => [
                                'youtube' => 'YouTube',
                                'mp4' => 'MP4',
                                'vimeo' => 'Vimeo',
                            ],
                            'default_value' => 'youtube',
                            'allow_null' => 0,
                            'multiple' => 0,
                            'ui' => 0,
                            'return_format' => 'value',
                            'ajax' => 0,
                            'placeholder' => ''
                        ],
                        [
                            'key' => 'field_' . md5('group_recurring_video_poster'),
                            'label' => 'Vorschaubild',
                            'name' => 'video_poster',
                            'type' => 'image',
                            'instructions' => '1600x900',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => [
                                'width' => '',
                                'class' => '',
                                'id' => ''
                            ],
                            'return_format' => 'array',
                            'preview_size' => 'thumbnail',
                            'library' => 'all',
                            'min_width' => '',
                            'min_height' => '',
                            'min_size' => '',
                            'max_width' => '',
                            'max_height' => '',
                            'max_size' => '',
                            'mime_types' => ''
                        ],
                        [
                            'key' => 'field_' . md5('group_recurring_video_yt_id'),
                            'label' => 'YouTube-ID',
                            'name' => 'youtube_id',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => [
                                [
                                    [
                                        'field' => 'field_' . md5('group_recurring_video_type'),
                                        'operator' => '==',
                                        'value' => 'youtube'
                                    ]
                                ]
                            ],
                            'wrapper' => [
                                'width' => '',
                                'class' => '',
                                'id' => ''
                            ],
                            'default_value' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'maxlength' => ''
                        ],
                        [
                            'key' => 'field_' . md5('group_recurring_video_vimeo_id'),
                            'label' => 'Vimeo-ID',
                            'name' => 'vimeo_id',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => [
                                [
                                    [
                                        'field' => 'field_' . md5('group_recurring_video_type'),
                                        'operator' => '==',
                                        'value' => 'vimeo'
                                    ]
                                ]
                            ],
                            'wrapper' => [
                                'width' => '',
                                'class' => '',
                                'id' => ''
                            ],
                            'default_value' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'maxlength' => ''
                        ],
                        [
                            'key' => 'field_' . md5('group_recurring_video_mp4'),
                            'label' => 'MP4-Datei',
                            'name' => 'mp4',
                            'type' => 'file',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => [
                                [
                                    [
                                        'field' => 'field_' . md5('group_recurring_video_type'),
                                        'operator' => '==',
                                        'value' => 'mp4'
                                    ]
                                ]
                            ],
                            'wrapper' => [
                                'width' => '',
                                'class' => '',
                                'id' => ''
                            ],
                            'return_format' => 'array',
                            'library' => 'all',
                            'min_size' => '',
                            'max_size' => '',
                            'mime_types' => '.mp4'
                        ],
                    ]
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'page'
                    ]
                ],
                [
                    [
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'post'
                    ]
                ],
            ],
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => false,
            'description' => '',
            'show_in_rest' => 0
        ]);
    }
}

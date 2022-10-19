<?php
\WP\ImageHelper::img(
    get_sub_field('file'),
    'test-class',
    [0.5, 1],
    '1600x1200',
    ['data-foo' => 'bar', 'alt' => 'specific alt tag'],
    true
);

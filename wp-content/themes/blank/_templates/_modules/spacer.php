<?php
$spacer_height = get_sub_field('spacer_height');
$spacer_bg = get_sub_field('spacer_bg');
$spacer_border = get_sub_field('spacer_border');
$height = '';
$border_color = 'border-gray500';

switch ($spacer_height) {
    case 'null':
        $height .= '';
        break;
    case 'small':
        $height .= 'pb-6 pt-6 md:pb-12 md:pt-12';
        break;
    case 'medium':
        $height .= 'pb-10 pt-10 md:pb-20 md:pt-20';
        break;
    case 'large':
        $height .= 'pb-14 pt-14 md:pb-28 md:pt-28';
        break;
}
?>

<div class="section-inner <?= $height ?> bg-<?= $spacer_bg ?> ">
    <div class="spacer__inner <?= $spacer_border ? 'border-t ' . $border_color : '' ?>"></div>
</div>
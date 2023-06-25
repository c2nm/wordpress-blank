<?php
$slug = get_sub_field('slug');
$hide_link = get_sub_field('hide_anchor_link');
?>

<div class="section-inner">
    <div id="<?= sanitize_title($slug) ?>" data-name="<?= $slug ?>" class="section-anchor-target <?= ($hide_link ? 'hidden-link' : '') ?>"></div>
</div>
<?php
$title = apply_filters('the_content', get_sub_field('module_headline')['title']);
$subtitle = apply_filters('the_content', get_sub_field('module_headline')['subtitle']);
$image = get_sub_field('media')['image'];
$focus_points = get_sub_field('media')['focus_points'];
$content_title = apply_filters('the_content', get_sub_field('content')['title']);
$content_text = apply_filters('the_content', get_sub_field('content')['text']);
$content_text_layout = apply_filters('the_content', get_sub_field('content')['text_layout']);
?>

<div class="section-inner">
    <div class="section-inner-top">
        <div class="container mx-auto px-6 md:px-20 lg:px-8">
            <?php if ($title || $subtitle) { ?>
                <div class="md:grid md:grid-cols-12 md:gap-4 mb-12 md:mb-16">
                    <div class="md:col-span-12">
                        <?php if ($title) { ?>
                            <div class="text-center">
                                <?php if (get_row_index() === 1 && !is_front_page()) { ?>
                                    <h1 class="h1">
                                        <?= $title ?>
                                    </h1>
                                <?php } else { ?>
                                    <h2 class="h2">
                                        <?= $title ?>
                                    </h2>
                                <?php } ?>
                            </div>
                        <?php } ?>
                        <?php if ($subtitle) { ?>
                            <div class="text-center">
                                <?php if (get_row_index() === 1 && !is_front_page()) { ?>
                                    <h2 class="h4 mt-2 md:mt-4">
                                        <?= $subtitle ?>
                                    </h2>
                                <?php } else { ?>
                                    <h3 class="h4 mt-2 md:mt-4">
                                        <?= $subtitle ?>
                                    </h3>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="section-inner-bottom">
        <?php if ($image) {
            \WP\ImageHelper::img(
                $image,
                'align--'.$content_text_layout.' w-full md:h-full md:object-cover md:absolute md:top-0 md:left-0 '.$focus_points,
                [1, 1],
                '1920x600',
                ['title' => $image['alt']],
                true
            );
        }
        ?>

        <div class="container mx-auto px-6 md:px-20 lg:px-8 z-10 flex relative text--<?= ($content_text_layout) ?>">
            <?php if ($content_title || $content_text) { ?>

                <div class="content flex relative w-full h-96 w-1/2">
                    <div class="content-inner flex">
                        <div>
                            <?php if ($content_title) { ?>
                                <?php if (get_row_index() === 1 && !is_front_page() && !$title && !$subtitle) { ?>
                                    <h1 class="h2">
                                        <?= $content_title ?>
                                    </h1>
                                <?php } else { ?>
                                    <h2 class="h3">
                                        <?= $content_title ?>
                                    </h2>
                                <?php } ?>
                            <?php } ?>
                            <?php if ($content_text) { ?>
                                <div class="mt-5 content-wysiwyg">
                                    <?= $content_text ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
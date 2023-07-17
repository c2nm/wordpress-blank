<?php
$title = apply_filters('the_content', get_sub_field('module_headline')['title']);
$subtitle = apply_filters('the_content', get_sub_field('module_headline')['subtitle']);
$image = get_sub_field('image');
?>

<div class="section-inner overflow-hidden">
    <div class="container mx-auto px-6 md:px-20 lg:px-8">
        <?php if ($title || $subtitle) { ?>
            <div class="md:grid md:grid-cols-12 md:gap-4 mb-12 md:mb-16">
                <div class="md:col-span-12">
                    <?php if ($title) { ?>
                        <div class="text-center">
                            <?php if (get_row_index() === 1) { ?>
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
                            <?php if (get_row_index() === 1) { ?>
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

        <?php if ($image) { ?>
            <div class="md:grid md:grid-cols-12 md:gap-4">
                <div class="md:col-span-12">
                    <div class="image relative">
                        <div class="image-wrap w-full relative z-10">
                            <?php
                            \WP\ImageHelper::img(
                                get_sub_field('image'),
                                'object-cover object-center',
                                [0.5, 1],
                                '1600x1200',
                                ['data-foo' => 'bar', 'alt' => 'specific alt tag'],
                                true
                            );
                            ?>
                        </div>
                        <?php
                        $image_caption = get_sub_field('image_caption') ?: get_field('media_copyright', $image['ID']); ?>
                        <div class="image-description content-wysiwyg py-4 text-14 text-light pr-12 md:pr-0 z-10 relative">
                            <?php if ($image_caption) { ?>
                                <?= $image_caption ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
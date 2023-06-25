<?php
$title = apply_filters('the_content', get_sub_field('module_headline')['title']);
$subtitle = apply_filters('the_content', get_sub_field('module_headline')['subtitle']);
$text = apply_filters('the_content', get_sub_field('text'));
$image = get_sub_field('image');
$order = get_sub_field('order');
$image_orientation = get_sub_field('image_orientation');
?>

<div class="section-inner overflow-hidden">
    <div class="container mx-auto px-6 md:px-20 lg:px-8 flex justify-center relative z-10">
        <div class="w-full">
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

            <div class="md:grid md:grid-cols-12 md:gap-4 text-image-wrap relative">
                <?php if ($image) { ?>
                    <div class="md:col-span-6 <?= $order === 'text_image' ? 'order-2' : 'order-1' ?>">
                        <div class="image mt-8 md:mt-0 md:flex items-center <?= $order === 'text_image' ? 'order-left' : 'order-right' ?>">
                            <?php
                            \WP\ImageHelper::img(
                                $image,
                                '',
                                [0.5, 1],
                                '300x300',
                                ['title' => $image['alt']],
                                true
                            );
                            ?>
                        </div>
                    </div>
                <?php } ?>

                <?php if ($text) { ?>
                    <div class="md:col-span-6 <?= $order === 'text_image' ? 'order-1' : 'order-2' ?>">
                        <div class="text mt-8 md:mt-0 md:flex items-center">
                            <div class="content-wysiwyg relative z-10">
                                <?= $text ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
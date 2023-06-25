<?php
$title = apply_filters('the_content', get_sub_field('module_headline')['title']);
$subtitle = apply_filters('the_content', get_sub_field('module_headline')['subtitle']);
$text_left = apply_filters('the_content', get_sub_field('text_left'));
$text_right = apply_filters('the_content', get_sub_field('text_right'));
?>

<div class="section-inner">


    <div class="container mx-auto px-6 md:px-20 lg:px-8 relative z-10">
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

        <?php if ($text_left || $text_right) { ?>
            <div class="md:grid md:grid-cols-12 md:gap-4">
                <div class="md:col-span-12 content-wysiwyg flex flex-wrap justify-center relative z-10">
                    <?php if ($text_left) { ?>
                        <div class="col-left w-full md:w-1/2 md:pr-6">
                            <?= $text_left ?>
                        </div>
                    <?php } ?>

                    <?php if ($text_right) { ?>
                        <div class="col-right w-full md:w-1/2 md:pl-6 pt-8 md:pt-0">
                            <?= $text_right ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
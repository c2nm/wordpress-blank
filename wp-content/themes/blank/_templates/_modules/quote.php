<?php
$title = apply_filters('the_content', get_sub_field('module_headline')['title']);
$subtitle = apply_filters('the_content', get_sub_field('module_headline')['subtitle']);
$quote_content = apply_filters('the_content', get_sub_field('quote')['content']);
$quote_author = apply_filters('the_content', get_sub_field('quote')['author']);
?>

<div class="section-inner">
    <div class="section-top">
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
        </div>
    </div>

    <div class="section-bottom">
        <div class="container mx-auto px-6 md:px-20 lg:px-8">
            <?php if ($quote_content || $quote_author) { ?>
                <div class="md:grid md:grid-cols-12 md:gap-4">
                    <div class="md:col-span-7 md:col-start-3">
                        <?php if ($quote_content) { ?>
                            <div class="relative">
                                <img src="<?= ICONS_PATH . 'quote.svg' ?>" alt=""
                                     class="svginject w-20 h-20 md:w-28 md:h-28
                                     fill-gray-500 md:absolute md:-left-6 md:-top-4 md:-translate-x-full"/>
                                <div class="h3">
                                    <div class="normal-case">
                                        <?= $quote_content ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <?php if ($quote_author) { ?>
                            <div class="mt-8">
                                <?= $quote_author ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
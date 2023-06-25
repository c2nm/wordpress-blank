<?php
$title = apply_filters('the_content', get_sub_field('module_headline')['title']);
$subtitle = apply_filters('the_content', get_sub_field('module_headline')['subtitle']);
$table = get_sub_field('table');
?>

<div class="section-inner">
    <div class="container container-narrow mx-auto px-6 md:px-20 lg:px-8">
        <?php if ($title || $subtitle) { ?>
            <div class="md:grid md:grid-cols-12 md:gap-4 mb-12 md:mb-16">
                <div class="md:col-span-12">
                    <?php if ($title) { ?>
                        <div>
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
                        <div>
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

        <?php if ($table) { ?>
            <div class="md:grid md:grid-cols-12 md:gap-4">
                <div class="md:col-span-12">
                    <div class="table-wrap">
                        <?= $table ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
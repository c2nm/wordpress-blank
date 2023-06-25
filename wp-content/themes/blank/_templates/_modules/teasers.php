<?php
$title = apply_filters('the_content', get_sub_field('module_headline')['title']);
$subtitle = apply_filters('the_content', get_sub_field('module_headline')['subtitle']);
$teasers = get_sub_field('teasers');
?>

<div class="section-inner">
    <div class="section-inner-top pb-16 md:pb-32">
        <div class="container container-narrow mx-auto px-6 md:px-20 lg:px-8">
            <?php if ($title || $subtitle) { ?>
                <div class="md:grid md:grid-cols-12 md:gap-4">
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

    <?php if ($teasers) { ?>
        <div class="section-inner-bottom pb-4 md:pb-0">
            <div class="container container-narrow mx-auto px-6 md:px-20 lg:px-8">
                <div class="md:grid md:grid-cols-12 md:gap-4">
                    <div class="md:col-span-12 flex flex-wrap justify-center -translate-y-8 md:-translate-y-10">
                        <?php foreach ($teasers as $teaser__key => $teaser) {
                            $teaser_image = $teaser['image'];
                            $teaser_title = apply_filters('the_content', $teaser['content']['title']);
                            $teaser_text = apply_filters('the_content', $teaser['content']['text']);
                            ?>

                            <div class="box-item mt-10 first:mt-0">
                                <div class="md:flex md:flex-nowrap shadow-2xl">
                                    <div class="w-full md:w-1/2 relative">
                                        <?php if ($teaser_image) {
                                            \WP\ImageHelper::img(
                                                $teaser_image,
                                                '',
                                                [1, 1],
                                                '300x300',
                                                ['title' => $teaser_image['alt']],
                                                true
                                            );
                                        }
                                        ?>
                                    </div>
                                    <div class="w-full md:w-1/2 p-6 md:p-16 text flex items-center">
                                        <div class="w-full">
                                            <?php if ($teaser_title) { ?>
                                                <h3 class="h4 mb-6 md:w-4/5">
                                                    <?= $teaser_title ?>
                                                </h3>
                                            <?php } ?>
                                            <div class="content-wysiwyg">
                                                <?php if ($teaser_text) { ?>
                                                    <?= $teaser_text ?>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
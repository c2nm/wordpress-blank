<?php
$title = apply_filters('the_content', get_sub_field('module_headline')['title']);
$subtitle = apply_filters('the_content', get_sub_field('module_headline')['subtitle']);
?>

<div class="section-inner overflow-hidden">
    <?php if ($title || $subtitle) { ?>
        <div class="section-inner-top">
            <div class="container container-narrow mx-auto px-6 md:px-20 lg:px-8">
                    <div class="md:grid md:grid-cols-12 md:gap-4 mb-12 md:mb-16">
                        <div class="md:col-span-12 section-header text-gray-700">
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
            </div>
        </div>
    <?php } ?>
    <div class="section-inner-bottom <?= (!$title && !$subtitle ? 'mt-2 md:mt-4' : '') ?>">
        <div class="container container-narrow mx-auto px-6 md:px-20 lg:px-8">
            <div class="md:grid md:grid-cols-12 md:gap-4">
                <div class="md:col-span-12">
                    <div class="section-video <?= (!$title && !$subtitle ? 'section-video--no-title' : '') ?>">
                        <?php
                        $video_poster = get_sub_field('video')['video_poster'];
                        $video_type = get_sub_field('video')['video_type'];
                        $video_youtube_id = get_sub_field('video')['youtube_id'];
                        $video_vimeo_id = get_sub_field('video')['vimeo_id'];
                        $video_source = get_sub_field('video')['mp4'] ? get_sub_field('video')['mp4']['url'] : '';
                        $video_mime = get_sub_field('video')['mp4'] ? get_sub_field('video')['mp4']['mime_type'] : '';
                        $video_muted = false;
                        $video_id = null;
                        switch ($video_type) {
                            case 'youtube':
                                $video_id = $video_youtube_id;
                                break;
                            case 'vimeo':
                                $video_id = $video_vimeo_id;
                                break;
                        }
                        include(get_template_directory() . '/_templates/_elements/video.php'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
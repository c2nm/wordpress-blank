<div class="video-wrap bg-black relative z-10">
    <div class="video-player group">
        <div class="embed-video">
            <div class="video-trigger group relative cursor-pointer"
                 data-type="video-<?= $video_type ?>"
                 data-video-muted="<?= $video_muted ?>"
                 data-video-source="<?= $video_source ?>"
                 data-video-mime="<?= $video_mime ?>"
                 data-video-id="<?= $video_id ?>">
                <div class="video-poster w-full h-full relative z-10">
                    <?php if ($video_poster) { ?>
                        <img src="<?= $video_poster['sizes']['1600x900'] ?>"
                             alt="<?= htmlentities($video_poster['alt']) ?>"
                             title="<?= htmlentities($video_poster['alt']) ?>"
                             class="w-full h-full absolute top-0 left-0 object-cover">
                    <?php } else { ?>
                        <img src="<?= \WP\Helper::getThumbnailUrl($video_id, $video_type) ?>"
                             alt=""
                             title=""
                             class="w-full h-full absolute top-0 left-0 object-cover">
                    <?php } ?>
                </div>
                <div class="video-button rounded-full flex items-center justify-center w-16 h-16 bg-white opacity-70 z-10 border-5 border-secondary absolute top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 cursor-pointer transition-all duration-300 ease-in-out group-hover:opacity-100">
                    <img src="<?= ICONS_PATH . '/media/media-play.svg' ?>" alt=""
                         class="svginject w-5 h-5 fill-primary -mr-1 transition-all duration-300 ease-in-out"/>
                </div>
                <?php if ($video_type == 'youtube' || $video_type == 'vimeo') {
                    //echo get_cc_video($video_type);
                } ?>
            </div>
        </div>
    </div>
</div>
<?php
global $post;

if (!is_front_page() && !is_search()) { ?>
    <?php
    $hide_breadcrumbs = get_field('hide_breadcrumbs', $post->ID);
    if (!$hide_breadcrumbs) { ?>
        <section class="section section--breadcrumbs pt-10 md:pt-20 pb-10 md:pb-20 relative">
            <div class="section-inner">
                <div class="container mx-auto px-6 md:px-20 lg:px-8">
                    <div class="md:grid md:grid-cols-12 md:gap-4">
                        <div class="md:col-span-12">
                            <div class="flex flex-nowrap breadcrumb-items">
                                <?php if (function_exists('yoast_breadcrumb')) {
                                    yoast_breadcrumb('', '');
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>
<?php } ?>

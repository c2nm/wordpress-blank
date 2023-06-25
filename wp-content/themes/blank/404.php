<?php
get_header();
$text_404 = get_field('404_text', 'option');
?>

    <main id="main">
        <div class="section section--s-404 pt-12 md:pt-24 pb-10 md:pb-20 bg-transparent parent-bg-transparent relative">
            <div class="section-inner">
                <div class="container mx-auto px-6 md:px-20">
                    <div class="md:grid md:grid-cols-12 md:gap-4">
                        <div class="md:col-span-8 md:col-start-3">
                            <div class="h-10"></div>
                            <div class="content-wysiwyg">
                                <?php if ($text_404) { ?>
                                    <?= $text_404 ?>
                                <?php } else { ?>
                                    <h1 class="h1 text-xl">404</h1>
                                    <br>
                                    <div>
                                        Die Seite wurde leider nicht gefunden.
                                    </div>
                                    <br>
                                    <a class="btn btn-primary w-full sm:w-1/2 md:w-full mx-auto"
                                       href="<?= get_bloginfo('url') ?>"><span>Startseite</span></a>
                                <?php } ?>
                            </div>
                            <div class="h-10"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php
get_footer();

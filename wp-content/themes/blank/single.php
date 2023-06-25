<?php
global $post;
get_header();
?>
    <main id="main">
        <?php if (!is_front_page()) {
            include(get_template_directory() . '/_templates/_common/breadcrumbs.php');
        } ?>

        <?php require_once get_template_directory() . '/_templates/_common/flexible-content.php'; ?>

        <section class="section section--text pt-10 md:pt-20 pb-10 md:pb-20 relative">
            <div class="section-inner">
                <div class="container mx-auto px-6 md:px-20 lg:px-8">
                    <div class="md:grid md:grid-cols-12 md:gap-4">
                        <div class="md:col-span-12 flex flex-wrap items-center -mb-8">
                            <a href="#" target="_self"
                               class="mr-6 md:mr-14 mb-8 btn btn-primary group hyphens-none">
                                <span>Zurück zur Blog-Übersicht</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section section--comments pt-10 md:pt-20 pb-10 md:pb-20 bg-white parent-bg-white relative ">
            <div class="section-inner">
                <div class="container mx-auto px-6 md:px-20 lg:px-8">
                    <div class="md:grid md:grid-cols-12 md:gap-4 mb-12 md:mb-16">
                        <div class="md:col-span-6">
                            <div>
                                <h2 class="h2">Kommentar schreiben</h2>
                                <p>Ihre E-Mail-Adresse wird nicht veröffentlicht. Erforderliche Felder sind mit * markiert.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container mx-auto px-6 md:px-20 lg:px-8">
                    <div class="md:grid md:grid-cols-12 md:gap-4">
                        <div class="md:col-span-6">
                            <form class="add-blog-comment" method="post"
                                  action="<?php echo rest_url('v1/comments'); ?>" autocomplete="off">
                                <div class="md:grid md:grid-cols-12 md:gap-8">
                                    <div class="md:col-span-6">
                                        <input name="first-name"
                                               type="text"
                                               class="form-control w-full"
                                               placeholder="Vorname*"
                                               id="comment-first-name"
                                               required>
                                    </div>
                                    <div class="md:col-span-6">
                                        <input name="last-name"
                                               type="text"
                                               class="form-control w-full"
                                               placeholder="Nachname*"
                                               id="comment-last-name"
                                               required>
                                    </div>
                                    <div class="md:col-span-12">
                                        <input name="email"
                                               type="email"
                                               class="form-control w-full"
                                               placeholder="E-Mail-Adresse*"
                                               id="comment-email"
                                               required>
                                    </div>
                                    <div class="md:col-span-12">
                                       <textarea name="message"
                                                 class="form-control w-full"
                                                 placeholder="Ihre Nachricht*"
                                                 id="comment-message"
                                                 rows="10"
                                                 required></textarea>
                                    </div>
                                    <div class="md:col-span-12">
                                        <input type="hidden" name="post-id" value="<?= get_the_ID() ?>" />
                                        <input type="hidden" name="lang" value="<?= defined('ICL_LANGUAGE_CODE')
                                            ? ICL_LANGUAGE_CODE
                                            : 'de' ?>" />
                                        <input type="text" name="topfhonig1" value="" tabindex="-1" autocomplete="impp" />
                                        <input type="text" name="topfhonig2" value="" tabindex="-1" autocomplete="impp" />
                                        <input type="text" name="topfhonig3" value="" tabindex="-1" autocomplete="impp" />
                                        <input type="submit" class="btn btn-primary hyphens-none" id="comment-submit" value="Absenden" />
                                    </div>
                                    <div class="md:col-span-12">
                                       <div class="message"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php get_footer();

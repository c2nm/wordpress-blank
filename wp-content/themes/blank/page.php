<?php
global $post;
get_header();
?>

    <main id="main">
        <?php
        // wordpress style
        /*
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                the_content();
            }
        }
        */

        // breadcrumbs
        if (!is_front_page()) {
            include(get_template_directory() . '/_templates/_common/breadcrumbs.php');
        }

        // flexible content
        require_once get_template_directory() . '/_templates/_common/flexible-content.php';
        ?>
    </main>

<?php
get_footer();

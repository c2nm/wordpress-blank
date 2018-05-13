<?php
// fallback file
echo '<html>';
echo '<head>'; wp_head(); echo '</head>';
echo '<body>';
if( have_posts() )
{
    while( have_posts() )
    {
        the_post();
        the_title();
        the_content();
    }
}
wp_footer();
echo '</body>';
echo '</html>';
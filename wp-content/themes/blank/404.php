<?php
get_header();
echo '<div class="fixed top-0 left-0 right-0 bottom-0 text-center whitespace-no-wrap bg-white flex flex-col justify-center items-center min-h-screen">';
echo '<div class="inline-block align-middle w-full text-xs bg-white">';
echo '<h2 class="bg-white font-bold mb-10 text-9xl">';
echo '404';
echo '</h2>';
echo '<a class="block font-bold" href="' . get_bloginfo('url') . '">';
echo 'home';
echo '</a>';
echo '</div>';
echo '</div>';
get_footer();

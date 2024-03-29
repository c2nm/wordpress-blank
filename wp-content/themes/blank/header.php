<?php
echo \WP\Core::asciiArt();
echo '<!DOCTYPE html>';
echo '<html ';
language_attributes();
echo ' class="font-custom responsive-typography selection-color scrollbar' .
    (!\WP\Core::isProduction() ? ' dev' : '') .
    '">';
echo '<head>';
echo '<meta charset="' . get_bloginfo('charset') . '" />';
echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, minimum-scale=1" />';
wp_head();
echo '</head>';
echo '<body ';
body_class();
echo '>';
echo '<header>';
wp_nav_menu([
    'theme_location' => 'main-menu',
]);
echo '</header>';
echo '<main>';

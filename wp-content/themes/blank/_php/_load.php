<?php
namespace WP;

new Core();
new Acf();
//new MenuWalker();
new Example();
new SendComment();
new ImageHelper(
    /* resolutions */
    [360, 375, 414, 768, 1024, 1280, 1366, 1440, 1536, 1600, 1680, 1920, 2048, 2560, 4096], // 4k
    //[360, 375, 414, 768, 1024, 1280, 1366, 1440, 1536, 1600, 1680, 1920], // 2k
    /* breakpoints */
    [768, 1024] // 3 layouts
    //[768] // 2 layouts
);
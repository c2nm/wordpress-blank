<header id="header">
    <div id="header-overlay hidden"></div>
    <nav class="fixed z-50 w-full bg-white top-0 flex flex-wrap items-center justify-between py-4 shadow-lg">
        <div class="container mx-auto px-6 md:px-20 lg:px-8 flex flex-wrap items-center justify-between">
            <div class="w-full relative flex justify-between lg:w-auto lg:static lg:block lg:justify-start">
                <a class="text-sm font-medium leading-relaxed inline-block mr-4 py-2 whitespace-nowrap uppercase text-slate-700" href="#">Logo goes here</a>
                <button class="cursor-pointer leading-none px-3 py-1 border border-solid border-transparent rounded bg-transparent block lg:hidden outline-none focus:outline-none" type="button">
                    <img src="<?= ICONS_PATH . 'quote.svg' ?>" alt="" class="svginject fill-black w-4"/>
                </button>
            </div>
            <div class="lg:flex flex-grow items-center hidden">
                <?php
                use WP\MenuWalker;
                wp_nav_menu([
                    'theme_location' => 'main-menu',
                    'menu_class' => '',
                    'container_id' => 'nav-main',
                    'container' => 'div',
                    'container_class' => '',
                    'items_wrap' => '<ul class="flex flex-col lg:flex-row list-none lg:ml-auto">%3$s</ul>',
                    'fallback_cb' => false,
                    'depth' => 2,
                    'walker' => new MenuWalker()
                ]); ?>
            </div>
        </div>
    </nav>
</header>
<header>
    <nav class="fixed z-50 w-full bg-white top-0 flex flex-wrap items-center justify-between px-2 py-3 shadow-lg">
        <div class="container mx-auto px-6 md:px-20 lg:px-8 flex flex-wrap items-center justify-between">
            <div class="w-full relative flex justify-between lg:w-auto lg:static lg:block lg:justify-start"><a
                        class="text-sm font-medium leading-relaxed inline-block mr-4 py-2 whitespace-nowrap uppercase text-slate-700"
                        href="#">Logo goes here</a>
                <button class="cursor-pointer text-xl leading-none px-3 py-1 border border-solid border-transparent rounded bg-transparent block lg:hidden outline-none focus:outline-none"
                        type="button"><i class="fas fa-bars"></i></button>
            </div>
            <div class="lg:flex flex-grow items-center hidden">
                <!--
            <?php wp_nav_menu([
                    'theme_location' => 'main-menu',
                    'menu_class' => '',
                    'container_id' => 'nav-main',
                    'container' => 'div',
                    'container_class' => '',
                    'items_wrap' => '<ul class="flex flex-col lg:flex-row list-none lg:ml-auto">%3$s</ul>',
                    'fallback_cb' => false,
                    'depth' => 2,
                    'walker' => new Menu_Walker()
                ]); ?>
            -->

                <li class="nav-item">
                    <a class="download-button px-3 py-2 flex items-center text-xs uppercase font-medium text-slate-700 hover:text-slate-500" href="#">
                        <span class="ml-2">Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="download-button px-3 py-2 flex items-center text-xs uppercase font-medium text-slate-700 hover:text-slate-500" href="#">
                        <span class="ml-2">Product</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="download-button px-3 py-2 flex items-center text-xs uppercase font-medium text-slate-700 hover:text-slate-500" href="#">
                        <span class="ml-2">About us</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="download-button px-3 py-2 flex items-center text-xs uppercase font-medium text-slate-700 hover:text-slate-500" href="#">
                        <span class="ml-2">Portfolio</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="download-button px-3 py-2 flex items-center text-xs uppercase font-medium text-slate-700 hover:text-slate-500">
                        <img src="<?= ICONS_PATH . 'quote.svg' ?>" alt=""
                             class="svginject fill-black w-4"/>
                        <span class="ml-2">Contact</span>
                    </a>
                </li>
            </div>
        </div>
    </nav>
</header>
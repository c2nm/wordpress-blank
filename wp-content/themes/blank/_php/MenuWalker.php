<?php
namespace WP;

class MenuWalker extends \Walker_Nav_Menu
{
    /**
     * Start the element output.
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item Menu item data object.
     * @param int $depth Depth of menu item. May be used for padding.
     * @param array $args Additional strings.
     * @return void
     */
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        global $post;
        $classes = implode(' ', $item->classes);

        if (isset($post->post_type) && $post->post_type != null && $post->post_type != '') {
            if (in_array($post->post_type, $item->classes)) {
                $classes .= ' current-menu-item';
            }
        }

        $output .=
            $depth === 0
                ? '<li class="' .
                $classes .
                ' level-0 group mb-2 md:mb-0 md:h-16 relative md:flex md:transition-all md:duration-300 md:ease-in-out w-full md:w-auto">'
                : '<li class="md:mb-5 ' . $classes . '">';
        $attributes = '';

        //adding class
        $attributes .=
            ' class=" font-primary text-white md:text-gray-600 leading-none transition-all duration-300 ease-in-out w-full md:w-auto group ' .
            ($depth === 0
                ? 'nav-main-link flex items-center justify-start text-14 md:text-18 font-normal py-2 md:py-4 md:px-4 lg:px-9 uppercase'
                : 'nav-sub-link relative text-14 md:text-18 text-white font-normal opacity-90 hover:text-secondary-light md:text-primary-light md:opacity-60 md:opacity-100 flex justify-start items-center ml-2 md:ml-0 py-2 md:py-0 group md:hover:text-primary-light no-underline focus:no-underline active:no-underline md:hover:underline md:focus:underline md:active:underline') .
            '"';

        !empty($item->attr_title) and
        // Avoid redundant titles
        $item->attr_title !== $item->title and
        ($attributes .= ' title="' . esc_attr($item->attr_title) . '"');

        !empty($item->url) and ($attributes .= ' href="' . esc_attr($item->url) . '"');

        $attributes = trim($attributes);
        $title = apply_filters('the_title', $item->title, $item->ID);
        $target = 'target="' . ($item->target ? $item->target : '_self') . '"';
        $item_output =
            "$args->before<a $attributes $target><span>$args->link_before$title</span></a>" .
            "$args->link_after$args->after";

        // Since $output is called by reference we don't need to return anything.
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    /**
     * @param string $output Passed by reference. Used to append additional content.
     * @return void
     * @see Walker::start_lvl()
     *
     */
    public function start_lvl(&$output, $depth = 0, $args = null)
    {
        $output .=
            '<div class="dropdown-menu-container w-full overflow-hidden transition-all duration-300 ease-in-out md:absolute md:top-full ' .
            (get_field('header_invert', 'option') ? 'md:left-0' : 'md:right-0') .
            '  md:w-80 md:opacity-0 md:invisible md:transform md:-translate-y-2"><div class="fixed top-0 left-0 bg-error"></div>';
        $output .=
            '<ul class="dropdown-menu text-primary-light md:-mb-5 pb-3 md:pt-8 md:pb-7 md:px-6 md:bg-tertiary-light">';
    }

    /**
     * @param string $output Passed by reference. Used to append additional content.
     * @return void
     * @see Walker::end_lvl()
     *
     */
    public function end_lvl(&$output, $depth = 0, $args = null)
    {
        $output .= '</ul>';
        $output .= '</div>';
    }

    /**
     * @param string $output Passed by reference. Used to append additional content.
     * @return void
     * @see Walker::end_el()
     *
     */
    function end_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $output .= '</li>';
    }
}

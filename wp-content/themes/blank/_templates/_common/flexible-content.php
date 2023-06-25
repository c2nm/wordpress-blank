
<?php if (have_rows('blocks')) {
    if (!post_password_required()) {
        $is_first_accordion = true;

        while (have_rows('blocks')) {
            the_row();
            if (get_row_layout() === 'accordion-start') {
                echo '<div class="accordion-wrap bg-transparent parent-bg-transparent relative">';
            } elseif (get_row_layout() === 'accordion-item') {
                if ($is_first_accordion === false) {
                    echo '</div>'; // close last accordion item content
                    echo '</div>'; // close last accordion item
                }
                echo '<div class="accordion-item mb-2">';
                if (get_sub_field('title')) {
                    echo '<div class="accordion-title container container-narrow mx-auto px-6 md:px-20 lg:px-8">';
                    echo '<div class="border-b border-border-color border-solid cursor-pointer py-2">';
                    echo '<div class="md:grid md:grid-cols-12 md:gap-4">';
                    echo '<div class="md:col-span-12">';
                    echo '<div class="flex flex-nowrap items-center">';
                    echo '<img src="' .
                        ICONS_PATH .
                        'arrow-up.svg' .
                        '" alt="" class="svginject w-8 h-8 -ml-2 mr-2 fill-gray-500 transition-all duration-300 ease-in-out"/>';
                    echo '<span>' . get_sub_field('title') . '</span>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="accordion-content mt-4 hidden">';
                }
                $is_first_accordion = false;
            } elseif (get_row_layout() === 'accordion-end') {
                echo '</div>'; // close last accordion item content
                echo '</div>'; // close last accordion item
                echo '</div>'; // close accordion wrap
                $is_first_accordion = true;
            } else {
                if (
                    file_exists(get_template_directory() . '/_templates/_modules/' . get_row_layout() . '.php')
                ) {
                    // Module Custom Padding
                    $padding_top = isset(get_sub_field('module_padding')['module_padding_top'])
                        ? get_sub_field('module_padding')['module_padding_top']
                        : 'null';
                    $padding_bottom = isset(get_sub_field('module_padding')['module_padding_bottom'])
                        ? get_sub_field('module_padding')['module_padding_bottom']
                        : 'null';
                    $module_padding = \WP\Helper::setModulePadding($padding_top, $padding_bottom);

                    echo '<section class="section section--' .
                        get_row_layout() . ' ' . $module_padding . ' relative ' .
                        (get_row_index() === 1 ? 'section--first' : '') . '">';
                    include get_template_directory() . '/_templates/_modules/' . get_row_layout() . '.php';
                    echo '</section>';

                }
            }
        }
    } else {
        echo '<div class="password-protection">';
        echo get_the_password_form();
        echo '<div>';
    }
}

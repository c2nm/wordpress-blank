<?php
get_header();

// wordpress style
if( have_posts() )
{
    while( have_posts() )
    {
        the_post();
        the_content();
    }
}

// acf style
if( have_rows('blocks') )
{
    if (!post_password_required()) {
        echo '<div class="items">';
        while( have_rows('blocks') ) { the_row();        
            if( file_exists( get_template_directory().'/_blocks/'.get_row_layout().'.php' ) )
            {
                echo '<div class="item item--'.get_row_layout().'">';
                    echo '<div class="item__inner">';
                        include( get_template_directory().'/_blocks/'.get_row_layout().'.php' );
                    echo '</div>';
                echo '</div>';
            }
        }
        echo '</div>';
    }
    else {
        echo '<div class="password-protection">';
            echo get_the_password_form();
        echo '<div>';
    }
}

get_footer();
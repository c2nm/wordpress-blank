<?php
if( get_sub_field('title') )
{
    echo '<h2 class="item__title">';
        echo get_sub_field('title');
    echo '</h2>';
}

if( get_sub_field('content') )
{
    echo '<div class="item__content">';
        echo get_sub_field('content');
    echo '</div>';
}

if( have_rows('boxes') )
{    
    while( have_rows('boxes') )
    {
        the_row();
        echo get_sub_field('repeater_sub_item');
    }
}
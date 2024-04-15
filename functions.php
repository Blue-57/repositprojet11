<?php

function montheme_theme_support()
{
    add_theme_support('custom-logo');
    add_theme_support('title-tag');



    add_theme_support('menu');

    register_nav_menus(
        array(

            'primary_menu' => __('Menu Principal'),
            'footer_menu' => __('Menu Pied de page'),
        )
    );
}


add_action('after_setup_theme', 'montheme_theme_support');




function theme_enqueue_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css'); //theme parent

    wp_enqueue_style('custom-style', get_template_directory_uri() . '/assets/style/style.css', array('parent-style'), '1.0.0', 'all');

}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
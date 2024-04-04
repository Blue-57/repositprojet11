<?php

function montheme_theme_support()
{
    add_theme_support('custom-logo');
    add_theme_support('litle-tag');



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
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/styles.css'); //theme parent

    wp_enqueue_style('custom-style', get_template_directory_uri() . '/assets/style/style.css', array('parent-style'));

}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
<?php

function montheme_theme_support()
{
    add_theme_support('custom-logo');
    add_theme_support('title-tag');
    add_theme_support('menu');

    register_nav_menus(
        array(

            'primary_menu' => __('nav header'),
            'footer_menu' => __('nav footer'),
        )
    );
}
add_action('after_setup_theme', 'montheme_theme_support');





function theme_enqueue_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css'); //theme parent

    wp_enqueue_style('custom-style', get_template_directory_uri() . '/assets/style/style.css', array('parent-style'), '1.1.0', 'all', );

    wp_enqueue_script('custom-script', get_stylesheet_directory_uri() . '/assets/js/script.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');




add_action('wp_enqueue_scripts', 'enqueue_post_navigation_script');
// fichier js pour eviter erreur console, appel fichier js sur page acceuil 
function enqueue_post_navigation_script()
{
    // Vérifier si nous sommes sur une page de publication individuelle
    if (is_single()) {

        wp_enqueue_script('post-navigation-script', get_template_directory_uri() . '/assets/js/post.js', array(), '1.0.0', true);
    }
}



//appel fichier ajax 
require_once get_template_directory() . '/ajax.php';

function enqueue_lightbox_script()
{
    wp_enqueue_script('lightbox-script', get_template_directory_uri() . '/assets/js/lightbox.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_lightbox_script');

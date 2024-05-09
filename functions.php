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

    wp_enqueue_script('custom-script-contact', get_stylesheet_directory_uri() . '/assets/js/script-contact.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');


function charger_media_categories_callback()
{
    $categories = get_terms('media_categories');
    $options = '<option value="">SÉLECTIONNER UNE CATÉGORIE</option>';
    foreach ($categories as $category) {
        $options .= '<option value="' . $category->slug . '">' . strtoupper($category->name) . '</option>';
    }
    echo $options;
    wp_die();
}
add_action('wp_ajax_charger_media_categories', 'charger_media_categories_callback');
add_action('wp_ajax_nopriv_charger_media_categories', 'charger_media_categories_callback');


function charger_formats_callback()
{
    $formats = get_terms('format');
    $options = '<option value="">SÉLECTIONNER UN FORMAT</option>';
    foreach ($formats as $format) {
        $options .= '<option value="' . $format->slug . '">' . strtoupper($format->name) . '</option>';
    }
    echo $options;
    wp_die();
}
add_action('wp_ajax_charger_formats', 'charger_formats_callback');
add_action('wp_ajax_nopriv_charger_formats', 'charger_formats_callback');


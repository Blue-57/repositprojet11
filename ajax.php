<?php



//ajax
add_action('wp_ajax_load_more_posts', 'load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts');
add_action('wp_enqueue_scripts', 'my_enqueue_scripts');

function my_enqueue_scripts()
{
    // Enregistrer le script principal
    wp_enqueue_script('my-script', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), '1.0.0', true);

    // Récupérer l'URL de l'API Ajax
    $ajax_url = admin_url('admin-ajax.php');

    // Passer l'URL de l'API Ajax à votre script JavaScript
    wp_add_inline_script('my-script', 'var ajaxurl = "' . esc_js($ajax_url) . '";', 'before');
}


function load_more_posts()
{
    $offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;
    $posts_per_page = isset($_POST['posts_per_page']) ? intval($_POST['posts_per_page']) : 6;

    $args = array(
        'offset' => $offset,
        'posts_per_page' => $posts_per_page,
        // Autres arguments de requête selon vos besoins
    );

    $posts = get_posts($args);

    if ($posts) {
        foreach ($posts as $post) {
            // Mettez en forme vos résultats ici
// Par exemple, echo '<div>' . $post->post_title . '</div>';
        }
    }

    wp_die(); // Obligatoire pour terminer la réponse Ajax
}
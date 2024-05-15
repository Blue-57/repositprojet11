<?php



//ajax

// Fonction pour passer des données PHP à un script JavaScript
function enqueue_my_script()
{
    // Enregistrer le script principal
    wp_enqueue_script('my-script', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), '1.0.0', true);

    // Définir les données à passer à votre script JavaScript
    $ajax_url = admin_url('admin-ajax.php'); // Récupérer l'URL de l'API AJAX de WordPress
    $data = array(
        'ajax_url' => $ajax_url // Passer l'URL de l'API AJAX à votre script JavaScript
    );

    // Passer les données à votre script JavaScript
    wp_localize_script('my-script', 'my_ajax_obj', $data);
}


add_action('wp_enqueue_scripts', 'enqueue_my_script');

// Fonction pour charger plus de photos via AJAX
function load_more_photos()
{
    $page = isset($_POST['page']) ? intval($_POST['page']) : 0;
    $posts_per_page = 4;

    $args = array(
        'post_type' => 'photos',
        'posts_per_page' => $posts_per_page,
        'paged' => $page
    );

    $photos_query = new WP_Query($args);

    if ($photos_query->have_posts()) {
        while ($photos_query->have_posts()) {
            $photos_query->the_post();
            $post_link = get_permalink();
            ?>
            <a href="<?php echo esc_url($post_link); ?>">
                <div class="photo" data-post-id="<?php the_ID(); ?>">
                    <?php the_post_thumbnail(); ?>
                </div>
            </a>
            <?php
        }
        wp_reset_postdata();
    } else {
        echo 'Aucune photo trouvée.';
    }

    wp_die();
}

add_action('wp_ajax_load_more_photos', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');

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
    // Récupérer le numéro de page à partir de la requête AJAX
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    // Nombre de photos par page
    $posts_per_page = 4;

    // Arguments de requête pour WP_Query
    $args = array(
        'post_type' => 'photos',
        'posts_per_page' => $posts_per_page,
        'paged' => $page // Utiliser le numéro de page pour charger les photos suivantes
        // Ajoutez d'autres arguments selon vos besoins
    );

    // Exécuter la requête WP_Query
    $photos_query = new WP_Query($args);

    // Vérifier s'il y a des photos à afficher
    if ($photos_query->have_posts()) {
        // Boucler à travers les photos et les afficher
        while ($photos_query->have_posts()) {
            $photos_query->the_post();
            // Obtenir le lien vers le post
            $post_link = get_permalink();
            // Contenu de chaque photo ici
            ?>
            <a href="<?php echo $post_link; ?>">
                <div class="photo" data-post-id="<?php echo get_the_ID(); ?>">
                    <?php the_post_thumbnail(); ?>
                </div>
            </a>
            <?php
        }
        wp_reset_postdata(); // Réinitialiser les données de la publication
    } else {
        // Si aucune photo n'est trouvée
        echo 'Aucune photo trouvée.';
    }

    wp_die(); // Arrêter l'exécution de WordPress
}

// Ajouter l'action pour les utilisateurs connectés
add_action('wp_ajax_load_more_photos', 'load_more_photos');

// Ajouter l'action pour les utilisateurs non connectés
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');


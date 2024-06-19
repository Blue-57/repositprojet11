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
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $posts_per_page = 8;

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
            get_template_part('photos-templates');
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




function filter()
{
    // Récupérer les valeurs envoyées via la requête AJAX
    $categorieSelection = isset($_POST['categorieSelection']) ? $_POST['categorieSelection'] : 'all';
    $formatSelection = isset($_POST['formatSelection']) ? $_POST['formatSelection'] : 'all';
    $orderDirection = isset($_POST['orderDirection']) ? $_POST['orderDirection'] : 'DESC';
    $page = isset($_POST['page']) ? $_POST['page'] : 0;

    // Construire les arguments de la requête WP_Query en fonction des valeurs des menus déroulants
    $args = array(
        'post_type' => 'photos',
        'orderby' => 'date',
        'order' => $orderDirection,
        'posts_per_page' => 8, // Limite initiale de photos à afficher
        'paged' => $page,
        'tax_query' => array(
            'relation' => 'AND',
            $categorieSelection != "all" ? array(
                'taxonomy' => 'media_categories', // Nom de la taxonomie approprié
                'field' => 'slug',
                'terms' => $categorieSelection,
            ) : '',
            $formatSelection != "all" ? array(
                'taxonomy' => 'format', // Nom de la taxonomie approprié
                'field' => 'slug',
                'terms' => $formatSelection,
            ) : '',
        ),
    );

    // Effectuer la requête
    $ajax_query = new WP_Query($args);

    // Vérifier si la requête a réussi
    if ($ajax_query->have_posts()) {
        // Formatage des résultats de la requête
        $response = '';
        while ($ajax_query->have_posts()) {
            $ajax_query->the_post();
            // Ajouter le contenu de chaque photo à la réponse
            $response .= '<a href="' . get_permalink() . '" class="photo" data-post-id="' . get_the_ID() . '">';
            $response .= get_the_post_thumbnail();
            $response .= '</a>';
        }
    } else {
        // Aucune publication trouvée
        $response = 'Aucune photo trouvée.';
    }

    // Renvoyer la réponse AJAX
    echo $response;

    // Assurez-vous de terminer le script PHP pour éviter toute sortie supplémentaire
    wp_die();
}
// Action pour les utilisateurs connectés
add_action('wp_ajax_filter', 'filter');
// Action pour les utilisateurs non connectés
add_action('wp_ajax_nopriv_filter', 'filter');





function generate_taxonomy_options($taxonomy_name, $selected_value = '')
{
    // Récupérer les termes de la taxonomie spécifiée
    $terms = get_terms(
        array(
            'taxonomy' => $taxonomy_name,
            'orderby' => 'name',
            'hide_empty' => false,
        )
    );

    // Initialiser une chaîne pour stocker les options générées
    $options = '';

    // Générer les options à partir des termes récupérés
    foreach ($terms as $term) {
        // Vérifier si ce terme est sélectionné
        $selected = ($selected_value == $term->slug) ? 'selected' : '';

        // Générer l'option avec le nom du terme comme texte visible et le slug comme valeur
        $options .= '<option value="' . $term->slug . '" ' . $selected . '>' . $term->name . '</option>';
    }

    // Retourner la chaîne d'options générées
    return $options;
}
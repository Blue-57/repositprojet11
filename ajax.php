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

function filter()
{
    $query_args = array(
        'post_type' => 'photos',
        'orderby' => 'date',
        'order' => $_POST['orderDirection'],
        'posts_per_page' => 4,
        'paged' => $_POST['page'],
        'tax_query' => array(
            'relation' => 'AND',
            $_POST['categorieSelection'] != "all" ?
            array(
                'taxonomy' => $_POST['categorieTaxonomie'],
                'field' => 'slug',
                'terms' => $_POST['categorieSelection'],
            ) : '',
            $_POST['formatSelection'] != "all" ?
            array(
                'taxonomy' => $_POST['formatTaxonomie'],
                'field' => 'slug',
                'terms' => $_POST['formatSelection'],
            ) : '',
        ),
    );

    // Effectuer la requête
    $ajax_query = new WP_Query($query_args);

    // Vérifier si la requête a réussi
    if ($ajax_query->have_posts()) {
        // Formatage des résultats de la requête
        $response = array();
        while ($ajax_query->have_posts()) {
            $ajax_query->the_post();
            // Ajouter les données de chaque publication à la réponse
            $response[] = array(
                'title' => get_the_title(),
                'content' => get_the_content(),
                // Ajoutez d'autres champs nécessaires ici
            );
        }
    } else {
        // Aucune publication trouvée
        $response = array('message' => 'Aucune publication trouvée.');
    }

    // Renvoyer la réponse AJAX
    wp_send_json($response);

    // Assurez-vous de terminer le script PHP pour éviter toute sortie supplémentaire
    wp_die();
}
add_action('wp_ajax_nopriv_filter', 'filter');
add_action('wp_ajax_filter', 'filter');

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

<?php
// Récupérer les termes de taxonomie pour la publication actuelle
$terms_categories = get_the_terms($post->ID, 'media_categories');
$terms_formats = get_the_terms($post->ID, 'format');


if (!empty($terms_categories) && !empty($terms_formats) && !is_wp_error($terms_categories) && !is_wp_error($terms_formats)) {
    // Récupérer les IDs des termes de taxonomie pour les catégories de médias
    $category_ids = wp_list_pluck($terms_categories, 'term_id');
    $format_ids = wp_list_pluck($terms_formats, 'term_id');

    // Exclure l'ID de la publication actuelle de la liste des publications à récupérer
    $exclude_post_id = $post->ID;

    // Requête WP_Query pour récupérer deux photos de la même sous-catégorie de médias et de format
    $random_images = new WP_Query(
        array(
            'post_type' => 'photos',
            'post__not_in' => array($exclude_post_id), // Exclure la publication actuelle
            'tax_query' => array(
                'relation' => 'AND', // Utiliser une relation "ET" pour inclure les photos qui correspondent à la fois aux catégories de médias et aux formats
                array(
                    'taxonomy' => 'media_categories',
                    'field' => 'term_id',
                    'terms' => $category_ids,
                ),
                array(
                    'taxonomy' => 'format',
                    'field' => 'term_id',
                    'terms' => $format_ids,
                ),
            ),
            'orderby' => 'rand',
            'posts_per_page' => 2
        )
    );

    // Vérifier si des photos ont été trouvées
    if ($random_images->have_posts()) {
        while ($random_images->have_posts()):
            $random_images->the_post(); ?>
            <div class="recommandations__image">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail(); ?>
                </a>
            </div>
        <?php endwhile;
        wp_reset_postdata();
    } else {
        echo '<p class="texte">Il n\'y a pas encore d\'autres photos à afficher dans cette catégorie et ce format.</p>';
    }
} else {
    echo '<p class="texte">Aucune catégorie ou format trouvés pour cette photo.</p>';
}
?>
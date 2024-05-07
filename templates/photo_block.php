<?php
$terms_categories = get_the_terms(get_the_ID(), 'categories');
$terms_formats = get_the_terms(get_the_ID(), 'formats');

$category_ids = array();
if (!empty($terms_categories) && !is_wp_error($terms_categories)) {
    foreach ($terms_categories as $term) {
        $category_ids[] = $term->term_id;
    }
}

$format_ids = array();
if (!empty($terms_formats) && !is_wp_error($terms_formats)) {
    foreach ($terms_formats as $term) {
        $format_ids[] = $term->term_id;
    }
}
// Requête WP_Query pour récupérer les photos
$random_images = new WP_Query(
    array(
        'post_type' => 'photos',
        'post__not_in' => array(get_the_ID()),
        'tax_query' => array(
            'relation' => 'OR', // Utiliser une relation "OU" pour inclure les photos associées à n'importe lequel des termes
            array(
                'taxonomy' => 'categories',
                'field' => 'term_id',
                'terms' => $category_ids,
            ),
            array(
                'taxonomy' => 'formats',
                'field' => 'term_id',
                'terms' => $format_ids,
            ),
        ),
        'orderby' => 'rand',
        'posts_per_page' => 2
    )
);


if ($random_images->have_posts()):
    while ($random_images->have_posts()):
        $random_images->the_post();
        ?>
        <div class="recommandations__image">
            <a href="<?php the_permalink(); ?>">
                <?php echo the_post_thumbnail(); ?>
            </a>
        </div>
    <?php endwhile;
    wp_reset_postdata();
else:
    echo '<p class="texte">Il n\'y a pas encore d\'autres photos à afficher dans cette catégorie.</p>';
endif;
?>

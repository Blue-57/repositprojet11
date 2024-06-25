<?php
// Template pour afficher une photo avec hover, lightbox et infos
$post_link = get_permalink();
?>

<div class="photo-wrapper">
    <h1 class="hidden-title" style="display: none;"><?php the_title(); ?></h1>

    <a href="<?php echo esc_url($post_link); ?>" class="photo" data-post-id="<?php echo get_the_ID(); ?>">
        <?php the_post_thumbnail(); ?>

        <div class="hover-overlay">
            <img class="eye-icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/eyes.png"
                alt="Voir l'image">
        </div>
    </a>

    <div class="info-top-left">
        <a class="enlarge-link">
            <img class="enlarge-icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon_full.png"
                alt="Agrandir l'image">

        </a>
    </div>

    <div class="photo-info">
        <span class="photo-reference">Référence: <?php echo get_the_ID(); ?></span>
        <span class="photo-category">Catégorie: <?php
        $categories = get_the_terms(get_the_ID(), 'media_categories');
        if ($categories && !is_wp_error($categories)) {
            $category_names = array();
            foreach ($categories as $category) {
                $category_names[] = $category->name;
            }
            echo implode(', ', $category_names);
        }
        ?></span>
    </div>

</div>
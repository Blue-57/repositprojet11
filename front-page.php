<?php get_header();

?>

<?php get_template_part('hero'); ?>

<div class="menu-container">
    <div class="filters">
        <select name="categorie" id="categorie">
            <option value="">CATÉGORIES</option>

        </select>

        <select name="format" id="format">
            <option value="">FORMATS</option>

        </select>

        <select name="trier" id="trier">
            <option value="">TRIER PAR</option>

        </select>
    </div>
    <div class="photo-container">
        <?php
        // Début de la boucle pour afficher les photos
        $all_photos = new WP_Query(
            array(
                'post_type' => 'photos',
                'posts_per_page' => 4 // Limite initiale de photos à afficher
            )
        );

        if ($all_photos->have_posts()):
            while ($all_photos->have_posts()):
                $all_photos->the_post();
                // Obtenir le lien vers le post
                $post_link = get_permalink();
                // Afficher chaque photo avec un lien vers le post
                ?>
                <a href="<?php echo $post_link; ?>" class="photo" data-post-id="<?php echo get_the_ID(); ?>">
                    <?php the_post_thumbnail(); ?>
                </a>
                <?php
            endwhile;
            wp_reset_postdata();
        else:
            // Aucune photo trouvée
            echo 'Aucune photo trouvée.';
        endif;
        // Fin de la boucle
        ?>
    </div>
</div>

<input id="load-more-button" class="more-photos" type="button" value="Charger plus">




<?php get_footer(); ?>
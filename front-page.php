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
        // Début de la boucle
        $all_photos = new WP_Query(
            array(
                'post_type' => 'photos',
                'posts_per_page' => 4 // Chargez un nombre limité de photos initialement
            )
        );

        if ($all_photos->have_posts()):
            while ($all_photos->have_posts()):
                $all_photos->the_post();
                // Contenu de chaque photo ici, sans l'afficher immédiatement
                ?>
                <div class="photo" data-post-id="<?php echo get_the_ID(); ?>">
                    <?php the_post_thumbnail(); ?>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
        else:
            // Si aucune photo n'est trouvée
            echo 'Aucune photo trouvée.';
        endif;
        // Fin de la boucle
        ?>
    </div>


</div>



<input id="load-more-button" class="more-photos" type="button" value="Charger plus">








<?php get_footer(); ?>
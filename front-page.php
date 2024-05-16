<?php get_header();

?>

<?php get_template_part('hero'); ?>

<div class="menu-container">
    <div class="filters">


        <select id="media-categories-selector">
            <option value="all">CATÉGORIES</option>
            <option value="all">
            </option>


            <?php echo generate_taxonomy_options('media_categories', 'all'); ?>
        </select>



        <select id="media-format-selector">
            <option value="all">FORMATS</option>
            <option value="all">
            </option>

            <?php echo generate_taxonomy_options('format', 'all'); ?>
        </select>

        <select id="media-odre-selector">
            <option value="all">TRIER PAR</option>
            <option value="all">
            </option>

            <option value="DESC">Les plus récentes</option>
            <option value="">Les plus anciennes</option>
        </select>
    </div>


    <div class="photo-container">
        <?php
        // Début de la boucle pour afficher les photos
        $all_photos = new WP_Query(
            array(
                'post_type' => 'photos',
                'posts_per_page' => 8, // Limite initiale de photos à afficher
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

        endif;

        ?>
    </div>
</div>

<input id="load-more-button" class="more-photos" type="button" value="Charger plus">




<?php get_footer(); ?>
<?php get_header();

?>

<?php get_template_part('hero'); ?>

<div class="menu-container">
    <div class="filters">


        <select id="media-categories-selector" class="select">
            <option value="all">CATÉGORIES</option>
            <option value="all">
            </option>
            <?php echo generate_taxonomy_options('media_categories', 'all'); ?>
        </select>



        <select id="media-format-selector" class="select">
            <option value="all">FORMATS</option>
            <option value="all">
            </option>

            <?php echo generate_taxonomy_options('format', 'all'); ?>
        </select>

        <select id="media-odre-selector" class="select">
            <option value="all">TRIER PAR</option>
            <option value="all">
            </option>

            <option value="DESC">Les plus récentes</option>
            <option value="ASC">Les plus anciennes</option>
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
                <?php
                include ('photos-templates.php');
            endwhile;
            wp_reset_postdata();

        endif;

        ?>
    </div>
</div>

<input id="load-more-button" class="more-photos" type="button" value="Charger plus">

</div>



<?php get_footer(); ?>
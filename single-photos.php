<?php get_header(); ?>







<div class="post-photo ">
    <?php if (have_posts()):
        while (have_posts()):
            the_post(); ?>
            <section class="post-bloc ">
                <div class="post-bloc__description ">
                    <h1><?php the_title(); ?></h1>
                    <p>Référence : <?php echo get_post_meta(get_the_ID(), 'reference', true); ?></p>
                    <p>Catégorie : <?php
                    $categories = get_the_terms(get_the_ID(), 'media_categories');
                    if ($categories && !is_wp_error($categories)) {
                        $category_names = array();
                        foreach ($categories as $category) {
                            $category_names[] = $category->name;
                        }
                        echo implode(', ', $category_names);
                    }
                    ?></p>
                    <p>Format : <?php
                    $formats = get_the_terms(get_the_ID(), 'format');
                    if ($formats && !is_wp_error($formats)) {
                        $format_names = array();
                        foreach ($formats as $format) {
                            $format_names[] = $format->name;
                        }
                        echo implode(', ', $format_names);
                    }
                    ?>
                    <p>Type : <?php echo get_post_meta(get_the_ID(), 'type', true); ?></p>
                    <p>Année : <?php echo get_the_date('Y'); ?></p>



                </div>
                <img class="post-bloc__image " src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                <!--<div class="post-bloc__image colonne">
                <?php if (has_post_thumbnail()): ?>// verification si image s'affiche mise en commentaire si jamais 
                <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                 <?php else: ?>
       
                <?php endif; ?>
                </div>-->
            </section>



            <section class="interaction-photo ">
                <div>
                    <p class="texte">Cette photo vous intéresse ?</p>
                    <input class="interaction-photo__btn bouton btn-modale" type="button" value="Contact">
                </div>
                <div class="interaction-photo__navigation">
                    <?php
                    $prevPost = get_previous_post();
                    $nextPost = get_next_post();

                    if (!empty($prevPost)) {
                        $prevThumbnail = get_the_post_thumbnail_url($prevPost->ID);
                        $prevLink = get_permalink($prevPost); ?>
                        <div class="fleche">
                            <a href="<?php echo $prevLink; ?>">
                                <img class="fleche fleche-gauche"
                                    src="<?php echo get_template_directory_uri(); ?>/assets/img/flèche-gauche.png"
                                    alt="Flèche pointant vers la gauche" />
                            </a>
                        </div>
                    <?php }
                    if (!empty($nextPost)) {
                        $nextThumbnail = get_the_post_thumbnail_url($nextPost->ID);
                        $nextLink = get_permalink($nextPost); ?>
                        <div class="fleche">
                            <a href="<?php echo $nextLink; ?>">
                                <img class="fleche fleche-droite"
                                    src="<?php echo get_template_directory_uri(); ?>/assets/img/flèche-droite.png"
                                    alt="Flèche pointant vers la droite" />
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </section>


            <section class="recommandations">
                <h2>Vous aimerez aussi</h2>
                <div class="recommandations__images ">
                    <?php
                    $categorie = strip_tags(get_the_term_list(get_the_ID(), 'categories_photo'));
                    $random_images = new WP_Query(
                        array(
                            'post_type' => 'photos',
                            'post__not_in' => array(get_the_ID()),
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'categories_photo',
                                    'field' => 'slug',
                                    'terms' => $categorie,
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
                                    <?php the_post_thumbnail(); ?>
                                </a>
                            </div>
                        <?php endwhile;
                        wp_reset_postdata();
                    else:
                        echo '<p class="texte">Il n\'y a pas encore d\'autres photos à afficher dans cette catégorie.</p>';
                    endif;
                    ?>
                </div>
                <button class="recommandations__btn bouton" onclick="window.location.href='<?php echo site_url() ?>'">
                    Toutes les photos
                </button>
            </section>

        <?php endwhile; endif; ?>
</div>


































<?php get_footer(); ?>
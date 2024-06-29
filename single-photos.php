<?php get_header(); ?>

<?php

$reference = esc_attr(get_post_meta(get_the_ID(), "reference", true));// recuperation de la ref + cript action fichier js/ modif danc WP contact from 7
?>
<script>
    var reference = '<?php echo $reference; ?>';
</script>


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
                    <p>Année : <?php echo get_field('field_6627e2c622964'); ?>





                </div>
                <img class="post-bloc__image " src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                <!--<div class="post-bloc__image colonne">
                <?php if (has_post_thumbnail()): ?>// verification si image s'affiche mise en commentaire si jamais 
                <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                <?php


                ?>
                </div>
                 <?php else: ?>
       
                <?php endif; ?>
                </div>-->
            </section>



            <section class="interaction-photo ">
                <div class="interaction-texte">
                    <p class="texte">Cette photo vous intéresse ?</p>
                    <input class="interaction-photo__btn bouton btn-modale" type="button" value="Contact" id="bottom-Btn">
                </div>
                <div class="interaction-photo__navigation">
                    <?php
                    $prevPost = get_previous_post();
                    $nextPost = get_next_post();

                    if (!empty($prevPost)) {
                        $prevThumbnail = get_the_post_thumbnail_url($prevPost->ID);
                        $prevLink = get_permalink($prevPost); ?>
                        <div class="fleche-gauche">
                            <a href="<?php echo $prevLink; ?>">
                                <img class="fleche-g" src="<?php echo get_template_directory_uri(); ?>/assets/img/flèche-gauche.png"
                                    alt="Flèche pointant vers la gauche" />
                            </a>
                        </div>
                        <div class="preview">
                            <a href="<?php echo $prevLink; ?>">
                                <img class="previous-image" src="<?php echo $prevThumbnail; ?>"
                                    alt="Prévisualisation image précédente">
                            </a>
                        </div>
                    <?php }
                    if (!empty($nextPost)) {
                        $nextThumbnail = get_the_post_thumbnail_url($nextPost->ID);
                        $nextLink = get_permalink($nextPost); ?>
                        <div class="fleche-droite">
                            <a href="<?php echo $nextLink; ?>">
                                <img class="fleche-d" src="<?php echo get_template_directory_uri(); ?>/assets/img/flèche-droite.png"
                                    alt="Flèche pointant vers la droite" />
                            </a>
                        </div>
                        <div class="preview">
                            <a href="<?php echo $nextLink; ?>">
                                <img class="next-image" src="<?php echo $nextThumbnail; ?>" alt="Prévisualisation image suivante">
                            </a>
                        </div>
                    <?php } ?>
                </div>

            </section>


            <section class="recommandations">
                <h2>Vous aimerez aussi</h2>
                <div class="recommandations__images ">
                    <?php

                    get_template_part('templates/photo_block');
                    ?>
                </div>

            </section>

        <?php endwhile; endif; ?>


</div>


<?php get_footer(); ?>
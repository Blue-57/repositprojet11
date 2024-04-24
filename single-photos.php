<?php get_header();
?>







<div class="page-photo bloc-page">

    <?php if (have_posts()):
        while (have_posts()):
            the_post(); ?>

            <section class="photo-bloc colonnes">
                <div class="photo-bloc__description colonne">
                    <h1><?php the_title(); ?></h1>
                    <p>Référence : <?php echo get_post_meta(get_the_ID(), 'reference', true); ?></p>
                    <p>Catégorie : <?php echo strip_tags(get_the_term_list($post->ID, 'categories_photo')); ?></p>


                    <p>Format : <?php echo get_field('format'); ?></p>
                    <p>Type : <?php echo get_post_meta(get_the_ID(), 'type', true); ?></p>
                    <p>Année : <?php echo get_the_date('Y'); ?></p>
                </div>
                <div class="photo-bloc__image colonne">
                    <?php the_post_thumbnail(); ?>
                </div>
            </section>

            <section class="interaction-photo colonnes">
                <!-- Vos éléments d'interaction ici -->
            </section>

            <section class="recommandations">
                <!-- Vos recommandations pour d'autres photos ici -->
            </section>

        <?php endwhile; endif; ?>

</div>



































<?php get_footer(); ?>
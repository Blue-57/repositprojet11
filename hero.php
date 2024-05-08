<section class="hero">
    <h1>Photographe event</h1>
    <?php
    $random_image = new WP_Query(
        array(
            'post_type' => 'photos',
            'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'format',
                    'field' => 'slug',
                    'terms' => array('paysage', 'portrait'),
                ),
                array(
                    'taxonomy' => 'media_categories',
                    'field' => 'slug',
                    'terms' => array('concert', 'mariage', 'reception', 'television'),
                ),
            ),
            'orderby' => 'rand',
            'posts_per_page' => '1'
        )
    );
    if ($random_image->have_posts()) {
        while ($random_image->have_posts()) {
            $random_image->the_post();
            echo '<div class="hero__background" style="background-image: url(' . esc_url(get_the_post_thumbnail_url()) . ');"></div>';
        }
    }
    wp_reset_postdata();
    ?>
</section>
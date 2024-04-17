<footer class="footer">
    <nav class="footer__nav">
        <?php
        if (has_nav_menu('footer_menu')) {
            wp_nav_menu(array('theme_location' => 'footer_menu', ));
        } ?>

        <?php get_template_part('templates/modale'); ?>

        <?php wp_footer() ?>
    </nav>
</footer>
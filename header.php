<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_head() ?>

</head>

<body>

    <header>

        <section class="header">

            <nav class="header__nav">
                <?php
                the_custom_logo();

                if (has_nav_menu('primary_menu')) {
                    wp_nav_menu(array('theme_location' => 'primary_menu', 'menu_class' => 'primary-menu'));
                }

                ?>

            </nav>
            <div class="burger-menu" id="burger-menu">
                <div class="menu-closed"></div>
                <div class="menu-open"></div>
            </div>


            <div class="panel" id="main-panel">
                <div class="overlay" id="panel-overlay">
                    <?php
                    if (has_nav_menu('primary_menu')) {
                        wp_nav_menu(
                            array(
                                'theme_location' => 'primary_menu',
                                'menu_class' => 'mobile-menu',
                                'items_wrap' => '<ul class="mobile-menu">%3$s<li><a href="#" class="contact">CONTACT</a></li></ul>',
                            )
                        );
                    }
                    ?>

                </div>

            </div>

        </section>





    </header>





































</body>
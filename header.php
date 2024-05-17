<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <?php wp_head() ?>

</head>

<body>

    <header>

        <section class="header">

            <nav class="header__nav">
                <?php
                the_custom_logo();

                if (has_nav_menu('primary_menu')) {
                    wp_nav_menu(array('theme_location' => 'primary_menu', ));
                }

                ?>


            </nav>

        </section>




    </header>






































</body>
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


                if (has_nav_menu('primary_menu')) {
                    wp_nav_menu(array('theme_location' => 'primay_menu', ));
                }


                ?>

            </nav>


        </section>




    </header>






































</body>
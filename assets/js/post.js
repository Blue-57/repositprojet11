// post
document.addEventListener('DOMContentLoaded', function () {
    const arrowGauche = document.querySelector('.fleche-gauche');
    const arrowDroite = document.querySelector('.fleche-droite');
    const previousImage = document.querySelector('.previous-image');
    const nextImage = document.querySelector('.next-image');
    const navigationBlock = document.querySelector('.interaction-photo__navigation');

    // Cacher les images par défaut en ajustant l'opacité si elles existent
    if (previousImage) {
        previousImage.style.opacity = '0';
    }
    if (nextImage) {
        nextImage.style.opacity = '0';
    }

    // Afficher les images lorsque la souris est à l'intérieur du bloc
    navigationBlock.addEventListener('mouseenter', function () {
        if (previousImage) {
            previousImage.style.opacity = '1';
        }
        if (nextImage) {
            nextImage.style.opacity = '1';
        }
    });

    // Cacher les images lorsque la souris quitte le bloc
    navigationBlock.addEventListener('mouseleave', function () {
        if (previousImage) {
            previousImage.style.opacity = '0';
        }
        if (nextImage) {
            nextImage.style.opacity = '0';
        }
    });

    // Afficher l'image suivante au survol de la flèche gauche
    if (arrowGauche) {
        arrowGauche.addEventListener('mouseover', function () {



            arrowGauche.addEventListener('mouseover', function () {
                if (navigationBlock.contains(arrowGauche)) {
                    if (previousImage) {
                        previousImage.style.opacity = '1';
                    }
                    if (nextImage) {
                        nextImage.style.opacity = '0';
                    }
                } else if (navigationBlock.contains(arrowDroite) && previousImage && previousImage.src === "") {
                    if (nextImage) {
                        nextImage.style.opacity = '1';
                    }
                }
            });
        });
    }

    // Afficher l'image suivante au survol de la flèche droite
    if (arrowDroite) {
        arrowDroite.addEventListener('mouseover', function () {


            arrowDroite.addEventListener('mouseover', function () {
                if (navigationBlock.contains(arrowDroite)) {
                    if (previousImage) {
                        previousImage.style.opacity = '0';
                    }
                    if (nextImage) {
                        nextImage.style.opacity = '1';
                    }
                } else if (navigationBlock.contains(arrowGauche) && nextImage && nextImage.src === "") {
                    if (previousImage) {
                        previousImage.style.opacity = '1';
                    }
                }
            });
        });

    }

});


// JavaScript pour le bouton du bas de la page
jQuery(document).ready(function ($) {
    // Gestionnaire de clic pour le bouton en bas de la page
    $('#bottom-Btn').click(function () {
        var reference = window.reference;
        $('#reference-form-field').val(reference);
        $('#modalContact').show();
    });
});

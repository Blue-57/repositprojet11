document.addEventListener("DOMContentLoaded", function () {

    var modal = document.getElementById('modalContact');


    var btn = document.getElementById("menu-item-80");


    var span = document.getElementsByClassName("close")[0];


    btn.onclick = function () {
        modal.style.display = "block";
    }

    span.onclick = function () {
        modal.style.display = "none";
    }


    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
});


document.addEventListener('DOMContentLoaded', function () {
    const arrowGauche = document.querySelector('.fleche-gauche');
    const arrowDroite = document.querySelector('.fleche-droite');
    const previousImage = document.querySelector('.previous-image');
    const nextImage = document.querySelector('.next-image');
    const navigationBlock = document.querySelector('.interaction-photo__navigation');

    // Cacher les images par défaut
    previousImage.style.opacity = '0';
    nextImage.style.opacity = '0';

    // Afficher les images lorsque la souris est à l'intérieur du bloc
    navigationBlock.addEventListener('mouseenter', function () {
        previousImage.style.opacity = '1';
        nextImage.style.opacity = '1';
    });

    // Cacher les images lorsque la souris quitte le bloc
    navigationBlock.addEventListener('mouseleave', function () {
        previousImage.style.opacity = '0';
        nextImage.style.opacity = '0';
    });

    // Afficher l'image précédente au survol de la flèche gauche
    arrowGauche.addEventListener('mouseover', function () {
        if (navigationBlock.contains(arrowGauche)) {
            previousImage.style.opacity = '1';
            nextImage.style.opacity = '0';
        }
    });

    // Afficher l'image suivante au survol de la flèche droite
    arrowDroite.addEventListener('mouseover', function () {
        if (navigationBlock.contains(arrowDroite)) {
            previousImage.style.opacity = '0';
            nextImage.style.opacity = '1';
        }
    });
});








jQuery(document).ready(function ($) {// affichage de la modal avec la ref 
    $('.interaction-photo__btn').click(function () {
        $('#reference-form-field').val(reference);
        $('#modalContact').show();
    });
});

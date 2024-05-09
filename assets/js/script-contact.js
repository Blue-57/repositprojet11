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



// JavaScript pour le bouton du bas de la page
jQuery(document).ready(function ($) {
    // Gestionnaire de clic pour le bouton en bas de la page
    $('#bottom-Btn').click(function () {
        var reference = window.reference;
        $('#reference-form-field').val(reference);
        $('#modalContact').show();
    });
});



// post page
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






// Fonction pour charger les catégories depuis WordPress
function chargerCategories() {
    jQuery.ajax({
        url: ajaxurl, // L'URL de l'API AJAX de WordPress
        type: 'POST',
        data: {
            action: 'charger_media_categories' // Action WordPress pour traiter la requête
        },
        success: function (response) {
            // Ajouter les catégories récupérées en tant qu'options dans le menu déroulant des catégories
            jQuery('#categorie').html(response);
        }
    });
}


// Fonction pour charger les formats depuis WordPress
function chargerFormats() {
    jQuery.ajax({
        url: ajaxurl, // L'URL de l'API AJAX de WordPress
        type: 'POST',
        data: {
            action: 'charger_formats' // Action WordPress pour traiter la requête
        },
        success: function (response) {
            // Ajouter les formats récupérés en tant qu'options dans le menu déroulant des formats
            jQuery('#format').html(response);
        }
    });
}

// Appeler les fonctions pour charger les catégories et les formats lorsque le document est prêt
jQuery(document).ready(function () {
    chargerCategories();
    chargerFormats();
});




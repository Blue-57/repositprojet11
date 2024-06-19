jQuery(document).ready(function ($) {
    $('.enlarge-link').on('click', function (e) {
        e.preventDefault();
        // Ajoutez ici le code pour ouvrir la lightbox
        console.log('Lien d\'agrandissement cliqué');

        var photoTitle = $(this).closest('.photo-wrapper').find('.photo-info .photo-reference').text();
        var fullImageUrl = $(this).closest('.photo-wrapper').find('.photo img').attr('src');

        // Mettre à jour le contenu de la lightbox avec les données récupérées
        $('.lightbox .photo-title').text(photoTitle);
        $('.lightbox .full-image').attr('src', fullImageUrl);


        $('.lightbox').fadeIn(); // Affiche la lightbox

        // Pour tester, assurez-vous que la lightbox s'affiche
        // Si la lightbox s'affiche correctement, vous pourrez ensuite ajouter le contenu dynamique
    });

    // Fermeture de la lightbox
    $('.lightbox-close').on('click', function () {
        $('.lightbox').fadeOut();
    });

    // Navigation dans la lightbox
    // Exemple de navigation vers la photo suivante
    $('.lightbox-next').on('click', function () {
        // Implémentez votre logique pour naviguer vers la photo suivante
    });

    // Exemple de navigation vers la photo précédente
    $('.lightbox-prev').on('click', function () {
        // Implémentez votre logique pour naviguer vers la photo précédente
    });
});

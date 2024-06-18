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




jQuery(document).ready(function ($) {
    var page = 0;
    var postsPerPage = 8;
    var loading = false; // Indique si une requête AJAX est en cours
    var endOfPosts = false; // Indique si tous les posts ont été chargés

    // Fonction pour charger plus de photos
    function loadMorePhotos() {
        if (!loading && !endOfPosts) {
            loading = true; // Mettre le chargement à true pour éviter les requêtes multiples simultanées

            // Envoyer une requête AJAX pour récupérer les publications suivantes
            $.ajax({
                url: my_ajax_obj.ajax_url, // URL de l'API AJAX de WordPress
                type: 'POST',
                data: {
                    action: 'load_more_photos', // Action à définir dans WordPress pour gérer cette requête
                    page: page, // Page actuelle
                    posts_per_page: postsPerPage // Nombre de publications par page
                },
                success: function (response) {
                    if (response.trim() !== '') {
                        // Vérifier les nouvelles photos pour éviter les doublons
                        var newPhotos = $(response).find('.photo');
                        var existingPhotoIds = $('.photo').map(function () {
                            return $(this).data('post-id');
                        }).get();

                        newPhotos.each(function () {
                            var postId = $(this).data('post-id');
                            // Ajouter uniquement les photos qui ne sont pas déjà présentes sur la page
                            if (existingPhotoIds.indexOf(postId) === -1) {
                                $('.photo-container').append($(this));
                            }
                        });



                        page++; // Passer à la page suivante pour la prochaine requête
                    } else {
                        // Indiquer que tous les posts ont été chargés
                        endOfPosts = true;
                    }
                    loading = false; // Réinitialiser le statut de chargement
                },
                error: function (xhr, status, error) {
                    console.error('Erreur AJAX :', error); // Gérer les erreurs éventuelles
                    loading = false; // Réinitialiser le statut de chargement en cas d'erreur
                }
            });
        }
    }

    // Clic sur le bouton "Charger plus"
    $('#load-more-button').on('click', function () {
        loadMorePhotos(); // Charger plus de photos au clic sur le bouton
    });


});



/*
$(window).on('scroll', function () {
   if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
       loadMorePhotos(); // 
   }
});*/



jQuery(document).ready(function ($) {
    // Associer un événement de changement au menu déroulant des catégories
    $('#media-categories-selector').change(function () {
        ajaxRequest();
    });

    // Associer un événement de changement au menu déroulant des formats
    $('#media-format-selector').change(function () {
        ajaxRequest();
    });

    // Associer un événement de changement au menu déroulant de l'ordre de tri
    $('#media-odre-selector').change(function () {
        ajaxRequest();
    });

    // Fonction pour effectuer la requête AJAX
    function ajaxRequest() {
        var categorieSelection = $('#media-categories-selector').val();
        var formatSelection = $('#media-format-selector').val();
        var ordre = $('#media-odre-selector').val();

        $.ajax({
            type: 'POST',
            url: my_ajax_obj.ajax_url,
            dataType: 'html',
            data: {
                action: 'filter',
                categorieSelection: categorieSelection,
                formatSelection: formatSelection,
                orderDirection: ordre,
                page: 0 // Réinitialiser la page à 0 lorsque les filtres changent
            },
            success: function (resultat) {
                $('.photo-container').html(resultat); // Mettre à jour la section des photos avec les nouvelles données
            },
            error: function (result) {
                console.warn(result);
            },
        });
    }
    $('#media-odre-selector').change(function () {
        ajaxRequest(); // Appeler la fonction AJAX à chaque changement dans le menu déroulant de tri
    });
});




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
    var postsPerPage = 4;
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




function ajaxRequest(chargerPlus) {
    var categorieSelection = $('#media-categories-selector').val();
    var formatSelection = $('#media-format-selector').val();
    var ordre = $('#media-odre-selector"').val();

    $.ajax({
        type: 'POST',
        url: my_ajax_obj.ajax_url,
        dataType: 'html',
        data: {
            action: 'filter',
            categorieTaxonomie: 'media_categories',
            categorieSelection: categorieSelection,
            formatTaxonomie: 'format',
            formatSelection: formatSelection,
            orderDirection: ordre,
            page: pageActuelle,
        },
        success: function (resultat) {
            if (chargerPlus) {
                $('#photo-container').append(resultat);
            } else {
                $('#photo-container').html(resultat);
            }

            if (categorieSelection === 'mariage' && pageActuelle >= 3) {
                $('#load-more-button').attr('style', 'display: none;');
            } else if (pageActuelle === 5) {
                $('#load-more-button').attr('style', 'display: none;');
            } else if (
                (categorieSelection === 'concert' ||
                    categorieSelection === 'reception' || categorieSelection === 'television') &&
                pageActuelle === 1
            ) {
                $('#load-more-button').attr('style', 'display: none;');
            } else {
                $('#load-more-button').attr('style', 'display: block;');
            }
        },
        error: function (result) {
            console.warn(result);
        },
    });
}


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


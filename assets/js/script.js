
//modale 
document.addEventListener("DOMContentLoaded", function () {
    var modal = document.getElementById('modalContact'); // Sélectionnez votre modal par son ID

    // Sélectionnez le bouton "Contact" dans le menu principal
    var btnMain = document.getElementById("menu-item-80");

    // Sélectionnez le bouton "Contact" dans le menu burger
    var btnBurger = document.querySelector('.contact');

    var span = document.querySelector(".close"); // Sélectionnez le bouton de fermeture du modal

    // Fonction pour ouvrir le modal
    function openModal() {
        modal.style.display = "block";
    }

    // Fonction pour fermer le modal
    function closeModal() {
        modal.style.display = "none";
    }

    // Gestion des événements de clic

    // Pour le bouton "Contact" dans le menu principal
    btnMain.addEventListener("click", function (event) {
        event.preventDefault(); // Empêchez le lien de suivre le href
        openModal();
    });

    // Pour le bouton "burger-menu" (menu burger)
    btnBurger.addEventListener("click", function (event) {
        event.preventDefault(); // Empêchez le lien de suivre le href
        openModal();
    });

    // Pour le bouton de fermeture du modal
    span.addEventListener("click", function () {
        closeModal();
    });

    // Pour fermer le modal en cliquant en dehors de celui-ci
    window.addEventListener("click", function (event) {
        if (event.target === modal) {
            closeModal();
        }
    });
});











document.addEventListener('DOMContentLoaded', function () {
    var burgerMenu = document.getElementById('burger-menu');
    var menuClosed = document.querySelector('.menu-closed');
    var menuOpen = document.querySelector('.menu-open');
    var menuOverlay = document.getElementById('panel-overlay'); // Utilisation de menu-overlay

    var isOpen = false; // Variable pour suivre l'état du menu ouvert/fermé

    burgerMenu.addEventListener('click', function () {
        if (!isOpen) {
            // Si le menu est fermé, ouvre le menu et affiche menu-overlay
            menuClosed.style.opacity = '0';
            menuOpen.style.opacity = '1';
            menuOpen.style.pointerEvents = 'auto'; // Réactive les événements de clic sur l'image menu ouvert
            menuOverlay.style.opacity = '1'; // Affiche menu-overlay
            menuOverlay.style.pointerEvents = 'auto'; // Active les événements de clic sur menu-overlay
            isOpen = true; // Met à jour l'état du menu à ouvert
        } else {
            // Si le menu est ouvert, ferme le menu et cache menu-overlay
            menuClosed.style.opacity = '1';
            menuOpen.style.opacity = '0';
            menuOpen.style.pointerEvents = 'none'; // Désactive les événements de clic sur l'image menu ouvert
            menuOverlay.style.opacity = '0'; // Cache menu-overlay
            menuOverlay.style.pointerEvents = 'none'; // Désactive les événements de clic sur menu-overlay
            isOpen = false; // Met à jour l'état du menu à fermé
        }
    });
});











// requete ajax
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
                        // Convertir la réponse en éléments jQuery
                        var newPhotos = $(response);

                        // Vérifier les nouvelles photos pour éviter les doublons
                        newPhotos.each(function () {
                            var postId = $(this).find('.photo').data('post-id');
                            var existingPhotoIds = $('.photo').map(function () {
                                return $(this).data('post-id');
                            }).get();

                            // Ajouter uniquement les photos qui ne sont pas déjà présentes sur la page
                            if (existingPhotoIds.indexOf(postId) === -1) {
                                $('.photo-container').append($(this));
                            }

                        });

                        page++;
                    } else {
                        // Indiquer que tous les posts ont été chargés
                        endOfPosts = true;



                    }

                    loading = false; // Réinitialiser le statut de chargement
                    $('.enlarge-link').on('click', function (e) {
                        e.preventDefault();
                        photoWrappers = $('.photo-wrapper');

                        currentPhotoIndex = $(this).closest('.photo-wrapper').index('.photo-wrapper');
                        showLightbox(currentPhotoIndex);
                    });


                },
                error: function (xhr, status, error) {
                    console.error('Erreur AJAX :', error);
                    loading = false; // Réinitialiser le statut de chargement en cas d'erreur

                }
            });
        }
    }

    // Clic sur le bouton "Charger plus"
    $('#load-more-button').on('click', function () {
        loadMorePhotos();

    });

});



// option pour le scroll
/*
$(window).on('scroll', function () {
   if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
       loadMorePhotos(); 
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
                $('.enlarge-link').on('click', function (e) {
                    e.preventDefault();
                    photoWrappers = $('.photo-wrapper');

                    currentPhotoIndex = $(this).closest('.photo-wrapper').index('.photo-wrapper');
                    showLightbox(currentPhotoIndex);
                });

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









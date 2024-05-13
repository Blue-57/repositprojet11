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






// requete
jQuery(function ($) {
    var offset = 4;
    var postsPerPage = 4;

    // Fonction pour charger plus de publications
    function loadMorePosts() {
        offset += postsPerPage;

        // Envoie une requête Ajax pour charger plus de publications
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'load_more_posts',
                offset: offset,
                posts_per_page: postsPerPage
            },
            success: function (response) {
                // Ajoute les publications chargées à l'élément avec l'ID "posts-container"
                $('#posts-container').append(response);


            }
        });
    }

    // Gérer le clic sur le bouton "Charger plus"
    $('#load-more-button').on('click', function () {
        loadMorePosts();

    });
});




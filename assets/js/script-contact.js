document.addEventListener("DOMContentLoaded", function () {
    // Get the modal
    var modal = document.getElementById('modalContact');

    // Get the button that opens the modal
    var btn = document.getElementById("menu-item-80");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on the button, open the modal
    btn.onclick = function () {
        modal.style.display = "block";
    }

    span.onclick = function () {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
});



document.addEventListener('DOMContentLoaded', function () {
    const previousImage = document.querySelector('.previous-image');
    const nextImage = document.querySelector('.next-image');

    // Cacher les images précédentes et suivantes par défaut
    previousImage.style.display = 'none';
    nextImage.style.display = 'none';

    const arrowGauche = document.querySelector('.fleche-gauche');
    const arrowDroite = document.querySelector('.fleche-droite');

    // Événement au clic sur la flèche gauche
    arrowGauche.addEventListener('click', function () {
        previousImage.style.display = 'block';
        nextImage.style.display = 'none';
    });

    // Événement au clic sur la flèche droite
    arrowDroite.addEventListener('click', function () {
        previousImage.style.display = 'none';
        nextImage.style.display = 'block';
    });
});

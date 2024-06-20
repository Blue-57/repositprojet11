jQuery(document).ready(function ($) {
    currentPhotoIndex = -1;
    photoWrappers = $('.photo-wrapper');



    $('.enlarge-link').on('click', function (e) {
        e.preventDefault();
        currentPhotoIndex = $(this).closest('.photo-wrapper').index('.photo-wrapper');
        showLightbox(currentPhotoIndex);
    });

    $('.lightbox-close').on('click', function () {
        $('.lightbox').fadeOut();
    });

    $('.lightbox-next').on('click', function () {
        currentPhotoIndex = (currentPhotoIndex + 1) % photoWrappers.length;
        showLightbox(currentPhotoIndex);
    });

    $('.lightbox-prev').on('click', function () {
        currentPhotoIndex = (currentPhotoIndex - 1 + photoWrappers.length) % photoWrappers.length;
        showLightbox(currentPhotoIndex);
    });
});

var currentPhotoIndex = -1;
var photoWrappers = jQuery('.photo-wrapper');
function showLightbox(index) {

    var photoWrapper = jQuery(photoWrappers[index]);
    var photoTitle = photoWrapper.find('.hidden-title').text();
    var fullImageUrl = photoWrapper.find('.photo img').attr('src');
    var photoReference = photoWrapper.find('.photo-reference').text().trim();

    jQuery('.lightbox .photo-title').text(photoTitle);
    jQuery('.lightbox .photo-reference').text(photoReference);
    jQuery('.lightbox .full-image').attr('src', fullImageUrl);

    jQuery('.lightbox').fadeIn();
}
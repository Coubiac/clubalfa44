$(document).ready(function() {
    var screenWidth = $(window).width();

    if (screenWidth > 800) {
        $("#video").html('<video class="hide-on-med-and-down" id="video1" autoplay loop style="width: 100%">' +
            '<source src="videos/alfa.mp4" type="video/mp4" />' +
            '<source src="videos/alfa.webm" type="video/webm">' +
            '<source src="videos/alfa.ogv" type="video/ogg" />' +
            '<p>Your browser does not support the video tag.</p>' +
            '</video>');
        $('.preloader-background').delay(1700).fadeOut('slow');
        $('.preloader-wrapper')
            .delay(1700)
            .fadeOut();
        $('#video1').get(0).play();
    }
    else{
        $('.preloader-background').remove();
    }

});

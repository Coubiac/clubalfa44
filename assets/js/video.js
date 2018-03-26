$(document).ready(function() {
    var screenWidth = $(window).width();

    if (screenWidth > 800) {
        $("#video").html('<video ' +
            'class="hide-on-med-and-down" ' +
            'id="video1" ' +
            'autoplay ' +
            'loop ' +
            'poster="images/videoplaceholder.jpg"' +
            'style="width: 100%">' +
            '<source src="videos/alfa.mp4" type="video/mp4" />' +
            '<source src="videos/alfa.webm" type="video/webm">' +
            '<source src="videos/alfa.ogv" type="video/ogg" />' +
            '<p>Your browser does not support the video tag.</p>' +
            '</video>'+
            '<div class="hide-on-med-and-down" id="vidtop-content">' +
            '<div class="vid-info">' +
            '<h1 class="center-align">Bienvenue !</h1>' +
            '<p>Le club alfa 44 vous propose 4 activités: Lutte, Fitness, Musculation et Grappling-Fight</p>' +
            '<p>Venez vite vous inscrire, nous n\'attendons plus que vous !</p>' +
            '<a class="center-align btn btn-primary alfa-electrique" href="/commande">Je m\'inscris !</a>' +
            '</div>' +
            '</div>');
        $('.preloader-background').delay(1700).fadeOut('slow');
        $('.preloader-wrapper')
            .delay(1700)
            .fadeOut();
        $('#video1').get(0).play();
    }
    else{
        $('.preloader-background').remove();
        $('#video').html('<img src='')
    }

});

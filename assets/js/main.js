
var $ = require('jquery');
require('../materialize-src/js/bin/materialize.min');
$(document).ready(function(){
    $('.preloader-background').delay(1700).fadeOut('slow');

    $('.preloader-wrapper')
        .delay(1700)
        .fadeOut();
    $('.carousel.carousel-slider').carousel({fullWidth: true});
    autoplay();
    $('.button-collapse').sideNav({'edge': 'left'});
    $('select').material_select();

    $('.materialboxed').materialbox();

    var count = $('.count-chars');
//script pour compter les caractères
    $('.textarea-contact').keyup(function () {

        console.log($(this).val().length);
        count.text($(this).val().length);

        if($(this).val().length > 1200)
        {
            $('.count-chars').css('color', 'red')
        }
        else
        {
            $('.count-chars').css('color', 'black')
        }
    });
// script for alerts
    $('#alert_close').click(function(){
        $( "#alert_box" ).fadeOut( "slow", function() {
        });
    });

});

function autoplay() {
    $('.carousel').carousel('next');
    setTimeout(autoplay, 4500);
}

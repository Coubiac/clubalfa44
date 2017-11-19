
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
    $('select').not('.disabled').material_select();
    $('.materialboxed').materialbox();

});

function autoplay() {
    $('.carousel').carousel('next');
    setTimeout(autoplay, 4500);
}

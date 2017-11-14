
var $ = require('jquery');
require('../materialize-src/js/bin/materialize.min');
$(document).ready(function(){
    $('.preloader-background').delay(1700).fadeOut('slow');

    $('.preloader-wrapper')
        .delay(1700)
        .fadeOut();
// Plugin initialization
    $('.carousel.carousel-slider').carousel({fullWidth: true});
    autoplay();

    $('.carousel').carousel();
    $('.slider').slider();
    $('.modal').modal();
    $('.scrollspy').scrollSpy();
    $('.button-collapse').sideNav({'edge': 'left'});
    $('.datepicker').pickadate({selectYears: 20});
    $('.timepicker').pickatime();
    $('select').not('.disabled').material_select();
    $('input.autocomplete').autocomplete({
        data: {"Apple": null, "Microsoft": null, "Google": 'http://placehold.it/250x250'},
    });

});

function autoplay() {
    $('.carousel').carousel('next');
    setTimeout(autoplay, 4500);
}

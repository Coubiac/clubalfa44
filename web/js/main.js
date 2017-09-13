/**
 * Created by ben on 10/09/2017.
 */
$(document).ready(function(){
// Plugin initialization
    $('.carousel.carousel-slider').carousel({fullWidth: true});
    autoplay();

    $('.carousel').carousel();
    $('.slider').slider();
    $('.parallax').parallax();
    $('.modal').modal();
    $('.scrollspy').scrollSpy();
    $('.button-collapse').sideNav({'edge': 'left'});
    $('.datepicker').pickadate({selectYears: 20});
    $('.timepicker').pickatime();
    $('select').not('.disabled').material_select();
    $('.card-action').fitText(0.8);
    $('input.autocomplete').autocomplete({
        data: {"Apple": null, "Microsoft": null, "Google": 'http://placehold.it/250x250'},
    });
});
function autoplay() {
    $('.carousel').carousel('next');
    setTimeout(autoplay, 4500);
}

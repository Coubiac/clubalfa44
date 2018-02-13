
var $ = require('jquery');
require('../materialize-src/js/bin/materialize.min');
$(document).ready(function(){
    var screenWidth = $(window).width();
    // if window width is smaller than 800 remove the autoplay attribute
    // from the video
    if (screenWidth < 800){
        $('.preloader-background').remove();
    }
    if (screenWidth > 800){
        $("#video").html('<video class="hide-on-med-and-down" id="video1" autoplay loop style="width: 100%"><source src="videos/alfa.mp4" type="video/mp4" /><source src="videos/alfa.webm" type="video/webm"><source src="videos/alfa.ogv" type="video/ogg" /><p>Your browser does not support the video tag.</p></video>');
        $('.preloader-background').delay(1700).fadeOut('slow');
        $('.preloader-wrapper')
            .delay(1700)
            .fadeOut();}
    $('#video1').get(0).play();



    $('.button-collapse').sideNav({
        'menuWidth': 240,
        'edge': 'left'
    });
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



var $ = require('jquery');
require('../materialize-src/js/bin/materialize.min');
$(document).ready(function(){
    var screenWidth = $(window).width();
    // if window width is smaller than 800 remove the autoplay attribute
    // from the video
    if (screenWidth < 800){
        $('video').removeAttr('autoplay');
    } else {
        $('video').attr('autoplay');
    }

git
    $('.preloader-background').delay(1700).fadeOut('slow');

    $('.preloader-wrapper')
        .delay(1700)
        .fadeOut();

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


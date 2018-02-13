$(document).ready(function(){

    $('.button-collapse').sideNav({
        'menuWidth': 240,
        'edge': 'left'
    });
    $('select').material_select();

    $('.materialboxed').materialbox();

// script for alerts
    $('#alert_close').click(function(){
        $( "#alert_box" ).fadeOut( "slow", function() {
        });
    });

});

$(document).ready(function() {

    $('.button-collapse').sideNav({
        'menuWidth': 240,
        'edge': 'left'
    });
    $('select').material_select();

    $('.materialboxed').materialbox();


// script for alerts
    $('#alert_close').click(function () {
        $("#alert_box").fadeOut("slow", function () {
        });
    });

    //script for modals
    $('.modal-trigger').click(function () {
        //On initialise les modales materialize
        $('.modal').modal();
        //On récupère l'url depuis la propriété "Data-target" de la balise html a
        url = $(this).attr('data-target');
        //on fait un appel ajax vers l'action symfony qui nous renvoie la vue
        $.get(url, function (data) {
            //on injecte le html dans la modale
            $('.modal-content').html(data);
            //on ouvre la modale
            $('#modal1').modal('open');
        });
    })
});


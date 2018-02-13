$(document).ready(function () {

    var count = $('.count-chars');


//script pour compter les caractères
    $('.textarea-contact').keyup(function () {

        console.log($(this).val().length);
        count.text($(this).val().length);

        if ($(this).val().length > 1200) {
            $('.count-chars').css('color', 'red')
        }
        else {
            $('.count-chars').css('color', 'black')
        }
    });
});

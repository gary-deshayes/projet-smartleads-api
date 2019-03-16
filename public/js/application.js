/*Javacript principal de l'application */


//Permet de rendre les lignes des tables clickable
$(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});
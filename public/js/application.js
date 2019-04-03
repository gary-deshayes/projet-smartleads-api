/*Javacript principal de l'application */


//Permet de rendre les lignes des tables clickable
$(document).ready(function ($) {
    //Ligne table clickable
    $(".clickable-row").on("click", "td:gt(0)", function () {
        window.location = $(this).parent().data("href");
    });

    //sidenav
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });

    $(".div-contacts-cible input").addClass("col-lg-1");
    $(".div-contacts-cible label").addClass("col-lg-11");
});
$(function () {
    $(".datepicker").datepicker({
        dateFormat: "dd-mm-yy",
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+0",
        maxDate: "+0d",
        buttonText: "<i class='fa fa-calendar'></i>"
    });


    $("#anim").on("change", function () {
        $("#datepicker").datepicker("option", "showAnim", $(this).val());
    });
});

$("#search_limit").on("change", function () {
    $("#form_search").submit();
})
//Changement des statut switchs
$("[id^='statut']").on("change", function () {
    console.log($(this));
    var entity = $(this).attr("id").split("statut-")[1];
    var value;
    if ($(this).is(":checked")) {
        value = 1;
    } else {
        value = 0;
    }

    if(entity == "contact"){
        changeStatutContact(value)
    }
})

function changeStatutContact(value){
    var data = {
        statut: value
    };
    var url = "/admin/contacts/change_statut/" + $("#contacts_code").val();
    $.post( url, data,function( data ) {
        if(data.retour == true) {
            console.log("okk");
        }
      });
}


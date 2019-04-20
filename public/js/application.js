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

    $(".gestion_formulaire input").addClass("custom-control-input");
    $(".gestion_formulaire label").addClass("custom-control-label");

    $(".gestion_formulaire > .row > div").addClass("col-lg-8");
    $(".gestion_formulaire > .row > p").addClass("col-lg-4");
    $(".hidden-form").parent().hide();

    $(".gestion-formulaire-checkbox-div > div").addClass("custom-control custom-checkbox");

    //Permet de rendre dynamique la selection des checkbox dans le formulaire d'opérations
    $(".gestion-formulaire-checkbox-div").on("click", ":checkbox", function(){
        if($(this).is(":checked")) {
            switch($(this).val()){
                case "2":
                    $(this).parent().prev().children("input").prop("checked", true);
                break;
                case "3":
                    $(this).parent().prev().children("input").prop("checked", true);
                    $(this).parent().prev().prev().children("input").prop("checked", true);
                break;
            }
        }
        if(!$(this).is(":checked")) {
            switch($(this).val()){
                case "2":
                    $(this).parent().next().children("input").prop("checked", false);
                break;
                case "1":
                    $(this).parent().next().children("input").prop("checked", false);
                    $(this).parent().next().next().children("input").prop("checked", false);
                break;
            }
        }
        
    })

    $(".my-rating").starRating({
        initialRating: $("#decision_level").val() / 2,
        strokeColor: '#894A00',
        strokeWidth: 10,
        starSize: 25,
        disableAfterRate: false,
        callback: function (currentRating, $el) {
            console.log('rated ' + currentRating * 2);
            console.log('DOM element ', $el);
            var data = {
                decision_level: currentRating * 2
            };
            var url = "/admin/company/change_decision/" + $("#company_code").val();
            $.post(url, data, function (data) {
                if (data.retour == true) {
                    console.log("okk");
                }
            });
        }
    });

});
// $(document).ready(function () {
//     $('#mail').on('click', function () {
//         alert('Email envoyé');
//     });
// });

$(function () {
    $(".datepicker").datepicker({
        dateFormat: "dd-mm-yy",
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+0",
        maxDate: "+0d",
        buttonText: "<i class='fa fa-calendar'></i>"
    });

    $(".datepicker-operation").datepicker({
        dateFormat: "dd-mm-yy",
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+0",
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

    if (entity == "contact") {
        changeStatutContact(value)
    }
})

function changeStatutContact(value) {
    var data = {
        statut: value
    };
    var url = "/admin/contacts/change_statut/" + $("#contacts_code").val();
    $.post(url, data, function (data) {
        if (data.retour == true) {
            console.log("okk");
        }
    });
}


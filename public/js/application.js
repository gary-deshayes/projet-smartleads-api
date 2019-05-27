/*Javacript principal de l'application */


//Permet de rendre les lignes des tables clickable
$(document).ready(function ($) {
    //Ligne table clickable
    $(".clickable-row").on("click", "td:gt(0)", function () {
        window.location = $(this).parent().data("href");
    });

    //Active les tooltips
    $('[data-toggle="tooltip"]').tooltip();

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
    $(".gestion-formulaire-checkbox-div").on("click", ":checkbox", function () {
        if ($(this).is(":checked")) {
            switch ($(this).val()) {
                case "2":
                    $(this).parent().prev().children("input").prop("checked", true);
                    break;
                case "3":
                    $(this).parent().prev().children("input").prop("checked", true);
                    $(this).parent().prev().prev().children("input").prop("checked", true);
                    break;
            }
        }
        if (!$(this).is(":checked")) {
            switch ($(this).val()) {
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
    //Permet de noter les entreprises de 0 à 10
    $(".my-rating").starRating({
        initialRating: $("#decision_level").val() / 2,
        strokeColor: '#894A00',
        strokeWidth: 10,
        starSize: 25,
        disableAfterRate: false,
        callback: function (currentRating, $el) {
            var data = {
                decision_level: currentRating * 2
            };
            var url = "/admin/company/change_decision/" + $("#company_code").val();
            $.post(url, data, function (data) {
                if (data.retour == true) {
                }
            });
        }
    });

    //Permet de mettre un background aux lignes selectionées
    $(".checkbox-dynamic :checkbox").on("click", function () {
        if ($(this).is(":checked")) {
            $(this).parent().parent().parent().addClass("selected-line");
        } else {
            $(this).parent().parent().parent().removeClass("selected-line");
        }
    })
    //Check tout les checkbox
    $(".checkbox-dynamic-all :checkbox").on("click", function () {
        if ($(this).is(":checked")) {
            $(".checkbox-dynamic :checkbox").prop("checked", true);

        } else {
            $(".checkbox-dynamic :checkbox").prop("checked", false);

        }
    })

    $(".live-img-display").on("change", function () {
        if ($(this)[0].files && $(this)[0].files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#display-img-profile')
                    .attr('src', e.target.result)
                    .width(100)
                    .height(100);
            };

            reader.readAsDataURL($(this)[0].files[0]);
        }
    })
    /*Partie Settings*/

    //Permet de gérer l'affichage des sous catégories dans paramètres
    if ($("#settings-contacts").val() == 1) {
        $("#partProfession").show();
        $("#partDecisionMaking").hide();
    } else {
        $("#partProfession").hide();
        $("#partDecisionMaking").show();
    }

    $("#settings-contacts").on("change", function () {
        if ($("#settings-contacts").val() == 1) {
            $("#partProfession").show();
            $("#partDecisionMaking").hide();
        } else {
            $("#partProfession").hide();
            $("#partDecisionMaking").show();
        }
    });

    $('#editModalProfession').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id');
        var libelle = button.data('libelle');
        var modal = $(this)
        modal.find('#profession_id').val(id)
        modal.find('#profession_libelle').val(libelle)
    })

    $('#editModalDecision').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id');
        var libelle = button.data('libelle');
        var modal = $(this)
        modal.find('#decision_making_id').val(id)
        modal.find('#decision_making_libelle').val(libelle)
    })

    //Permet de gérer l'affichage des sous catégories dans paramètres
    if ($("#settings-entreprises").val() == 1) {
        $("#partStatuts").show();
        $("#partActivityArea").hide();
        $("#partLegalStatus").hide();
        $("#partNumberEmployees").hide();
        $("#partTurnovers").hide();
        $("#partCountry").hide();
    } else if ($("#settings-entreprises").val() == 2) {
        $("#partStatuts").hide();
        $("#partActivityArea").show();
        $("#partLegalStatus").hide();
        $("#partNumberEmployees").hide();
        $("#partTurnovers").hide();
        $("#partCountry").hide();
    } else if ($("#settings-entreprises").val() == 3) {
        $("#partStatuts").hide();
        $("#partActivityArea").hide();
        $("#partLegalStatus").show();
        $("#partNumberEmployees").hide();
        $("#partTurnovers").hide();
        $("#partCountry").hide();
    } else if ($("#settings-entreprises").val() == 4) {
        $("#partStatuts").hide();
        $("#partActivityArea").hide();
        $("#partLegalStatus").hide();
        $("#partNumberEmployees").show();
        $("#partTurnovers").hide();
        $("#partCountry").hide();
    } else if ($("#settings-entreprises").val() == 5) {
        $("#partStatuts").hide();
        $("#partActivityArea").hide();
        $("#partLegalStatus").hide();
        $("#partNumberEmployees").hide();
        $("#partTurnovers").show();
        $("#partCountry").hide();
    } else if ($("#settings-entreprises").val() == 6) {
        $("#partStatuts").hide();
        $("#partActivityArea").hide();
        $("#partLegalStatus").hide();
        $("#partNumberEmployees").hide();
        $("#partTurnovers").hide();
        $("#partCountry").show();
    }

    //Partie settings entreprise
    $("#settings-entreprises").on("change", function () {
        switch ($("#settings-entreprises").val()) {
            case "1":
                $("#partStatuts").show();
                $("#partActivityArea").hide();
                $("#partLegalStatus").hide();
                $("#partNumberEmployees").hide();
                $("#partTurnovers").hide();
                $("#partCountry").hide();
                break;
            case "2":
                $("#partStatuts").hide();
                $("#partActivityArea").show();
                $("#partLegalStatus").hide();
                $("#partNumberEmployees").hide();
                $("#partTurnovers").hide();
                $("#partCountry").hide();
                break;
            case "3":
                $("#partStatuts").hide();
                $("#partActivityArea").hide();
                $("#partLegalStatus").show();
                $("#partNumberEmployees").hide();
                $("#partTurnovers").hide();
                $("#partCountry").hide();
                break;
            case "4":
                $("#partStatuts").hide();
                $("#partActivityArea").hide();
                $("#partLegalStatus").hide();
                $("#partNumberEmployees").show();
                $("#partTurnovers").hide();
                $("#partCountry").hide();
                break;
            case "5":
                $("#partStatuts").hide();
                $("#partActivityArea").hide();
                $("#partLegalStatus").hide();
                $("#partNumberEmployees").hide();
                $("#partTurnovers").show();
                $("#partCountry").hide();
                break;
            case "6":
                $("#partStatuts").hide();
                $("#partActivityArea").hide();
                $("#partLegalStatus").hide();
                $("#partNumberEmployees").hide();
                $("#partTurnovers").hide();
                $("#partCountry").show();
                break;


        }
    });

    $('#editModalStatus').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id');
        var libelle = button.data('libelle');
        var color = button.data('color');
        var modal = $(this)
        modal.find('#company_status_id').val(id)
        modal.find('#company_status_libelle').val(libelle)
        modal.find('#company_status_color').val(color)
    })

    $('#editModalActivity').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id');
        var libelle = button.data('libelle');
        var modal = $(this)
        modal.find('#activity_area_id').val(id)
        modal.find('#activity_area_libelle').val(libelle)
    })

    $('#editModalLegalStatus').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id');
        var libelle = button.data('libelle');
        var modal = $(this)
        modal.find('#legal_status_id').val(id)
        modal.find('#legal_status_libelle').val(libelle)
    })

    $('#editModalNumberEmployees').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id');
        var libelle = button.data('libelle');
        var modal = $(this)
        modal.find('#number_employees_id').val(id)
        modal.find('#number_employees_libelle').val(libelle)
    })

    $('#editModalTurnovers').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id');
        var libelle = button.data('libelle');
        var modal = $(this)
        modal.find('#turnovers_id').val(id)
        modal.find('#turnovers_libelle').val(libelle)
    })

    $('.select2-tags').select2({
        width: "300px"
    });

    $('#addModalAffectedArea').on('show.bs.modal', function (event) {
        $(".select2-tags-add").val(null);
        $('.select2-tags-add').select2({
            width: "300px"
        });
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var libelle = button.data('libelle');
        var modal = $(this);



    })



    $('#editModalAffectedArea').on('show.bs.modal', function (event) {
        $(".select2-tags").val(null);
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var libelle = button.data('libelle');
        var modal = $(this);
        modal.find('#affected_area_id').val(id);
        modal.find('#affected_area_libelle').val(libelle);
        //Récupération des départements déjà lié à une zone
        $.ajax({
            url: '/admin/affectedarea/getdepartments/' + id,
            type: 'GET',
            success: function (result) {
                if (result.data.length > 0) {
                    result.data.forEach(function (e) {
                        $("#affected_area_departments option[value='" + e + "]'").attr("selected", "selected");
                    })
                    $(".select2-tags").val(result.data).trigger("change");
                    $('.select2-tags').select2({
                        width: "300px"
                    });

                }
            }
        });



    })

    $('#editModalCountry').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var code = button.data('code');
        var libelle = button.data('libelle');
        var modal = $(this)
        modal.find('#country_code').val(code)
        modal.find('#country_libelle').val(libelle)
    })

    $("#suppression-contacts").on("click", function (event) {
        event.preventDefault();
        $("#form_delete_contacts").submit();
    })

    $("#suppression-salesperson").on("click", function (event) {
        event.preventDefault();
        $("#form_delete_salesperson").submit();
    })

    $("#suppression-company").on("click", function (event) {
        event.preventDefault();
        $("#form_delete_company").submit();
    })

});

$(function () {
    $(".datepicker").datepicker({
        dateFormat: "dd/mm/yy",
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+0",
        maxDate: "+0d",
        buttonText: "<i class='fa fa-calendar'></i>"
    });

    //Date arrivée et départ des commerciaux et contacts
    $(".datepickerArrival").datepicker({
        dateFormat: "dd/mm/yy",
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+0",
        maxDate: "+0d",
        buttonText: "<i class='fa fa-calendar'></i>",
        onClose: function (selectedDate) {
            $(".datepickerDeparture").datepicker("option", "minDate", selectedDate);
        }
    });

    $(".datepickerDeparture").datepicker({
        dateFormat: "dd/mm/yy",
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+20",
        buttonText: "<i class='fa fa-calendar'></i>",
        onClose: function (selectedDate) {
            $(".datepickerArrival").datepicker("option", "maxDate", selectedDate);
        }
    });
    //Si la date d'arrivée du commercial est déjà selectionnée, au lancement on restreint la date de départ après la date d'arrivée
    if ($(".datepickerArrival").val() != null) {
        $(".datepickerDeparture").datepicker("option", "minDate", $(".datepickerArrival").val());
    }

    $(".datepicker-operation-sending").datepicker({
        dateFormat: "dd-mm-yy",
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+0",
        buttonText: "<i class='fa fa-calendar'></i>",
        onClose: function (selectedDate) {
            $(".datepicker-operation-closing").datepicker("option", "minDate", selectedDate);
        }
    });

    $(".datepicker-operation-closing").datepicker({
        dateFormat: "dd-mm-yy",
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+0",
        buttonText: "<i class='fa fa-calendar'></i>",
        onClose: function (selectedDate) {
            $(".datepicker-operation-sending").datepicker("option", "maxDate", selectedDate);
        }
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
    if (entity == "salesperson") {
        changeStatutSalesperson(value)
    }
    if (entity == "company") {
        changeStatutCompany(value)
    }
})

function changeStatutContact(value) {
    var data = {
        statut: value
    };
    var url = "/admin/contacts/change_statut/" + $("#contacts_code").val();
    $.post(url, data, function (data) {
        if (data.retour == true) {
        }
    });
}

// Donut Component Dashboard
var options = {
    chart: {
        type: 'donut',
        height: 300
    },
    dataLabels: {
        enabled: false,
    },
    labels: ['Ouvert', 'Non ouvert', 'Délivré', 'Ajout/Mise à jour des données'],
    plotOptions: {
        pie: {
            size: 80,
            donut: {
                size: '80%'
            }
        }
    },
    legend: {
        show: true,
        showForSingleSeries: false,
        showForNullSeries: true,
        showForZeroSeries: true,
        position: 'bottom',
        horizontalAlign: 'left',
        offsetY: 30,
        itemMargin: {
            horizontal: 0,
            vertical: 20
        },
        labels: {
            colors: ['#B3B3B3']
        },
    },
    series: [44, 55, 41, 100],
    responsive: [{
        breakpoint: 480,
        options: {
            chart: {
                width: 200
            },
            legend: {
                position: 'bottom'
            }
        }
    }]
}

var chart = new ApexCharts(
    document.querySelector("#chart"),
    options
);
chart.render();

// Chart Component Dashboard
var options = {
    chart: {
        height: 350,
        type: 'line',
        shadow: {
            enabled: true,
            color: '#000',
            top: 18,
            left: 7,
            blur: 10,
            opacity: 1
        },
        toolbar: {
            show: false
        }
    },
    colors: ['#77B6EA', '#545454'],
    dataLabels: {
        enabled: true,
    },
    series: [{
        name: "Opérations",
        data: [28, 29, 33, 36, 32, 32, 80]
    },
    {
        //Pour avoir le point en haut a droite
        name: "",
        data: []
    }
    ],
    grid: {
        borderColor: '#e7e7e7',
        row: {
            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.5
        },
    },
    markers: {

        size: 6
    },
    xaxis: {
        categories: ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Jui', 'Juil']
    },
    legend: {
        position: 'top',
        horizontalAlign: 'right',
        floating: true,
        offsetY: -25,
        offsetX: -5
    }
}

var chart = new ApexCharts(
    document.querySelector("#line-operation-chart"),
    options
);
chart.render();

function changeStatutSalesperson(value) {
    var data = {
        statut: value
    };
    var url = "/admin/salesperson/change_statut/" + $("#salesperson_code").val();
    $.post(url, data, function (data) {
        if (data.retour == true) {
        }
    });
}


function changeStatutCompany(value) {
    var data = {
        statut: value
    };
    var url = "/admin/company/change_statut/" + $("#company_code").val();
    $.post(url, data, function (data) {
        if (data.retour == true) {
        }
    });
}


$("#profession_delete").on("click", function (e) {
    e.preventDefault();
    $('#editModalProfession').modal("hide");

    $.ajax({
        url: '/admin/profession/' + $("#profession_id").val(),
        type: 'DELETE',
        success: function (result) {
            if (result == 1) {
                $("#td-settings-profession-" + $("#profession_id").val()).remove();
            }
        }
    });
});

$("#decision_making_delete").on("click", function (e) {
    e.preventDefault();
    $('#editModalDecision').modal("hide");

    $.ajax({
        url: '/admin/decisionMaking/' + $("#decision_making_id").val(),
        type: 'DELETE',
        success: function (result) {
            if (result == 1) {
                $("#td-settings-decision-" + $("#decision_making_id").val()).remove();
            }
        }
    });
})
//colors: ["ffa200"],

var options = {
    chart: {
        height: 230,
        type: 'radialBar',
    },

    series: [50],
    labels: ["Indice de qualité CRM"],
    colors: ["#ffa200"],
    plotOptions: {
        radialBar: {
            startAngle: -90,
            endAngle: 90,
            hollow: {
                margin: 15,
                size: "70%"
            },

            dataLabels: {
                showOn: "always",
                name: {
                    offsetY: 20,
                    show: true,
                    color: "#999999",
                    fontSize: "12px",
                    fontWeight: "bold"
                },
                value: {
                    offsetY: -22,
                    color: "#999999",
                    fontSize: "28px",
                    show: true
                }
            }
        }
    },

    stroke: {
        lineCap: "round",
    },
}

var chart = new ApexCharts(
    document.querySelector("#chart-circle"),
    options
);

chart.render();


var options1 = {
    chart: {
        height: 280,
        type: "radialBar",
    },
    series: [67],
    colors: ["#20E647"],
    plotOptions: {
        radialBar: {
            startAngle: -135,
            endAngle: 135,
            track: {
                background: '#333',
                startAngle: -135,
                endAngle: 135,
            },
            dataLabels: {
                name: {
                    show: false,
                },
                value: {
                    fontSize: "30px",
                    show: true
                }
            }
        }
    },
    fill: {
        type: "gradient",
        gradient: {
            shade: "dark",
            type: "horizontal",
            gradientToColors: ["#87D4F9"],
            stops: [0, 100]
        }
    },
    stroke: {
        lineCap: "butt"
    },
    labels: ["Progress"]
};


// function drawChart() {

//     var data = google.visualization.arrayToDataTable([
//         ['Task', 'Hours per Day'],
//         ['Ouvert', 46],
//         ['Non délivré', 14],
//         ['Non ouvert', 20],
//         ['Ajout/mise à jour des données', 20]
//     ]);

// google.charts.load('current', {'packages':['corechart']});
// google.charts.setOnLoadCallback(drawChart);

// function drawChart() {

//   var data = google.visualization.arrayToDataTable([
//     ['Task', 'Hours per Day'],
//     ['Ouvert',     46],
//     ['Non délivré',  14],
//     ['Non ouvert', 20],
//     ['Ajout/mise à jour des données', 20]
//   ]);

//   var options = {
//     title: 'Performance des opérations',
//     pieHole : 0.5,
//   };

//   var chart = new google.visualization.PieChart(document.getElementById('piechart'));

//   chart.draw(data, options);
// }

//   //doughnut
//   var ctxD = document.getElementById("doughnutChart").getContext('2d');
//   var myLineChart = new Chart(ctxD, {
//     type: 'doughnut',
//     data: {
//       labels: ["Red", "Green", "Yellow", "Grey", "Dark Grey"],

//       datasets: [{
//         data: [300, 50, 100, 40, 120],
//         backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
//         hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
//       }]
//     },
//     options: {
//       responsive: true
//     }
//   });


//Partie target opération

if ($("#target_operation_entity").val() == "Company") {
    parameterTargetCompany()
}

$('#target_operation_entity').on("change", function () {
    switch ($(this).val()) {
        case "Company":
            $("#target_operation_parameter").empty();
            parameterTargetCompany();
            switch ($("#target_operation_parameter").val()) {
                case "postalCode":
                    inputTargetOperation();
                    break;
                case "NumberEmployees":
                    selectTargetOperation("NumberEmployees");
                    break;
                case "CompanyStatus":
                    selectTargetOperation("CompanyStatus");
                    break;
                case "Country":
                    selectTargetOperation("Country");
                    break;
                case "ActivityArea":
                    selectTargetOperation("ActivityArea");
                    break;
                case "Turnovers":
                    selectTargetOperation("Turnovers");
                    break;
            }
            break;
        case "Salesperson":
            $("#target_operation_parameter").empty();
            parameterTargetSalesperson();
            switch ($("#target_operation_parameter").val()) {
                case "AffectedArea":
                    selectTargetOperation("AffectedArea");
                    break;

            }
            break;
        case "Contacts":
            $("#target_operation_parameter").empty();
            parameterTargetContacts();
            switch ($("#target_operation_parameter").val()) {
                case "DecisionMaking":
                    selectTargetOperation("DecisionMaking");
                    break;
                case "Profession":
                    selectTargetOperation("Profession");
                    break;

            }
            break;

    }

})

if ($('#target_operation_parameter').val() == "postalCode") {
    inputTargetOperation();
}

$('#target_operation_parameter').on("change", function () {
    switch ($(this).val()) {
        case "postalCode":
            inputTargetOperation();
            break;
        case "NumberEmployees":
            selectTargetOperation("NumberEmployees");
            break;
        case "CompanyStatus":
            selectTargetOperation("CompanyStatus");
            break;
        case "Country":
            selectTargetOperation("Country");
            break;
        case "ActivityArea":
            selectTargetOperation("ActivityArea");
            break;
        case "Turnovers":
            selectTargetOperation("Turnovers");
            break;
        case "AffectedArea":
            selectTargetOperation("AffectedArea");
            break;
        case "DecisionMaking":
            selectTargetOperation("DecisionMaking");
            break;
        case "Profession":
            selectTargetOperation("Profession");
            break;
        case "CodeCompany":
            inputTargetOperation();
            break;
        case "CodeSalesperson":
            inputTargetOperation();
            break;
        case "NameCompany":
            inputTargetOperation();
            break;
        case "NameSalesperson":
            inputTargetOperation();
            break;
        case "Town":
            inputTargetOperation();
            break;
        case "RolesSalesperson":
            if ($("#target_operation_input").length > 0) {
                $("#target_operation_input").remove()
            }
            if ($("#target_operation_select").length == 0) {
                $("#div-target-value").append($("<select>", {
                    id: "target_operation_select",
                    class: "form-control col-lg-4",
                    name: "target_operation[select]"
                }))
            } else {
                $("#target_operation_select").empty();
            }
            $('#target_operation_select').append($('<option>', {
                value: "ROLE_DIRECTEUR",
                text: "Directeur"
            }));
            $('#target_operation_select').append($('<option>', {
                value: "ROLE_RESPONSABLE",
                text: "Responsable"
            }));
            $('#target_operation_select').append($('<option>', {
                value: "ROLE_COMMERCIAL",
                text: "Commercial"
            }));
            break;

    }

})




function parameterTargetCompany() {
    $('#target_operation_parameter').append($('<option>', {
        value: "postalCode",
        text: 'Code postal'
    }));
    $('#target_operation_parameter').append($('<option>', {
        value: "NumberEmployees",
        text: 'Effectifs'
    }));
    $('#target_operation_parameter').append($('<option>', {
        value: "CompanyStatus",
        text: 'Statut'
    }));
    $('#target_operation_parameter').append($('<option>', {
        value: "Country",
        text: 'Pays'
    }));
    $('#target_operation_parameter').append($('<option>', {
        value: "ActivityArea",
        text: 'Code NAF'
    }));
    $('#target_operation_parameter').append($('<option>', {
        value: "Turnovers",
        text: 'Chiffre d\'affaire'
    }));
    $('#target_operation_parameter').append($('<option>', {
        value: "CodeCompany",
        text: 'Code'
    }));
    $('#target_operation_parameter').append($('<option>', {
        value: "NameCompany",
        text: 'Nom'
    }));
    $('#target_operation_parameter').append($('<option>', {
        value: "Town",
        text: 'Ville'
    }));
}

function parameterTargetSalesperson() {
    $('#target_operation_parameter').append($('<option>', {
        value: "AffectedArea",
        text: 'Zone affectée'
    }));
    $('#target_operation_parameter').append($('<option>', {
        value: "CodeSalesperson",
        text: 'Code'
    }));
    $('#target_operation_parameter').append($('<option>', {
        value: "NameSalesperson",
        text: 'Nom'
    }));
    $('#target_operation_parameter').append($('<option>', {
        value: "RolesSalesperson",
        text: 'Profil'
    }));
}

function parameterTargetContacts() {
    $('#target_operation_parameter').append($('<option>', {
        value: "DecisionMaking",
        text: 'Pouvoir décisionnel'
    }));
    $('#target_operation_parameter').append($('<option>', {
        value: "Profession",
        text: 'Métier'
    }));
}



function inputTargetOperation() {
    if ($("#target_operation_select").length > 0) {
        $("#target_operation_select").remove()
    }
    if ($("#target_operation_input").length == 0) {
        $("#div-target-value").append($("<input>", {
            id: "target_operation_input",
            class: "form-control col-lg-4",
            name: "target_operation[input]",
            'data-toggle': "tooltip",
            'data-placement': "top",
            title: "Saisie obligatoire"
        }));
    } else {
        $("#target_operation_input").val("");
    }

}

function selectTargetOperation(entity) {
    if ($("#target_operation_input").length > 0) {
        $("#target_operation_input").remove()
    }


    if ($("#target_operation_select").length == 0) {
        $("#div-target-value").append($("<select>", {
            id: "target_operation_select",
            class: "form-control col-lg-4",
            name: "target_operation[select]"
        }))
    } else {
        $("#target_operation_select").empty();
    }

    //Récupération des valeurs a ajouter au select
    $.ajax({
        url: '/admin/operations/selectDynamique/' + entity,
        type: 'GET',
        success: function (result) {
            result.data.forEach(function (res) {
                if (entity == "Country") {
                    $('#target_operation_select').append($('<option>', {
                        value: res.code,
                        text: res.libelle
                    }));
                } else {
                    $('#target_operation_select').append($('<option>', {
                        value: res.id,
                        text: res.libelle
                    }));
                }

            })

        }
    });




}

$("#add-target").on("click", function () {
    if ($("#target_operation_input").length > 0) {
        if ($("#target_operation_input").val() == "") {
            $("#target_operation_input").focus();
            return;
        }
    }
    $.ajax({
        type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
        url: '/admin/operations/sauvegarde_target', // the url where we want to POST
        data: $("#form_target_operation").serialize(), // our data object
        dataType: 'json', // what type of data do we expect back from the server
        encode: true,
        success: function (result) {
            if ($("#target_operation_input").length > 0) {
                $("#target_operation_input").val("")
            }
            let div = '<div class="row div-target-operation">';
            div += '<div class="col-lg-3 white-back">';
            switch (result.target.entity) {
                case "Company":
                    div += "Entreprise";
                    break;
                case "Contacts":
                    div += "Contact";
                    break;
                case "Salesperson":
                    div += "Commercial";
                    break;
            }
            div += '</div>';
            div += '<p>Dont</p>';
            div += '<div class="col-lg-3 white-back">';
            switch (result.target.parameter) {
                case "NumberEmployees":
                    div += "Effectifs";
                    break;
                case "Country":
                    div += "Pays";
                    break;
                case "AffectedArea":
                    div += "Zone affectée";
                    break;
                case "ActivityArea":
                    div += "Code NAF";
                    break;
                case "CompanyStatus":
                    div += "Statut";
                    break;
                case "postalCode":
                    div += "Code postal";
                    break;
                case "Turnovers":
                    div += "Chiffre d'affaire";
                    break;
                case "Profession":
                    div += "Métier";
                    break;
                case "DecisionMaking":
                    div += "Pouvoir décisionnel";
                    break;
                case "CodeSalesperson":
                    div += "Code";
                    break;
                case "CodeCompany":
                    div += "Code";
                    break;
                case "NameSalesperson":
                    div += "Nom";
                    break;
                case "NameCompany":
                    div += "Nom";
                    break;
                case "Town":
                    div += "Ville";
                    break;
                case "RolesSalesperson":
                    div += "Profil";
                    break;
            }
            div += '</div>';
            div += '<p>=</p>';
            div += '<div class="col-lg-3 white-back" id="div-target-value">';
            if (result.target.type_value == 1) {
                div += result.target.value_entity;
            } else {
                div += result.target.value;
            }
            div += '</div>';
            div += '<button class="btn-delete-target"> <i class="fas fa-times"></i></button>';
            div += '<input hidden value="' + result.target.id + '"/>';
            $("#list_ciblages_valide").prepend(div);

            $(".div-target-selected-operation .red-font:eq(0)").text(result.contacts_cibles);
            $(".div-target-selected-operation .red-font:eq(1)").text(result.ciblages);

        }
    })
})

$("#list_ciblages_valide").on("click", 'button', function () {
    let div = $(this);

    $.ajax({
        type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
        url: '/admin/operations/delete_target/' + $(this).next().val(), // the url where we want to POST
        dataType: 'json', // what type of data do we expect back from the server
        encode: true,
        success: function (result) {
            if (result.retour == "1" || result.retour == "1") {

                div.parent().fadeOut({
                    duration: 750,
                    done: function () {
                        div.parent().remove();
                        $(".div-target-selected-operation .red-font:eq(0)").text(result.contacts_cibles);
                        $(".div-target-selected-operation .red-font:eq(1)").text(result.ciblages);
                    }
                });

            }

        }
    })
})



$("[id$='-checked']").on("click", function () {
    getCheckBoxId();
    var id = $(this).attr("id").split("-",2);
    var entity = id[1];
    console.log(entity);

    switch (entity) {
        case 'company':
          entité = "entreprises"
          break;
        case 'salesperson':
            entité = "commerciaux"
            break;
        case 'contacts':
            entité = "contacts"
            break;
        case 'responsable':
            entité = "responsable"
            entity = "company"
            break;
      }
    if(values.length > 0)
    {
        if ( confirm( "Êtes-vous sur de vouloir supprimer les " + entité + " selectionnés ?" ) ) {
            deleteEntitiesSelected(values, entity);
            $(':checkbox').prop('checked', false);
    
        } else {
            
        }
    }
    else{
        alert("Veuillez cocher des contacts afin de pouvoir les supprimer")
    }
    
})
// $("[#all-check']").on("click", function () {

//     getCheckBoxId();
//     var id = $(this).attr("id").split("-",2);
//     var entity = id[1];
//     console.log(entity);

//     switch (entity) {
//         case 'company':
//           entité = "entreprises"
//           break;
//         case 'salesperson':
//         entité = "commerciaux"
//         break;
//       }
//     if(values.length > 0)
//     {
//         if ( confirm( "Êtes-vous sur de vouloir supprimer les " + entité + " selectionnés ?" ) ) {
//             deleteEntitiesSelected(values, entity);
//             $(':checkbox').prop('checked', false);
    
//         } else {
            
//         }
//     }
//     else{
//         alert("Veuillez cocher des contacts afin de pouvoir les supprimer")
//     }
    
// })

function deleteEntitiesSelected(values, entity)
{
    var data = {
        eachId : values
    };


    var url = "/admin/" + entity + "/delete/many";
    $.ajax({
        url: url,
        type: 'DELETE',
        data: data,
        success: function(result) {
            if (result.result == 1) {
                result.ids.forEach(id => {
                    $("#check-" + id).parent().parent().parent().fadeOut(1500, function() {
                        $("#check-" + id).parent().parent().parent().remove();
                        document.location.reload();
                      });
                });
                
            }
            
        }
    });
    
}


$("#suppression-contacts").on("click", function (event) {
    event.preventDefault();
    $("#form_delete_contacts").submit();
})

function getCheckBoxId() {
    values= [];
    $("[id^='check']:checked").each(function () {
        var eachId = $(this).attr("id").split("check-")[1];
        values.push(eachId);
    });

}


$('#table-resultats-operation').DataTable({
    "dom": '<"top"f>rt<"bottom"lp><"clear">',
    "info": false,
    "language": {
        "paginate": {
            "next": ">",
            "previous": "<"
        },
        "lengthMenu": "_MENU_",
        "search": "",
    }
});

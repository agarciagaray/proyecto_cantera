$(document).ready(function () {
    initDataTableMaterialsOverviewSociety();
});

var dataTableMaterialsOverviewSociety = null;
function initDataTableMaterialsOverviewSociety() {
    dataTableMaterialsOverviewSociety = $("#table-materialsOverviewSociety").DataTable({
        language: {
            url:BASE_URL +  BASE_URL +"/js/plugins/datatables/es.json",
        },
        responsive: true,
        lengthChange: true,
        autoWidth: false,
        bDestroy: true,
        processing: true,
        bSort: true,
        scrollY: 450,
        order: [[0, "desc"]],
        // iDisplayLength: 8,
    });
}





function downloadRemissionPdf() {
    var configuracion_ventana =
        "menubar=yes,location=yes,resizable=yes,scrollbars=yes,status=yes";
    var route = "pdfReportRemissions?" + $(".idRemissionReport").serialize();

    window.open([route], ["ReportRemissions"], [configuracion_ventana]);

    return 0;
}

function downloadRemissionMaterialsPdf() {
    var configuracion_ventana =
        "menubar=yes,location=yes,resizable=yes,scrollbars=yes,status=yes";
    var route =
        "pdfReportMaterials?" + $(".remissionMaterialsReport").serialize();

    window.open([route], ["pdfReportMaterials"], [configuracion_ventana]);

    return 0;
}

function downloadRemissionMaterialsExcel() {
    var configuracion_ventana =
        "menubar=yes,location=yes,resizable=yes,scrollbars=yes,status=yes";
    var route =
        "reportMaterials?" + $(".form-remissionMaterialsReport").serialize();

    window.open([route], ["reportMaterials"], [configuracion_ventana]);

    return 0;
}

function exportExcelMaterialOverview(value){


    var configuracion_ventana =
        "menubar=yes,location=yes,resizable=yes,scrollbars=yes,status=yes";
                  //Este es la ruta                  Index
    var route = "reportMaterials?" + $(".form-materialOverview").serialize()+'&excel=true';
                    //Me direcciona al medoto del reporte
    window.open([route], ["reportMaterials"], [configuracion_ventana]);

    return 0;
 }



function downloadRemissionsExcel() {

    notCancelled = "";
    if( $('.notCancelled').prop('checked') ) {
        notCancelled = $("#notCancelled").val()
    }
    var query = {
        idClient : $('#idClient').val(),
        idConstruction :$("#idConstruction").val(),
        idSociety :$("#idSociety").val(),
        dateStart :$("#dateStart").val(),
        dateEnd :$("#dateEnd").val(),
        stateInvoice :$("#stateInvoice").val(),
        notCancelled:notCancelled,
        filter :false
    }

    swal({
        title: "¿Estás seguro?",
        text: "¡De exportar el excel con las caracteristicas dadas?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Descargar",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        if (result) {
            // var configuracion_ventana =
            //     "menubar=yes,location=yes,resizable=yes,scrollbars=yes,status=yes";
            // var route =
            //     "exportExcelRemissions?" + $(".idRemissionReport").serialize();
              var url = BASE_URL+'/exportExcelRemissions?' + $.param(query);
                window.location = url;
            // window.open([route], ["reportRemissions"], [configuracion_ventana]);
        }
    });

    return 0;
}

$(document).ready(function () {
    initReport();
    $("#table-materialsOverview").DataTable({
        language: {
            url:BASE_URL +  BASE_URL +"/js/plugins/datatables/es.json",
        },
        responsive: true,
        lengthChange: true,
        autoWidth: false,
        bDestroy: true,
        processing: true,
        bSort: false,
        scrollY: 450,


    });

    $("#table-commodiesProduction").DataTable({
        language: {
            url:BASE_URL +  BASE_URL +"/js/plugins/datatables/es.json",
        },
        responsive: true,
        lengthChange: true,
        autoWidth: false,
        bDestroy: true,
        processing: true,
        bSort: false,
        scrollY: 450,


    });

    // .buttons().container().appendTo('#table-report_wrapper .col-md-6:eq(0)');
});

var dataTableReport = null;
function initReport(){
    dataTableReport = $("#table-report").DataTable({
        language: {
            url:BASE_URL +  BASE_URL +"/js/plugins/datatables/es.json",
        },
        responsive: true,
        lengthChange: true,
        autoWidth: false,
        bDestroy: true,
        processing: true,
        bSort: false,
        scrollY: 450,
      //  iDisplayLength: 8,

    });

}

function detailRemission(idRemission, material = false) {
    openModal("Detalle remisión.");
    $.ajax({
        type: "get",
        url: " detailRemission/" + idRemission + "/" + material,
        success: (data) => {
            $("#adminModalBody").html("");
            $("#adminModalBody").html(data);
        },
        error: (data) => {
            alertDanger();
            if (typeof data.responseJSON.errors == "object") {
                onFail(data.responseJSON.errors);
            } else {
                onDangerUniqueMessage(data.responseJSON.message);
            }
        },
    });
    return 0;
}


function filterRemissionReport() {

    var notCancelled = "";
    if( $('.notCancelled').prop('checked') ) {
        notCancelled = $("#notCancelled").val()
    }


    var query = {
        idClient : $('#idClient').val(),
        idConstruction :$("#idConstruction").val(),
        idSociety :$("#idSociety").val(),
        dateStart :$("#dateStart").val(),
        dateEnd :$("#dateEnd").val(),
        stateInvoice :$("#stateInvoice").val(),
        notCancelled:notCancelled,
        filter :true
    }

    var url = BASE_URL+'/exportExcelRemissions?' + $.param(query);
    $.ajax({
        type: "get",
        url: url,
        success: (data) => {

            dataTableReport.destroy()
            $("#table-report-remission").html("");
            $("#table-report-remission").append(data);
            initReport()

            swal({
                title: "Éxito!",
                text: "Se ha filtrado con éxito",
                icon: "success",
            });
        },
        error: (error) => {
            alertDanger();
            if (typeof error.responseJSON.errors == "object") {
                onFail(error.responseJSON.errors);
            } else {
                onDangerUniqueMessage(error.responseJSON.message);
            }
        },
    });
    return 0;
}


//Reporte por Material
function exportExcelMaterialOverview(value){


    var configuracion_ventana =
        "menubar=yes,location=yes,resizable=yes,scrollbars=yes,status=yes";
    var route = "reportMaterialOverview?" + $(".form-materialOverview").serialize()+'&excel=true';

    window.open([route], ["reportMaterialOverview"], [configuracion_ventana]);

    return 0;
 }


/*

 function exportExcelMaterialOverview(value){
    var configuracion_ventana =
        "menubar=yes,location=yes,resizable=yes,scrollbars=yes,status=yes";
    var route =
        "reportMaterialOverview?" + $(".form-materialOverview").serialize()+'&excel=true';

    window.open([route], ["reportMaterialOverview"], [configuracion_ventana]);

    return 0;
 }

 */
 function exportExcelMaterialOverviewSociety(value){
    var configuracion_ventana =
        "menubar=yes,location=yes,resizable=yes,scrollbars=yes,status=yes";
    var route = "reportMaterialOverviewSociety?" + $(".form-materialOverviewSociety").serialize()+'&excel=true';

    window.open([route], ["reportMaterialOverviewSociety"], [configuracion_ventana]);

    return 0;
 }

 function exportExcelCommodiesProduction(value){


    // if($("#idCommodity").val().length == 0 || $('#dateStart').val().length == 0  || $('#dateEnd').val().length == 0 ){
    //     alertDanger('Para exportar se requiere selecciona una materia prima, una fecha inicial y final');
    //     return 0;
    // }

    var configuracion_ventana =
        "menubar=yes,location=yes,resizable=yes,scrollbars=yes,status=yes";
    var route = "reportCommodiesProduction?" + $(".form-commodiesProduction").serialize()+'&excel=true';

    window.open([route], ["reportCommodiesProduction"], [configuracion_ventana]);

    return 0;
 }

 
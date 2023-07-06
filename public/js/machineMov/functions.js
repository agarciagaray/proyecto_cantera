$(document).ready(function () {
    initDataTableMovMachine();
    $(".maquine-select2").select2();
});

var initDataTableMachine = null;
function initDataTableMovMachine() {
    initDataTableMachine = $("#table-machineMov").DataTable({
        language: {
            url: BASE_URL + BASE_URL + "/js/plugins/datatables/es.json",
        },
        fnRowCallback: function (
            nRow,
            aData,
            iDisplayIndex,
            iDisplayIndexFull
        ) {
            console.log("aData", aData);
            console.log("nRow", nRow);
            if (aData.mqmv_estado == "I") {
                $("td", nRow).css("color", "#e3342f");
            }
        },
        columnDefs: [
            {
                width: 30,
                targets: 0,
            },
            {
                width: 30,
                targets: 1,
            },
            {
                width: 30,
                targets: 2,
            },
            {
                width: 30,
                targets: 3,
            },
            {
                width: 30,
                targets: 4,
            },
            {
                width: 30,
                targets: 5,
            },
            {
                width: 30,
                targets: 6,
            },
            {
                width: 30,
                targets: 7,
            },
            {
                width: 30,
                targets: 8,
            },
            {
                width: 30,
                targets: 9,
            },
        ],

        initComplete: function (settings, json) {
            console.log("json", json);
            window.swal.close();
        },
        ajax: {
            url: BASE_URL + "/getApiMachineMov",
            error: function (jqXHR, ajaxOptions, thrownError) {
                console.log(
                    thrownError +
                        "\r\n" +
                        jqXHR.statusText +
                        "\r\n" +
                        jqXHR.responseText +
                        "\r\n" +
                        ajaxOptions.responseText
                );
            },
        },
        buttons: [],
        responsive: true,
        bFilter: false,
        bDestroy: true,
        processing: true,
        erverSide: true,
        scrollX: true,
        scrollY: 550,
        columns: [
            {
                data: "id",
            },
            {
                data: null,

                render: function (data, type, row) {
                    return row.machine.maqn_placa;
                },
            },
            {
                data: "mqmv_fecha",
            },
            {
                data: null,
                render: function (data, type, row) {
                    let inicio = "";
                    let final = "";
                    if (row.horometro_hinicio != null) {
                        inicio = row.horometro_hinicio;
                    }

                    if (row.horometro_hfinal != null) {
                        final = row.horometro_hfinal;
                    }

                    return inicio + "-" + final;
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    let inicio = "";
                    let final = "";
                    if (row.mqmv_hinicio  != null) {
                        inicio = row.mqmv_hinicio ;
                    }

                    if (row.mqmv_hfin != null) {
                        final = row.mqmv_hfin;
                    }

                    return inicio + "-" + final;


                },
            },
            {
                data: null,

                render: function (data, type, row) {
                    let result = "";
                    if(row.mqmv_hinicio && row.mqmv_hfin ){

                        var hrentrada = moment(row.mqmv_hinicio, 'hh:mm');
                        var hrsalida = moment(row.mqmv_hfin, 'hh:mm');
                        var duration = moment.duration(hrsalida.diff(hrentrada)).asHours();

                        result = duration;
                    }
                    else{

                        result =parseFloat(row.horometro_hfinal) - parseFloat(row.horometro_hinicio);
                    }
                    return  result;
                },
            },
            {
                data: "mqmv_vlrhora",
            },
            {
                data: "mqmv_obs",
            },
            {
                data: "id_conductor",
            },
            {
                data: null,
                render: function (data, type, row) {
                    let btnCheck = "";

                    btnCheck =
                        '<button class="btn btn-sm btn-info mr-1" onclick="createMachineMov(' +
                        row.id +
                        ',true)" type="button"><i class="fas fa-eye"></i></button>';

                    if (row.mqmv_estado == "A") {
                        btnCheck +=
                            '<button class="btn btn-sm btn-primary mr-1" onclick="createMachineMov(' +
                            row.id +
                            ',false)" type="button"><i class="fas fa-edit"></i></button><button class="btn btn-sm btn-danger" onclick="deleteMachineMov(' +
                            row.id +
                            ')" type="button"> <i class="fas fa-trash"></i> </button>';
                    }
                    return btnCheck;
                },
            },
        ],
        order: [[0, "desc"]],
    });
}

function sendMachineMov() {
    let id = document.getElementById("id").value;
    var data = $(".form-send-machine-mov").serialize();
    url = "saveMachineMov";

    $.ajax({
        type: "post",
        url: url,
        data: data,
        headers: {
            "X-CSRF-Token": $('meta[name="csrf-token"]').attr("content"),
        },
        success: (data) => {
            // Llega aca y la pego

            // $('.maquine-select2').select2();
            // $('.select2').select2('destroy');
            // $('.select3').select2('destroy');
            hideModal();
            // $("#tbody_machine_mov").html("");
            // $("#tbody_machine_mov").append(data);
            // $(".selection").remove();
            // $(".select3").empty();
            // $('.select3').select2();
            initDataTableMovMachine();
            alertSuccess();
            initSelect();
            //
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
function isCommaDecimalNumber(value) {
    return /^-?(?:\d+(?:,\d*)?)$/.test(value);
}

//Metodo de eliminar
function deleteMachineMov(id_machine_mov) {
    swal({
        title: "¿Estás seguro",
        text: "¡Se le cambiara el estado de movimiento de maquina!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Desea inactivarlo",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        console.log(result);
        if (result) {
            $.ajax({
                type: "get",
                url: "deleteMachineMov/" + id_machine_mov,
                success: (data) => {
                    // $("#tbody_machine_mov").html("");
                    // $("#tbody_machine_mov").append(data);
                    initDataTableMovMachine();
                    swal({
                        title: "¡Cambiado!",
                        text: "Se ha cambiado el estado con éxito",
                        icon: "success",
                    });
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
    });
}

// Esta es la conversion de la cantidad  #1 ---------------------------------------------------------------------------
function createMachineMov(id_maquine_mov = null, show = null) {
    if (id_maquine_mov == null && show == null) {
        openModal("Crear movimiento de maquina.");
    }
    if (show == true) {
        openModal("Ver movimiento de maquina.");
    }
    if (show == false) {
        openModal("Editar movimiento de maquina.");
    }
    url =
        id_maquine_mov == null
            ? "formMachineMov"
            : "formMachineMov/" + id_maquine_mov + "/" + show;

    $.ajax({
        type: "get",
        url: url,
        success: (data) => {
            $("#adminModalBody").html("");
            $("#adminModalBody").append(data);

            // $(".selection").remove();
            // initSelect();
            doubleValue("#horometro_hinicio_visual", "#horometro_hinicio");
            doubleValue("#horometro_hfinal_visual", "#horometro_hfinal");
            doubleValue("#mqmv_vlrhora_visual", "#mqmv_vlrhora");
            initSelectTwoModal();
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

// Esta es la conversion de los horometros para que pueda salir la cantidad en la vista Fray Luis Martinez 30/05/2023 --0-----------------------


function showHorometro() {
    if ($("#same-address").prop("checked")) {
        $(".horometro").css({ display: "block" });
        $(".mqmv_hour").css({ display: "none" });
    } else {
        $(".horometro").css({ display: "none" });
        $(".mqmv_hour").css({ display: "block" });
        $("#horometro_hfinal").val("");
        $("#horometro_hinicio").val("");
    }
}
function doubleValue(value, value2) {
    var number = $(value).val();
    $(value2).val(number);
    const coma = number.toString().indexOf(",") !== -1 ? true : false;
    const arrayNumero = coma
        ? number.toString().split(",")
        : number.toString().split("");
    let integerPart = coma ? arrayNumero[0].split("") : arrayNumero;
    let floatPart = coma ? arrayNumero[1] : null;
    let result;
    let subIndex = 1;

    for (let i = integerPart.length - 1; i >= 0; i--) {
        if (integerPart[i] !== "," && subIndex % 3 === 0 && i != 0) {
            integerPart.splice(i, 0, ",");
            subIndex++;
        } else {
            subIndex++;
        }
    }

    integerPart = integerPart.toString();
    integerPart = integerPart.replace(/,/gi, "");
    result = coma ? integerPart + "," + floatPart : integerPart;

    $(value).val(result);
    return result;
}

function doubleValuePrice(value, value2) {
    console.log("hola", value, value2);
    var number = $(value).val();
    $(value2).val(number);
    const coma = number.toString().indexOf(".") !== -1 ? true : false;
    const arrayNumero = coma
        ? number.toString().split(".")
        : number.toString().split("");
    let integerPart = coma ? arrayNumero[0].split("") : arrayNumero;
    let floatPart = coma ? arrayNumero[1] : null;
    let result;
    let subIndex = 1;

    for (let i = integerPart.length - 1; i >= 0; i--) {
        if (integerPart[i] !== "." && subIndex % 3 === 0 && i != 0) {
            integerPart.splice(i, 0, ".");
            subIndex++;
        } else {
            subIndex++;
        }
    }

    integerPart = integerPart.toString();
    integerPart = integerPart.replace(/,/gi, "");
    result = coma ? integerPart + "," + floatPart : integerPart;

    $(value).val(result);
    return result;
}

//Aqui termina la conversion de los horometros para que pueda salir la cantidad en la vista Fray Luis Martinez 30/05/2023 #2----------------------------

function exportExcelMovMaq() {
    // var data = $(".form-list-mov-machine").serialize();

    var idMachine = $("#idMachine").val();
    var id_conductor = $("#id_conductor").val();
    var dateStart = $("#dateStart").val();
    var dateEnd = $("#dateEnd").val();

    if (!idMachine && !id_conductor && !dateStart && !dateEnd) {
        swal({
            title: "Recuerda!",
            text: "Para realizar la exportación de los datos al excel es obligatorio, elegir una maquina fecha inicial y una final.",
            icon: "info",
        });

        return;
    }
    

    var query = {
        idMachine: idMachine,
        id_conductor: id_conductor,
        dateStart: dateStart,
        dateEnd: dateEnd,
    };

    //     if(query.idMachine =='' && query.dateStart =='' && query.dateEnd ==''){
    //         swal({
    //             title: "Aviso!",
    //             text: "Para realizar el proceso de descar",
    //             icon: "success",
    //         });
    //     }
    //     alert(query.idMachine );

    // return 0;
    var url = BASE_URL + "/reportMachineMov?" + $.param(query);

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
            window.location = url;
            // clearFilter() ;
        }
    });
}
function filterMovMaq() {
    var data = $(".form-list-mov-machine").serialize();
    $.ajax({
        type: "get",
        url: "filterMovMaq",
        data: data,
        success: (data) => {
            initDataTableMachine.destroy();
            $("#tbody_machine_mov").html("");
            $("#tbody_machine_mov").append(data);

            initDataTableMovMachine();
            swal({
                title: "Éxito!",
                text: "Se ha filtrado con éxito",
                icon: "success",
            });
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
// function clearFilter() {

//     if(window.location.href.indexOf("?") > -1) {
//         var newUrl = refineUrl();
//         $(location).attr("href", newUrl);

//     }else{

//         $(location).attr("href",window.location.href);
//     }

// }

// function refineUrl()
// {
//     //get full url
//     var url = window.location.href;
//     //get url after/
//     var value = url = url.slice( 0, url.indexOf('?') );
//     //get the part after before ?
//     value  = value.replace('@System.Web.Configuration.WebConfigurationManager.AppSettings["BaseURL"]','');
//     return value;
// 




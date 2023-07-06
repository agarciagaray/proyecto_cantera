$(document).ready(function () {

    initDataTableMaterialMov()
    // initSelectTwoModal();

    // $('#table-MaterialMov tbody').on('click',function () {
    //     table.ajax.reload();
    //      $('#table-MaterialMov').DataTable( {
    //         ajax: "api/listMovementMachine"
    //     } );
    // });
});
var dataTableMaterialMov = null;
function initDataTableMaterialMov(){
    dataTableMaterialMov = $("#table-MaterialMov")
        .DataTable({
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
}

function createMaterialMovement(idMaterialMovement = null, show = null) {
    if (show == true) {
        openModal("Ver material en movimiento.");
    }

    if (idMaterialMovement == null && show == null) {
        openModal("Crear un material en movimiento.");
    }

    if (show == false) {
        openModal("Editar un material en movimiento.");
    }
    url =
        idMaterialMovement == null
            ? "formMaterialMovement"
            : "formMaterialMovement/" + idMaterialMovement + "/" + show;
    $.ajax({
        type: "get",
        url: url,
        success: (data) => {
            $("#adminModalBody").html("");
            $("#adminModalBody").append(data);

            initSelectTwoModal();
            // $("#adminModalBody").modal("hide");
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




function operationMaterial() {
    $("#prod_volumen").val("");

    var numviajes = $("#prod_numviajes").val();
    var cubicaje = $("#prod_cubicaje").val();


    

                            if (numviajes == "" && cubicaje == "") {
                                numviajes = 0;
                                cubicaje = 0;
                            }

                            if (numviajes == "" && numviajes > 0) {
                                numviajes = 1;
                            }

                            if (cubicaje == "" && cubicaje > 0) {
                                cubicaje = 1;
                            }

                            if (numviajes < 0) {
                                numviajes = numviajes * -1;
                                $("#prod_numviajes").val(numviajes);
                            }
                            if (cubicaje < 0) {
                                cubicaje = cubicaje * -1;
                                $("#prod_cubicaje").val(cubicaje);
                            }

                            var total = numviajes * cubicaje;

                            $("#prod_volumen").val(total);
                        }
            
function saveProduction() {
    data = $("#form-material-movement").serialize();
    $.ajax({
        type: "post",
        url: "saveMaterialMovement",
        data: data,
        success: (data) => {
            hideModal();
            $("#tbody_production").html("");
            $("#tbody_production").append(data);

            alertSuccess();

            // $('#table-MaterialMov').destroy();
        },
        error: (error) => {
            console.log("dada", error);
            alertDanger(error.responseJSON.message ?? '');
            if (typeof error.responseJSON.errors == "object") {
                onFail(error.responseJSON.errors);
            } else {
                onDangerUniqueMessage(error.responseJSON.message);
            }
        },
    });

    return 0;
}
function deleteMaterialMovement(prod_id) {
    // text: "¡Al eliminar el movimiento de material su inventario de producto queda negativo!",
    $.ajax({
        type: "get",
        url: "deleteMaterialMovement/" + prod_id,
        success: (data) => {

            if (data.code === 201) {
                swal({
                    title: "¿Estás seguro",
                    text: data.message,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Deseo eliminarlo",
                    cancelButtonText: "Cancelar",
                }).then((result) => {
                    if (result) {
                        $.ajax({
                            type: "get",
                            url: "deleteMaterialMovement/" + prod_id,
                            success: (response) => {
                                console.log('1',response)
                                swal({
                                    title: "¡Cambiado!",
                                    text: "Se ha cambiado el estado con éxito",
                                    icon: "success",
                                });
                                setTimeout(() => {
                                    location.reload();
                                }, 3000);

                                // $("#tbody_production").html("");
                                // $("#tbody_production").html(response.data);
                            },
                            error: (err) => {
                                alertDanger();

                                if (
                                    typeof err.responseJSON.errors == "object"
                                ) {
                                    onFail(err.responseJSON.errors);
                                } else {
                                    // swal.close()

                                    onDangerUniqueMessage(
                                        err.responseJSON.message
                                    );
                                }
                            },
                        });
                    }
                    return 0;
                });
            } else {
                swal({
                    title: "¿Estás seguro",
                    text: "¡Se le cambiara el estado del movimiento de material!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Deseo eliminarlo",
                    cancelButtonText: "Cancelar",
                }).then((result) => {
                    if (result) {
                        $.ajax({
                            type: "get",
                            url: "deleteMaterialMovement/" + prod_id,
                            success: (data) => {
                                console.log('2',data)
                                swal({
                                    title: "¡Cambiado!",
                                    text: "Se ha cambiado el estado con éxito",
                                    icon: "success",
                                });
                                $("#tbody_production").html("");
                                $("#tbody_production").html(data);
                            },
                            error: (error) => {
                                alertDanger();

                                if (
                                    typeof error.responseJSON.errors == "object"
                                ) {
                                    onFail(error.responseJSON.errors);
                                } else {
                                    // swal.close()

                                    onDangerUniqueMessage(
                                        error.responseJSON.message
                                    );
                                }
                            },
                        });
                    }
                    return 0;
                });
            }
        },
        error: (data) => {
            alertDanger();

            if (typeof data.responseJSON.errors == "object") {
                onFail(data.responseJSON.errors);
            } else {
                // swal.close()

                onDangerUniqueMessage(data.responseJSON.message);
            }
        },
    });
}
function maquineDeposite() {
    var prod_idmaqdeposita = $("#prod_idmaqdeposita").val();

    $.ajax({
        type: "get",
        url: "getMachine",
        data: {
            prod_idmaqdeposita: prod_idmaqdeposita,
        },
        success: (data) => {
            console.log("getMachine", data);
            $("#prod_cubicaje").val(data);
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

//Este es para el show

function disableMaquineDepositeView() {
    var origen = $("#typeProduction").val();
    if (origen == "E") {
        $("#div_materialPrima").show();
        $("#div_option").show();
        $("#div_maquineDeposite").show();
        $("#prod_idmaqdeposita").show();
        $("#div_material").hide();
        $("#div_maquineDeposite").show();

        var md = document.getElementById("salida");
        md.innerHTML = "Disposito que recibe el material (*)";

        // var m = document.getElementById("material");
        // m.innerHTML = "Material depositado (*)";
    }

    if (origen == "S") {
        $("#div_maquineDeposite").hide();
        $("#div_material").show();
        $("#div_materialPrima").hide();
        $("#div_option").hide();
        $("#prod_cubicaje").hide();
        $("#prod_numviajes").hide();

        var om = document.getElementById("salida");
        om.innerHTML = "Origen del material (*)";
        // var m = document.getElementById("material");
        // m.innerHTML = "Materiales (*)";
    }
    if (origen == "I") {
        $("#div_maquineDeposite").hide();
        $("#prod_idmaqdeposita").hide();
        $("#div_material").show();
        // $("#div_material").hide();
        $("#div_materialPrima").hide();
        $("#div_prod_iddispositivo").hide();
        $("#div_option").hide();
        $("#prod_cubicaje").hide();
        $("#prod_numviajes").hide();
        
        
        var md = document.getElementById("salida");
        md.innerHTML = "Disposito que recibe el materiales (*)";

        // var m = document.getElementById("material");
        // m.innerHTML = "Material depositado (*)";
    }
}

function downloadProductionsExcel() {
    var configuracion_ventana =
        "menubar=yes,location=yes,resizable=yes,scrollbars=yes,status=yes";
    var route =
        "exportExcelProductions?" + $(".idProductionReport").serialize();

    window.open([route], ["reportMaterials"], [configuracion_ventana]);

    return 0;
}




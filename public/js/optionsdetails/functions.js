

function searchPorcentajeMateriales() {
    let idCliente = $(".obra_idcliente").val(); // Obtengo la id del cliente
    var option = "<option selected value=''>Seleccion una obra</option>";
    if (idCliente != 0) {
        $.ajax({
            url: "searchContructionClient/" + idCliente,
            type: "GET",
            // dataType: 'json',
            success: function (response) {
                if (response.length > 0) {
                    $(".idObra").removeAttr("disabled");
                    $.each(response, function (k, v) {
                        option +=
                            "<option value=" +
                            parseInt(v.id) +
                            ">" +
                            v.obra_nombre +
                            "</option>";
                    });

                    $(".idObra").html("");
                    $(".idObra").append(option);
                } else {
                    onDangerUniqueMessage(
                        "El cliente seleccionado no cuenta con obras"
                    );
                    $(".idObra").html("");
                    $(".idObra").attr("disabled", true);
                }
            },
            error: (error) => {
                console.log("error", error);
            },
        });
    }
}

    /* 
function filterPorcentajeAssigment() {

   // alert('Hola ya esta funcionando gracias a Dios')

                             
    var options_id= $("#options_id").val();
   // var dateStart = $("#dateStart").val();
   // var dateEnd = $("#dateEnd").val();
   //if (!idOption && !dateStart && !dateEnd)
    if (!options_id) {
        swal({
            title: "Recuerda!",
            text: "Para realizar el filtro es obligatorio, elegir una opcion.",
            icon: "info",
        });

        return;
    }

    var data = {
        options_id: options_id,
     //   dateStart: dateStart,
      //  dateEnd: dateEnd,


      // Este es para asignar el porcentaje Fray Luis 
        statusInvoice: $("#statusInvoice").val(),
       //Este es para asiganar o guardar la factura
    };
    $.ajax({
        type: "get",
        url: "cerrarporcentajes",
        data: data,
        success: (data) => {
            console.log("data", data);
            $("#tbody_porcentaje").html("");
            $("#tbody_porcentaje").append(data);
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

*/


function searchOptionsDetails() {
    let options_id = $(".Options_Details").val(); // Obtengo la id del cliente
    //var option = "<option selected value=''>Seleccion una opcion</option>";
    if (idCliente != 0) {
        $.ajax({
            url: "searchOptionsdetails/" + options_id,
            type: "GET",
            // dataType: 'json',

            /*
            success: function (response) {
                if (response.length > 0) {
                    $(".idObra").removeAttr("disabled");
                    $.each(response, function (k, v) {
                        option +=
                            "<option value=" +
                            parseInt(v.id) +
                            ">" +
                            v.obra_nombre +
                            "</option>";
                    });

                    $(".idObra").html("");
                    $(".idObra").append(option);
                } else {
                    onDangerUniqueMessage(
                        "El cliente seleccionado no cuenta con obras"
                    );
                    $(".idObra").html("");
                    $(".idObra").attr("disabled", true);
                }
            },*/
            error: (error) => {
                console.log("error", error);
            },
        });
    }
}

$("#cleanField").click(function () {
    url =
        BASE_URL +
        "/inventory?tanq_origen=&search=&searchOrigin=&tanq_unidad=&dateStart=&dateEnd=";
    var nuevaUrl = url.substring(0, url.indexOf("?"));

    $(location).attr("href", nuevaUrl);
});

function clearFilter() {
    if (window.location.href.indexOf("?") > -1) {
        var newUrl = refineUrl();
        $(location).attr("href", newUrl);

    } else {
        $(location).attr("href", window.location.href);
    }
    return 0;
}

function refineUrl() {
    //get full url
    var url = window.location.href;
    //get url after/
    var value = (url = url.slice(0, url.indexOf("?")));
    //get the part after before ?
    value = value.replace(
        '@System.Web.Configuration.WebConfigurationManager.AppSettings["BaseURL"]',
        ""
    );
    return value;
}

function closeModal() {

    $(".select2").remove();
    // $(".select2").select2("val", "");
    // $(".select3").remove();
    $("#adminModal").modal("hide");
    initSelect();
  };








  function createPorcentajessalidas(id_Porcentaje_ = null,show = null){

    if (id_Porcentaje_  == null && show == null) {

        openModal("Crear   opcion.")
    }
    if (show ==true) {

        openModal("Ver opcion.")
    }
    if (show ==false) {

        openModal("Edita opcion.")
    }
    url = id_Porcentaje_  == null ? 'formPorcentajesalida' : 'formPorcentajesalida/' + id_Porcentaje_  + '/' + show;

    $.ajax({
        type: 'get',
        url: url,
        success: (data) => {

            $('#adminModalBody').html('');
            $('#adminModalBody').html(data);

            initSelectTwoModal()

        },
        error: (data) => {
            alertDanger()
            if (typeof (data.responseJSON.errors) == 'object') {
                onFail(data.responseJSON.errors)
            } else {
                onDangerUniqueMessage(data.responseJSON.message)
            }
         }
    });
    return 0;
}
//------------------------------------------------------------------------------------------------------
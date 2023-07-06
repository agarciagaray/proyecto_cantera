$(document).ready(function () {
    initAsociateInvoiceRemission()
    initSettlement()
});

var dataAsociateInvoiceRemission= null;

function initAsociateInvoiceRemission(){
    dataAsociateInvoiceRemission = $("#table_asociate_invoice_remission")
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


var  dataSettlement = null;
function initSettlement(){
   dataSettlement = $("#table_settlement")
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

// Metodo para guardar remision y su detalle
function saveInvoiceAssignment(type) {
    let numFac = $("#numFact").val();

    if(numFac == ""){

        swal({
            title: "Recuerda!",
            text: "Para poder asignar factura, se debe ingresar un número de factura.",
            icon: "info",
        });

        return 0;
    }



    let statusInvoice = $("#statusInvoice").val();

    if (numFac == "" && statusInvoice == "L") {
        alertDanger("Recuerda ingresar el número de factura");
    }
    if (array.length > 0) {
        var message =
            statusInvoice != "L"
            
                ? "¡Las remisiones seleccionadas pasarán a preliquidadas?"
                : "¡Las preliquidaciones seleccionadas pasarán a facturadas?";
        swal({
            title: "¿Estás seguro?",
            text: message,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result) {
                $.ajax({
                    type: "post",
                        
                    url: "saveInvoiceAssignment",
                    data: {
                        remissionAssigns: array,
                        remi_numfactura: numFac,
                        type: type,
                        idConstruction: $("#idConstruction").val(),
                        dateStart: $("#dateStart").val(),
                        dateEnd: $("#dateEnd").val(),
                    },
                    headers: {
                        "X-CSRF-Token": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    success: (data) => {
                        hideModal();
                        // Llega aca y la pego
                        $("#numFact").val("");
                        if (type == "PL") {

                            dataAsociateInvoiceRemission.destroy()
                            $("#tbody_remissionInvoice").html("");
                            $("#tbody_remissionInvoice").append(data);
                            initAsociateInvoiceRemission()
                        } else {
                            dataSettlement.destroy(9)
                            $("#tbody_remissionLiquidation").html("");
                            $("#tbody_remissionLiquidation").append(data);
                            initSettlement();
                        }

                        array = [];
                        alertSuccess();
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
            }
        });
    } else {
        alertDanger(
            "Para poder guardar se debe seleccionar las remisiones, en la columna asignar de la tabla de remisiones"
        );
    }

    return 0;
}

array = [];





//----------------------------------------------------------SECCION DE APROBACION DE LOS PORCENTAJES--------------------------------

         

function savePorcentajeAssignment(type){





        let optionAssgins = $("#optionAssgins").val();
    
        if (array.length > 0) {
            var message =
            //(L) Me va hacer referencia  a los porcentajes ya cerrad@s
            optionAssgins != "C"
                    ? "¡Las opciones seleccionadas pasarán a cerradas #1?"
                    : "¡Las opciones seleccionadas pasarán a cerradas #2?";
            swal({
                title: "¿Estás seguro?",
                text: message,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Aceptar",
                cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result) {
                    $.ajax({
                        type: "post",
                            
                        url: "savePorcentajeAssignment",
                        data: {
                          
                            optionAssigns: array,
                        
                            type: type,
                            options_id: $("#options_id").val()
                   
                        },
                        headers: {
                            "X-CSRF-Token": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
    
                /* NOTA AQUI QUEDE ES PEDAZO DE CODIGO HACE REFENCIA  PARA ASIGNAR # FACTURAS 
                PERO COMO NO ESTAMOS TRABAJANDO EN ESTA SECCION CON FACTURAS SINO CON OPCIONES 31/05/2023
              */
                
                success: (data) => {
                                                        hideModal();
                                                        // Llega aca y la pego
                                                        $("#optionAssigns").val("");
    
                                                        // Estas son las iniciales de para cerraR el porcentajes.
                                                        if (type == "C") {
    
                                                            dataAsociateInvoiceRemission.destroy()
                                                            $("#tbody_porcentaje").html("");
                                                            $("#tbody_porcentaje").append(data);
                                                            initAsociateInvoiceRemission()
                                                        } else {
                                                            dataSettlement.destroy(9)
                                                            $("#tbody_porcentaje").html("");
                                                            $("#tbody_porcentaje").append(data);
                                                            initSettlement();
                                                        }
    
                                                        array = [];
                                                        alertSuccess();
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
                }
            });
        } else {
            alertDanger(
                "Para poder guardar se debe seleccionar las opciones, en la columna aprobar de la tabla de opciones"
            );
        }
    
        return 0;
    }
    
    array = [];
    



    
    //console.log("Welcome to Programiz!");
/*
var porcentaje_1 = 70;
var porcentaje_2 = 15; 
var porcentaje_3 = 15;


var convertir = 100;

volumen= 180;
totalizar = porcentaje_2 *  volumen / 100
return  console.log(totalizar);

 */    
  


  //  console.log('Esta es una prueba el boton esta funcinando');

//}
//----------------------------------------------------------




function assignUnassign(div, id_remission) {
    // array.push(id);

    if ($("#" + div).is(":checked")) {
        array.push({ id: id_remission });
    } else {
        var newArray = array.filter((item) => item.id !== id_remission);
        array = [];
        array = newArray;
    }
}






//Nota: Funcion para la seccion  de Aprobacion de porcentajes  Este es el paso para aprobar el porcentaje que tomamos en el check Fray Luis Martinez 31/05/2023
function OptionUnassign(div,option_id) {
    // array.push(id);
    if ($("#" + div).is(":checked")) {
        array.push({ id: option_id});
    } else {
        var newArray = array.filter((item) => item.id !== option_id);
        array = [];
        array = newArray;
    }
}
// --------------------------------------------------------------------------------------------------
function createRemissionAssign(id_remission, show) {
    openModal("Ver remisión.");

    url =
        id_remission == null
            ? "formRemission"
            : "formRemission/" + id_remission + "/" + show;

    $.ajax({
        type: "get",
        url: url,
        success: (data) => {
            $("#adminModalBody").html("");
            $("#adminModalBody").append(data);

            initSelectTwoModal();
            $(".selection").remove();
            initSelect();
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
function reportRemissionAssignment() {
    var dateStart = $("#dateStart").val();
    var dateEnd = $("#dateEnd").val();
    var idConstruction = $("#idConstruction").val();
    var configuracion_ventana =
        "menubar=yes,location=yes,resizable=yes,scrollbars=yes,status=yes";
    var route =
        "pdfReportRemissionAssignments?" +
        "dateStart=" +
        dateStart +
        "&dateEnd=" +
        dateEnd +
        "&idConstruction=" +
        idConstruction;

    window.open([route], ["ReportRemissions"], [configuracion_ventana]);

    return 0;
}

// function cleanFilter() {
//     $("#dateStart").val("");
//     $("#dateEnd").val("");
//     $("#idConstruction").val("");
//     $("#numFact").val("");
// }

        //Exportacion del excel FRAY LUIS

function preSettlementRemissionAssigment() {
    var idConstruction = $("#idConstruction").val();
    var dateStart = $("#dateStart").val();
    var dateEnd = $("#dateEnd").val();


    if (!idConstruction || !dateStart && !dateEnd) {
        swal({
            title: "Recuerda!",
            text: "Para realizar la exportación de los datos al excel es obligatorio, elegir una obra, fecha inicial y una final.",
            icon: "info",
        });

        return;
    }

    var query = {
        idConstruction: idConstruction,
        dateStart: dateStart,
        dateEnd: dateEnd,
        statusInvoice: $("#statusInvoice").val(),
        preSettlement: true,
        pre_settlement_management:$("#pre_settlement_management").val() ?? false
    };

    // return 0;
    var url = BASE_URL + "/exportlistInvoiceAssignment?" + $.param(query);

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

         //#1


       //Filtrar las remisiones FRAY LUIS
         
function filterRemissionAssigment() {
   // alert('HOla');

    var idConstruction = $("#idConstruction").val();
    var dateStart = $("#dateStart").val();
    var dateEnd = $("#dateEnd").val();

    if (!idConstruction && !dateStart && !dateEnd) {
        swal({
            title: "Recuerda!",
            text: "Para realizar el filtro es obligatorio, elegir una obra, fecha inicial y una final.",
            icon: "info",
        });

        return;
    }

    var data = {
                        idConstruction: idConstruction,
                        dateStart: dateStart,
                        dateEnd: dateEnd,
                        statusInvoice: $("#statusInvoice").val(),
                };
    $.ajax({
        type: "get",
            //listInvoiceAssignment
        url: "listInvoiceAssignment",
        data: data,
        success: (data) => {
            console.log("data", data);
            $("#tbody_remissionInvoice").html("");
            $("#tbody_remissionInvoice").append(data);
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

//   --------------------------------(SECCION PRODUCCION-ASIGNACION DE PORCENTAJES)---------------------------------



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



   // Este es el filtrado de Asiganacion de porcentaje Fray Luis Martinez 30/05/2023    
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
               
          url: "Filtraropciones",
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
  


//  Esta es la parte del filtro por nombre de la opcion en la vista  % De los materiales en funcion de salida Fray Luis Martinez 13/06/2023

  function filterSalidaPorcentajeAssigment() {

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
               
          url: "Filtraropciones",
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
  
  
  /*
  
  function searchOptionsDetails() {
      let _idOption = $(".Options_Details").val(); // Obtengo la id del cliente
      //var option = "<option selected value=''>Seleccion una opcion</option>";
      if (_idOption != 0) {
          $.ajax({
              url: "searchOptionsdetails/" + _idOption,
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
  
  $("#cleanField").click(function () {
      url =
          BASE_URL +
          "/inventory?tanq_origen=&search=&searchOrigin=&tanq_unidad=&dateStart=&dateEnd=";
      var nuevaUrl = url.substring(0, url.indexOf("?"));
  
      $(location).attr("href", nuevaUrl);
  });

  */
  
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
      //get full urls
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
  

  
  //Fin Asiganacion de porcentaje Fray Luis Martinez 30/05/2023    ------------------------------------------------------------------------------
  
  //Ver opciones antes de asignar (Fray Luis Martinez 31/05/2023)    ------------------------------------------------------------------------------

  function createOptionAssign(id_remission, show) {
    openModal("Ver option.");

    url =
        id_remission == null
            ? "formOptions"
            : "formOptions/" + id_remission + "/" + show;

    $.ajax({
        type: "get",
        url: url,
        success: (data) => {
            $("#adminModalBody").html("");
            $("#adminModalBody").append(data);

            initSelectTwoModal();
            $(".selection").remove();
            initSelect();
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
//----------------------------------------------------------------------------------------------------------------






function settlementRemissionAssigmentExcel() {
    var idConstruction = $("#idConstruction").val();
    var dateStart = $("#dateStart").val();
    var dateEnd = $("#dateEnd").val();

    if (!idConstruction && !dateStart && !dateEnd) {
        swal({
            title: "Recuerda!",
            text: "Para realizar la exportación de los datos al excel es obligatorio, elegir una obra, fecha inicial y una final.",
            icon: "info",
        });

        return;
    }

    var query = {
        idConstruction: idConstruction,
        dateStart: dateStart,
        dateEnd: dateEnd,
        statusInvoice: $("#statusInvoice").val(),
        preSettlement: true,
        // preSettlement:false,
    };

    // return 0;listInvoiceAssignment
    var url = BASE_URL + "/exportlistInvoiceAssignment?" + $.param(query);

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
            swal({
                title: "Éxito!",
                text: "Se exportado con éxito",
                icon: "success",
            });
            window.location = url;
            // clearFilter() ;
        }
    });
}

function filterLiquidationRemission() {
    var data = {
        idConstruction: $("#idConstruction").val(),
        dateStart: $("#dateStart").val(),
        dateEnd: $("#dateEnd").val(),
        statusInvoice: $("#statusInvoice").val(),
        filter: true,
    };
    $.ajax({
        type: "get",
        url: "listLiquidationRemission",
        data: data,
        success: (data) => {
            console.log("data", data);
            $("#tbody_remissionLiquidation").html("");
            $("#tbody_remissionLiquidation").append(data);
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

function editSettlement(id) {
    swal({
        title: "¿Estás seguro?",
        text: "¡La preliquidación se eliminará del sistema y la remisión estará disponible para una nueva liquidación?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Anular",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        if (result) {
            $.ajax({
                type: "get",
                url: "preSettlementCanceled",
                data: {
                    id: id,
                },
                success: (data) => {
                    $("#tbody_settlement").html("");
                    $("#tbody_settlement").append(data);

                    swal({
                        title: "Éxito!",
                        text: "Se ha eliminado con exito",
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
        }
    });
}
function filterSettlement() {
    var data = {
        idConstruction: $("#idConstruction").val(),
        dateStart: $("#dateStart").val(),
        dateEnd: $("#dateEnd").val(),
        statusInvoice: $("#statusInvoice").val(),
        filter: true,
    };
    $.ajax({
        type: "get",
        url: "listPreSettlement",
        data: data,
        success: (data) => {
            $("#tbody_settlement").html("");
            $("#tbody_settlement").append(data);
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
}

function remittanceToLiquidateExcel() {
    var idConstruction = $("#idConstruction").val();
    var dateStart = $("#dateStart").val();
    var dateEnd = $("#dateEnd").val();

    if (!idConstruction && !dateStart && !dateEnd) {
        swal({
            title: "Recuerda!",
            text: "Para realizar la exportación de los datos al excel es obligatorio, elegir una obra, fecha inicial y una final.",
            icon: "info",
        });

        return;
    }

    var query = {
        idConstruction: idConstruction,
        dateStart: dateStart,
        dateEnd: dateEnd,
    };

    var url = BASE_URL + "/exportExcelRemittanceToLiquidate?" + $.param(query);

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
        }
    });
}

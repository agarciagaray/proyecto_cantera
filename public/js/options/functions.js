

$(document).ready(function () {


    $("#table-options").DataTable({
        language: {
            "url":BASE_URL +  BASE_URL +"/js/plugins/datatables/es.json"
        },
        responsive: true,
        lengthChange: true,
        autoWidth: true,
        scrollY: 580,
        bSort : false
    });


});
         
function saveOption(){
    let id = document.getElementById('id').value;
    var data = $('.form-send-options').serialize();
    url =id !== '' ? 'updateOptions':'saveOptions';

    $.ajax({
        type: 'post',
        url: url,
        data:data,
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        success: (data) => {
            hideModal();
            // Llega aca y la pego
            $('#tbody_options').html('');
            $('#tbody_options').html(data);

            alertSuccess()
        },

        
        error: (data) => {
            alertDanger()
            if (typeof (data.responseJSON.errors) == 'object') {
                onFail(data.responseJSON.errors)
            } else {
                onDangerUniqueMessage(data.responseJSON.message)
            }
            //alert('No has llenados los campos');
           /* if (idMat==false && nom_option==1 ){
                alertDanger("Recuerda diligenciar los campos de nombre  y  mateiales ")
                ;
            }
               */
            
        }
    });

    return 0;
}


//Metodo de eliminar
function deleteOptions(id_options){
    swal({
        title: '¿Estás seguro',
        text: "¡Se le cambiara el estado de la opcion de %!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Desea inactivarlo',
        cancelButtonText: "Cancelar",
      }).then((result) => {
          console.log(result);
        if (result) {

            $.ajax({
                type: 'get',
                url: 'deleteOptions/'+id_options,
                success: (data) => {

                    $('#tbody_options').html('');
                    $('#tbody_options').html(data);
                    swal({

                        title: '¡Cambiado!',
                        text: 'Se ha cambiado el estado con éxito',
                        icon: "success",
                      })

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
      })
}

function ConversionSalida( show = true)
{

    // alert('Hola Todo bien');
        if (show ==true) {
    
            openModal("Ver Las conversiones de las salidas.")
        }
      
        url = show == null ? '' : 'Salidaporcentajes/' + show + 'Salidaporcentajes/' + show;
    
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
    




function createOptions(id_options_ = null,show = null){

    if (id_options_ == null && show == null) {

        openModal("Crear   opcion.")
    }
    if (show ==true) {

        openModal("Ver opcion.")
    }
    if (show ==false) {

        openModal("Edita opcion.")
    }
    url = id_options_ == null ? 'formOptions' : 'formOptions/' + id_options_ + '/' + show;

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


function addDetail() {
    
    var idMat = $("#idMat").val();

    var lengthTr =$("#tbody_options tbody tr").length

    if (count == 1 && lengthTr ==1) {
        alertDanger("Solo se puede agregar un material");
        return 0;
    }
    var data = {
        
        id_material: idMat,
        count: count++,
    };

    $.ajax({
        type: "get",
        url: "trOptions",
        data: data,
        success: (data) => {
            $("#tbody_options").append(data);
        },
        error: (data) => {
            if (typeof data.responseJSON.errors == "object") {
                onFail(data.responseJSON.errors);
            } else {
                onDangerUniqueMessage(data.responseJSON.message);
            }
        },
    }).done(function (data) {
        // var cont_fila = ($('#tbody_remissiondet').find('tr').length);
        // var total_general = 0;
        // for (var i = 0; i < cont_fila + 1; i++) {
        //     var subtotal = $('#subt_' + i).val();
        //     if (subtotal != undefined) {
        //         total_general = parseFloat(total_general) + parseFloat(subtotal);
        //     }
        // }
        // $('#totalRemission').val((total_general * 1).toFixed(2));
        // $("#summary").text((total_general * 1).toFixed(2));
    });

    // count ++;
    return 0;
    // }
}
function removeOptionItem(trOption_) {
    count = 0;
    $("#option" + trOption_).remove();
    
    var cont_fila = $("#tbody_options").find("tr").length;
    var total_general = 0;
    for (var i = 0; i < cont_fila + 1; i++) {
        var subtotal = $("#subt_" + i).val();

        if (subtotal != undefined) {
            total_general = parseFloat(total_general) + parseFloat(subtotal);
        }
    }

    $("#summary").text((total_general * 1).toFixed(2));
}

function Prueba()
{alert ('Hola');}

//exportacion al excel  salidas conversiones 




function filterSalidaPorcentajeAssigmen() {
    // alert('HOla');
 
     var  prod_fecha_1= $("#prod_fecha_1").val();
     var  prod_fecha_2 = $("#prod_fecha_2").val();
   //  var dateEnd = $("#dateEnd").val();
 
     if (!prod_fecha_1 && !prod_fecha_1) {
         swal({
             title: "Recuerda!",
             text: "Para realizar el filtro es obligatorio, elegir una fecha inicial y una final.",
             icon: "info",
            });
 
         return;
     }
 
     var data = {
        prod_fecha_1: prod_fecha_1,
        prod_fecha_2: prod_fecha_2,
                      //   dateEnd: dateEnd,
    //  statusInvoice: $("#statusInvoice").val(),
                 };
     $.ajax({
         type: "get",
             //listInvoiceAssignment
         url: "Filtrarsalida",
         data: data,
         success: (data) => {
             console.log("data", data);
             $("#tbody_optionsdetails").html("");
             $("#tbody_optionsdetails").append(data);
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
 

 function filterSalidaPorcentajeAssigmen_() {
    var data = $(".formOpcionAssignment").serialize();
    $.ajax({
        type: "get",
        url: "Filtrarsalida",
        data: data,
        success: (data) => {
            dataTableRemission.destroy();
            $("#tbody_optionsdetails").html("");
            $("#tbody_optionsdetails").html(data);
            initDataTableRemission();
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





//------------------------------------------

function remittancePorcentajeAsignadoExcel()
 {    //exportacion al excel
        var prod_fecha_1 = $("#prod_fecha_1").val();
        var prod_fecha_2 = $("#prod_fecha_2").val();
       // var dateEnd = $("#dateEnd").val();
    
    
        if (!prod_fecha_1 && !prod_fecha_2) {
            swal({
                title: "Recuerda!",
                text: "Para realizar la exportación de los datos al excel es obligatorio, elegir una fecha inicial y una final.",
                icon: "info",
            });
    
            return;
        }
    
        var query = {
            prod_fecha_1: prod_fecha_1,
            prod_fecha_2: prod_fecha_2,
          //  dateEnd: dateEnd,
         
        };
    
        // return 0;
        var url = BASE_URL + "/exportlistSalidasPorcentajes?" + $.param(query);
    
        swal({
            title: "¿Estás seguro?",
            text: "¡Desea exportar el excel con las caracteristicas dadas?",
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
    


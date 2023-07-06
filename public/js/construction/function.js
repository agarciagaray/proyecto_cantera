$(document).ready(function () {
    initDatatableContruction()
});

var dataTabletContruction = null;
function initDatatableContruction(){

    dataTabletContruction =   $("#constructionTable").DataTable({
        language: {
            url:BASE_URL +  BASE_URL +"/js/plugins/datatables/es.json",
        },
        responsive: true,
        lengthChange: true,
        autoWidth: false,
        bDestroy: true,
        processing: true,
        bSort: false,
        scrollY: 550,
       // iDisplayLength: 8,
    });

}

//Crear, editar , ver Obras
function createContruction(id_construction = null, show = null) {

    if (id_construction == null && show == null) {
        openModal("Crear de obra.")
    }
    if (show == true) {

        openModal("Ver de obra.")
    }
    if (show == false) {

        openModal("Editar de obra.")
    }
    url = id_construction == null ? 'formContruction' : 'formContruction/' + id_construction + '/' + show;

    $.ajax({
        type: 'get',
        url: url,
        success: (data) => {

            $('#adminModalBody').html('');
            $('#adminModalBody').html(data);
            if (show) {

                $("#sendRolePermissionButton").remove();
            } else {
                initSelectTwoModal()
            }
            $("#rSocial").val("")
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



// Metodo para guardar obra
function saveConstruction() {
    let id = document.getElementById('id').value;
    var porcSuministro = $('#porcSuministro').val();
    var porcTransporte = $('#porcTransporte').val();
    var total = parseInt(porcTransporte) + parseInt(porcSuministro);

    if(total != null){
        if(total<100){
            swal({

                title: '¡Aviso!',
                text: 'La sumatoria de los procentajes de suministro y transporte debe ser 100, no menor 100',
                icon: "info",
              });
              return 0;
        }
        if(total>100){
            swal({

                title: '¡Aviso!',
                text: 'La sumatoria de los procentajes de suministro y transporte debe ser 100, no mayor 100',
                icon: "info",
              });
              return 0;
        }
    }else{

        swal({

            title: '¡Aviso!',
            text: 'Los procentajes de suministro y transporte son requeridos',
            icon: "info",
          });
          return 0;
    }



    var data = $('.form-send-constr').serialize();

    url = id == 0 ? 'saveConstruction' : 'updateConstruction/' + id;

    $.ajax({
        type: 'post',
        url: url,
        data: data,
        headers: { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
        success: (data) => {
            hideModal();
            // Lllega aca y la pego
            $('#tbody_construction').html('');
            $('#tbody_construction').html(data);

            alertSuccess()
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


//Metodo de eliminar
function deleteConstruction(id,tr) {
    swal({
        title: '¿Estás seguro',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Desea eliminarlo',
        cancelButtonText: "Cancelar",
    }).then((result) => {
        console.log(result);
        if (result) {

            $.ajax({
                type: 'get',
                url: 'deleteContructor/' + id,
                success: (data) => {

                    $('#tbody_construction').html('');
                    $('#tbody_construction').html(data);
                    swal({

                        title: '¡Cambiado!',
                        text: 'Se ha cambiado el estado con éxito',
                        icon: "success",
                    })

                },
                error: (data) => {

                    alertDanger(data.responseJSON.message ?? '')

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

function totalPercentage() {
    var porcSuministro = $('#porcSuministro').val();
    var porcTransporte = $('#porcTransporte').val();
    var total = 0;
    if (porcSuministro > 100) {
        $('#porcSuministro').val(100);

    }
    if (porcSuministro < 0) {
        $('#porcSuministro').val(0);

    }

    if (porcTransporte > 100) {
        $('#porcTransporte').val(100);

    }
    if (porcTransporte < 0) {
        $('#porcTransporte').val(0);

    }
    if (porcSuministro != null) {
        if (porcSuministro > 100) {
            porcSuministro = 100;

        }
        total = 100 - porcSuministro;
        $('#porcTransporte').val(total);
    }
}

function filterContructionExcel(filter){

    var query = {
        idClient : $('#idClient').val(),
        filter :filter,
        status:$('#status').val()
    }
    var url = BASE_URL+'/filterContructionExcel?' + $.param(query);

    if(filter){

        $.ajax({
            type: "get",
            url: url,
            success: (data) => {

                dataTabletContruction.destroy()
                $("#tbody_construction").html("");
                $("#tbody_construction").append(data);
                initDatatableContruction()
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

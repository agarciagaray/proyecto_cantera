
$(document).ready(function () {

    initDataTablePriceList()
    // $("#priceListTable").DataTable({
    //     "language": {
    //         "url": BASE_URL +"/js/plugins/datatables/es.json"
    //     },
    //     "dom": 'Bfrtip',
    //     "responsive": true,
    //     "lengthChange": true,
    //     "autoWidth": true,
    //     //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
    //    //  "iDisplayLength": 7,
    //    "scrollY": 450,
    //     "bSort" : false
    // }).buttons().container().appendTo('#priceListTable_wrapper .col-md-6:eq(0)');
});

var dataTablePriceList = null;

function initDataTablePriceList(){

    dataTablePriceList  =  $("#priceListTable").DataTable({
        language: {
            url: BASE_URL +"/js/plugins/datatables/es.json",
        },
        responsive: true,
        lengthChange: true,
        autoWidth: false,
        bDestroy: true,
        processing: true,
        bSort: false,
        scrollY: 450,
       // iDisplayLength: 8,
    });
}

//Crear, editar , ver lista de precioss
function createPriceList(id_priceList = null, show = null) {

    if (id_priceList == null && show == null) {
        openModal("Crear de lista de precios.")
    }
    if (show == true) {

        openModal("Ver de lista de precios.")
    }
    if (show == false) {

        openModal("Editar de lista de precios.")
    }
    url = id_priceList == null ? 'formPriceList' : 'formPriceList/' + id_priceList + '/' + show;

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


// Metodo para guardar lista de precios
function savePriceList() {

    var data = $('.form-send-price-lists').serialize();

    url =  'savePriceList';

    $.ajax({
        type: 'post',
        url: url,
        data: data,
        headers: { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
        success: (data) => {
            hideModal();
            // Lllega aca y la pego
            $('#tbody_priceList').html('');
            $('#tbody_priceList').html(data);

            alertSuccess()
        },
        error: (error) => {

            console.log('data',error.responseJSON);
            alertDanger()
            if (typeof (error.responseJSON.errors) == 'object') {

                onFail(error.responseJSON)
            } else {
                onDangerUniqueMessage(error.responseJSON.message)
            }
        }
    });

    return 0;
}


//Metodo de eliminar
function deletePriceList(id_priceList) {
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
                url: 'deletePriceList/' + id_priceList,
                success: (data) => {

                    $('#tbody_priceList').html('');
                    $('#tbody_priceList').html(data);

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


var countMaterial = 0;
function materialPriceList() {

    var id_material =$('#id_material').val();

    $.ajax({
        type: 'get',
        data:{
            count: countMaterial++,
        },
        url: 'searchMaterial/' + id_material,
        success: (data) => {

            // $('#tbody_material_listPrice').html('');
            $('#tbody_material_listPrice').append(data);
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
    $countMaterial = countMaterial + 1;
    return 0;
}
function deletePriceListTable(_div){
    $('#'+_div).remove();
}

function filterListPrice(){
    var data = {
        id_customer : $('#id_customer').val(),
        id_obra : $('#id_obra_list_price').val(),
        excel :false,
        dateStart :$("#dateStart").val(),
        dateEnd :$("#dateEnd").val(),
    }
    $.ajax({
        type: "get",
        url: "exportListPrice",
        data: data,
        success: (data) => {
            console.log("data", data);


            dataTablePriceList.destroy()
            $("#tbody_priceList").html("");
            $("#tbody_priceList").append(data);
            initDataTablePriceList()

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
function exportListPrice(){
    var data = $(".form-list-price-list").serialize();


    var query = {
        id_obra : $('#id_obra_list_price').val(),
        dateStart :$("#dateStart").val(),
        dateEnd :$("#dateEnd").val(),
        excel :true
    }

// return 0;
    var url = BASE_URL+'/exportListPrice?' + $.param(query);

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

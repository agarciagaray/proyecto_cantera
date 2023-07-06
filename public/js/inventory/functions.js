function downloadPdf() {
    var configuracion_ventana = "menubar=yes,location=yes,resizable=yes,scrollbars=yes,status=yes";
    var route = 'reportDocument?'+$('.form-report').serialize();

     window.open([route],['Reportes'],[configuracion_ventana]);

    return 0;
}

function reportExcelInventory(){

    var configuracion_ventana = "menubar=yes,location=yes,resizable=yes,scrollbars=yes,status=yes";
    var route = 'inventory?'+$('.form-inventory').serialize()+'&excel=true';

     window.open([route],['inventory'],[configuracion_ventana]);

    return 0;

}


function reportExcelInventoryMaterial(){
    var configuracion_ventana = "menubar=yes,location=yes,resizable=yes,scrollbars=yes,status=yes";
    var route = 'inventoryControl?'+$('.form-inventoryControl').serialize()+'&excel=true';

     window.open([route],['inventoryControl'],[configuracion_ventana]);

    return 0;

}

$(document).ready(function () {


    $("#table-inventory").DataTable({
        "language": {
            "url":BASE_URL +  BASE_URL +"/js/plugins/datatables/es.json"
        },
        // "dom": 'Bfrtip',
        "responsive": true,
        "lengthChange": true,
        "autoWidth": true,
        "bSort" : false,
        "scrollY": 450,
        // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    });
// }.buttons().container().appendTo('#table-inventory_wrapper .col-md-6:eq(0)');

    $("#table-report-tanking").DataTable({
        "language": {
            "url":BASE_URL +  BASE_URL +"/js/plugins/datatables/es.json"
        },
        // "dom": 'Bfrtip',
        "responsive": true,
        "lengthChange": true,
        "autoWidth": true,
        // //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        // "iDisplayLength": 9,
        "bSort" : false
    });

    $("#table-inventory-control").DataTable({
        "language": {
            "url":BASE_URL +  BASE_URL +"/js/plugins/datatables/es.json"
        },
        // "dom": 'Bfrtip',
        "responsive": true,
        "lengthChange": true,
        "autoWidth": true,
        // //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        // "iDisplayLength": 9,
        "bSort" : false
    });


});

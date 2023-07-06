<?php

use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::view('/', 'auth.login');
// Route::get('/', function () {
//    return view('auth.login');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

//Users
Route::get('/listUsers', 'Admin\UserController@index')->name('listUsers')->middleware('auth');
Route::get('/deleteUser/{idUser}', 'Admin\UserController@delete')->name('deleteUser')->middleware('auth');
Route::post('/saveUser/{idUser?}', 'Admin\UserController@save')->name('saveUser')->middleware('auth');
Route::get('/formUser/{idUser?}/{show?}', 'Admin\UserController@form')->name('formmUser')->middleware('auth');
//Permissions
Route::get('/listPermissions', 'Admin\PermissionController@index')->name('listPermissions')->middleware('auth');
Route::get('/deletePermission/{idPermission}', 'Admin\PermissionController@delete')->name('deletePermission')->middleware('auth');
Route::post('/savePermission/{idPermission?}', 'Admin\PermissionController@save')->name('savePermission')->middleware('auth');
Route::get('/formPermission/{idPermission?}/{show?}', 'Admin\PermissionController@form')->name('formPermission')->middleware('auth');

//Roles
Route::get('/listRoles', 'Admin\RoleController@index')->name('listRoles')->middleware('auth');
Route::get('/deleteRole/{idRole}', 'Admin\RoleController@delete')->name('deleteRole')->middleware('auth');
Route::post('/saveRole/{idRole?}', 'Admin\RoleController@save')->name('saveRole')->middleware('auth');
Route::get('/formRole/{idRole?}/{show?}', 'Admin\RoleController@form')->name('fromRole')->middleware('auth');

// Asociar permiso a rol.
Route::get('/listRolePermissions', 'Admin\RolePermissionController@index')->name('listRolPermissions')->middleware('auth');
Route::get('/deleteRolPermission/{id_role}/{id_permission}', 'Admin\RolePermissionController@delete')->name('deleteRolPermission')->middleware('auth');
Route::post('/saveRolPermission/{idRolPermission?}', 'Admin\RolePermissionController@save')->name('saveRolPermission')->middleware('auth');
Route::get('/formRolPermission/{permission_id?}/{role_id?}/{show?}', 'Admin\RolePermissionController@form')->name('formRolPermission')->middleware('auth');

// Asociar rol a usuario.
Route::get('/listUserRoles', 'Admin\UserRolController@index')->name('listUserRoles')->middleware('auth');
Route::get('/deleteUserRol/{id_user}/{id_role}', 'Admin\UserRolController@delete')->name('deleteUserRol')->middleware('auth');
Route::post('/saveUserRol/{idUserRol?}', 'Admin\UserRolController@save')->name('saveUserRol')->middleware('auth');
Route::get('/formUserRol/{role_id?}/{model_id?}/{show?}', 'Admin\UserRolController@form')->name('formUserRol')->middleware('auth');

// Personas
Route::get('/showPerson/{id}', 'PersonController@show')->name('showPerson')->middleware('auth');

// Clientes
Route::get('/listClients', 'ClientController@index')->name('listClients')->middleware('auth');
Route::get('/getCities/{idState}', 'ClientController@Cities')->name('Cities')->middleware('auth');
// Route::get('/showClient/{id}', 'ClientController@showClient')->name('showClient')->middleware('auth');
Route::get('/deleteClient/{id}', 'ClientController@destroy')->name('deleteClient')->middleware('auth');
Route::post('/saveClient', 'ClientController@store')->name('saveClient')->middleware('auth');
Route::post('/updateClient/{id}', 'ClientController@update')->name('updateClient')->middleware('auth');
Route::get('/showClient/{id}', 'ClientController@searchClient')->name('showClient')->middleware('auth');
Route::get('/formClient/{id?}/{show?}', 'ClientController@create')->name('formClient')->middleware('auth');


// Proveedores
Route::get('/listSuppliers', 'SupplierController@index')->name('listSuppliers')->middleware('auth');
Route::get('/getCities/{idState}', 'SupplierController@Cities')->name('Cities')->middleware('auth');
Route::get('/formSupplier/{id?}/{show?}', 'SupplierController@create')->name('formSupplier')->middleware('auth');
Route::post('/saveSupplier', 'SupplierController@store')->name('saveSupplier')->middleware('auth');
Route::get('/deleteSupplier/{idSupplier}', 'SupplierController@destroy')->name('deleteSupplier')->middleware('auth');
Route::post('/searchEconomica', 'SupplierController@searchEconomica')->name('searchEconomica')->middleware('auth');
Route::get('/getApiSuppliers', 'SupplierController@getApiSuppliers')->name('getApiSuppliers')->middleware('auth');




// Sociedades
Route::get('/listSocieties', 'SocietyController@index')->name('listSocieties')->middleware('auth');
Route::get('/getCities/{idState}', 'SocietyController@Cities')->name('Cities')->middleware('auth');
Route::post('/saveSociety', 'SocietyController@store')->name('saveSociety')->middleware('auth');
Route::get('/formSociety/{id?}/{show?}', 'SocietyController@create')->name('formSociety')->middleware('auth');
Route::get('/deleteSociety/{idSociety}', 'SocietyController@destroy')->name('deleteSociety')->middleware('auth');

// Obras
Route::get('/listConstructions', 'ConstructionController@index')->name('listConstructions')->middleware('auth');
Route::get('/showConstruction/{id}', 'ConstructionController@show')->name('showConstruction')->middleware('auth');
Route::post('/saveConstruction', 'ConstructionController@store')->name('saveConstruction')->middleware('auth');
Route::post('/updateConstruction/{id}', 'ConstructionController@update')->name('updateConstruction')->middleware('auth');
Route::get('/formContruction/{id?}/{show?}', 'ConstructionController@create')->name('formContruction')->middleware('auth');
Route::get('/getCities/{idState}', 'ConstructionController@Cities')->name('Cities')->middleware('auth');
Route::get('/searchContructionClient/{obra_idcliente}', 'ConstructionController@searchContructionClient')->name('searchContructionClient')->middleware('auth');
Route::get('/filterContructionExcel', 'ConstructionController@filterContructionExcel')->name('filterContructionExcel')->middleware('auth');
Route::get('/filterContructionExcel', 'ConstructionController@filterContructionExcel')->name('filterContructionExcel')->middleware('auth');
Route::get('/deleteContructor/{idContructor}', 'ConstructionController@destroy')->name('deleteContructor')->middleware('auth');




// Materiales
Route::get('/listMaterials', 'MaterialController@index')->name('listMaterials')->middleware('auth');
Route::post('/saveMaterial', 'MaterialController@store')->name('saveMaterial')->middleware('auth');
Route::post('/updateMaterial/{id}', 'MaterialController@update')->name('updateMaterial')->middleware('auth');
Route::get('/deleteMaterial/{idMaterial}', 'MaterialController@destroy')->name('deleteMaterial')->middleware('auth');
Route::get('/formMaterial/{id?}/{show?}', 'MaterialController@create')->name('formMaterial')->middleware('auth');

// Materia Prima
Route::get('/listCommodities', 'CommodityController@index')->name('listCommodities')->middleware('auth');
Route::get('/formCommodity/{id?}/{show?}', 'CommodityController@create')->name('formCommodity')->middleware('auth');
Route::post('/saveCommodity', 'CommodityController@store')->name('saveCommodity')->middleware('auth');
Route::get('/deleteCommodity/{idCommodity}', 'CommodityController@destroy')->name('deleteCommodity')->middleware('auth');

// Dispositivos
Route::get('/listDevices', 'DeviceController@index')->name('listDevices')->middleware('auth');
Route::get('/formDevice/{id?}/{show?}', 'DeviceController@create')->name('formDevice')->middleware('auth');
Route::post('/saveDevice', 'DeviceController@store')->name('saveDevice')->middleware('auth');
Route::get('/deleteDevice/{idDevice}', 'DeviceController@destroy')->name('deleteDevice')->middleware('auth');

// Máquinas
Route::get('/listMachines', 'MachineController@index')->name('listMachines')->middleware('auth');
Route::get('/deleteMachine/{id}', 'MachineController@destroy')->name('deleteMachine')->middleware('auth');
Route::post('/saveMachine', 'MachineController@store')->name('saveMachine')->middleware('auth');
Route::post('/updateMachine/{id}', 'MachineController@update')->name('updateMachine')->middleware('auth');
Route::get('/formMachine/{id?}/{show?}', 'MachineController@create')->name('formMachine')->middleware('auth');
Route::get('/deleteMaquine/{idMaquine}', 'MachineController@destroy')->name('deleteMaquine')->middleware('auth');
Route::post('/getCubitajeMachine', 'MachineController@getCubitajeMachine')->name('getCubitajeMachine')->middleware('auth');

// Tipos de Máquinas
Route::get('/listMachinesTypes', 'MachinesTypeController@index')->name('listMachinesTypes')->middleware('auth');
Route::get('/formMachineType/{id?}/{show?}', 'MachinesTypeController@create')->name('formMachineType')->middleware('auth');
Route::get('/deleteMaquineType/{idMaquineType}', 'MachinesTypeController@destroy')->name('deleteMachineType')->middleware('auth');
Route::post('/saveMachineType', 'MachinesTypeController@store')->name('saveMachineType')->middleware('auth');

//Conductores
Route::get('/listDriver', 'DriverController@index')->name('listDriver')->middleware('auth');

Route::get('/getCities/{idState}', 'DriverController@Cities')->name('Cities')->middleware('auth');
// Route::get('/showClient/{id}', 'ClientController@showClient')->name('showClient')->middleware('auth');
Route::get('/deleteDriver/{id}', 'DriverController@destroy')->name('deleteDriver')->middleware('auth');
Route::post('/saveDriver', 'DriverController@store')->name('saveDriver')->middleware('auth');
Route::post('/updateDriver/{id}', 'DriverController@update')->name('updateDriver')->middleware('auth');
Route::get('/showDriver/{id}', 'DriverController@searchDriver')->name('showDriver')->middleware('auth');
Route::get('/formDriver/{id?}/{show?}', 'DriverController@create')->name('formDriver')->middleware('auth');
//Route::get('/formClient/{id?}/{show?}', 'ClientController@create')->name('formClient')->middleware('auth');

// Obsservaciones de Máquinas
Route::get('/listObsMac', 'MachineObsController@index')->name('listObsMac')->middleware('auth');
Route::get('/formMachineObs/{id?}/{show?}', 'MachineObsController@create')->name('formMachineObs')->middleware('auth');
Route::get('/deleteMaquineObs/{idMaquineObs}', 'MachineObsController@destroy')->name('deleteMachineObs')->middleware('auth');
Route::post('/saveMachineObs', 'MachineObsController@store')->name('saveMachineObs')->middleware('auth');

// Conceptos de Pagos
Route::get('/listConcPayments', 'ConceptPaymentController@index')->name('listConcPayments')->middleware('auth');
Route::get('/formConceptPayment/{id?}/{show?}', 'ConceptPaymentController@create')->name('formConceptPayment')->middleware('auth');
Route::get('/deleteConceptPayment/{idConceptPayment}', 'ConceptPaymentController@destroy')->name('deleteConceptPayment')->middleware('auth');
Route::post('/saveConceptPayment', 'ConceptPaymentController@store')->name('saveConceptPayment')->middleware('auth');

// Movimientos de Máquinas
Route::get('/listMachinesMovs', 'MachineMovController@index')->name('listMachinesMovs')->middleware('auth');
Route::get('/formMachineMov/{id?}/{show?}', 'MachineMovController@create')->name('formMachineMov')->middleware('auth');
Route::get('/deleteMachineMov/{idMaquineMov}', 'MachineMovController@destroy')->name('deleteMachineMov')->middleware('auth');
Route::post('/saveMachineMov', 'MachineMovController@store')->name('saveMachineMov')->middleware('auth');

Route::get('/filterMovMaq', 'MachineMovController@filterMovMaq')->name('filterMovMaq')->middleware('auth');
Route::get('/getApiMachineMov', 'MachineMovController@getApiMachineMov')->name('getApiMachineMov')->middleware('auth');




// Remisiones
Route::get('/listRemissions', 'RemissionController@index')->name('listRemissions')->middleware('auth');
Route::get('/detailRemission/{idRemission}/{material?}', 'RemissionController@detailRemission')->name('detailRemission')->middleware('auth');
Route::get('/referralReceipt/{idRemission}', 'RemissionController@referralReceipt')->name('referralReceipt')->middleware('auth');
Route::get('/cancelRemission/{idRemission}', 'RemissionController@cancelRemission')->name('cancelRemission')->middleware('auth');
Route::get('/filterRemission', 'RemissionController@filterRemission')->name('filterRemission')->middleware('auth');
Route::get('/exportlistInvoiceAssignment', 'RemissionController@exportlistInvoiceAssignment')->name('exportlistInvoiceAssignment')->middleware('auth');

// Conceptos de Novedades de Remisiones
Route::get('/listConcNov', 'RemissionConcNovController@index')->name('listConcNov')->middleware('auth');
Route::get('/formConceptNovelty/{id?}/{show?}', 'RemissionConcNovController@create')->name('formConceptNovelty')->middleware('auth');
Route::get('/deleteConceptNovelty/{idConceptNovelty}', 'RemissionConcNovController@destroy')->name('deleteConceptNovelty')->middleware('auth');
Route::post('/saveConceptNovelty', 'RemissionConcNovController@store')->name('saveConceptNovelty')->middleware('auth');

// Novedades de Remisiones
Route::get('/listNovRem', 'RemissionNoveltyController@index')->name('listNovRem')->middleware('auth');
Route::get('/formRemissionNovelty/{id?}/{show?}', 'RemissionNoveltyController@create')->name('formRemissionNovelty')->middleware('auth');
Route::get('/deleteRemissionNovelty/{idRemissionNovelty}', 'RemissionNoveltyController@destroy')->name('deleteRemissionNovelty')->middleware('auth');
Route::post('/saveRemissionNovelty', 'RemissionNoveltyController@store')->name('saveRemissionNovelty')->middleware('auth');
Route::get('/filterRemissionNov', 'RemissionNoveltyController@filterRemissionNov')->name('filterRemissionNov')->middleware('auth');

//  Inventory
Route::get('/inventory', 'InventoryController@index')->name('inventory')->middleware('auth');
Route::get('/formInventory', 'InventoryController@form')->name('formInventory')->middleware('auth');
Route::get('/deleteInventory', 'InventoryController@delete')->name('deleteInventory')->middleware('auth');
Route::post('/save', 'InventoryController@save')->name('save')->middleware('auth');
Route::get('/inventoryControl', 'InventoryController@inventoryControl')->name('inventoryControl')->middleware('auth');

//Machinery Novelty
Route::get('/listMachineryNovelty', 'MachineryNoveltyController@index')->name('listMachineryNovelty')->middleware('auth');
Route::get('/formMachineryNovelty/{mqdt_id?}/{show?}', 'MachineryNoveltyController@form')->name('formMachineryNovelty')->middleware('auth');
Route::get('/deleteMachineryNovelty/{mqdt_id}', 'MachineryNoveltyController@delete')->name('deleteMachineryNovelty')->middleware('auth');
Route::post('/saveMachineryNovelty', 'MachineryNoveltyController@save')->name('saveMachineryNovelty')->middleware('auth');

//Material Movement
Route::get('/listMaterialMovement', 'MaterialMovementController@index')->name('listMaterialMovement')->middleware('auth');
Route::get('/formMaterialMovement/{prod_id?}/{show?}', 'MaterialMovementController@form')->name('formMaterialMovement')->middleware('auth');
Route::get('/deleteMaterialMovement/{prod_id}', 'MaterialMovementController@delete')->name('deleteMaterialMovement')->middleware('auth');
Route::post('/saveMaterialMovement', 'MaterialMovementController@save')->name('saveMaterialMovement')->middleware('auth');
Route::get('/getMachine', 'MaterialMovementController@getMachine')->name('getMachine')->middleware('auth');


//Options de %
Route::get('/trOptions', 'OptionsController@trOptions')->name('trOptions')->middleware('auth');

Route::get('/Options', 'OptionsController@index')->name('Options')->middleware('auth');

Route::get('/formOptions/{id?}/{show?}','OptionsController@create')->name('formOptions')->middleware('auth');
Route::get('/deleteOptions/{idoptions}', 'OptionsController@destroy')->name('deleteOptions')->middleware('auth');
Route::post('/saveOptions', 'OptionsController@store')->name('saveOptions')->middleware('auth');
Route::post('/updateOptions', 'OptionsController@update')->name('updateOptions')->middleware('auth');
//Optionsdetails
// Esta repetido me parece con option
//Route::get('/optionsDetails','OptionsdetailsController@index')->name('optionsDetails')->middleware('auth');
           //asignacionPorcentajes
// Route::get('/Asignacionporcentaje', 'OptionsdetailsController@Asignacionporcentaje')->name('Asignacionporcentaje')->middleware('auth');
// ver % salida
Route::get('/formPorcentajesalida/{id?}/{show?}', 'OptionsdetailsController@create')->name('formPorcentajesalida')->middleware('auth');


//Este es la ruta para la salida de los materiales convertidos.
Route::get('/Porcentajesalida/{id?}/{show?}','OptionsdetailsController@Porcentajesalida')->name('Porcentajesalida')->middleware('auth');

//Este seria la vista de las salida de los por centajes Fray Luis 15/06/2023

Route::get('/Salidaporcentajes/{id?}/{show?}', 'OptionsdetailsController@createSalidaPorcentaje')->name('Salidaporcentajes')->middleware('auth');
Route::get('/Filtrarsalida','OptionsdetailsController@FiltrarsalidaConversion')->name('Filtrarsalida')->middleware('auth');
Route::get('/exportlistSalidasPorcentajes', 'OptionsdetailsController@exportlistPorcentajes')->name('exportlistSalidasPorcentajes')->middleware('auth');
// Asiganacion de Porcentajes
//Route::get('/searchOptionsdetails/{Options_Details}', 'OptionsdetailsController@searchOptionsdetails')->name('searchOptionsdetails')->middleware('auth');
Route::post('/savePorcentajeAssignment', 'OptionsdetailsController@savePorcentajeAssignment')->name('savePorcentajeAssignment')->middleware('auth');

//vista#3                                                 
//Route::get('/cerrarporcentajes', 'OptionsdetailsController@cerrarporcentajes')->name('cerrarporcentajes')->middleware('auth');

//ruta de prueba para servidor28/06/2023



//-----------------------------------------------------------------------------pruebas




Route::get('/cerrarop', 'OptionsdetailsController@cerraroption')->name('cerrarop')->middleware('auth');









//-----------------------------------------------------------------------------pruebas
Route::get('/cerraroption', 'OptionsdetailsController@cerraroption')->name('cerraroption')->middleware('auth');

Route::get('/conversionesporcentajes', 'OptionsdetailsController@conversiones')->name('conversionesporcentajes')->middleware('auth');


Route::get('/Filtraropciones', 'OptionsdetailsController@Filtraropciones')->name('Filtraropciones')->middleware('auth');


/*Route::get('/Options', 'OptionsController@index')->name('Options')->middleware('auth');
Route::get('/formOptions/{id?}/{show?}','OptionsController@create')->name('formOptions')->middleware('auth');
Route::get('/deleteOptions/{idoptions}', 'OptionsController@destroy')->name('deleteOptions')->middleware('auth');
Route::post('/saveOptions', 'OptionsController@store')->name('saveOptions')->middleware('auth');
*/

// Viatico Other
Route::get('/listViaticoOther', 'ViaticoOtherController@index')->name('listViaticoOther')->middleware('auth');
Route::get('/formViaticoOther/{mqpg_id?}/{show?}', 'ViaticoOtherController@form')->name('formViaticoOther')->middleware('auth');
Route::get('/deleteViaticoOther/{mqpg_id}', 'ViaticoOtherController@delete')->name('deleteViaticoOther')->middleware('auth');
Route::post('/saveViaticoOther', 'ViaticoOtherController@save')->name('saveViaticoOther')->middleware('auth');

//Material Tankage
//FuelDischarge
Route::get('/listFuelDischarge', 'TankageController@listFuelDischarge')->name('listFuelDischarge')->middleware('auth');
Route::get('/formFuelDischarge/{ccmb_id?}/{show?}', 'TankageController@formFuelDischarge')->name('formFuelDischarge')->middleware('auth');
Route::get('/deleteFuelDischarge/{ccmb_id}', 'TankageController@deleteFuelDischarge')->name('deleteFuelDischarge')->middleware('auth');
Route::post('/saveFuelDischarge', 'TankageController@saveFuelDischarge')->name('saveFuelDischarge')->middleware('auth');

//CubitanksLoading
Route::get('/listCubitanksLoading', 'TankageController@listCubitanksLoading')->name('listCubitanksLoading')->middleware('auth');
Route::get('/formCubitanksLoading/{cubt_id?}/{show?}', 'TankageController@formCubitanksLoading')->name('formCubitanksLoading')->middleware('auth');
Route::get('/deleteCubitanksLoading/{cubt_id}', 'TankageController@deleteCubitanksLoading')->name('deleteCubitanksLoading')->middleware('auth');
Route::post('/saveCubitanksLoading', 'TankageController@saveCubitanksLoading')->name('saveCubitanksLoading')->middleware('auth');


//MachineTankine
Route::get('/listMachineTanking', 'TankageController@listMachineTanking')->name('listMachineTanking')->middleware('auth');
Route::get('/formMachineTanking/{tanq_id?}/{show?}', 'TankageController@formMachineTanking')->name('formMachineTanking')->middleware('auth');
Route::get('/deleteMachineTanking/{tanq_id}', 'TankageController@deleteMachineTanking')->name('deleteMachineTanking')->middleware('auth');
Route::post('/saveMachineTanking', 'TankageController@saveMachineTanking')->name('saveMachineTanking')->middleware('auth');

//Report
Route::get('/reports', 'ReportController@index')->name('reports')->middleware('auth');
Route::get('/reportDocument', 'ReportController@reportDocument')->name('reportDocument')->middleware('auth');
Route::get('/reportRemissions', 'ReportController@reportRemissions')->name('reportRemissions')->middleware('auth');
Route::get('/pdfReportRemissions', 'ReportController@pdfReportRemissions')->name('pdfReportRemissions')->middleware('auth');
Route::get('/pdfReportRemissionAssignments', 'ReportController@pdfReportRemissionAssignments')->name('pdfReportRemissionAssignments')->middleware('auth');
Route::get('/pdfReportRemissionNovelties/{idRemissionNovelties}', 'ReportController@pdfReportRemissionNovelties')->name('pdfReportRemissionNovelties')->middleware('auth');
Route::get('/reportMaterials', 'ReportController@reportMaterials')->name('reportMaterials')->middleware('auth');
Route::get('/pdfReportMaterials', 'ReportController@pdfReportMaterials')->name('pdfReportMaterials')->middleware('auth');
//esta es la nueva ruta para el reporte  
Route::get('/exportExcelMaterialRemission', 'ReportController@exportExcelMaterialRemission')->name('exportExcelMaterialRemission')->middleware('auth');
                                                        
Route::get('/reportMaterialOverview', 'ReportController@reportMaterialOverview')->name('reportMaterialOverview')->middleware('auth');
Route::get('/reportMaterialOverviewSociety', 'ReportController@reportMaterialOverviewSociety')->name('reportMaterialOverviewSociety')->middleware('auth');
Route::get('/reportCommodiesProduction', 'ReportController@reportCommodiesProduction')->name('reportCommodiesProduction')->middleware('auth');



// Remisiones
Route::get('/listRemissions', 'RemissionController@index')->name('listRemissions')->middleware('auth');
Route::get('/remission', 'RemissionController@trRemission')->name('remission')->middleware('auth');
Route::post('/saveRemission', 'RemissionController@store')->name('saveRemission')->middleware('auth');
Route::get('/formRemission/{id?}/{show?}', 'RemissionController@create')->name('formRemission')->middleware('auth');
Route::get('/deleteRemission/{id}', 'RemissionController@destroy')->name('deleteRemission')->middleware('auth');
// Route::get('/filterByConstruction/{id?}', 'RemissionController@filterByConstruction')->name('filterByConstruction')->middleware('auth');

//Facturación
Route::get('/listInvoiceAssignment', 'RemissionController@listInvoiceAssignment')->name('listInvoiceAssignment')->middleware('auth');
Route::post('/saveInvoiceAssignment', 'RemissionController@saveInvoiceAssignment')->name('saveInvoiceAssignment')->middleware('auth');
Route::get('/listLiquidationRemission', 'RemissionController@listLiquidationRemission')->name('listLiquidationRemission')->middleware('auth');


// Lista de Precios
Route::get('/getPriceList/{idObra?}/{idMaterial?}', 'PriceListController@getPriceList')->name('getPriceList')->middleware('auth');
Route::get('/listPriceList', 'PriceListController@index')->name('listPriceList')->middleware('auth');
Route::get('/formPriceList/{priceList_id?}/{show?}', 'PriceListController@create')->name('formPriceList')->middleware('auth');
Route::get('/deletePriceList/{priceList_id}', 'PriceListController@destroy')->name('deletePriceList')->middleware('auth');
Route::post('/savePriceList', 'PriceListController@store')->name('savePriceList')->middleware('auth');
Route::get('/searchMaterial/{material_id}', 'PriceListController@searchMaterial')->name('searchMaterial')->middleware('auth');
Route::get('/exportListPrice', 'PriceListController@exportListPrice')->name('exportListPrice')->middleware('auth');

// Asignacion de Factura

//Excel
Route::get('/reportMachineMov', 'ReportController@reportMachineMov')->name('reportMachineMov')->middleware('auth');
Route::get('/exportExcelMaterialRemission', 'ReportController@exportExcelMaterialRemission')->name('exportExcelMaterialRemission')->middleware('auth');
Route::get('/exportExcelRemissions', 'ReportController@exportExcelRemissions')->name('exportExcelRemissions')->middleware('auth');
Route::get('/exportExcelProductions', 'ReportController@exportExcelProductions')->name('exportExcelProductions')->middleware('auth');

Route::get('/listPreSettlement', 'PreSettlementController@index')->name('listPreSettlement')->middleware('auth');
Route::get('/preSettlementCanceled', 'PreSettlementController@edit')->name('preSettlementCanceled')->middleware('auth');
Route::get('/exportExcelProductions', 'ReportController@exportExcelProductions')->name('exportExcelProductions')->middleware('auth');
Route::get('/exportExcelRemittanceToLiquidate', 'ReportController@exportExcelRemittanceToLiquidate')->name('exportExcelRemittanceToLiquidate')->middleware('auth');
// Route::get('/storage-link', function(){



//Route::get('/driver', 'DriverController@index')->name('conductor')->middleware('auth');

//     if(file_exists(public_path(('storage')))){

//         return redirect()->route('home');
//     }else{

//         app('files')->link(
//             storage_path('app/public'),public_path('storage')
//         );

//         return redirect()->route('home');
//     }

// });


// Route::get('/showPerson/{id}', 'PersonController@show')->name('showPerson')->middleware('auth');
// Route::get('/showClient/{id}', 'ClientController@show')->name('showClient')->middleware('auth');

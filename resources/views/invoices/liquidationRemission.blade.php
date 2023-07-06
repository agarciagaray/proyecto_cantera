@extends('adminlte::page')
<!-- , ['iFrameEnabled' => true] -->
@section('title', 'Remisiones por Facturar')

@section('content_header')
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/sweetalert2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/select2.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/buttons.bootstrap4.min.css') }}">

@stop
@section('content')
    <form class="form-send-invoice-assign">
        {{-- @csrf --}}
        <div class="card card-info">
            <div class="card-header">
                <h1 class="card-title"><b>Asignación de factura</b></h1>
            </div>

            <div class="card-body">
                <div class="dataTables_wrapper dt-bootstrap4">

                    <form class="form-horizontal formRemissionAssignment">
                        <div class="row">
                            <input type="hidden" value="L" name="statusInvoice" id="statusInvoice">
                            <div class="col-12 col-sm-3 mb-3">
                                <label for="numFact" style="font-size: 10pt">No. Factura</label>
                                <input type="form-control" class="form-control" placeholder="Digite el No. de factura"
                                    name="numFact" id="numFact" tabindex="1" autofocus="autofocus" autocomplete="off">
                            </div>
                            <div class="col-12 col-sm-2">
                                <label for="numFact" style="font-size: 10pt">Acción</label>
                                <button class="btn btn-success btn-sm mt-1" onclick="saveInvoiceAssignment('L')"
                                    type="button">
                                    <i class="fas fa-save"></i> Asignar
                                </button>
                            </div>
                            <div class="col-12 col-sm-7 mb-3"></div>
                            <div class="col-md-4 col-sm-4 col-12 col-xs-12">
                                <div class="form-group">
                                      <label style="font-size: 10pt">Clientes</label>
                                    <select class="form-control select3 obra_idcliente" name="idClient" id="idClient"
                                        onchange="searchContructionClient()">
                                        <option></option>
                                        @foreach ($clients as $client)
                                            <option value="{{ $client->id }}">{{ $client->Person->pers_razonsocial }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
        
                            <div class="col-md-4 col-sm-4 col-12 col-xs-12">
                                <div class="form-group">
                                      <label style="font-size: 10pt">Obras</label>
                                    <select class="form-control select3 idObra" name="idConstruction" id="idConstruction">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-sm-2 mb-3">
                                <label style="font-size: 10pt">Fecha inicial</label>
                                <input type="date" name="dateStart" id="dateStart" class="form-control"
                                    autocomplete="off" value="{{ $request->dateStart ?? '' }}" required>
                            </div>
                            <div class="col-12 col-sm-2 mb-3">
                                <label style="font-size: 10pt">Fecha final</label>
                                <input type="date" name="dateEnd" id="dateEnd" class="form-control" autocomplete="off"
                                    value="{{ $request->dateEnd ?? '' }}" required>
                            </div>

                            <div class="col-12 col-sm-8 mb-3">
                                <label style="font-size: 10pt">Acción</label>
                                <a class="btn btn-primary btn-sm"><i class="fa fa-search" aria-hidden="true"
                                        onclick="filterLiquidationRemission()"></i></a>
                                <a class="btn btn-secondary btn-sm" onclick="clearFilter()"><i class="fa fa-eraser"
                                        aria-hidden="true" target="_blank"></i></a>
                            </div>
                            
                            <div class="col-12 col-sm-4 text-center">
                                <label style="font-size: 8.4pt;color:red">Se filtra con la fecha de la grabación de la preliquidación</label>
                            </div>
                        </div>
                    </form>

                    <div class="row">
                        <div class="col-sm-12 col-12 col-md-12">
                            <div class="table-responsive">
                                <table class="table" id="table_asociate_invoice_remission">
                                    <thead class="table-primary">
                                        <tr>
                                            <th class="text-center">
                                                Asignar
                                            </th>
                                            <th class="text-center">
                                                Id
                                            </th>
                                            <th class="text-center">
                                                Nombre Obra
                                            </th>
                                            <th class="text-center">
                                                Razón Social/Nombre
                                            </th>
                                            <th class="text-center">
                                                Número de remisión
                                            </th>
                                            <th class="text-center" >
                                                Fecha
                                            </th>
                                            <th>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_remissionLiquidation" name="tbody_remissionLiquidation">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop
@include('layouts.modal')
@section('js')
    <script src="{{ asset('js/plugins/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/admin/validate.js') }}"></script>
    <script src="{{ asset('js/admin/admin.js') }}"></script>
    <script src="{{ asset('js/util.js') }}"></script>
    <script src="{{ asset('js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('js/invoiceAssignment/function.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons.colVis.min.js') }}"></script>
@stop
</form>

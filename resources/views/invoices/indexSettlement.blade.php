@extends('adminlte::page')
<!-- , ['iFrameEnabled' => true] -->
@section('title', 'Manejo de preliquidación')

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
                <h1 class="card-title"><b>Manejo de preliquidación</b></h1>
            </div>

            <div class="card-body">
                <div class="dataTables_wrapper dt-bootstrap4">

                    <form class="form-horizontal formRemissionAssignment" action="{{ route('listInvoiceAssignment') }}">
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-12 col-xs-12">
                                <div class="form-group">
                                    <label style="font-size: 8pt">Clientes</label>
                                    <select class="form-control select3 obra_idcliente" name="idClient" id="idClient"
                                        onchange="searchContructionClient()" required>
                                        <option></option>
                                        @foreach ($clients as $client)
                                            <option value="{{ $client->id }}">{{ $client->Person->pers_razonsocial }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input name="pre_settlement_management" id="pre_settlement_management" value="true" type="hidden"/>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-4 col-12 col-xs-12">
                                <div class="form-group">
                                    <label style="font-size: 8pt">Obras</label>
                                    <select class="form-control select3 idObra" name="idConstruction" id="idConstruction" required>
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-sm-2 mb-3">
                                <label style="font-size: 8pt">Fecha inicial</label>
                                <input type="date" name="dateStart" id="dateStart" class="form-control"
                                    autocomplete="off" value="{{ $request->dateStart ?? '' }}" required>
                            </div>
                            <div class="col-12 col-sm-2 mb-3">
                                <label style="font-size: 8pt">Fecha final</label>
                                <input type="date" name="dateEnd" id="dateEnd" class="form-control" autocomplete="off"
                                    value="{{ $request->dateEnd ?? '' }}" required>
                            </div>

                            <div class="col-12 col-sm-4 mb-3">
                                <label style="font-size: 8pt">Acción</label>
                                <a class="btn btn-primary btn-sm"><i class="fa fa-search" aria-hidden="true"
                                        onclick="filterSettlement()"></i></a>
                                <a class="btn btn-secondary btn-sm" onclick="clearFilter()"><i class="fa fa-eraser"
                                        aria-hidden="true" target="_blank"></i></a>
                                <a class="btn btn-success btn-sm" title="Exportar"
                                    onclick="preSettlementRemissionAssigment()"> <i class="fa fa-file-excel"
                                        aria-hidden="true"></i></a>

                            </div>
                        </div>
                    </form>

                    <div class="row">
                        <div class="col-sm-12 col-12 col-md-12">
                            <div class="table-responsive">
                                <table class="table" id="table_settlement">
                                    <thead class="table-primary">
                                        <tr>
                                            <th class="text-center">
                                                Id preliquidación
                                            </th>
                                            <th class="text-center">
                                                Id remisión
                                            </th>
                                            <th class="text-center">
                                                Nombre obra
                                            </th>
                                            <th class="text-center">
                                                Razón social
                                            </th>
                                            <th class="text-center">
                                                Número de remisión
                                            </th>
                                            <th class="text-center">
                                                Fecha
                                            </th>
                                            <th class="text-center">
                                                Estado
                                            </th>
                                            <th class="text-center">
                                                Acción
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_settlement" name="tbody_settlement">
                                        @foreach ($preSettlements as $settlement)
                                            <tr @if ($settlement->status == 'A') style="color:#e3342f" @endif>
                                                <td class="text-center">{{ $settlement->id }}</td>
                                                <td class="text-center">{{ $settlement->Remission->id ?? ''}}</td>
                                                <td class="text-center">{{ $settlement->Construction->obra_nombre }}</td>
                                                <td class="text-center">{{ $settlement->Construction->Client->Person->pers_razonsocial }}</td>
                                                <td class="text-center">{{ $settlement->Remission->num_remission ?? '' }}</td>
                                                <td class="text-center">{{ $settlement->date }}</td>
                                                <td class="text-center">{{ $settlement->status }}</td>

                                                <td class="text-center">
                                                    @if ($settlement->status == 'SF')
                                                        <a class="btn btn-danger btn-primary"
                                                            onclick="editSettlement({{ $settlement->id }})"
                                                            title="Anular"><i class="fa fa-ban" aria-hidden="true"></i></a>
                                                    @endif

                                                </td>

                                            </tr>
                                        @endforeach
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

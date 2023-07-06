@extends('adminlte::page')
@section('title', 'Listado de remisiones')

@section('content_header')
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/sweetalert2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/select2.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/buttons.bootstrap4.min.css') }}">

@endsection

@section('content')
    <div class="card card-info">
        <div class="card-header">
            <h1 class="card-title"><b> Listado de remisiones</b></h1>
        </div>
        

        <div class="card-body">
            {{-- <div class="dataTables_wrapper dt-bootstrap4"> --}}
            <div class="row">
                <div class="col-sm-12 col-md-6 mb-2">
                    <button class="btn btn-primary" onclick="createRemission()" type="button">
                        <i class="fa fa-plus" aria-hidden="true"></i> Crear </button>
                </div>
                <div class="col-sm-12">
                    <form class="form-horizontal form-list-remission">
                        <div class="row">
                            <div class="col-md-4 col-6 col-xs-6">
                                <label>Maquinas (PLACA)</label>
                                <select class="form-control select3" name="idMachine" id="idMachine">
                                    <option value=""></option>
                                    @foreach ($machines as $machine)
                                        <option value="{{ $machine->id }}">
                                            {{ $machine->maqn_placa }} -
                                            {{ $machine->MachineType->tmaq_nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 col-6 col-xs-6">
                                <label>Fecha inicial</label>
                                <input type="date" name="dateStart" class="form-control datepicker" id="dateStart"
                                    autocomplete="off">
                            </div>
                            <div class="col-md-4 col-6 col-xs-6">
                                <label>Fecha final</label>
                                <input type="date" name="dateEnd" class="form-control datepicker" autocomplete="off"
                                    id="dateEnd">
                            </div>
                            <div class="col-md-4 col-sm-4 col-6 col-xs-6">
                                {{-- <br> --}}
                                <label>
                                    <input type="checkbox" name="notCancelled" id="notCancelled"> Sin anuladas
                                </label>

                            </div>

                          <div class="col-md-4 col-sm-4 col-6 col-xs-6">

                       
                                <label>Clientes</label>
                                <select class="form-control select3 obra_idcliente" name="idClient" id="idClient"
                                    onchange="searchContructionClient()">
                                    <option></option>
                                    @foreach ($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->Person->pers_razonsocial }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>

                         <div class="col-md-4 col-sm-4 col-6 col-xs-6">
                                <label>Obras</label>
                                <select class="form-control select3 idObra" name="idConstruction" id="idConstruction">
                                    <option></option>
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-4 col-6 col-xs-6">

                                <label>Sociedad</label>
                                <select class="form-control select3" name="idSociety" id="idSocietyRemission">
                                    <option></option>
                                    @foreach ($societies as $society)
                                        <option value="{{ $society->id }}">{{ $society->person->pers_razonsocial }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-md-4 col-sm-4 col-6 col-xs-6">

                                <label>Acción</label><br>
                                <button class="btn btn-primary mt-2 mr-1 btn-sm" type="button" title="Filtar"
                                    onclick="filterRemission()"><i class="fa fa-search" aria-hidden="true"
                                        title="Buscar"></i></button>
                                <button class="btn btn-secondary mt-2 mr-1 btn-sm" type="button" title="Limpiar filtro"
                                    onclick="clearFilter()"><i class="fa fa-eraser" aria-hidden="true"
                                        title="Limpiar filtro"></i></button>
                                <button class="btn btn-success mt-2 mr-1 btn-sm" type="button" title="Exportar excel"
                                    onclick="exportExcelRemission()"><i class="fa fa-file-excel"
                                        aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table" id="table-remission">
                            <thead class="table-primary">
                                <tr>
                                    <th class="text-center">
                                        ID
                                    </th>
                                    <th class="text-center">
                                        CLIENTE
                                    </th>
                                    <th class="text-center">
                                        OBRA
                                    </th>
                                    <th class="text-center">
                                        SOCIEDAD
                                    </th>
                                    <th class="text-center">
                                        FECHA
                                    </th>
                                    <th class="text-center">
                                        NO. DE FACTURA
                                    </th>
                                    <th class="text-center">
                                        NO. INTERNO
                                    </th>
                                    <th class="text-center">
                                        Nov
                                    </th>
                                    <th class="text-center">
                                        PLACA
                                    </th>
                                    <th class="text-center">
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="tbody_remission" name="tbody_remission">
                                @foreach ($remissions as $remission)
                                    <tr id="tr_{{ $remission->id }}"
                                        @if ($remission->remi_estado == 'I') style="color:#e3342f"
                                            @elseif ($remission->remi_estado == 'AN')
                                            style="color:#e1a900" @endif
                                        class="text-center">
                                        <td>
                                            {{ $remission->id }}
                                        </td>
                                        <td>
                                            {{ $remission->Construction->Client->Person->pers_razonsocial ?? '' }}
                                        </td>
                                        <td>
                                            {{ $remission->Construction->obra_nombre ?? '' }} -
                                            {{ $remission->Construction->id }}
                                        </td>
                                        <td>
                                            {{ $remission->Society->Person->pers_razonsocial ?? '' }}
                                            {{-- {{ $remission->Society->Person->pers_primerapell ?? '' }}
                                                {{ $remission->Society->Person->pers_segapell ?? '' }}
                                                {{ $remission->Society->Person->pers_primernombre ?? '' }}
                                                {{ $remission->Society->Person->pers_segnombre ?? '' }} --}}
                                        </td>
                                        <td>
                                            {{ $remission->remi_fecha }}
                                        </td>
                                        <td>
                                            {{ $remission->remi_numfactura }}
                                        </td>
                                        <td>
                                            {{ $remission->num_remission }}
                                        </td>
                                        <td class="text-center">
                                            @if (count($remission->remissionNovelties) > 0)
                                                <input type="checkbox" checked="checked" disabled>
                                            @endif

                                        </td>
                                        <td>
                                            {{ $remission->Machine->maqn_placa ?? '' }}
                                        </td>
                                        <td class="text-right py-0 align-middle">
                                            <div class="btn-group btn-group-sm">
                                                <button class="btn btn-info mr-1 btm-sm"
                                                    onclick="createRemission({{ $remission->id }}, true)" type="button">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
                                                <!--button class="btn btn-primary mr-1" onclick="createRemission({{ $remission->id }}, false)" type="button">
                                                                                            <i class="fas fa-edit"></i>
                                                                                        </button-->
                                                <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->

                                                @if ($remission->remi_estado == 'A')
                                                    <button class="btn btn-warning mr-1 btm-sm"
                                                        onclick="cancelRemission({{ $remission->id }}, true)"
                                                        title="Anular remisión" type="button">
                                                        <i class="fa fa-ban" aria-hidden="true"></i>
                                                    </button>
                                                @endif
                                                <a class="btn btn-danger btm-sm" target="_black" type="button"
                                                    href="{{ route('referralReceipt', $remission->id) }}">
                                                    <i class="fa fa-file-pdf"aria-hidden="true"></i>
                                                </a>
                                                {{-- @if ($remission->remi_estado == 'A')
                                                        <button class="btn btn-danger"
                                                            onclick="deleteRemission({{ $remission->id }})"
                                                            type="button">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    @endif --}}

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            {{-- </div> --}}
        </div>
    </div>

@endsection
@include('layouts.modal')
@section('js')
    <script src="{{ asset('js/plugins/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/admin/validate.js') }}"></script>
    <script src="{{ asset('js/admin/admin.js') }}"></script>
    <script src="{{ asset('js/util.js') }}"></script>
    <script src="{{ asset('js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('js/remission/function.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons.colVis.min.js') }}"></script>
@endsection

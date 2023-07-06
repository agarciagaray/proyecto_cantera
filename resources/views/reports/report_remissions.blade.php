@extends('adminlte::page')
<!-- , ['iFrameEnabled' => true] -->
@section('title', 'Generación de reportes de remisiones')

@section('content_header')

    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/select2.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/buttons.bootstrap4.min.css') }}">
    <link href="{{ asset('css/plugins/sweetalert2.min.css') }}" rel="stylesheet">
@stop

@section('content')
    @include('layouts.alert')
    <form class="form-horizontal idRemissionReport">
        <div class="card card-info">
            <div class="card-header">
                <h1 class="card-title"><b> Generación de reportes de remisiones</b></h1>
            </div>

            <div class="row pt-4 pl-4 pb-4 pr-4">
                <div class="col-md-3 col-sm-3 col-12 col-xs-12">
                    <div class="form-group">
                        <span class="info-box-text">Clientes</span>
                        <select class="form-control select3 obra_idcliente" name="idClient" id="idClient"
                            onchange="searchContructionClient()">
                            <option></option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}"
                                    {{ $request->idClient == $client->id ? 'selected' : '' }}>
                                    {{ $client->Person->pers_razonsocial }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3 col-sm-3 col-12 col-xs-12">
                    <div class="form-group">
                        <span class="info-box-text">Obras</span>
                        <select class="form-control select3 idObra" name="idConstruction" id="idConstruction">
                            <option></option>
                            {{-- @foreach ($constructions as $construction)
                                <option value="{{ $construction->id }}">{{ $construction->obra_nombre }}</option>
                            @endforeach --}}


                        </select>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-12 col-xs-12">
                    <div class="form-group">
                        <span class="info-box-text">Sociedad</span>
                        <select class="form-control select3" name="idSociety" id="idSociety">
                            <option></option>
                            @foreach ($societies as $society)
                                <option value="{{ $society->id }}"
                                    {{ $request->idSociety == $society->id ? 'selected' : '' }}>
                                    {{ $society->person->pers_razonsocial }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3 col-sm-3 col-12 col-xs-12">
                    <span class="info-box-text">Fecha inicial</span>
                    <input type="date" name="dateStart" id="dateStart" class="form-control" autocomplete="off"
                        value="{{ $request->dateStart ?? '' }}">
                </div>
                <div class="col-md-3 col-sm-3 col-12 col-xs-12">
                    <span class="info-box-text">Fecha final</span>
                    <input type="date" name="dateEnd" id="dateEnd" class="form-control" autocomplete="off"
                        value="{{ $request->dateEnd ?? '' }}">
                </div>
                <div class="col-md-3 col-sm-3 col-12 col-xs-8">
                    <span class="info-box-text">Estado</span>
                    {{($request->stateInvoice)}}
                    @php
                        $selectedStateInvoice =$request->stateInvoice ?? '';
                    @endphp
                   <select class="form-control select3" name="stateInvoice" id="stateInvoice">
                        <option></option>
                        <option value="0"  {{ $selectedStateInvoice == '0' ? 'selected' : '' }}>Sin factura</option>
                        <option value="1"  {{  $selectedStateInvoice == '1' ? 'selected' : '' }}>Con factura</option>
                    </select>
                </div>
                <div class="col-md-2 col-sm-2 col-2 col-xs-12" >
                        <br>
                      <label>

                        <input type="checkbox" name="notCancelled" id="notCancelled"> Sin anuladas
                      </label>

                </div>
                <div class="col-md-3 col-sm-3 col-12 col-xs-12">
                    <span class="info-box-text">Acciones</span><br>
                    <a class="btn btn-primary btn-sm"><i class="fa fa-search" aria-hidden="true"
                            title="Buscar" onclick="filterRemissionReport()"></i></a>
                    <button class="btn btn-secondary btn-sm" title="Limpiar filtro" onclick="clearFilter()"
                        type="button"><i class="fa fa-eraser" aria-hidden="true"></i></button>
                    {{-- <a class="btn btn-danger btn-sm" onclick="downloadRemissionPdf()" target="_blank" title="Generar pdf"><i class="fa fa-file-pdf" aria-hidden="true"></i></a> --}}
                    <a class="btn btn-success btn-sm" onclick="downloadRemissionsExcel()"
                        title="Generar excel"><i class="fa fa-file-excel" aria-hidden="true" title="Exportar excel"></i></a>

                </div>
            </div>
            <div class="card-body p-0 mr-4 ml-4 mb-4" style="display: block;">
                <div class="table-responsive">
                    <table class="table" id="table-report">
                        <thead class="table-primary">
                            <tr class="text-center">
                                <th scope="col">#</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Obra</th>
                                <th scope="col">Cliente</th>
                                <th scope="col">Sociedad</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Número interno</th>
                                <th scope="col">Nov</th>
                                <th scope="col">Detalle</th>
                            </tr>
                        </thead>
                        <tbody id="table-report-remission">
                            @foreach ($remissions as $remission)
                                <tr class="text-center" @if($remission->remi_estado == 'AN') style='background-color:#e1a900;color:white' @endif>
                                    <td>{{ $remission->id }}</td>
                                    <td>{{ $remission->remi_fecha }}</td>
                                    <td>{{ $remission->Construction->obra_nombre }}</td>
                                    <td>{{ $remission->Construction->Client->Person->pers_razonsocial }}</td>
                                    <td>{{ $remission->Society->Person->pers_razonsocial }}</td>
                                    <td>{{ $remission->remi_numfactura == null ? 'Sin factura' : 'Con factura #' . $remission->remi_numfactura }}
                                    </td>

                                    <td>{{ $remission->num_remission }}</td>
                                    <td>
                                        @if (count($remission->remissionNovelties) > 0)
                                            <input type="checkbox" checked="checked" disabled>
                                        @endif

                                    </td>
                                    <td>
                                        <a class="btn btn-success mb-2 btn-sm"
                                            onclick="detailRemission({{ $remission->id }})">
                                            Detalle
                                        </a>
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                    {{-- <div class="offset-md-5"> {!! $materialInventory->links() !!} </div> --}}
                </div>
            </div>
        </div>
    </form>
@endsection
@include('layouts.modal')
@section('js')
    <script src="{{ asset('js/plugins/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('js/report/functions.js') }}"></script>
    <script src="{{ asset('js/util.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
    {{-- <script src="{{ asset('js/plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons.colVis.min.js') }}"></script> --}}
@endsection

@extends('adminlte::page')
<!-- , ['iFrameEnabled' => true] -->
@section('title', 'Resumén por material ')

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
    <form class="form-horizontal form-commodiesProduction" action="{{ route('reportCommodiesProduction') }}">
        <div class="card card-info">
            <div class="card-header">
                <h1 class="card-title"><b> Resumén por material prima</b></h1>
            </div>

            <div class="row pt-4 pl-4 pb-4 pr-4">
                <div class="col-md-3 col-sm-3 col-12 col-xs-12">
                    <div class="form-group">
                        <span class="info-box-text">Materia prima</span>
                        <select class="form-control select3" name="idCommodity" id="idCommodity">
                            <option></option>
                            @foreach ($commodities as $commodity)
                                <option value="{{ $commodity->id }}"
                                    {{ $request->idCommodity == $commodity->id ? 'selected' : '' }}>
                                    {{ $commodity->matp_descripcion }}</option>
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

                <div class="col-md-3 col-sm-3 col-12 col-xs-12">
                    <span class="info-box-text">Acciones</span><br>
                    <button class="btn btn-primary btn-sm"><i class="fa fa-search" aria-hidden="true"
                            title="Buscar"></i></button>
                    <button class="btn btn-secondary btn-sm" title="Limpiar filtro" onclick="clearFilter()"
                        type="button"><i class="fa fa-eraser" aria-hidden="true"></i></button>

                    <button class="btn btn-success btn-sm" onclick="exportExcelCommodiesProduction(true)"
                        title="Generar excel"><i class="fa fa-file-excel" aria-hidden="true"
                            title="Exportar excel"></i></button>

                </div>

            </div>
            {{-- <a class="btn btn-danger btn-sm" onclick="downloadRemissionPdf()" target="_blank" title="Generar pdf"><i class="fa fa-file-pdf" aria-hidden="true"></i></a> --}}

            <div class="card-body p-0 mr-4 ml-4 mb-4" style="display: block;">
                <div class="table-responsive">
                    <table class="table" id="table-commodiesProduction">
                        <thead class="table-primary">
                            <tr class="text-center">
                                <th scope="col">Fecha</th>
                                <th scope="col">Dispositivo</th>
                                <th scope="col">Deposita</th>
                                <th scope="col">Materia prima</th>
                                <th scope="col">Cantidad</th>
                                {{-- <th scope="col">Suministro</th> --}}
                            </tr>
                        </thead>
                        <tbody id="table-commodiesProduction-remission">
                            @foreach ($commodiesProduction as $key=> $commodity)
                                <tr class="text-center">
                                    <td>{{ $commodity->fecha ?? 'sin datos'}}</td>
                                    <td>{{ $commodity->dispositivo  ?? 'sin datos' }}</td>
                                    <td>{{ $commodity->deposita  ?? 'sin datos' }}</td>
                                    <td>{{ $commodity->materia_prima ?? 'sin datos'}}</td>
                                    <td>{{ $commodity->entrada  ?? 'sin datos'}}</td>
                                    {{-- <td>${{ number_format($commodity->suministro, 2) }}</td> --}}
                                </tr>
                            @endforeach

                        </tbody>

                    </table>
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

@endsection

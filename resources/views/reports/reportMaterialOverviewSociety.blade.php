@extends('adminlte::page')
<!-- , ['iFrameEnabled' => true] -->
@section('title', 'Resumén de material por sociedad')

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
    <form class="form-horizontal form-materialOverviewSociety" action="{{ route('reportMaterialOverviewSociety') }}">
        <div class="card card-info">
            <div class="card-header">
                <h1 class="card-title"><b> Resumén de material por sociedad</b></h1>
            </div>

            <div class="row pt-4 pl-4 pb-4 pr-4">
                <div class="col-md-3 col-sm-3 col-12 col-xs-12">
                    <div class="form-group">
                        <span class="info-box-text">Sociedades</span>
                            <select class="form-control select3" name="idSociety" id="idSocietyRemission">
                                <option></option>
                                @foreach ($societies as $society)
                                    <option value="{{ $society->id }}" {{$request->idSociety == $society->id  ? 'selected':''}}>{{ $society->person->pers_razonsocial }}</option>
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

                    <button class="btn btn-success btn-sm" onclick="exportExcelMaterialOverviewSociety(true)"
                        title="Generar excel"><i class="fa fa-file-excel" aria-hidden="true"
                            title="Exportar excel"></i></button>

                </div>

            </div>
            {{-- <a class="btn btn-danger btn-sm" onclick="downloadRemissionPdf()" target="_blank" title="Generar pdf"><i class="fa fa-file-pdf" aria-hidden="true"></i></a> --}}

            <div class="card-body p-0 mr-4 ml-4 mb-4" style="display: block;">
                <div class="table-responsive">
                    <table class="table" id="table-materialsOverviewSociety">
                        <thead class="table-primary">
                            <tr class="text-center">
                                <th scope="col">Razón social</th>
                                <th scope="col">Número de remisión</th>
                                <th scope="col">Nombre del material</th>
                                <th scope="col">Cantidad</th>
                            </tr>
                        </thead>
                        <tbody id="table-materialsOverviewSociety-remission">
                            @foreach ($materialsOverviewSocieties as $key=> $materialOverview)
                                <tr class="text-center">
                                    <td>{{ $materialOverview->pers_razonsocial}}</td>
                                    <td>{{ $materialOverview->num_remission ?? ''}}</td>
                                    <td>{{ $materialOverview->mate_descripcion }}</td>
                                    <td>{{ $materialOverview->dtrm_cantdespachada }}</td>
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

@extends('adminlte::page')
@section('title', 'Listado de novedades de remisiones')
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
            <h1 class="card-title"><b> Listado de novedades de remisiones</b></h1>
        </div>

        <div class="card-body">
            <div class="dataTables_wrapper dt-bootstrap4">
                <div class="row pl-4">
                    <div class="col-sm-12 col-md-6 mb-2">
                        <button class="btn btn-primary" onclick="createRemissionNovelty()" type="button">
                            <i class="fa fa-plus" aria-hidden="true"></i> Crear </button>
                    </div>
                </div>
                <form class="form-horizontal form-list-remission-nov">
                    <div class="row pt-4 pl-4 pb-4 pr-4">
                        <div class="col-md-4">
                            <label for="idRemision" style="font-size: 9pt">Num de remision</label>
                            <select class="form-control select3" name="rmnv_idremision" id="rmnv_idremisionnov">
                                <option></option>
                                @foreach ($remissions as $remission)
                                    <option value="{{ $remission->id }}">
                                        {{ $remission->num_remission }}-{{ $remission->Construction->obra_nombre }}
                                    </option>
                                @endforeach
                            </select>
                            {{-- -{{ $remission->Construction->Client->Person->pers_razonsocial }}-{{ $remission->Society->Person->pers_razonsocial ?? '' }} --}}
                        </div>
                        <div class="col-md-3">
                            <label for="idRemision" style="font-size: 9pt">Fecha inicial</label>
                            <input type="date" name="dateStart" class="form-control datepicker" id="dateStart"
                                autocomplete="off">
                        </div>
                        <div class="col-md-3">
                            <label for="idRemision" style="font-size: 9pt">Fecha final</label>
                            <input type="date" name="dateEnd" class="form-control datepicker" autocomplete="off"
                                id="dateEnd">
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="idRemision" style="font-size: 9pt">Acción</label><br>
                                <button class="btn btn-primary mt-2 mr-1 btn-sm" type="button" title="Filtar"
                                    onclick="filterConversionSalida()"><i class="fa fa-search" aria-hidden="true"
                                        title="Buscar"></i></button>
                                <button class="btn btn-secondary mt-2 mr-1 btn-sm" type="button" title="Limpiar filtro"
                                    onclick="clearFilter()"><i class="fa fa-eraser" aria-hidden="true"
                                        title="Limpiar filtro"></i></button>
                                <button class="btn btn-success mt-2 mr-1 btn-sm" type="button" title="Exportar excel"
                                    onclick="exportExcelRemissionNov()"><i class="fa fa-file-excel"
                                        aria-hidden="true"></i></button>

                            </div>
                        </div>
                        <div class="col-md-4 col-sm-64col-12 col-xs-12">
                            <div class="form-group">
                                <label for="idRemision" style="font-size: 9pt">Clientes</label>
                                <select class="form-control select3 obra_idcliente" name="idClient" id="idClientRemission"
                                    onchange="searchContructionClient()">
                                    <option></option>
                                    @foreach ($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->Person->pers_razonsocial }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-4 col-12 col-xs-12">
                            <div class="form-group">
                                <span class="info-box-text" style="font-size: 9pt"><b>Obras</b></span>
                                <select class="form-control select3 idObra" name="idConstruction" id="idConstruction">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-12 col-xs-12">
                            <div class="form-group">
                                <label for="idRemision" style="font-size: 9pt">Concepto de novedad</label>
                                <select class="form-control select3" name="conceptNoveltyRemission"
                                    id="conceptNoveltyRemission">
                                    <option></option>
                                    @foreach ($remissionconcnovs as $conceptNovelty)
                                        <option value="{{ $conceptNovelty->id }}">{{ $conceptNovelty->cncn_nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                </form>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table" id="table-remissionNov">
                                <thead class="table-primary">
                                    <tr>
                                        <th>
                                            ID
                                        </th>
                                        <th>
                                            # REMISIÓN
                                        </th>
                                        <th>
                                            CLIENTE
                                        </th>
                                        <th>
                                            OBRA
                                        </th>
                                        <th>
                                            CONCEPTO
                                        </th>
                                        <th>
                                            MATERIAL
                                        </th>
                                        <th>
                                            VALOR
                                        </th>
                                        <th>
                                            FECHA
                                        </th>
                                        <th>
                                            OBS
                                        </th>
                                        <th>
                                        </th>
                                        <th>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_novrem" name="tbody_novrem">
                                    @foreach ($remissionnovs as $remissionnov)
                                        <tr id="tr_{{ $remissionnov->id }}"
                                            @if ($remissionnov->rmnv_estado == 'I') style="color:#e3342f" @endif>
                                            <td>
                                                {{ $remissionnov->id }}
                                            </td>
                                            <td>
                                                {{ $remissionnov->Remission->num_remission ?? '' }}
                                            </td>
                                            <td>
                                                {{ $remissionnov->Remission->Construction->Client->Person->pers_razonsocial ?? '' }}
                                            </td>
                                            <td>
                                                {{ $remissionnov->Remission->Construction->obra_nombre ?? '' }}
                                            </td>
                                            <td>
                                                {{ $remissionnov->RemissionConcNovelty->cncn_nombre }}
                                            </td>
                                            <td>
                                                @if(isset($remissionnov->Remission->detailRemissions))
                                                    @foreach ($remissionnov->Remission->detailRemissions as $remission)
                                                        {{$remission->Material->mate_descripcion}}
                                                    @endforeach
                                                @endif
                                            </td>

                                            <td>
                                                {{ $remissionnov->rmnv_nuevovalor }}
                                                @if ($remissionnov->Client)
                                                    <b>Cliente:</b>
                                                    {{ $remissionnov->Client->Person->pers_razonsocial ?? '' }}<br>
                                                    <b>Obra:</b> {{ $remissionnov->Construction->obra_nombre ?? '' }}
                                                @endif
                                                {{ $remissionnov->rmnv_fecha }}
                                            </td>
                                            <td>
                                                {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $remissionnov->created_at)->format('Y-m-d') }}
                                            </td>
                                            <td>
                                                {{ $remissionnov->rmnv_obs }}
                                            </td>
                                            {{-- <td>
                                                {{ $remissionnov->rmnv_estado }}
                                            </td> --}}

                                            <td>

                                                <button class="btn btn-info btn-sm"
                                                    onclick="createRemissionNovelty({{ $remissionnov->id }},true)"
                                                    type="button">
                                                    <i class="fas fa-eye"  aria-hidden="true"></i>
                                                </button>

                                                @if ($remissionnov->rmnv_estado == 'A')
                                                    <button class="btn btn-primary btn-sm mt-1"
                                                        onclick="createRemissionNovelty({{ $remissionnov->id }},false)"
                                                        type="button">
                                                        <i class="fas fa-edit"  aria-hidden="true"></i>
                                                    </button>


                                                    <button class="btn btn-danger btn-sm mt-1"
                                                        onclick="deleteRemissionNovelty({{ $remissionnov->id }},'tr_{{ $remissionnov->id }}')"
                                                        type="button">
                                                        <i class="fas fa-trash"  aria-hidden="true"></i>
                                                    </button>
                                                @endif


                                            </td>
                                            <td> <a class="btn btn-sm" style="background-color: #900C3F;color: #fff"
                                                    href="{{ route('pdfReportRemissionNovelties', $remissionnov->id) }}"
                                                    target="_blank"><i class="fa fa-file-pdf" aria-hidden="true"></i></a>
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
@endsection
@include('layouts.modal')
@section('js')
    <script src="{{ asset('js/plugins/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/admin/validate.js') }}"></script>
    <script src="{{ asset('js/admin/admin.js') }}"></script>
    <script src="{{ asset('js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('js/util.js') }}"></script>
    <script src="{{ asset('js/remissionnovelties/functions.js') }}"></script>
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

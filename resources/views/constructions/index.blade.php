@extends('adminlte::page')
<!-- , ['iFrameEnabled' => true] -->
@section('title', 'Listado de obras')

@section('content_header')
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/sweetalert2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/select2.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/buttons.bootstrap4.min.css') }}">

@stop

@section('content')

    {{-- <section class="content">
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-primary" onclick="createContruction()" type="button">
                    Crear
                </button>
                <br>
                <div class="card card-info mt-2">
                    <div class="card-body p-0" style="display: block;"> --}}
    <div class="card card-info">
        <div class="card-header">
            <h1 class="card-title"><b>Listado de obras</b></h1>
        </div>

        <div class="card-body">
            <div class="">
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <button class="btn btn-primary" onclick="createContruction()" type="button">
                                <i class="fa fa-plus" aria-hidden="true"></i> Crear </button>
                        </div>
                    </div>
                    <div class="col-md- col-sm-3 col-12 col-xs-12">
                        <div class="form-group">
                            <span class="info-box-text">Clientes</span>
                            <select class="form-control select3" name="idClient" id="idClient">
                                <option></option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->Person->pers_razonsocial }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-12 col-xs-12">
                        <div class="form-group">
                            <span class="info-box-text">Estado</span>
                            <select class="form-control select3" name="status" id="status">
                                 <option></option>
                                <option value="A" selected>ACTIVO</option>
                                <option value="I">INACTIVO</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-12 col-xs-12">
                        <div class="form-group">
                            <span class="info-box-text">Acción</span><br>
                            <button class="btn btn-primary mr-1 btn-sm" type="button" title="Filtar"
                                onclick="filterContructionExcel(true)"><i class="fa fa-search" aria-hidden="true"
                                    title="Buscar"></i></button>
                            <button class="btn btn-secondary mr-1 btn-sm" type="button" title="Limpiar filtro"
                                onclick="clearFilter()"><i class="fa fa-eraser" aria-hidden="true"
                                    title="Limpiar filtro"></i></button>
                            <button class="btn btn-success mr-1 btn-sm" type="button" title="Exportar excel"
                                onclick="filterContructionExcel(false)"><i class="fa fa-file-excel"
                                    aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table" id="constructionTable">
                                <thead class="table-primary">
                                    <tr>
                                        <th>
                                            Id
                                        </th>
                                        {{-- <th>
                                            Id. Cliente
                                        </th> --}}
                                        <th>
                                            Cliente
                                        </th>
                                        <th>
                                            Nombre de Obra
                                        </th>
                                        <th>
                                            Dirección
                                        </th>
                                        <th>
                                            %Sumin.
                                        </th>
                                        <th>
                                            %Transp.
                                        </th>
                                        <th>
                                            Observaciones
                                        </th>
                                        <th>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_construction" name="tbody_construction">
                                    @foreach ($constructions as $construction)
                                        <tr id="tr_{{ $construction->id }}"
                                            @if ($construction->obra_estado == 'I') style="color:#e3342f" @endif>
                                            <td>
                                                {{ $construction->id }}
                                            </td>
                                            {{-- <td>
                                                {{ $construction->obra_idcliente }}
                                            </td> --}}
                                            <td>
                                                {{  $construction->Client->Person->pers_razonsocial ?? '' }}
                                            </td>
                                            <td>
                                                {{ $construction->obra_nombre }}
                                            </td>
                                            <td>
                                                {{ $construction->Client->Person->State->dpto_nombre }} -
                                                {{ $construction->Client->Person->City->ciud_nombre }} <br>
                                                {{ $construction->Client->Person->pers_direccion }}
                                            </td>
                                            <td>
                                                {{ $construction->obra_porcsuministro }}
                                            </td>
                                            <td>
                                                {{ $construction->obra_porctransporte }}
                                            </td>
                                            <td>
                                                {{ $construction->obra_obs }}
                                            </td>

                                            <td class="text-right py-0 align-middle">
                                                <div class="btn-group btn-group-sm">
                                                    <button class="btn btn-info mr-1"
                                                        onclick="createContruction({{ $construction->id }},true)"
                                                        type="button">
                                                        <i class="fas fa-eye">
                                                        </i>
                                                    </button>
                                                    <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
                                                    @if ($construction->obra_estado == 'A')
                                                        <button class="btn btn-primary mr-1"
                                                            onclick="createContruction({{ $construction->id }},false)"
                                                            type="button">
                                                            <i class="fas fa-edit">
                                                            </i>
                                                        </button>
                                                  
                                                
                                                    <button class="btn btn-danger"
                                                        onclick="deleteConstruction({{ $construction->id }},'tr_{{ $construction->id }}')"
                                                        type="button">
                                                        <i class="fas fa-trash">
                                                        </i>
                                                    </button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- <div class="offset-md-5"> {!! $constructions->links() !!} </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- </div>
                </br>
            </div>
        </div>
    </section> --}}
@stop
@include('layouts.modal')
{{-- @include('constructions.form') --}}
@section('js')
    <script src="{{ asset('js/plugins/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/admin/validate.js') }}"></script>
    <script src="{{ asset('js/admin/admin.js') }}"></script>
    <script src="{{ asset('js/util.js') }}"></script>
    <script src="{{ asset('js/construction/function.js') }}"></script>
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

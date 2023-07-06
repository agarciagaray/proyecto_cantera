@extends('adminlte::page')
<!-- , ['iFrameEnabled' => true] -->
@section('title', 'Listado de Proveedores')

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
                <button class="btn btn-primary" onclick="createSupplier()" type="button">
                    Crear
                </button>
                <br>
                <div class="card card-info mt-2">
                    <div class="card-body p-0" style="display: block;"> --}}
    <div class="card card-info">
        <div class="card-header">
            <h1 class="card-title"><b> Listado de proveedores</b></h1>
        </div>

        <div class="card-body">
            {{-- <div class="dataTables_wrapper dt-bootstrap4"> --}}
            <div class="row">
                <div class="col-sm-12 col-md-6 mb-2">
                    <button class="btn btn-primary" onclick="createSupplier()" type="button">
                        Crear
                    </button>
                </div>
                {{-- </div>
                <div class="row"> --}}
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-hover" id="table-supplier" style="width:100%">
                            <thead>
                                <tr>
                                    <th>
                                        Id
                                    </th>
                                    <th>
                                        Razón Social
                                    </th>
                                    <th>
                                        Dirección
                                    </th>
                                    <th>
                                        Datos adicionales
                                    </th>
                                    <th>
                                        Acción
                                    </th>
                                </tr>
                            </thead>
                            {{-- <thead class="table-primary">
                                <tr>
                                    <th>
                                        Id
                                    </th>
                                    <th>
                                        Razón Social
                                    </th>
                                    <th>
                                        Dirección
                                    </th>
                                    <th>
                                        Datos adicionales
                                    </th>
                                    <th>
                                        Acción
                                    </th>
                                </tr>
                            </thead> --}}
                            {{-- <tbody id="tbody_supplier" name="tbody_supplier"> --}}
                                {{-- @foreach ($suppliers as $supplier)
                                    <tr id="tr_supplier{{ $supplier->id }}"
                                        @if ($supplier->prov_estado == 'I') style="color:#e3342f" @endif>
                                        <td>
                                            {{ $supplier->id }}
                                        </td>
                                        <td>
                                            {{ $supplier->Person->pers_razonsocial }}<br>
                                            {{ $supplier->Person->pers_tipoid }} :
                                            {{ $supplier->Person->pers_identif }}<br>
                                            Digito de verficación:  {{ $supplier->codeVerification }}
                                        </td>
                                        <td>
                                            {{ $supplier->Person->City->State->dpto_nombre }} -
                                            {{ $supplier->Person->City->ciud_nombre }}<br>
                                            {{ $supplier->Person->pers_direccion }}
                                        </td>
                                        <td>
                                            {{ $supplier->Person->pers_primernombre . ' ' . $supplier->Person->pers_segnombre . ' ' . $supplier->Person->pers_primerapell . ' ' . $supplier->Person->pers_segapell ?? '' }}<br>
                                            TEL: {{ $supplier->Person->pers_telefono }}<br>

                                            {{ $supplier->Person->pers_email }}
                                        </td>

                                        <td class="text-right py-0 align-middle">
                                            <div class="btn-group btn-group-sm">
                                                <button class="btn btn-info mr-1"
                                                    onclick="createSupplier({{ $supplier->id }}, true)" type="button">
                                                    <i class="fas fa-eye">
                                                    </i>
                                                </button>
                                                <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
                                                @if ($supplier->prov_estado == 'A')
                                                <button class="btn btn-primary mr-1"
                                                    onclick="createSupplier({{ $supplier->id }},false,'{{ $supplier->Person->pers_tipoid }}')"
                                                    type="button">
                                                    <i class="fas fa-edit">
                                                    </i>
                                                </button>
                                                <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
                                                <button class="btn btn-danger"
                                                    onclick="deleteSupplier({{ $supplier->id }},'tr_{{ $supplier->id }}')"
                                                    type="button">
                                                    <i class="fas fa-trash">
                                                    </i>
                                                </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach --}}
                            {{-- </tbody> --}}
                        </table>
                    </div>
                </div>
                {{-- </div> --}}
                {{-- </div> --}}
            </div>
        </div>
    </div>
        {{--

                </div>
                </br>
            </div>
        </div>
    </section> --}}
    @stop
    @include('layouts.modal')
    {{-- @include('suppliers.form') --}}
    @section('js')
        <script src="{{ asset('js/plugins/sweetalert.min.js') }}"></script>
        <script src="{{ asset('js/plugins/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('js/admin/validate.js') }}"></script>
        <script src="{{ asset('js/admin/admin.js') }}"></script>
        <script src="{{ asset('js/plugins/select2.min.js') }}"></script>
        <script src="{{ asset('js/util.js') }}"></script>
        <script src="{{ asset('js/supplier/functions.js') }}"></script>
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

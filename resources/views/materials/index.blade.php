@extends('adminlte::page')
<!-- , ['iFrameEnabled' => true] -->
@section('title', 'Listado de Materiales')

@section('content_header')
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/sweetalert2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/select2.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/buttons.bootstrap4.min.css') }}">
    <h1>

    </h1>
@stop

@section('content')
    {{-- <section class="content">
        <div class="row">
            <div class="col-md-12">
     
                <br>
                <div class="card card-info mt-2">
                    <div class="card-body p-0" style="display: block;"> --}}
    <div class="card card-info">
        <div class="card-header">
            <h1 class="card-title"><b>Listado de materiales</b></h1>
        </div>

        <div class="card-body">
            <div id="clientTable" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12 col-md-6 mb-2">
                        <button class="btn btn-primary" onclick="createMaterial()" type="button">
                       <i class="fa fa-plus" aria-hidden="true"></i> Crear  </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table" id="table-material">
                                <thead class="table-primary">
                                    <tr>
                                        <th>
                                            Id
                                        </th>
                                        <th>
                                            Código
                                        </th>
                                        {{-- <th>
                                            Clasificación
                                        </th> --}}
                                        <th>
                                            Descripción
                                        </th>
                                        <th>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_material" name="tbody_material">
                                    @foreach ($materials as $material)
                                        <tr id="tr_{{ $material->id }}"
                                            @if ($material->mate_estado == 'I') style="color:#e3342f" @endif>
                                            <td>
                                                {{ $material->id }}
                                            </td>
                                            <td>
                                                {{ $material->mate_codigo }}
                                            </td>
                                            {{-- <td>
                                                {{ $material->mate_clasificacion }}
                                            </td> --}}
                                            <td>
                                                {{ $material->mate_descripcion }}
                                            </td>

                                            <td class="text-right py-0 align-middle">
                                                <div class="btn-group btn-group-sm">
                                                    <button class="btn btn-info mr-1"
                                                        onclick="createMaterial({{ $material->id }},true)" type="button">
                                                        <i class="fas fa-eye">
                                                        </i>
                                                    </button>
                                                    @if ($material->mate_estado == 'A')
                                                        <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
                                                        <button class="btn btn-primary mr-1"
                                                            onclick="createMaterial({{ $material->id }},false)"
                                                            type="button">
                                                            <i class="fas fa-edit">
                                                            </i>
                                                        </button>
                                                  
                                                    <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
                                                    <button class="btn {{ $material->mate_estado == 'A' ? 'btn-danger':'btn-success' }}"
                                                        onclick="deleteMaterial({{ $material->id }},'{{ $material->mate_estado == 'A' ? 'I' : 'A' }}')"
                                                        type="button">
                                                        @if ($material->mate_estado == 'A')
                                                            <i class="fas fa-trash"></i>
                                                        @else
                                                            <i class="fa fa-check" aria-hidden="true"></i>
                                                        @endif

                                                    </button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- <div class="offset-md-5"> {!! $materials->links() !!} </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- </div>

                </div>
                </br>
            </div>
        </div>
    </section> --}}
@stop
@include('layouts.modal')
{{-- @include('materials.form') --}}
@section('js')
    <script src="{{ asset('js/plugins/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/admin/validate.js') }}"></script>
    <script src="{{ asset('js/admin/admin.js') }}"></script>
    <script src="{{ asset('js/util.js') }}"></script>
    <script src="{{ asset('js/material/function.js') }}"></script>
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

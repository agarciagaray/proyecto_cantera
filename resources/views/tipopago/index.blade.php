@extends('adminlte::page')
<!-- , ['iFrameEnabled' => true] -->
@section('title', 'Listado de conceptos de novedades de remisiones')

@section('content_header')
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/sweetalert2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/select2.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/buttons.bootstrap4.min.css') }}">

@stop
@section('content')
    <div class="card card-info">
        <div class="card-header">
            <h1 class="card-title"><b>Listado de tipos de pago</b></h1>
        </div>

        <div class="card-body">
            <div class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12 col-md-6 mb-2">
                        @can('Crear tipo de pago')
                            <button class="btn btn-primary" onclick="createConceptNovelty()" type="button">
                                Crear
                            </button>
                        @endcan
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table" id="table-concnov">
                                <thead class="table-primary">
                                    <tr>
                                        <th>
                                            Id
                                        </th>
                                        <th>
                                            Nombre
                                        </th>
                                        {{-- <th>
                                            Estado
                                        </th> --}}
                                        <th>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_concnov" name="tbody_concnov">
                                    @foreach ($tipopago as $tipopago)
                                        <tr id="tr_{{ $remissionconcnovelty->id }}"
                                            @if ($remissionconcnovelty->cncn_estado == 'I') style="color:#e3342f" @endif>

                                            <td>
                                                {{ $tipopago->id_tipopago}}
                                            </td>
                                            <td>
                                                {{ $tipopago->descripcion }}
                                            </td>
                                            {{-- <td>
                                                {{ $tipopago->estado }}
                                            </td> --}}

                                            <td class="text-right py-0 align-middle">
                                                <div class="btn-group btn-group-sm">
                                                    <button class="btn btn-info mr-1"
                                                        onclick="createConceptNovelty({{ $tipopago->id_tipopago }},true)"
                                                        type="button">
                                                        <i class="fas fa-eye">
                                                            
                                                        </i>
                                                    </button>
                                                    <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
                                                    @if ($remissionconcnovelty->cncn_estado == 'A') 
                                                    @can('Editar un tipo de pago')
                                                        <button class="btn btn-primary mr-1"
                                                            onclick="createConceptNovelty({{ $tipopago->id_tipopago }},false)"
                                                            type="button">
                                                            <i class="fas fa-edit">
                                                            </i>
                                                        </button>
                                                    @endcan
                                             

                                                    <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
                                                    @can('Eliminar un tipo de pago')
                                                        <button class="btn btn-danger"
                                                            onclick="deleteConceptNovelty({{ $tipopago->id_tipopago }},'tr_{{ $tipopago->id_tipopago }}')"
                                                            type="button">
                                                            <i class="fas fa-trash">
                                                            </i>
                                                        </button>
                                                    @endcan
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- <divclass="offset-md-5">!!$tipopago->links()!!</div> --}}
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
@stop
@include('layouts.modal')
@section('js')
    <script src="{{ asset('js/plugins/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/admin/validate.js') }}"></script>
    <script src="{{ asset('js/admin/admin.js') }}"></script>
    <script src="{{ asset('js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('js/util.js') }}"></script>
    <script src="{{ asset('js/remissionconcnovelties/functions.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script><!-- Este es la ruta para llamar la funcon de JS-->
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons.colVis.min.js') }}"></script>
@stop

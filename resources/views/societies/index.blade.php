@extends('adminlte::page')
<!-- , ['iFrameEnabled' => true] -->
@section('title', 'Listado de Sociedades')

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
            <h1 class="card-title"><b>Listado de sociedades</b></h1>
        </div>

        <div class="card-body">
            <div id="clientTable" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12 col-md-6 mb-2">
                        <button class="btn btn-primary" onclick="createSociety()" type="button">
                       <i class="fa fa-plus" aria-hidden="true"></i> Crear  </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table" id="societyTable">
                                <thead class="table-primary">
                                    <tr>
                                        <th>
                                            Id
                                        </th>
                                        <th>
                                            Logo
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
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_society" name="tbody_society">
                                    @foreach ($societies as $society)
                                        <tr id="tr_society{{ $society->id }}"  @if ($society->soci_estado== 'I') style="color:#e3342f" @endif>
                                             <td>
                                                {{ $society->id }}
                                            </td>  
                                            <td>
                                                @if ($society->soci_nombrelogo)
                                                <img src="{{ asset($society->soci_nombrelogo)}}" class="img-xs">
                                                @else
                                                <img src="{{ asset('img/defualtSociety.png')}}" class="img-xs">
                                                @endif
                                               
                                            </td>  
                                            <td>
                                                {{ $society->Person->pers_razonsocial ?? '' }}<br>
                                                {{ $society->Person->pers_tipoid ?? '' }}: {{ $society->Person->pers_identif ?? '' }} 
                                            </td>
                                            <td>
                                                {{ $society->Person->State->dpto_nombre ?? '' }} - 
                                                {{ $society->Person->City->ciud_nombre ?? '' }}<br>
                                                {{ $society->Person->pers_direccion ?? '' }}
                                            </td>
                                            <td>
                                                {{ $society->Person->pers_primernombre .' '. $society->Person->pers_segnombre.' '.$society->Person->pers_primerapell .' '.$society->Person->pers_segapell  ?? '' }}<br>
                                                Tel : {{ $society->Person->pers_telefono ?? '' }}
                                            {{--  </td>
                                            <td>  --}}
                                                {{ $society->Person->pers_email ?? '' }}
                                            </td>
                                            {{-- <td>
                                                {{ $society->soci_estado ?? '' }}
                                            </td> --}}

                                            <td class="text-right py-0 align-middle">
                                                <div class="btn-group btn-group-sm">
                                                    <button class="btn btn-info mr-1"
                                                        onclick="createSociety({{ $society->id }},true)" type="button">
                                                        <i class="fas fa-eye">
                                                        </i>
                                                    </button>
                                                    <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
                                                    @if ($society->soci_estado== 'A')
                                                    <button class="btn btn-primary mr-1"
                                                        onclick="createSociety({{ $society->id }},false,'{{ $society->Person->pers_tipoid }}')"
                                                        type="button">
                                                        <i class="fas fa-edit">
                                                        </i>
                                                    </button>
                                                
                                                    <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
                                                    <button class="btn btn-danger"
                                                        onclick="deleteSociety({{ $society->id }},'tr_{{ $society->id }}')"
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
                            {{-- <div class="offset-md-5"> {!! $societies->links() !!} </div> --}}
                        </div>
                    </div>
                </div>
                </br>
            </div>
        </div>
    </div>

@stop
@include('layouts.modal')
{{-- @include('societies.form') --}}
@section('js')
    <script src="{{ asset('js/plugins/sweetalert.min.js') }}">
    </script>
    <script src="{{ asset('js/plugins/jquery.validate.min.js') }}">
    </script>
    <script src="{{ asset('js/admin/validate.js') }}">
    </script>
    <script src="{{ asset('js/admin/admin.js') }}">
    </script>
    <script src="{{ asset('js/plugins/select2.min.js') }}">
    </script>
    <script src="{{ asset('js/util.js') }}">
    </script>

    <script src="{{ asset('js/society/functions.js') }}">
    </script>

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

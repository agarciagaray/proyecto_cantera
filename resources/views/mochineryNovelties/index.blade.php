@extends('adminlte::page')
<!-- , ['iFrameEnabled' => true] -->
@section('title', 'Listado de novedades de maquinaria')

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
            <h1 class="card-title"><b> Listado de novedades de maquinaria</b></h1>
        </div>

        <div class="card-body">
            <div class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12 col-md-6 mb-2">
                        <button class="btn btn-primary" onclick="createMachineNovelty()" type="button">
                       <i class="fa fa-plus" aria-hidden="true"></i> Crear  </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table" id="table-machineryNov">
                                <thead class="table-primary">
                                    <tr>
                                        <th>Maquina</th>
                                        <th>Fecha</th>
                                        <th>Observaciones</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_machineOb" name="tbody_machineOb">
                                    @foreach ($machineObs as $machine)
                                        <tr @if ($machine->mqdt_estado== 'I') style="color:#e3342f" @endif>
                                            
                                            {{-- mqdt_estado --}}
                                            <td>{{ $machine->Machine->maqn_placa }}</td>
                                            <td>{{ $machine->mqdt_fecha }}</td>
                                            <td>{{ $machine->mqdt_obs }}</td>
                                            <td class="text-right py-0 align-middle">
                                                <div class="btn-group btn-group-sm">
                                                    <button class="btn btn-info mr-1 btn-sm"
                                                    onclick="createMachineNovelty({{ $machine->id }},true)" type="button">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
                                                    @if ($machine->mqdt_estado== 'A')
                                                    <button class="btn btn-primary mr-1 btn-sm" 
                                                        onclick="createMachineNovelty({{ $machine->id }},false)"
                                                        type="button">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                               
                                                    <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
                                                    <button class="btn btn-danger btn-sm"
                                                        onclick="deleteMochineNovely({{ $machine->id }})"
                                                        type="button">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                    @endif
                                                </div>
                                            </td>
                                            {{-- <td> --}}
                                                {{-- <button class="btn btn-info mr-1" onclick="createMachineNovelty({{ $machine->id }},true)"><i class="fa fa-eye" aria-hidden="true"></i></button>--}}
                                                {{-- <button class="btn btn-primary mr-1" onclick="createMachineNovelty({{ $machine->id }},false)"><i class="fas fa-edit"></i></button>--}}
                                                {{-- <button class="btn btn-danger" onclick="deleteMochineNovely({{ $machine->id }})"><i class="fa fa-trash" aria-hidden="true"></i></button>--}}
                                            {{-- </td> --}}
                                      
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- <divclass="offset-md-5">!!$machineObs->links()!!</div> --}}
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
    <script src="{{ asset('js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('js/mochineryNovelty/function.js') }}"></script>
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
@stop

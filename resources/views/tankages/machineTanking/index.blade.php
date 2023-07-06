@extends('adminlte::page')
<!-- , ['iFrameEnabled' => true] -->
@section('title', 'Listado de Tanqueo de Máquinas')

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
            <h1 class="card-title"><b> Listado de tanqueo de máquinas</b></h1>
        </div>

        <div class="card-body">
            <div class="dataTables_wrapper dt-bootstrap4">
                @can('Formulario de máquinas de tanqueo')
                    <div class="row">
                        <div class="col-sm-12 col-md-6 mb-2">
                            <button class="btn btn-primary" onclick="createMachineTanking()" type="button">
                                Crear
                            </button>
                        </div>
                    </div>
                @endcan
                <form action="{{ route('listMachineTanking') }}" >
                <div class="row">
                    <div class="col-md-3">
                        <label>Maquina</label>
                        <select class="form-control select3" name="tanq_idmaquina" id="tanq_idmaquina">
                            @foreach ($machines as $machine)
                                <option value="{{ $machine->id }}" {{ $request->mqdt_idmaquina == $machine->id ? 'selected' : '' }}>
                                    {{ $machine->maqn_placa }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="idRemision" style="font-size: 9pt">Fecha inicial</label>
                        <input type="date" name="dateStart" class="form-control datepicker" id="dateStart"
                            autocomplete="off" value="{{$request->dateStart}}">
                    </div>
                    <div class="col-md-3">
                        <label for="idRemision" style="font-size: 9pt">Fecha final</label>
                        <input type="date" name="dateEnd" class="form-control datepicker" autocomplete="off"
                            id="dateEnd" value="{{$request->dateEnd}}">
                    </div>
                    <div class="col-md-3 pb-2">
                        <span class="info-box-text">Acciones</span><br>
                        <button class="btn btn-primary btn-sm"><i class="fa fa-search" aria-hidden="true"></i></button>
                        <button class="btn btn-secondary btn-sm"  onclick="clearFilter()" type="button"><i class="fa fa-eraser"
                                aria-hidden="true"></i></button>
                    </div>
                </div>
                </form>

            <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table" id="table-MachineTanking">
                                <thead class="table-primary">
                                    <tr class="text-center">
                                        <th>Remisión</th>
                                        <th>Maquina</th>
                                        <th>Origen</th>
                                        <th>Fecha</th>
                                        <th>Volumén</th>
                                        <th>Unidad</th>
                                        <th>Observaciones</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="tbody-MachineTanking" name="tbody-MachineTanking">
                                    @foreach ($machineTankings as $machineTanking)

                                        <tr id="tr_{{ $machineTanking->id }}" class="text-center">
                                            <td> {{ $machineTanking->Fuelsshopping->ccmb_numremision ?? ''}}</td>

                                            <td> {{ $machineTanking->Machine->maqn_placa ?? '' }}  - {{  isset($machineTanking->Machine->MachineType) ? $machineTanking->Machine->MachineType->tmaq_nombre :''}}</td>
                                            <td>{{ $machineTanking->tanq_origen }}</td>
                                            <td>{{ $machineTanking->tanq_fecha }}</td>
                                            <td>{{ $machineTanking->tanq_volumen }}</td>
                                            <td>{{ $machineTanking->tanq_unidad }}</td>

                                            {{-- {{ asset('files\MachineTanking\profile-1647209289.pdf') }} --}}

                                            {{-- <td><a class="btn btn-danger" href="{{ asset($machineTanking->tanq_docsoporte )}}" target="_blank"><i class="fa fa-file-pdf" aria-hidden="true"></i></a></td> --}}
                                            <td>{{ $machineTanking->tanq_observaciones }}</td>
                                            <td class="text-right py-0 align-middle">
                                                <div class="btn-group btn-group-sm">
                                                    @can('Formulario de máquinas de tanqueo')
                                                        <button class="btn btn-info mr-1"
                                                            onclick="createMachineTanking({{ $machineTanking->id }},true)"><i
                                                                class="fa fa-eye" aria-hidden="true" type="button"></i></button>
                                                    @endcan
                                                    @can('Formulario de máquinas de tanqueo')
                                                        <button class="btn btn-primary mr-1"
                                                            onclick="createMachineTanking({{ $machineTanking->id }},false)"><i
                                                                class="fas fa-edit" type="button"></i></button>
                                                    @endcan
                                                    @can('Eliminar de máquinas de tanqueo')
                                                        <button class="btn btn-danger"
                                                            onclick="deleteMachineTanking({{ $machineTanking->id }})"><i
                                                                class="fa fa-trash" aria-hidden="true" type="button"></i></button>
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- <divclass="offset-md-5">!!$machineTankings->links()!!</div> --}}
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
    <script src="{{ asset('js/util.js') }}"></script>
    <script src="{{ asset('js/machineTanking/function.js') }}"></script>
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

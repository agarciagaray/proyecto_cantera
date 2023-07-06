@extends('adminlte::page')
<!-- , ['iFrameEnabled' => true] -->
@section('title', 'Listado de observaciones de máquinas')

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
            <h1 class="card-title"><b> Listado de observaciones de máquinas</b></h1>
        </div>

        <div class="card-body">
            <form action="{{ route('listObsMac') }}">
                <div class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12 col-md-3 mb-2">
                            <button class="btn btn-primary" onclick="createMachinesObs()" type="button">
                                <i class="fa fa-plus" aria-hidden="true"></i> Crear </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label>Maquina</label>
                            <select class="form-control select3" name="mqdt_idmaquina" id="mqdt_idmaquina">
                                @foreach ($machines as $machine)
                                    <option value="{{ $machine->id }}" {{ $request->mqdt_idmaquina == $machine->id ? 'selected' : '' }}>
                                        {{ $machine->maqn_placa }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Fecha inicial</label>
                            <input type="date" name="dateStart" class="form-control datepicker" id="dateStart"
                                autocomplete="off" value="{{ $request->dateStart }}">
                        </div>
                        <div class="col-md-3">
                            <label>Fecha final</label>
                            <input type="date" name="dateEnd" class="form-control datepicker" autocomplete="off"
                                id="dateEnd" value="{{ $request->dateEnd }}">
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Acción</label><br>
                                <button class="btn btn-primary mt-2 mr-1 btn-sm" type="submit" title="Filtar"><i
                                        class="fa fa-search" aria-hidden="true" title="Buscar"></i></button>
                                <button class="btn btn-secondary mt-2 mr-1 btn-sm" type="button" title="Limpiar filtro"
                                    onclick="clearFilter()"><i class="fa fa-eraser" aria-hidden="true"
                                        title="Limpiar filtro"></i></button>
                            </div>
                        </div>

                    </div>
            </form>
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table" id="table-machinesobs">
                            <thead class="table-primary">
                                <tr>
                                    <th>
                                        Id
                                    </th>
                                    <th>
                                        Placa
                                    </th>
                                    <th>
                                        Fecha y hora
                                    </th>
                                    {{-- <th>
                                            Hora
                                        </th> --}}
                                    <th>
                                        Obs
                                    </th>
                                    <th>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="tbody_machines-obs" name="tbody_machines-obs">
                                @foreach ($machinesobs as $machinesob)
                                    <tr id="tr_{{ $machinesob->id }}"
                                        @if ($machinesob->mqdt_estado == 'I') style="color:#e3342f" @endif>
                                        <td>
                                            {{ $machinesob->id }}
                                        </td>
                                        <td>
                                            {{ $machinesob->Machine->maqn_placa }}
                                        </td>
                                        <td>
                                            <b>{{ $machinesob->created_at }}</b>
                                        </td>
                                        <td>
                                            {{ $machinesob->mqdt_obs }}
                                        </td>
                                        {{-- <td>
                                                {{ $machinesob->mqdt_estado }}
                                            </td> --}}

                                        <td class="text-right py-0 align-middle">
                                            <div class="btn-group btn-group-sm">
                                                <button class="btn btn-info mr-1"
                                                    onclick="createMachinesObs({{ $machinesob->id }},true)" type="button">
                                                    <i class="fas fa-eye">
                                                    </i>
                                                </button>
                                                <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
                                                @if ($machinesob->mqdt_estado == 'A')
                                                    <button class="btn btn-primary mr-1"
                                                        onclick="createMachinesObs({{ $machinesob->id }},false)"
                                                        type="button">
                                                        <i class="fas fa-edit">
                                                        </i>
                                                    </button>

                                                    <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
                                                    <button class="btn btn-danger"
                                                        onclick="deleteMachineObs({{ $machinesob->id }},'tr_{{ $machinesob->id }}')"
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
                        {{-- <divclass="offset-md-5">!!$machinesobs->links()!!</div> --}}
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
    </div>
@stop
{{-- @include('machinesobs.form') --}}
@include('layouts.modal')
@section('js')
    <script src="{{ asset('js/plugins/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/admin/validate.js') }}"></script>
    <script src="{{ asset('js/admin/admin.js') }}"></script>
    <script src="{{ asset('js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('js/util.js') }}"></script>
    <script src="{{ asset('js/machineObs/functions.js') }}"></script>
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

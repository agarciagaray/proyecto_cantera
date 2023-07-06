@extends('adminlte::page')
<!-- , ['iFrameEnabled' => true] -->
@section('title', 'Listado de Otros Pagos')

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
            <h1 class="card-title"><b> Lista de viáticos y otros valores por máquina</b></h1>
        </div>

        <div class="card-body">
            <form action="{{ route('listViaticoOther') }}">
                <div class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12 col-md-2 mb-2">
                            <button class="btn btn-primary" onclick="createMachinePayment()" type="button">
                                Crear
                            </button>

                        </div>
                        <div class="col-sm-12 col-md-3 mb-2">
                            <label>Maquina</label>
                        <select class="form-control select3" name="id_machine" id="plate_vehicleRemission">
                            <option></option>
                            @foreach ($machines as $machine)
                                <option value="{{ $machine->id }}" {{ $request->id_machine == $machine->id ? 'selected' : '' }}>
                                    {{ $machine->maqn_placa }}</option>
                            @endforeach
                        </select>
                        </div>
                        <div class="col-md-2">
                            <label>Fecha inicial</label>
                            <input type="date" name="dateStart" class="form-control datepicker" id="dateStart"
                                autocomplete="off" required value="{{ $request->dateStart }}">
                        </div>
                        <div class="col-md-2">
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
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table" id="table-viaticoOther">
                                <thead class="table-primary">
                                    <tr>
                                        <th>Maquina</th>
                                        <th>Concepto</th>
                                        <th>Fecha</th>
                                        <th>Valor pagado</th>
                                        <th>Observación</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_viaticoOther" name="tbody_viaticoOther">
                                    @foreach ($viaticoOthers as $viaticoOther)
                                        <tr id="tr_{{ $viaticoOther->id }}"
                                            @if ($viaticoOther->mqpg_estado == 'I') style="color:#e3342f" @endif>
                                            <td>{{ $viaticoOther->Machine->maqn_placa }}</td>
                                            <td>{{ $viaticoOther->ConceptPayment->cncp_nombre }}</td>
                                            <td>{{ $viaticoOther->mqpg_fecha }}</td>
                                            <td>{{ $viaticoOther->mqpg_vlrpagado }}</td>
                                            <td>{{ $viaticoOther->mqpg_obs }}</td>
                                            <td>
                                                <button class="btn btn-secondary btn-sm"
                                                    onclick="createMachinePayment({{ $viaticoOther->id }},true)"
                                                    type="button"><i class="fa fa-eye" aria-hidden="true"></i></button>


                                                @if ($viaticoOther->mqpg_estado == 'A')
                                                    <button class="btn btn-primary btn-sm"
                                                        onclick="createMachinePayment({{ $viaticoOther->id }},false)"
                                                        type="button"><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-danger btn-sm"
                                                        onclick="deleteMachinePayment({{ $viaticoOther->id }})"
                                                        type="button"><i class="fa fa-trash"
                                                            aria-hidden="true"></i></button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- <divclass="offset-md-5">!!$viaticoOthers->links()!!</div> --}}
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
    <script src="{{ asset('js/machinePayment/function.js') }}"></script>
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

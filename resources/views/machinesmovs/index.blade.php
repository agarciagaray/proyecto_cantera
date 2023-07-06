@extends('adminlte::page')
<!-- , ['iFrameEnabled' => true] -->
@section('title', 'Listado de movimientos de máquinas')

@section('content_header')
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/sweetalert2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/select2.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/buttons.bootstrap4.min.css') }}">

@stop

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">

                {{-- @csrf --}}
                <div class="card card-info">
                    <div class="card-header">
                        <h1 class="card-title"><b>Listado de movimientos de máquinas</b></h1>
                    </div>
                    <div class="card-body p-0" style="display: block;">
                        <div class="col-md-12 ml-3 mr-3 mt-3">
                            <button class="btn btn-primary" onclick="createMachineMov()" type="button">
                                Crear
                            </button>
                        </div>
                        <form class="form-horizontal form-list-mov-machine">
                            <div class="row pt-4 pl-4 pb-4 pr-4">
                                <div class="col-md-4">
                                    <span class="info-box-text">Maquinas (PLACA)</span>
                                    <select class="form-control select3" name="idMachine" id="idMachine">
                                        <option value=""></option>
                                        @foreach ($machines as $machine)
                                            <option value="{{ $machine->id }}">
                                                {{ $machine->maqn_placa }} -
                                                {{ $machine->MachineType->tmaq_nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>





                                
                           
                    <div class="col-3 col-sm-2 mb-3">
                    <div class="form-group">
                    <span class="info-box-text">Conductor</span>
                    <select class="form-control select3" name="id_conductor" id="id_conductor">
                               <option ></option>
                                        @foreach ($drivers as $driver)
                                            <option value="{{ $driver->id}}">
                                                {{ $driver->id }} -
                                                {{ $driver->person->pers_primernombre}}
                                            </option>
                                        @endforeach
                                    </select>  
                            </div>
                        </div>
             



                                <div class="col-md-3">
                                    <span class="info-box-text">Fecha inicial</span>
                                    <input type="date" name="dateStart" class="form-control datepicker" id="dateStart"
                                        autocomplete="off" required>
                                </div>
                                <div class="col-md-3">
                                    <span class="info-box-text">Fecha final</span>
                                    <input type="date" name="dateEnd" class="form-control datepicker" autocomplete="off" id="dateEnd"
                                       required>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <span class="info-box-text">Acción</span><br>
                                        <button class="btn btn-primary mt-2 mr-1 btn-sm" type="button" title="Filtar" onclick="filterMovMaq()"><i class="fa fa-search" aria-hidden="true" title="Buscar"></i></button>
                                        <button class="btn btn-secondary mt-2 mr-1 btn-sm" type="button"  title="Limpiar filtro" onclick="clearFilter()"><i class="fa fa-eraser" aria-hidden="true" title="Limpiar filtro"></i></button>
                                        <button class="btn btn-success mt-2 mr-1 btn-sm" type="button"  title="Exportar excel" onclick="exportExcelMovMaq()"><i class="fa fa-file-excel" aria-hidden="true"
                                              ></i></button>

                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="card-body p-0 pt-2 pl-4 pr-4 pb-4">
                            <div class="table-responsive">
                                <table class="table" id="table-machineMov" style="width:100%">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>
                                                Id.
                                            </th>
                                            <th>
                                                Placa
                                            </th>
                                            <th>
                                                Fecha
                                            </th>
                                            <th>
                                                Horometro
                                            </th>
                                            <th>
                                                Horas
                                            </th>
                                            <th>
                                                Cantidad
                                            </th>
                                            <th>
                                                Vlr
                                            </th>
                                            <th>
                                                Observación
                                            </th>
                                            <th>
                                                #id.Conductor
                                            </th>
                                            <th>
                                                Acción
                                            </th>
                                        </tr>
                                    </thead>
                                    {{-- <tbody id="tbody_machine_mov" name="tbody_machine_mov">
                                        @foreach ($machinesmovs as $machinemov)
                                            <tr id="tr_{{ $machinemov->id }}"
                                                @if ($machinemov->mqmv_estado == 'I') style="color:#e3342f" @endif>
                                                <td>{{ $machinemov->id }}</td>
                                                <td>{{ $machinemov->Machine->maqn_placa }}</td>
                                                <td>{{ $machinemov->mqmv_fecha ?? '' }}</td>
                                                <td>{{ $machinemov->horometro_hinicio }} - {{  $machinemov->horometro_hfinal }}
                                                </td>
                                                <td>{{ $machinemov->mqmv_hinicio }} - {{ $machinemov->mqmv_hfin }}</td>
                                                <td>
                                                    @if($machinemov->mqmv_hinicio && $machinemov->mqmv_hfin )
                                                   {{ $machinemov->hourDiff($machinemov->mqmv_hinicio ?? 0,$machinemov->mqmv_hfin ?? 0)}}
                                                   @else
                                                   {{  $machinemov->rest(doubleval($machinemov->horometro_hinicio)??00.00 ,doubleval($machinemov->horometro_hfinal)??00.00 ) }}
                                                   @endif
                                                </td>
                                                <td>{{ $machinemov->mqmv_vlrhora }}</td>
                                                <td>{{ $machinemov->mqmv_obs }}</td>
                                                <td>{{ $machinemov->id_conductor }}</td>
                                                <td class="text-right py-0 align-middle">
                                                    <div class="btn-group btn-group-sm">
                                                        <button class="btn btn-info mr-1"
                                                            onclick="createMachineMov({{ $machinemov->id }},true)"
                                                            type="button">
                                                            <i class="fas fa-eye">
                                                            </i>
                                                        </button>
                                                        @if ($machinemov->mqmv_estado == 'A')
                                                            <button class="btn btn-primary mr-1"
                                                                onclick="createMachineMov({{ $machinemov->id }},false)"
                                                                type="button">
                                                                <i class="fas fa-edit">
                                                                </i>
                                                            </button>
                                                        <button class="btn btn-danger"
                                                            onclick="deleteMachineMov({{ $machinemov->id }},'tr_{{ $machinemov->id }}')"
                                                            type="button">
                                                            <i class="fas fa-trash">
                                                            </i>
                                                        </button>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody> --}}
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@stop
{{-- @include('machinesmovs.form') --}}
@include('layouts.modal')
@section('js')
    <script src="{{ asset('js/plugins/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/admin/validate.js') }}"></script>
    <script src="{{ asset('js/admin/admin.js') }}"></script>
    <script src="{{ asset('js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('js/util.js') }}"></script>
    <script src="{{ asset('js/machineMov/functions.js') }}"></script>

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


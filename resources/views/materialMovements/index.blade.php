@extends('adminlte::page')

<!-- , ['iFrameEnabled' => true] -->
@section('title', 'Listado de material en movimiento')

@section('content_header')
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/select2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/sweetalert2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/buttons.bootstrap4.min.css') }}">

@stop

@section('content')
    <div class="card card-info">
        <div class="card-header">
            <h1 class="card-title"><b> Listado de material en movimiento</b></h1>
        </div>

        <div class="card-body">
            <div class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12 col-md-6 mb-2">
                        <button class="btn btn-primary" onclick="createMaterialMovement()" type="button">
                       <i class="fa fa-plus" aria-hidden="true"></i> Crear  </button>
                    </div>
                </div>
                <form action="{{ route('listMaterialMovement') }}" class="idProductionReport">
                    <div class="row pt-4  pb-0 pr-4">
                        <div class="col-md-3">
                            <div class="form-group">
                                <span class="info-box-text">Tipo de operación</span>
                                <select class="form-control select3" name="typeProductionMaterial" id="typeProductionMaterial">
                                    <option value=""></option>
                                    <option value="I">INVENTARIO</option>
                                    <option value="S">SALIDA</option>
                                </select>
                            </div>
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
                        <div class="col-md-3">
                            <span class="info-box-text">Acciones</span><br>
                            <button class="btn btn-primary btn-sm"><i class="fa fa-search" aria-hidden="true"></i></button>
                            <button class="btn btn-secondary btn-sm"><i class="fa fa-eraser"
                                    aria-hidden="true"></i></button>
                            <a class="btn btn-success btn-sm" onclick="downloadProductionsExcel()" target="_blank"
                                title="Generar excel"><i class="fa fa-file-excel" aria-hidden="true"
                                    title="Exportar excel"></i></a>

                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table" id="table-MaterialMov">
                                <thead class="table-primary">
                                    <tr>
                                        <th>Id</th>
                                        <th>Tipo</th>
                                        <th>Deposita</th>
                                        <th>Depositado en</th>
                                        <th>Materia prima</th>
                                        <th>Material</th>
                                        <th>Fecha</th>
                                        <th># de viajes</th>
                                        <th>Cubicaje</th>
                                        <th>Volumen</th>
                                        <th>Opcion</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_production">
                                    @foreach ($productions as $production)
                                        {{-- mqmv_estado --}}

                                        <tr @if ($production->prod_estado == 'I') style="color:#e3342f" @endif>
                                            <td>{{ $production->id }}</td>
                                            <td>{{ $production->typeProduction }}</td>
                                            <td>{{ $production->Machine->maqn_placa ?? '' }}</td>
                                            <td>{{ $production->Device->disp_descripcion ?? '' }}</td>
                                            <td>{{ $production->Commodity->matp_descripcion ?? '' }}</td>
                                            <td>{{ $production->Material->mate_descripcion ?? '' }}</td>
                                            <td>{{ $production->prod_fecha }}</td>
                                            <td>{{ $production->prod_numviajes }}</td>
                                            <td>{{ $production->prod_cubicaje }}</td>
                                            <td>{{ $production->prod_volumen }}</td>
                                            <td> @foreach ($production->Options_ as $Option)
                                                 {{$Option->nom_option}}
                                                @endforeach</td>
                                            <td class="text-right py-0 align-middle">
                                                <div class="btn-group btn-group-sm">
                                                    <button class="btn btn-info mr-1"
                                                        onclick="createMaterialMovement({{ $production->id }},true)"><i
                                                            class="fa fa-eye" aria-hidden="true"></i></button>
                                                    @if ($production->prod_estado == 'A')
                                                        <button class="btn btn-primary mr-1"
                                                            onclick="createMaterialMovement({{ $production->id }},false)"><i
                                                                class="fas fa-edit"></i></button>

                                                    <button class="btn btn-danger"
                                                        onclick="deleteMaterialMovement({{ $production->id }})"><i
                                                            class="fa fa-trash" aria-hidden="true"></i></button>
                                                            @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- <div class="offset-md-5"> {!! $productions->links() !!} </div> --}}
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
    <script src="{{ asset('js/materialMovement/function.js') }}"></script>
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

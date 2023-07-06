@extends('adminlte::page')
<!-- , ['iFrameEnabled' =>
true] -->
@section('title', ' Control de inventario')

@section('content_header')

    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/select2.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/buttons.bootstrap4.min.css') }}">

@endsection
@include('layouts.alert')
@section('content')

    <form class="form-horizontal form-inventoryControl" action="{{ route('inventoryControl') }}">
        <div class="card card-info ">
            <div class="card-header">
                <h1 class="card-title"><b>Control de inventario</b></h1>
            </div>
            <div class="row pt-4 pl-4 pb-0 pr-4">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Material</label>
                        <select class="form-control select3 prod_idmaterial" name="prod_idmaterial" id="prod_idmaterial"
                            >
                            <option></option>
                            @foreach ($materials as $material)
                                <option value="{{ $material->id }}"
                                    {{ $material->id == $request->prod_idmaterial ? 'selected' : '' }}>
                                    {{ $material->mate_descripcion }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @php
                    $date = \Carbon\Carbon::now();
                @endphp
                <div class="col-md-3 col-6 col-xs-6">
                    <label>Fecha inicial</label>
                    <input type="date" name="dateStart" class="form-control" id="dateStart"
                        value="{{ !isset($request->dateStart) ? \Carbon\Carbon::now()->startOfMonth()->subMonth()->toDateString():$request->dateStart }}" autocomplete="off">
                </div>
                <div class="col-md-3 col-6 col-xs-6">
                    <label>Fecha final</label>
                    <input type="date" name="dateEnd" class="form-control" autocomplete="off" id="dateEnd"
                        value="{{ !isset($request->dateEnd) ? $date->format('Y-m-d') : $request->dateEnd }}">
                </div>
                <div class="col-md-2">
                    <label>Acciones</label><br>
                    <button class="btn btn-primary btn-sm"><i class="fa fa-search" aria-hidden="true"></i></button>
                    <button class="btn btn-secondary btn-sm" onclick="clearFilter()" type="button"><i class="fa fa-eraser"
                            aria-hidden="true"></i></button>
                    <button class="btn btn-success btn-sm" onclick="reportExcelInventoryMaterial()" type="button"><i
                            class="fa fa-file-excel" aria-hidden="true"></i></button>
                </div>
            </div>
            <div class="card-body ">

                <div class="table-responsive">
                    <table class="table" id="table-inventory-control">
                        <thead class="table-primary">
                            <tr class="text-center">
                                {{-- <th>#</th> --}}
                                <th>Fecha</th>
                                <th>Tipo de movimiento</th>
                                <th>Material</th>
                                <th>+ Entrada inventario</th>
                                <th class="text-danger">- Salida por venta</th>
                                <th>+ Ingreso manual</th>
                                <th>Cantidad final</th>

                            </tr>
                        </thead>
                        <tbody>

                            @php
                                $total = 0;
                                $totalres = 0;
                                $totalrestante = 0;
                            @endphp
                            @foreach ($materialInventory as $key => $material)
                                <tr style="{{ $key == 0 ? 'background:#343a40;color:white' : '' }}">
                                    {{-- <td class="text-center">
                                        @if ($material->typeProduction == null)

                                        @else
                                            {{ $material->id }}
                                        @endif
                                    </td> --}}
                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($material->prod_fecha)->format('d/m/Y') }}
                                    </td>
                                    <td class="text-center">
                                        @if ($material->typeProduction == 'S')
                                            SALIDA
                                        @elseif ($material->typeProduction == 'I')
                                            INVENTARIO
                                        @else
                                            VENTAS
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ $material->mate_descripcion }}
                                    </td>

                                    <td class="text-center text-success">
                                        <b>
                                            @if ($material->typeProduction == 'S')
                                                {{ $material->salida_pro }}
                                            @endif
                                        </b>
                                    </td>
                                    <td class="text-center text-danger">
                                        <b>
                                            @if ($material->typeProduction == "V")
                                                {{ $material->salida_sale }}
                                            @endif
                                        </b>
                                    </td>
                                    <td class="text-center text-success">
                                        <b>
                                            @if ($material->typeProduction == 'I')
                                                {{ $material->salida_pro }}
                                            @endif
                                        </b>
                                    </td>
                                    @php
                                        $total += $material->salida_pro;
                                        $totalres += $material->salida_sale;
                                        $totalrestante = $total - $totalres;
                                    @endphp
                                    <td class="text-center {{ $totalrestante > 0 ? 'text-success' : 'text-danger' }}">
                                        <b>
                                            @if ($material->typeProduction == 'S')
                                                {{ $total }}
                                            @elseif ($material->typeProduction == 'I')
                                                {{ $total }}
                                            @else
                                                {{ $totalrestante }}
                                            @endif
                                        </b>
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('js')

    <script src="{{ asset('js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('js/util.js') }}"></script>
    <script src="{{ asset('js/inventory/functions.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons.colVis.min.js') }}"></script>
@endsection

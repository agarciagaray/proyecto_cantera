@extends('adminlte::page')
<!-- , ['iFrameEnabled' => true] -->
@section('title', 'Listado de descargas')

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
            <h1 class="card-title"><b> Listado de descargas de combustible</b></h1>
        </div>

        <div class="card-body">
            <div class="dataTables_wrapper dt-bootstrap4">
                {{--  @can('Formulario de descarga de carrotanque')  --}}
                <div class="row">
                    <div class="col-sm-12 col-md-6 mb-2">
                        <button class="btn btn-primary" onclick="createFuelsShoopping()" type="button">
                            Crear
                        </button>
                    </div>
                </div>
                {{--  @endcan  --}}
                <form action="{{ route('listMachineTanking') }}">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="idRemision" style="font-size: 9pt">Fecha inicial</label>
                            <input type="date" name="dateStart" class="form-control datepicker" id="dateStart"
                                autocomplete="off" value="{{ $request->dateStart }}">
                        </div>
                        <div class="col-md-3">
                            <label for="idRemision" style="font-size: 9pt">Fecha final</label>
                            <input type="date" name="dateEnd" class="form-control datepicker" autocomplete="off"
                                id="dateEnd" value="{{ $request->dateEnd }}">
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
                            <table class="table" id="table-fuelsShopping">
                                <thead class="table-primary">
                                    <tr>
                                        <th style="text-align:center">Proveedor</th>
                                        <th style="text-align:center">Fecha</th>
                                        <th style="text-align:center">Número de remisión</th>
                                        <th style="text-align:center">Volumen</th>
                                        <th style="text-align:center">Unidad</th>
                                        <th style="text-align:center">Valor de unidad</th>
                                        <th style="text-align:center">Observaciones</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="tbody-fuelsShopping" name="tbody-fuelsShopping">

                                    @foreach ($fuelsshoppings as $fuelsshopping)
                                        <tr>
                                            <td style="text-align:center">
                                                @if (is_null($fuelsshopping->Supplier->Person->pers_razonsocial?? '' ))
                                                    {{ $fuelsshopping->Supplier->prov_identif ?? '' }}
                                                    {{ $fuelsshopping->Supplier->Person->pers_primernombre ?? '' }}
                                                    {{ $fuelsshopping->Supplier->Person->pers_segnombre ?? '' }}
                                                    {{ $fuelsshopping->Supplier->Person->pers_primerapell ?? '' }}
                                                    {{ $fuelsshopping->Supplier->Person->pers_segapell ?? '' }}
                                                @else
                                                    {{ $fuelsshopping->Supplier->prov_identif }}{{ $fuelsshopping->Supplier->Person->pers_razonsocial ?? '' }}
                                                @endif

                                            </td>

                                            <td style="text-align:center">{{ $fuelsshopping->ccmb_fechadescarga }}</td>
                                            <td style="text-align:center">{{ $fuelsshopping->ccmb_numremision }}</td>
                                            <td style="text-align:center">{{ $fuelsshopping->ccmb_volumen }}</td>
                                            <td style="text-align:center">{{ $fuelsshopping->ccmb_unidad }}</td>
                                            <td style="text-align:center">{{ $fuelsshopping->ccmb_vlrunidad }}</td>
                                            <td style="text-align:center">{{ $fuelsshopping->ccmb_observaciones }}</td>
                                            <td class="text-right py-0 align-middle" style="text-align:center">
                                                <div class="btn-group btn-group-sm">
                                                    @can('Formulario de Descarga de carrotanque')
                                                        <button class="btn btn-primary mr-1"
                                                            onclick="createFuelsShoopping({{ $fuelsshopping->id }},false)"><i
                                                                class="fas fa-edit"></i></button>
                                                    @endcan
                                                    @can('Formulario de Descarga de carrotanque')
                                                        <button class="btn btn-info mr-1"
                                                            onclick="createFuelsShoopping({{ $fuelsshopping->id }},true)"><i
                                                                class="fa fa-eye" aria-hidden="true"></i></button>
                                                    @endcan
                                                    @can('Eliminar de Descarga de carrotanque')
                                                        <button class="btn btn-danger"
                                                            onclick="deleteFuelsShoopping({{ $fuelsshopping->id }})"><i
                                                                class="fa fa-trash" aria-hidden="true"></i></button>
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>
                            {{-- <divclass="offset-md-5">!!$fuelsshoppings->links()!!</div> --}}
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
    <script src="{{ asset('js/fuelsShopping/function.js') }}"></script>
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

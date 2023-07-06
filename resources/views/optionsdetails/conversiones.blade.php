@extends('adminlte::page')
<!-- , ['iFrameEnabled' => true] -->
@section('title', 'Aprobacion de opciones')

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
            <h1 class="card-title"><b>% De los materiales en funcion de salida</b></h1>
        </div>

        <div class="card-body">
            <div class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12 col-md-6 mb-2">
                       
                       <form class="form-horizontal formOpcionAssignment" action="{{ route('conversionesporcentajes')}}">


                     <div class="row">
                       
                            <div class="col-md-4 col-sm-4 col-12 col-xs-12">
                                    
                                 
                                </div>

                                <div class="col-md-3">
                            <label for="prod_fecha_1" style="font-size: 9pt">Fecha inicial</label>
                            <input type="date" name="prod_fecha_1" class="form-control datepicker" id="prod_fecha_1"
                                autocomplete="off">
                        </div>
                        <div class="col-md-3">
                            <label for="prod_fecha_2" style="font-size: 9pt">Fecha final</label>
                            <input type="date" name="prod_fecha_2" class="form-control datepicker" autocomplete="off"
                                id="prod_fecha_2">
                        </div>

                            <div class="col-md-4 col-sm-4 col-12 col-xs-12">
                                <label style="font-size: 8pt">Acción</label>
                                <a class="btn btn-primary btn-sm"><i class="fa fa-search" aria-hidden="true"
                                        onclick="filterSalidaPorcentajeAssigmen()"></i></a>
                                <a class="btn btn-secondary btn-sm" onclick="clearFilter()"><i class="fa fa-eraser"
                                        aria-hidden="true" target="_blank"></i></a>

                                <a class="btn btn-success btn-sm"  title="Exportar pantalla"
                                onclick="remittancePorcentajeAsignadoExcel()"> <i class="fa fa-file-excel" aria-hidden="true"></i></a>
                              

                            </div>
                        </div>
                    </form>
                       
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table" id="table-optionsdetails">
                                <thead class="table-primary">
                                    <tr>
                                        <th>
                                            Id
                                        </th>
                                        <th>
                                            Opcion
                                        </th>

                                        <th>
                                            Material
                                        </th>
                                        <th>
                                            %
                                        </th>
                                        <th>
                                            Cantidad
                                        </th>
                                        <th>
                                            Total
                                        </th>
                                      
                                          
                                        <th>
                                            
                                        </th>
                                    <!--    {{-- <th>
                                            Estado
                                        </th> --}}-->
                                        <th>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_optionsdetails" name="tbody_optionsdetails">
                                    @foreach ($productions as $production)
                                    <tr id="tr_{{ $production->id }}"
                                    @if ($production->estado == 'I') style="color:#e3342f" @endif>
                                    <td>
                                        {{ $production->Production->id}}
                                    </td>
                                    <td>
                                        {{
                                            $production->Production->nom_option
                                        }}
                                    </td>
                                    </tr>
                                    @foreach ($production->Production->detailOptions as $detail)
                                    <tr>
                                        <td>

                                        </td>
                                        <td>
                                            
                                            </td>
                                            <td>
                                                    {{$detail->Material->mate_descripcion}}
                                            </td>
                                            <td>
                                            {{$detail->porcentaje}}
                                            </td>
                                            <td>
                                            {{(($detail->porcentaje * $production->prod_volumen)/100)}}
                                            </td>
                                            @endforeach
                                            <td>
                                                {{$production->prod_volumen}}
                                            </td>  
                                            <td>
                                             
                                            </td>   
                                  
                                        @endforeach
                                    </tbody>
                                </table>
                            {!!$productions->links()!!}
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
@stop
@include('layouts.modal')
{{-- @include('options.form') --}}
@section('js')
    <script src="{{ asset('js/plugins/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/admin/validate.js') }}"></script>
    <script src="{{ asset('js/admin/admin.js') }}"></script>
    <script src="{{ asset('js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('js/util.js') }}"></script>
    
    <script src="{{ asset('js/options/functions.js') }}"></script>

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

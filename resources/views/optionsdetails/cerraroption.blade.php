@extends('adminlte::page')
<!-- , ['iFrameEnabled' => true] -->
@section('title', 'Aprobacion porcentaje')

@section('content_header')
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/sweetalert2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/select2.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/datatables/buttons.bootstrap4.min.css') }}">

@stop
@section('content')
    <form class="form-send-optionsdetail-assign">
        {{-- @csrf --}}
        <div class="card card-info">
            <div class="card-header">
                <h1 class="card-title"><b>Aprobacion de porcentaje</b></h1>
            </div>

            <div class="card-body">
                <div class="dataTables_wrapper dt-bootstrap4">
                                                                                         
                    <form class="form-horizontal formOpcionAssignment" action="{{ route('cerrarop')}}">
                     <div class="row">
                          <!--
                            <div class="col-md-4 col-sm-4 col-12 col-xs-12">
                                <div class="form-group">
                                      <label style="font-size: 8pt">Opciones</label>
                                    <select class="form-control select3 _idOption" name="_idOption" id="_idOption"
                                        onchange="searchPorcentajeMateriales()">
                                        <option></option>
                                        @foreach ($options as $option)
                                            <option value="{{$option->id }}">{{$option->nom_option}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>-->
                            <div class="col-md-4 col-sm-4 col-12 col-xs-12">
                                    <label for="plate_vehicle" style="font-size: 8pt">Opcion</label>
                                 
                                    <select class="form-control select2"  name="options_id" id="options_id" >
                                        <option></option>
                                        @foreach ($Abiertas as $option)

                                        
                                            <option value="{{$option->options_id}}">{{$option->Production->nom_option}}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" class="form-control" placeholder="Opciones" title="Opciones" name="options_id" id="options_id" required tabindex="1">
                                </div>


                         <!--
                            <div class="col-12 col-sm-2 mb-3">
                                <label style="font-size: 8pt">Fecha inicial</label>
                                <input type="date" name="dateStart" id="dateStart" class="form-control"
                                    autocomplete="off" value="{{ $request->dateStart ?? '' }}" required>
                            </div>
                            <div class="col-12 col-sm-2 mb-3">
                                <label style="font-size: 8pt">Fecha final</label>
                                <input type="date" name="dateEnd" id="dateEnd" class="form-control" autocomplete="off"
                                    value="{{ $request->dateEnd ?? '' }}" required>
                            </div>

                            -->
                            <input type="hidden" value="C" name="statusInvoice" id="statusInvoice">
          

                            <div class="col-12 col-sm-2 mb-3">
                                <a class="btn btn-info btn-sm mt-3" onclick="savePorcentajeAssignment('C')"
                                    ><i class="fas fa-list"></i>Cerrar</a>
                                    {{--  preSettlementPorcentajeAssigment  --}}
                            </div>
                            
                            <div class="col-12 col-sm-2 mb-3">
                                <label style="font-size: 8pt">Acción</label>
                                <a class="btn btn-primary btn-sm"><i class="fa fa-search" aria-hidden="true"
                                        onclick="filterPorcentajeAssigment()"></i></a>
                                <a class="btn btn-secondary btn-sm" onclick="clearFilter()"><i class="fa fa-eraser"
                                        aria-hidden="true" target="_blank"></i></a>

                             
                            </div>
                        </div>
                    </form>

                    <div class="row">
                        <div class="col-sm-12 col-12 col-md-12">
                            <div class="table-responsive">
                                <table class="table" id="table_porcentaje_">
                                    <thead class="table-primary">
                                        <tr>
                                            <th class="text-center">
                                                Aprobar
                                            </th>
                                            <th class="text-center">
                                                Id
                                            </th>
                                            <th class="text-center">
                                                Nombre de la opcion
                                            </th>         
                                          
                                            <th class="text-center">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_porcentaje" name="tbody_porcentaje">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop
@include('layouts.modal')
@section('js')
    <script src="{{ asset('js/plugins/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/admin/validate.js') }}"></script>
    <script src="{{ asset('js/admin/admin.js') }}"></script>
    <script src="{{ asset('js/util.js') }}"></script>
    <script src="{{ asset('js/plugins/select2.min.js') }}"></script>
   <!--   <script src="{{ asset('js/optionsdetails/function.js') }}"></script>>-->
   <script src="{{ asset('js/invoiceAssignment/function.js') }}"></script>
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
</form>

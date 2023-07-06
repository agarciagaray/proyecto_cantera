@extends('adminlte::page')
<!-- , ['iFrameEnabled' => true] -->
@section('title', 'Listado de conceptos de pagos')

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
            <h1 class="card-title"><b> Listado de conceptos de pagos2023</b></h1>
        </div>

        <div class="card-body">
            <div class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12 col-md-6 mb-2">
                        <button class="btn btn-primary" onclick="createConceptPayment()" type="button">
                       <i class="fa fa-plus" aria-hidden="true"></i> Crear  </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table" id="table-concpayment">
                                <thead class="table-primary">
                                    <tr>
                                        <th>
                                            Id
                                        </th>
                                        <th>
                                            Nombre
                                        </th>
                                        {{-- <th>
                                            Estado
                                        </th> --}}
                                        <th>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_concpay" name="tbody_concpay">
                                    @foreach ($conceptspayments as $conceptpayment)
                                        <tr id="tr_{{ $conceptpayment->id }}"
                                            @if ($conceptpayment->cncp_estado == 'I') style="color:#e3342f" @endif>
                                            <td>
                                                {{ $conceptpayment->id }}
                                            </td>
                                            <td>
                                                {{ $conceptpayment->cncp_nombre }}
                                            </td>
                                            {{-- <td>
                                                {{ $conceptpayment->cncp_estado }}
                                            </td> --}}

                                            <td class="text-right py-0 align-middle">
                                                <div class="btn-group btn-group-sm">
                                                    <button class="btn btn-info mr-1"
                                                        onclick="createConceptPayment({{ $conceptpayment->id }},true)"
                                                        type="button">
                                                        <i class="fas fa-eye">
                                                        </i>
                                                    </button>
                                                    <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
                                                    @if ($conceptpayment->cncp_estado == 'A')
                                                    <button class="btn btn-primary mr-1"
                                                        onclick="createConceptPayment({{ $conceptpayment->id }},false)"
                                                        type="button">
                                                        <i class="fas fa-edit">
                                                        </i>
                                                    </button>
                                                                                      
                                                    <button class="btn btn-danger"
                                                        onclick="deleteConceptPayment({{ $conceptpayment->id }},'tr_{{ $conceptpayment->id }}')"
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
                            {{-- <divclass="offset-md-5">!!$conceptspayments->links()!!</div> --}}
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
@stop
@include('layouts.modal')
{{-- @include('conceptspayments.form') --}}
@section('js')
    <script src="{{ asset('js/plugins/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/admin/validate.js') }}"></script>
    <script src="{{ asset('js/admin/admin.js') }}"></script>
    <script src="{{ asset('js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('js/util.js') }}"></script>
    <script src="{{ asset('js/paymentItems/functions.js') }}"></script>
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

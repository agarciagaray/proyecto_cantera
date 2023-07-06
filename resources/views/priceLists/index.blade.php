@extends('adminlte::page')
<!-- , ['iFrameEnabled' => true] -->
@section('title', 'Listado de Precios')

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
            <h1 class="card-title"><b>Listado de precios</b></h1>
        </div>

        <div class="card-body">
            <div class="dataTables_wrapper dt-bootstrap4">
                <form class="form-list-price-list">
                    <div class="row">
                        <div class="col-sm-12 col-md-2 mb-2">

                            <button class="btn btn-primary" onclick="createPriceList()" type="button">
                                <i class="fa fa-plus" aria-hidden="true"></i> Crear </button>

                        </div>

                        <div class="col-12 col-sm-4 mb-3">
                            <label for="nombre" style="font-size: 9pt">Cliente</label>

                            <select class="form-control select3 obra_idcliente"  onchange="searchContructionClient()" id="id_customer">
                                <option ></option>
                                {{-- {{$selectedClient===$client->id  ? 'selected' : '' }} --}}
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}">
                                        {{ $client->Person->pers_razonsocial}} -{{ $client->Person->pers_identif }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-sm-4 mb-3">
                            <label for="nombre" style="font-size: 9pt">Obra</label>

                            <select class="form-control select3 idObra"  name="id_obra" required disabled id="id_obra_list_price">
                                <option></option>
                                @foreach ($constructions as $construction)
                                    <option value="{{ $construction->id }}">{{ $construction->obra_nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 col-sm-4"></div>
                        <div class="col-md-2 col-sm-4">
                            <span class="info-box-text" style="font-size: 9pt"><b>Fecha inicial</b></span>
                            <input type="date" name="dateStart" class="form-control datepicker" id="dateStart"
                                autocomplete="off">
                        </div>
                        <div class="col-md-2 col-sm-4">
                            <span class="info-box-text" style="font-size: 9pt"><b>Fecha final</b></span>
                            <input type="date" name="dateEnd" class="form-control datepicker" autocomplete="off"
                                id="dateEnd">
                        </div>
                        <div class="col-12 col-sm-4 mb-3 col-xs-12">
                            <label for="nombre" style="font-size: 9pt">Acción</label><br>
                            <button class="btn btn-primary  mr-1 btn-sm mt-2" type="button" title="Filtar"
                                onclick="filterListPrice()"><i class="fa fa-search" aria-hidden="true"
                                    title="Buscar"></i></button>
                            <button class="btn btn-secondary mr-1 btn-sm mt-2" type="button" title="Limpiar filtro"
                                onclick="clearFilter()"><i class="fa fa-eraser" aria-hidden="true"
                                    title="Limpiar filtro"></i></button>
                            <a class="btn btn-success mr-1 btn-sm mt-2" title="Exportar excel"><i class="fa fa-file-excel"
                                    aria-hidden="true" onclick="exportListPrice()"></i></a>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                        <table id="priceListTable"
                            class="table">
                            <thead class="table-primary">
                                <tr>
                                    <th>
                                        Id
                                    </th>
                                    <th>
                                        Material
                                    </th>
                                    <th>
                                        Cliente
                                    </th>
                                    <th>
                                        Obra
                                    </th>
                                    <th>
                                        Precio
                                    </th>
                                    <th>
                                        Iva
                                    </th>
                                    <th>
                                        Fecha
                                    </th>
                                    <th>

                                    </th>
                                </tr>
                            </thead>
                            <tbody id="tbody_priceList" name="tbody_priceList">
                                @foreach ($priceLists as $priceList)
                                    <tr id="tr_{{ $priceList->id }}"
                                        @if ($priceList->priceList_estado == 'I') style="color:#e3342f" @endif>
                                        <td>
                                            {{ $priceList->id }}
                                        </td>
                                        <td>
                                            {{ $priceList->Material->mate_descripcion }}
                                        </td>
                                        <td>
                                            {{ $priceList->Construction->Client->Person->pers_razonsocial }}
                                        </td>
                                        <td>
                                            {{ $priceList->Construction->obra_nombre }}
                                        </td>
                                        <td>
                                            {{ number_format($priceList->precio,2) }}
                                        </td>
                                        <td>
                                            {{ $priceList->iva }}
                                        </td>
                                        <td>
                                            {{ $priceList->created_at }}
                                        </td>
                                        <td class="text-right py-0 align-middle">
                                            <div class="btn-group btn-group-sm">
                                                <button class="btn btn-info mr-1"
                                                    onclick="createPriceList({{ $priceList->id }},true)" type="button">
                                                    <i class="fas fa-eye">
                                                    </i>
                                                </button>
                                                <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
                                                @if ($priceList->priceList_estado == 'A')
                                                    <button class="btn btn-primary mr-1"
                                                        onclick="createPriceList({{ $priceList->id }},false)"
                                                        type="button">
                                                        <i class="fas fa-edit">
                                                        </i>
                                                    </button>

                                                <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
                                                <button class="btn btn-danger"
                                                    onclick="deletePriceList({{ $priceList->id }},'tr_{{ $priceList->id }}')"
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
{{-- @include('machinestypes.form') --}}
@include('layouts.modal')
@section('js')
    <script src="{{ asset('js/plugins/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/admin/validate.js') }}"></script>
    <script src="{{ asset('js/admin/admin.js') }}"></script>
    <script src="{{ asset('js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('js/util.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons.colVis.min.js') }}"></script>

    <script src="{{ asset('js/priceList/functions.js') }}"></script>
@stop

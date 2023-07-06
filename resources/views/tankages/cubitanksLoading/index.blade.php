@extends('adminlte::page')
<!-- , ['iFrameEnabled' => true] -->
@section('title', 'Listado de Clientes')

@section('content_header')
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/sweetalert2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/select2.css') }}" rel="stylesheet">

    <h1>
        Lista un carga de cubitanques.
    </h1>
@stop

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                @can('Formulario de carga de cubitanques')
                <button class="btn btn-primary" onclick="createCubitanksLoading()" type="button">
                    Crear
                </button>
                @endcan
                <br>
                <div class="card card-info mt-2">
                    <div class="card-body p-0" style="display: block;">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="table-primary">
                                    <tr>
                                        <th scope="col">Compra</th>
                                        <th scope="col">Volumen</th>
                                        <th scope="col">Unidad</th>
                                        <th scope="col">Observaciones</th>
                                        <th scope="col" colspan="3">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody-cubitanksLoading">
                                    @foreach ($cubitanksLoadings as $cubitanksLoading)
                                        <tr>
                                            <td>{{ $cubitanksLoading->Fuelsshopping->ccmb_numremision }}</td>
                                            <td>{{ $cubitanksLoading->cubt_volumen }}</td>
                                            <td>{{ $cubitanksLoading->cubt_unidad }}</td>
                                            <td>{{ $cubitanksLoading->cubt_observaciones }}</td>
                                            <td>
                                                @can('Formulario de carga de cubitanques')
                                                <button class="btn btn-primary btn-sm"
                                                    onclick="createCubitanksLoading({{$cubitanksLoading->cubt_id }},false)"><i
                                                        class="fas fa-edit"></i></button>
                                                        @endcan
                                                        @can('Formulario de carga de cubitanques')
                                                <button class="btn btn-secondary btn-sm"
                                                    onclick="createCubitanksLoading({{$cubitanksLoading->cubt_id }},true)"><i
                                                        class="fa fa-eye" aria-hidden="true"></i></button>
                                                        @endcan
                                                        @can('Eliminar de carga de cubitanques')
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="deleteCubitanksLoading({{$cubitanksLoading->cubt_id }})"><i
                                                        class="fa fa-trash" aria-hidden="true"></i></button>
                                                        @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="offset-md-5"> {!!$cubitanksLoadings->links() !!} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@include('layouts.modal')
@section('js')
    <script src="{{ asset('js/plugins/sweetalert.min.js') }}">
    </script>
    <script src="{{ asset('js/plugins/jquery.validate.min.js') }}">
    </script>
    <script src="{{ asset('js/admin/validate.js') }}">
    </script>
    <script src="{{ asset('js/plugins/select2.min.js') }}">
    </script>
    <script src="{{ asset('js/util.js') }}">
    </script>
    <script src="{{ asset('js/cubitanksLoading/function.js') }}">
    </script>
@stop

{{-- @extends('layouts.modal')
@section('form') --}}
    <form class="form-send-material" >
        @csrf
        <input type="hidden" class="form-control" name="id" id="id" value="{{ $material->id ?? '' }}">

        {{--      <div class="row">
            <div class="col-12 col-sm-6 mb-3">
                <label for="cod" style="font-size: 9pt">Código/Sigla</label>
                <input type="text" class="form-control" placeholder="Código" name="mate_codigo" id="cod" required tabindex="1" value="{{ $material->mate_codigo ?? '' }}">
            </div>
        <div class="col-12 col-sm-6 mb-3">
                <label for="clasif" style="font-size: 9pt">Clasificación</label>
                @php
                    $selected= $material->mate_clasificacion ?? '';
                @endphp
                <select class="form-control" name="mate_clasificacion" id="clasif" required>
                    <option value="MP" {{ $selected == 'MP' ? 'selected' : '' }}>Materia Prima</option>
                    <option value="PR" {{ $selected == 'PR' ? 'selected' : '' }}>Producto</option>
                </select>
            </div> 
        </div> --}}
        <div class="row">
            <div class="col-12 col-sm-12 mb-3">
                <label for="cod" style="font-size: 9pt">Código/Sigla</label>
                <input type="text" class="form-control" placeholder="Código" name="mate_codigo" id="cod" required tabindex="1" value="{{ $material->mate_codigo ?? '' }}">
            </div>
            <div class="col-12 col-sm-12 mb-3">
                <label for="descr" style="font-size: 9pt">Descripción</label>
                <textarea class="form-control" id="descr" name="mate_descripcion" rows="3" required> {{ $material->mate_descripcion ?? '' }}</textarea>
            </div>
        </div>
        <div class="row">
            @can('Cambio de estado')
            <div class="col-12 col-sm-4 mb-3">
                <label for="estado" style="font-size: 9pt">Estado</label>
                @php
                        $selected = $material->mate_estado ?? '';
                @endphp
                <select class="form-control" name="estado" id="estado" required>
                    <option value="A" {{ $selected == 'A' ? 'selected' : '' }}>ACTIVO</option>
                    <option value="I" {{ $selected == 'I' ? 'selected' : '' }}>INACTIVO</option>
                </select>
            </div>
            @endcan
        </div>

        <div class="row">
            <div class="col-6">
                <button class="btn btn-success" onclick="saveMaterial()" type="button" id="sendMaterialButton">Guardar</button>
                <button type="button" class="btn btn-secondary" onclick="closeModal()">Cerrar</button>
            </div>
        </div>

    </form>
{{-- @endsection --}}
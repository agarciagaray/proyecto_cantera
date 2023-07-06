{{-- @extends('layouts.modal')
@section('form') --}}
    <form class="form-send-device" >
        @csrf
        <input type="hidden" class="form-control" name="id" id="id" value="{{ $device->id ?? '' }}">
        <div class="row ">
            @can('Cambio de estado')
            <div class="col-12 col-sm-12 mb-3">
                <label for="estado" style="font-size: 9pt">Estado</label>
                @php
                $selected = $device->disp_estado ?? ''
                
                @endphp
                <select class="form-control" name="disp_estado" id="disp_estado" required>
                    <option value="A" {{ $selected === 'A' ? 'selected' : '' }}>ACTIVO</option>
                    <option value="I" {{ $selected === 'I' ? 'selected' : '' }}>INACTIVO</option>
                </select>
            </div>
            @endcan
            <div class="col-12 col-sm-12 mb-3">
                <label for="descr" style="font-size: 9pt">Descripción</label>
                <textarea class="form-control" id="disp_descripcion" name="disp_descripcion" rows="3" required>{{ $device->disp_descripcion ?? '' }}</textarea>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <button class="btn btn-success" onclick="sendDevice()" type="button" id="sendDeviceButton">Guardar</button>
                <button type="button" class="btn btn-secondary" onclick="closeModal()">Cerrar</button>
            </div>
        </div>
    </form>
{{-- @endsection --}}
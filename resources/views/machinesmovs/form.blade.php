{{-- @extends('layouts.modal')
@section('form') --}}
<form class="form-send-machine-mov">
    @csrf
    <input type="hidden" class="form-control" name="id" id="id" value="{{ $machineMov->id ?? '' }}">
    <div class="row">
        <div class="col-12 col-sm-6 mb-3">
            <label for="idMaq" style="font-size: 9pt">Id. Máq. (PLACA) (*)</label>
            @php
                $selectMachine = $machineMov->mqmv_idmaquina ?? '';
            @endphp
            <select class="form-control select2" name="mqmv_idmaquina" id="mqmv_idmaquina">
                <option value=""></option>
                @foreach ($machines as $machine)
                    <option value="{{ $machine->id }}" {{ $selectMachine == $machine->id ? 'selected' : '' }}>
                        {{ $machine->maqn_placa }}</option>
                @endforeach
            </select>
            {{-- <input type="text" class="form-control" placeholder="Id. Máquina" title="Id. Máquina" name="idMaq" id="idMaq" required tabindex="1"> --}}
        </div>
     

        
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Fecha (*)</label>
                @php
                    $date = \Carbon\Carbon::now();
                @endphp
                <!-- Esta editable por solicitud del sr Mario Fra@y luis 17/03/2023-->
                <input type="date" class="form-control" name="mqmv_fecha" id="mqmv_fecha"
                    value="{{ $machineMov->mqmv_fecha ?? $date->format('Y-m-d') }}">

            </div>
        </div>



        <div class="col-12 col-sm-6 mb-3 mqmv_hour"
            style="{{ isset($machineMov->horometro_hfinal) ? 'display:none' : '' }}">
            <label for="fInicio" style="font-size: 9pt">Hora de Inicio</label>

            <input type="time" class="form-control double" placeholder="Hora Inicio" title="Hora de inicio"
                name="mqmv_hinicio" id="mqmv_hinicio" required value="{{ $machineMov->mqmv_hinicio ?? '' }}">
        </div>

        <div class="col-12 col-sm-6 mb-3 mqmv_hour"
            style="{{ isset($machineMov->horometro_hinicio) ? 'display:none' : '' }}">
            <label for="fFin" style="font-size: 9pt">Hora Final</label>
            <input type="time" class="form-control double" placeholder="Hora Fin" title="Hora final" name="mqmv_hfin"
                id="mqmv_hfin" required value="{{ $machineMov->mqmv_hfin ?? '' }}">
        </div>
        <div class="col-12 col-sm-3 mb-3">
            <label for="vlrHora" style="font-size: 9pt">Vlr. Hora (*)</label>

            <input type="text" class="form-control" placeholder="Vlr. Hora" title="Valor hora"
            min="0" id="mqmv_vlrhora_visual" value="{{ $machineMov->mqmv_vlrhora  ?? '' }}"
            onchange="doubleValue('#mqmv_vlrhora_visual','#mqmv_vlrhora')">

            <input type="hidden" class="form-control double" placeholder="Vlr. Hora" title="Valor hora"
                name="mqmv_vlrhora" id="mqmv_vlrhora" required value="{{ $machineMov->mqmv_vlrhora ?? '' }}"
                autocomplete="off" value="0">
        </div>
        <div class="col-12 col-sm-3 mb-3">
            <div class="form-check pt-3 mt-2">
                <input class="form-check-input" type="checkbox" name="horometro" id="same-address"
                    onclick="showHorometro()" {{ isset($machineMov->horometro_hinicio) ? 'checked' : '' }}>
                <label class="form-check-label" for="flexCheckDefault">
                    Horometro
                </label>
            </div>
        </div>

        <div class="col-12 col-sm-3 mb-3 horometro" style="{{ $machineMov->horometro_hinicio ?? 'display:none' }}">
            <label for="horometro_hinicio" style="font-size: 9pt;">Horometro inicial</label>
            <input type="text" class="form-control" title="Horometro inicial" 
           id="horometro_hinicio_visual" value="{{ $machineMov->horometro_hinicio ?? ''}}"
            onchange="doubleValue('#horometro_hinicio_visual','#horometro_hinicio')" placeholder="Ej:12.25">

            <input type="hidden" class="form-control" placeholder="" title="Horometro inicial" name="horometro_hinicio"
                id="horometro_hinicio" value="{{ $machineMov->horometro_hinicio ?? '' }}"
              autocomplete="off">
        </div>
        <div class="col-12 col-sm-3 mb-3 horometro" style="{{ $machineMov->horometro_hfinal ?? 'display:none' }}">
            <label for="horometro_hfina" style="font-size: 9pt;">Horometro final</label>
            <input type="text" class="form-control" title="Horometro final" 
               id="horometro_hfinal_visual" value="{{ $machineMov->horometro_hfinal ?? ''}}"
                onchange="doubleValue('#horometro_hfinal_visual','#horometro_hfinal')" placeholder="Ej:14.25">

            <input type="hidden" class="form-control" placeholder="" title="Horometro final" name="horometro_hfinal"
               id="horometro_hfinal" value="{{ $machineMov->horometro_hfinal ?? '' }}"
                autocomplete="off">
        </div>
    </div>
    </div>

    <div class="row">

        @can('Cambio de estado')
            <div class="col-12 col-sm-6 mb-3">
                <label for="estado" style="font-size: 9pt">Estado</label>
                @php
                    $selected = $machineMov->mqmv_estado ?? '';
                @endphp
                <select class="form-control select2" name="mqmv_estado" id="mqmv_estado" required tabindex="6">
                    <option value="A" {{ $selected == 'A' ? 'selected' : '' }}>ACTIVO</option>
                    <option value="I" {{ $selected == 'I' ? 'selected' : '' }}>INACTIVO</option>
                </select>
            </div>
        @endcan
    </div>






                    <div class="col-8 col-sm-8 mb-3">
                    <div class="form-group">
                    <label for="id_conductor" style="font-size: 9pt">Conductor</label>
                    <select class="form-control select3" name="id_conductor" id="id_conductor">
                              <option value=""></option>
                                        @foreach ($drivers as $driver)
                                            <option value="{{ $driver->id}}">
                                                {{ $driver->id }} -
                                                {{ $driver->person->pers_primernombre }}
                                            </option>
                                        @endforeach
                                    </select>  
                            </div>
                        </div>


    <div class="row">
        <div class="col-12 col-sm-12 mb-3">
            <label for="obs" style="font-size: 9pt">Observaciones</label>
            <textarea class="form-control" placeholder="Observaciones" title="Observaciones" id="mqmv_obs" name="mqmv_obs"
                rows="3" required tabindex="4">{{ $machineMov->mqmv_obs ?? '' }}</textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <button class="btn btn-success" onclick="sendMachineMov()" type="button">Guardar</button>
            <button type="button" class="btn btn-secondary" onclick="closeModal()">Cerrar</button>
        </div>
    </div>
</form>
{{-- @endsection --}}

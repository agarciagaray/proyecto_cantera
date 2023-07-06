
    <form class="form-send-concpay" >
        @csrf
        <input type="hidden" class="form-control" name="id" id="id" value="{{ $conceptPayment->id  ?? ''}}">
        <div class="row">
            <div class="col-12 col-sm-12 mb-3">
                <label for="nombre" style="font-size: 9pt">Nombre (*)</label>
                <input type="text" class="form-control" placeholder="Nombre" name="cncp_nombre" id="cncp_nombre" required tabindex="1" value="{{ $conceptPayment->cncp_nombre  ?? ''}}">
            </div>
            @can('Cambio de estado')
            <div class="col-12 col-sm-4 mb-3">
                <label for="estado" style="font-size: 9pt">Estado</label>
                @php
                    $selected  = $conceptPayment->cncp_estado ?? '';
                @endphp
                <select class="form-control select2" name="cncp_estado" id="cncp_estado" required>
                    <option value="A" {{  $selected  == 'A' ? 'selected' : '' }}>ACTIVO</option>
                    <option value="I" {{  $selected  == 'I' ? 'selected' : '' }}>INACTIVO</option>
                </select>
            </div>
            @endcan
        </div>

        <div class="row">
            <div class="col-6">
                <button class="btn btn-success" onclick="sendConceptPayment()" type="button" >Guardar</button>
                <button type="button" class="btn btn-secondary" onclick="closeModal()">Cerrar</button>
            </div>
        </div>
    </form>
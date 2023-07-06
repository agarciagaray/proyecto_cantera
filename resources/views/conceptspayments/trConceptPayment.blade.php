@foreach ($conceptspayments as $conceptpayment)
<tr id="tr_{{ $conceptpayment->id }}"  @if ($conceptpayment->cncp_estado == 'I') style="color:#e3342f" @endif>
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
                onclick="createConceptPayment({{ $conceptpayment->id }},true)" type="button">
                <i class="fas fa-eye">
                </i>
            </button>
            <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
            @if ($conceptpayment->cncp_estado == 'A')
            <button class="btn btn-primary mr-1"
                onclick="createConceptPayment({{ $conceptpayment->id }},false)" type="button">
                <i class="fas fa-edit">
                </i>
            </button>
    
            <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
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
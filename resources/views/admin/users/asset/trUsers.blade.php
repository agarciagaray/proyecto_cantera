@foreach ($users as $user)
    <tr id="tr_{{ $user->id }}" @if ($user->usua_estado == 'I') style="color:#e3342f" @endif>
        <td>
            {{ $user->name }}
        </td>
        <td>
            {{ $user->email }}
        </td>
        <td>
            @foreach ($user->roles as $role)
                {{ $role->name }},
            @endforeach
        </td>
        {{--  <td>
            {{ $user->usua_creacion }}
        </td>  --}}
        <td>
            {{ $user->created_at }}
        </td>
        <td class="text-right py-0 align-middle">
            @can('Formulario de usuarios')
                <button class="btn btn-info mr-1 btn-sm" onclick="createUser({{ $user->id }}, 'true' )" type="button">
                    <i class="fas fa-eye">
                    </i>
                </button>
            @endcan
            @can('Formulario de usuarios')
                @if ($user->usua_estado == 'A')
                    <button class="btn btn-primary mr-1 btn-sm" onclick="createUser({{ $user->id }},'false' )"
                        type="button">
                        <i class="fas fa-edit">
                        </i>
                    </button>
                @endif
            @endcan
            @if ($userAuth->id != $user->id)
                @can('Eliminar usuarios')
                <button class="btn btn-sm  {{ $user->usua_estado == 'A' ? 'btn-danger':'btn-success' }}"
                    onclick="deleteUser({{ $user->id }},'{{ $user->usua_estado == 'A' ? 'I' : 'A' }}')"
                    type="button" title="{{ $user->usua_estado == 'A' ? 'Inactivar' : 'Activar' }}">
                    @if ($user->usua_estado == 'A')
                        <i class="fas fa-trash"></i>
                    @else
                        <i class="fa fa-check" aria-hidden="true"></i>
                    @endif
                </button>
                @endcan
            @endif
        </td>
    </tr>
@endforeach

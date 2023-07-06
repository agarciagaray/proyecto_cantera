   @foreach ($remissions as $value)
       <tr>
           <td class="text-center">
               <input type="checkbox" name="chkFact_{{ $value->Remission->id }}" id="chkFact_{{ $value->Remission->id }}"
                   style="margin-left:auto; margin-right:auto;"
                   onchange="assignUnassign('chkFact_{{ $value->Remission->id }}',{{ $value->Remission->id }})">
           </td>
           <td class="text-center">
               {{ $value->Remission-> }}
           </td>
           <td class="text-center">
               {{ $value->Remission->Construction->obra_nombre ?? '' }}
           </td>
           <td class="text-center">
               {{ $value->Remission->Society->Person->pers_razonsocial ?? '' }}
               {{ $value->Remission->Society->Person->pers_primerapell ?? '' }}
               {{ $value->Remission->Society->Person->pers_segapell ?? '' }}
               {{ $value->Remission->Society->Person->pers_primernombre ?? '' }}
               {{ $value->Remission->Society->Person->pers_segnombre ?? '' }}
           </td>
           <td class="text-center">
               {{ $value->Remission->num_remission }}
           </td>
           <td class="text-center">
               {{ $value->Remission->remi_fecha }}
           </td>
           <td class="text-right py-0 align-middle">
               <div class="btn-group btn-group-sm">
                   <button class="btn btn-info mr-1" onclick="createRemissionAssign({{ $value->Remission->id }}, true)"
                       type="button">
                       <i class="fas fa-eye"></i>
                   </button>
               </div>
           </td>
       </tr>
   @endforeach

<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
{{-- <head>Reporte de cantera</head> --}}
<style>
    .page-break {
        page-break-after: always;
    }

    @page {
        margin: 0cm 0cm;
        font-family: Arial;

    }

    body {
        margin: 3cm 2cm 2cm;

    }

    header {
        position: fixed;
        top: 0cm;
        left: 0cm;
        right: 0cm;
        height: 1cm;
        background-color: #343a40;
        color: white;
        text-align: center;
        line-height: 25px;
    }

    table.customTable {
        width: 100%;
        background-color: #FFFFFF;
        border-collapse: collapse;
        border-width: 2px;
        border-color: #000000;
        border-style: solid;
        color: #000000;
        font-size: 14px;
    }

    table.customTable td,
    table.customTable th {
        border-width: 2px;
        border-color: #000000;
        border-style: solid;
        padding: 5px;
    }

    table.customTable thead {
        background-color: #343a40;
        color: #fff
    }

    .text-center {
        text-align: center;
    }
</style>
{{-- <head>Reporte {{ $date }}</head> --}}

<body>
    <header> 
       {{ $name }}
    </header>
    <main>
        <article>
  
            <h4 class="text-center">DATOS BASICOS.</h4>
            <b>FECHA: </b>{{ $date }}<br>
            <b>USUARIO: </b>{{ $user->name }}<br>
            <b>OBRA</b>: {{ $remissionNovelty->remission->Construction->obra_nombre }}<br>
            <b>SOCIEDAD</b>: {{ $remissionNovelty->remission->Society->Person->pers_razonsocial }}<br>
            <b>CLIENTE</b>: {{ $remissionNovelty->remission->Construction->Client->Person->pers_razonsocial }}<br>

            <h4 class="text-center">NOVEDAD.</h4>
            <b>FECHA DE NOVEDAD</b>: {{ $remissionNovelty->rmnv_fecha ?? '' }}<br>
            <b>CONCEPTO</b>: {{ $remissionNovelty->RemissionConcNovelty->cncn_nombre ?? '' }}<br>
            @if($remissionNovelty->rmnv_fecha)
            <b>NUEVA FECHA</b>: {{ $remissionNovelty->rmnv_fecha ?? '' }}<br>

            @endif

      
            @isset($remissionNovelty->Client)
                <b>NUEVO CLIENTE</b>: {{ $remissionNovelty->Client->Person->pers_razonsocial ?? '' }}<br>
            @endisset
            @isset($remissionNovelty->Construction)
            <b>NUEVA OBRA:</b> {{ $remissionNovelty->Construction->obra_nombre ?? '' }}<br>
            @endisset
            


            @isset($remissionNovelty->Material)
                <b>MATERIAL</b>: {{ $remissionNovelty->Material->mate_descripcion ?? '' }}<br>
            @endisset
            @if ( $remissionNovelty->rmnv_doc_vascula)
            <b>DOCUMENTO DE VASCULA</b>: {{ $remissionNovelty->rmnv_doc_vascula ?? '' }}<br>
            @endif
            
            @if ( $remissionNovelty->rmnv_nuevovalor)
            <b>NUEVO VOLUMEN</b>: {{ $remissionNovelty->rmnv_nuevovalor ?? '' }}<br>
            @endif

      
            <b>ID DE REMISIÓN</b>: {{ $remissionNovelty->remission->id?? '' }}<br>
            <b>NÚMERO DE FACTURA</b>: {{ $remissionNovelty->remission->remi_numfactura ?? '' }}<br>
            <b>NÚMERO DE REMISIÓN</b>: {{ $remissionNovelty->remission->num_remission ?? '' }}<br>
            <b>OBSERVACIÓN</b>: {{ $remissionNovelty->rmnv_obs ?? '' }}<br>
  
            @if (count($remissionNovelty->remission->detailRemissions) > 0)
                <h4 class="text-center">DETALLE DE REMISIÓN</h4>
                <table class="customTable">
                    <thead class="table-primary">
                        <tr>
                            <th>
                                Id Mat
                            </th>
                            <th>
                                Material
                            </th>
                            <th>
                                Und
                            </th>
                            <th>
                                Cant
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($remissionNovelty->remission->detailRemissions as $detail)
                            <tr class="text-center">
                                <td>
                                    {{ $detail->dtrm_idmaterial }}
                                </td>
                                <td>
                                    {{ $detail->Material->mate_descripcion }}
                                </td>
                                <td>
                                    {{ $detail->dtrm_cantdespachada }}
                                </td>

                                <td>
                                    {{ $detail->Unit->unit_descripcion }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

        </article>


    </main>
    </table>

</body>
{{-- <footer>
    <h1>Sistema cantera</h1>
</footer> --}}

</html>
<script type="text/php">if (isset($pdf) ) {
            $pdf->page_script('
                $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                $pdf->text(270, 730, "Pagina $PAGE_NUM de $PAGE_COUNT", $font, 10);
            ');
        }</script>

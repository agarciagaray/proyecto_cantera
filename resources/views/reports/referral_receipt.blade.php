<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .grid-one {

            position: relative;
            top: -45px;
            width: 270px;
            border: solid black 1px;
            height: 30px;
            padding: 5px 0px 4px 10px;
            border-radius: 10px;

        }

        .grid-two {
            position: relative;
            top: -86px;
            left: 290px;
            width: 400 px;
            border: solid black 1px;
            height: 30px;
            /* top. rigth, button, lef*/
            padding: 5px 0px 4px 10px;
            border-radius: 10px;

        }

        .grid-three {

            position: relative;
            top: -80px;

            border: solid black 1px;
            height: 30px;
            /* top. rigth, button, lef*/
            padding: 5px 0px 4px 10px;
            border-radius: 10px;

        }

        .grid-four {

            position: relative;
            top: -75px;

            border: solid black 1px;
            height: 20px;
            /* top. rigth, button, lef*/
            padding: 5px 0px 4px 10px;
            border-radius: 10px;

        }

        .grid-five {

            position: relative;
            top: -65px;

            border: solid black 1px;
            height: auto;
            /* top. rigth, button, lef*/
            padding: 5px 0px 4px 10px;
            border-radius: 10px;

        }

        b.b-danger {
            color: red;
        }

        .grid-header {
            position: relative;
            top: 5px;
            border: solid black 1px;
            height: 50px;
            /* margin-bottom: 4px;*/
            width: 280px;
            border-radius: 10px;
        }

        .font-rs {
            position: relative;
            top: -15px;
            padding-top: 0px;
            padding-left: 20px;
            font-size: 18px;
            text-transform: uppercase;
        }

        .font-nit {
            position: relative;
            top: -35px;
            left: 20px;
            font-size: 12px;
            text-transform: uppercase;
        }

        .font-la {

            position: relative;
            top: -35px;
            left: 20px;
            font-size: 12px;
            text-transform: uppercase;

        }

        .grid-legal {
            position: relative;
            top: -47px;
            left: 41.5%;
            height: 50px;
            width: 407px;
            margin-bottom: 4px;
            border-radius: 10px;
        }

        .container {
            position: relative;
            top: 10px;
        }

        .font-data {
            margin-top: -20px;
            margin-left: 130px;
        }
    </style>
</head>

<body>
    <main>

        <div class="container">
            <div class="grid-header" style="border: solid black 1px;">
                <p class="font-rs"><b>{{ isset($remission->Society) ? $remission->Society->Person->pers_razonsocial : '' }}</b></p>
                <p class="font-nit"><b>NIT:{{ isset($remission->Society) ? $remission->Society->Person->pers_identif : '' }}</b></p>

            </div>
            <div class="grid-legal" style="border: solid black 1px;">
                <p class="font-rs"><b>Titulo Minero GEP-132</b></p>
                <p class="font-la"><b>Licencia Ambiental Resolución 00953 de 2019</b></p>
            </div>


            <div class="grid-one"><b>RECIBO No.</b> <b class="b-danger">{{ $remission->num_remission }}</b></div>
            <div class="grid-two"><b>FECHA: </b>

                @if ($remission_nov_date)
                    {{ $remission_nov_date->rmnv_fecha }}
                @else
                    {{ $remission->created_at }}
                @endif

            </div>


            <div class="grid-three"><b>ENTREGADO A: </b>
          
                @if ($remission_nov_client)
                <p class="font-data"> {{ $remission_nov_client->Client->Person->pers_razonsocial }}</p>
                @else
                <p class="font-data"> {{ $remission->Construction->Client->Person->pers_razonsocial }}</p>
                @endif

            </div>

            <div class="grid-four"><b>DIRECCIÓN:</b>
                <p class="font-data"> {{ $remission->Construction->Client->Person->pers_direccion }}</p>
            </div>
            <div class="grid-five"><b>DESCRIPCIÓN:</b>
                <table class="table">
                    <thead class="table-primary">
                        <tr>
                            <th>
                                MATERIAL
                            </th>
                            <th>
                                UNIDAD
                            </th>
                            <th>
                                CANTIDAD
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($remission->detailRemissions as $detail)
                            <tr>
                                <td style="width:250px;text-align: center">
                                    @if (isset($detail->Material))
                                        {{ $detail->Material->mate_descripcion }}
                                    @endif
                                </td>
                                <td style="width:220px;text-align: center">
                                    {{ $detail->Unit->unit_descripcion }}
                                </td>
                                <td style="width:220px;text-align: center">
                                    @if ($remission_nov_vol)
                                        {{ $remission_nov_vol->rmnv_nuevovalor}}
                                    @else
                                        {{ $detail->dtrm_cantdespachada }}
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{--  <b>NOVEDADES DE REMISIONES</b>
                <table class="table">
                    <thead class="table-primary">
                        <tr>
                            <th>
                                MATERIAL
                            </th>
                            <th>
                                CONCEPTO
                            </th>
                            <th>
                                VALOR
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($remission->remissionNovelties as $detail)
                            <tr>
                                <td style="width:250px;text-align: center">
                                    @if (isset($detail->Material))
                                        {{ $detail->Material->mate_descripcion }}
                                    @endif
                                </td>
                                <td style="width:250px;text-align: center">
                                    {{ $detail->RemissionConcNovelty->cncn_nombre }}
                                </td>
                                <td style="width:250px;text-align: center">
                                    {{ $detail->rmnv_nuevovalor ?? ($detail->Client->Person->pers_razonsocial ?? '') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>  --}}
                <b>OBSERVACIÓN:</b>
                <p class="font-data"> {{ $remission->remi_obs ?? '' }}</p>
                <b>CONDUCTOR:</b> {{ $remission->Machine->name_complete ?? '' }}
                <b>VEHICULO:</b> {{ $remission->Machine->maqn_placa ?? '' }} <br>
                <b>C.C:</b> {{ $remission->Machine->nuip ?? '' }}<br>
                <b>RECIBIDO POR:</b> _____________________________________
                <b>FECHA DE RECIBIDO:</b> {{ date('m-d-Y') }}<br>
                <b>C.C:</b>________________________________________
            </div>
        </div>
    </main>
</body>

</html>




{{-- <div style="border: solid 1px black;width:200px">
    Recibo  No. 99014
</div>
<div style="border: solid 1px black">
    24/05/2022
</div> --}}

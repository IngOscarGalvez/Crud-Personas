<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Document</title>
</head>
<body>





<img src="{{ public_path('img/img_pdf1.jpg') }}" class="img">

<div id="panel">
    <h3 class="title">LEVANTAMIENTO DE REQUERIMIENTOS:</h3>
    <table class="table1">
        <tr>
            <td style="text-align: left !important; width: 100px;"><b>Empresa:</b></td>
            <td style="text-align: left !important;">{{$formulario->cliente->empresa}}</td>
        </tr>

        <tr>
            <td style="text-align: left !important; width: 100px;"><b>Contacto:</b></td>
            <td style="text-align: left !important;">{{$formulario->cliente->contacto}}</td>
        </tr>

        <tr>
            <td style="text-align: left !important; width: 100px;"><b>Teléfono:</b></td>
            <td style="text-align: left !important;">{{$formulario->cliente->telefono}}</td>
        </tr>

        <tr>
            <td style="text-align: left !important; width: 100px;"><b>Lugar:</b></td>
            <td style="text-align: left !important;">{{$formulario->cliente->lugar}}</td>
        </tr>

        <tr>
            <td style="text-align: left !important; width: 100px;"><b>Email:</b></td>
            <td style="text-align: left !important;">{{$formulario->email}}</td>
        </tr>
    </table>



</div>

<div id="panel2">
    <h2>“SU SEGURIDAD ES NUESTRO COMPROMISO”</h2>
</div>
<div style="page-break-after: always;"></div>

<img src="{{ public_path('img/fondo_pdf.jpg') }}" alt="" class="fondo">


<table >
    <tr>
        <th>Objetivos</th>
    </tr>
    <tr>
        <td style="size: 10pt !important;">
            <p>Definir los activos de información que serán objeto de auditoría en seguridad informática para determinar el nivel de riesgo e identificación de brechas en ciberseguridad a través de técnicas de Ethical Hacking, Análisis de vulnerabilidades, Ingeniería Social, Análisis de Código, entre otras.</p>
        </td>
    </tr>
</table>

<h3>ACTIVOS DE INFORMACIÓN OBJETO DE AUDITORÍA</h3>

<table >
    <tr>
        <th>Item</th>
        <th>Tipo de Servicio</th>
        <th>Modalidad</th>
        <th>Activo de Información</th>
        <th>Cant</th>
        <th>Observaciones</th>
    </tr>

    @php
        $i=0;

    @endphp

         @foreach($formulario->itemFormulario as $item)
            @php
                $i++;
            @endphp
            <tr>
                <td style="text-align: center !important; ">{{$i}}</td>
                <td style="text-align: left !important; ">{{$item->servicio->name}}</td>
                <td style="text-align: left !important; ">{{$item->modalidad->name}}</td>
                @if($item->objetivo->id=='22')
                    <td style="text-align: left !important; ">Otro ({{$item->otro}})</td>
                @else
                    <td style="text-align: left !important; ">{{$item->objetivo->name}}</td>
                @endif
                <td style="text-align: right !important; ">{{$item->cantidad}}</td>
                <td style="text-align: left !important; ">{{$item->observaciones}}</td>
            </tr>
         @endforeach
</table>
<div style="page-break-after: always;"></div>
<p>De manera oportuna, le enviaremos la propuesta tecnológica y comercial para la prestación de servicios profesionales en seguridad informática, para los activos y objetivos relacionados en este documento de levantamiento de requerimientos.</p>
<br>
<p>Cordialmente,</p>
<br><br>

<img src="{{ public_path('img/firm.jpg') }}" alt="" class="firm">


<script type="text/php">
    if ( isset($pdf) ) {

            $pdf->page_script('

                if($PAGE_NUM!=1){
                    $font = $fontMetrics->get_font("helvetica", "bold");
                    $pdf->text(480, 730, "Página $PAGE_NUM de $PAGE_COUNT |", $font, 10,array(.3,.5,1));
                }

            ');


    }
</script>



</body>
</html>

<style>

    body{

        font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;
        background-position: center;


        margin: 3cm .5cm 3cm .5cm;
        color: #000;
        background-color: #eee;
        text-align: justify;


    }
    h2,h3{
        text-align: center;
        color: #0c3961;
    }
    p{
        text-align: justify;
    }

    .firm{
        width: 100%;
    }

    table {
        width: 100%;
        border: 2px solid #000;
    }

    .table1{
        border: 0px solid #000 !important;
    }
    th, td {

        text-align: right;
        vertical-align: center;
        border: 1px solid #000;
        size: 5pt;



    }
    caption {
        padding: 0.3em;
        color: #fff;
        background: #000;
    }
    th {
        background-color: #0c3961;
        text-align: center;
        color: #fff;
    }

    .title{
        font-size: 16.5pt;
    }






    .fondo{
        position: fixed;

        width: 118%;
        height: 118%;
        margin-top: -1.5cm;
        margin-left: -1.5cm;

        overflow: hidden;
        padding: 0.1cm;
        top: -0cm;
        left: 0cm;
        border-bottom-width: 1px;
        z-index: -10000000;
    }
    #title{
        position: fixed;
        background-color: transparent;
        width: 60%;
        height: 20%;
        top: 20;
        left: 120;
        text-align: center;
        font-weight: bold;
        font-size: 15pt;

    }

    #pie{
        position: fixed;
        background-color: transparent;
        width: 75%;
        height: 10%;
        top: 745;
        left: 150;
        text-align: center;
        font-weight: bold;
        font-size: 10pt;
    }

    .img{
        position: absolute;
        width: 119%;
        height: 119%;
        margin-top: -4.18cm;
        margin-left: -1.7cm;



    }

    #firma{

    }
    #panel{
        position: absolute;
        width: 450px;
        min-height: 200px;
        float: left;
        margin-left: 6.5cm;

        margin-top: 14cm;
        background: transparent;
        text-align: right !important;
        color: #0c3961;


    }



    #panel2{
        position: absolute;
        width: 21.59cm;
        color: #0c3961;
        float: left;
        margin-top: 21cm;
        margin-left: -2cm;
        background: transparent;
        text-align: center;




    }


    hr {
        page-break-after: always;
        border: 0;
    }



</style>

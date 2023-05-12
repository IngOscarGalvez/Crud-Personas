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

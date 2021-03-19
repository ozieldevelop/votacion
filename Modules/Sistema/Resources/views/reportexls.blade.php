<html>
    <body>
        <table>


            <tr><td colspan="10" style="font-weight: bold; font-size: 12px;">Cooperativa Profesionales</td></tr>
            <tr><td colspan="10" style="font-weight: bold; font-size: 12px;">Listado de Enlaces</td></tr><br/>
            <tr style="background-color: #BDBDBD; font-size: 11px; font-weight: bold;">
                <td>ID ASOC</td>
                <td>NOMBRE</td>
                <td>ENLACE</td>
            </tr>
            @foreach($cliente as $result)
             <tr>
                  <td>{{$result->CLDOC}}</td>
                  <td>{{$result->NOMBRE}}</td>
                  <td>{{$result->Enlace}}</td>
             </tr>
             @endforeach

        </table>
    </body>
</html>
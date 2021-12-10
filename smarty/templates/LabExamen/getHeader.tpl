<table border= "1" width="90%" cellspadding="0" cellspacing="0">
    <tr><td>
            <table border='0' width="100%">   
                <tr>        
                    <td width="9%">Nombre</td>
                    <td width="45%">: <b>{$antecedente.h_apellido1} {$antecedente.h_apellido2}, {$antecedente.h_nombres}</b></td>
                    <td width="15%">Nro de Orden</td>
                    <td width="26%">: <b>{$antecedente.o_numero}</b></td>
                </tr>
                <tr>
                    <td>RUT</td>
                    <td>: {$antecedente.h_numero}</td>
                    <td>Fecha de Ingreso</td>
                    <td>: {$antecedente.o_fecha_toma|default:''}</td>
                </tr>
                <tr>
                    <td>Edad</td>
                    <td>: {$antecedente.o_edad|round:0} A&ntilde;os</td>
                    <td>Fecha de Recepci&oacute;n</td>
                    <td>: {$antecedente.l_fecha_recepcion|default:''}</td>
                </tr>
                <tr>
                    <td>Procedencia</td>
                    <td>: {$antecedente.s_nombre}</td>
                    <td>M&eacute;dico</td>
                    <td>: {$antecedente.m_nombre}</td>
                </tr>
            </table>
        </td></tr>
</table>
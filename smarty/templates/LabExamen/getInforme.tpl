<table border="0" width="100%">
{if ($doc ==1)}
<tr>
<th><b>EXAMEN</b></th>
<th><b>RESULTADO</b></th>
<th><b>UM</b></th>
<th><b>VALOR DE REFERENCIA</b></th>
</tr>
{/if}
    {foreach item=detalle key=ky from=$examen}
        {if $detalle.mostrar_titulo == "1"}
            <tr>
                <td colspan="4"><b>{$detalle.titulo}</b></td>
            </tr>
            <tr>
                <td colspan="4">&nbsp;</td>
            </tr>

        {/if}
        {foreach item=com key=ky from=$detalle.data}
            <tr style="background-color: #ededed;">
                <td  width="60%">{$com.examen} {$com.e_nombre} - {$com.p_nombre}</td>
                <td  width="10%" align="right">
                    {if is_numeric($com.l_resultado)}
                      {if ((($com.l_ref_inf != '0') && ($com.l_ref_sup !=  '0'))&&(($com.l_resultado < $com.l_ref_inf)||($com.l_resultado >$com.l_ref_sup)))}
                    
                        <span style="color:#ff0000">{$com.l_resultado|string_format:"%.2f"}</span>
                      {else}
                        {$com.l_resultado|string_format:"%.2f"}
                      
                      {/if}<span><a href='#' onclick="muestra_tendencia('{$com.h_numero}','{$com.e_codigo}','{$com.p_id}') ">Ver</a></span>  
                    {elseif $com.l_resultado != ''}
                        {$com.l_resultado}
                    {/if}
                </td>                 
                <td  width="10%">&nbsp;&nbsp;&nbsp;{$com.p_unidades}</td>            
                <td  width="15%" align="left">
                    {if (($com.l_ref_inf != '0') && ($com.l_ref_sup !=  '0'))}
                        {$com.l_ref_inf|string_format:"%.2f"} - {$com.l_ref_sup|string_format:"%.2f"}
                    {else}
                        {$com.valreferencia}
                      {*  {$com.ra_texto} *}
                    {/if}
                </td>
            </tr>
            {if $com.observacion != null}
                <tr>
                    <td colspan="4">&nbsp;</td>
                </tr>

                <tr>
                    <td colspan="4">
                        <table>
                            <tr>
                                <td width="10%">&nbsp;</td>
                                <td>{$com.observacion}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            {/if}

            {if $com.nota != null}
                <tr>
                    <td colspan="4">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="4">
                        <table width="100%">
                            <tr>
                                <td width="10%">&nbsp;</td>
                                <td>{$com.nota}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            {/if}  
            <tr>
                <td colspan="4">&nbsp;</td>
            </tr>

        {/foreach}
        <tr>
            <td colspan="4"  style="color: #333; font-size: 7pt;">&nbsp;&nbsp;&nbsp;<i>{$detalle.metodo}</i><br></td>
        </tr>        
    {/foreach}
</table>

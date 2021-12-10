<table width="100%" border="0">
    <tr>
        <td width="50%">&nbsp;</td>
        <td width="40%" align="center" >
            {if ($img != "")} 
               <img src="getFirma.php?nro_ord={$nro_ord}" width="132" height="40"><br>
            {/if} 
            {if $validado != null}
           Validado Por : {$validado}<br>
           {$fecha_val}
           {/if}
        </td>
        <td width="10%">&nbsp;</td>  
    </tr>
</table>

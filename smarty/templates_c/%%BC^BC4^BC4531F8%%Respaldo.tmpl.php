<?php /* Smarty version 2.6.13, created on 2015-10-21 10:53:05
         compiled from Respaldo.tmpl */ ?>
<script>

   <?php echo '
        $( "#btnrespaldo" ).button({icons: {primary: "ui-icon-arrowthick-1-ne"}});
   '; ?>
      


</script>
<center>
 <form id="FormRespaldo" action="Servicios/setRespaldo.php" method="post" onsubmit="if(this.adjunto.value=='')<?php echo '{alert(\'No ha seleccionado el archivo\');return false;}'; ?>
">
 <input type="hidden" name="id_atencion" value="<?php echo $this->_tpl_vars['id_atencion']; ?>
">
  Anexo <input type="file" name="adjunto">
  <br><br>
 <button type="submit" id="btnrespaldo">Grabar Datos</button>    
 </form>
</center>
<?php echo '
<script>
var optionsrespaldo = { 
                success:       showResponseRespaldo
            };   
            function showResponseRespaldo(responseText, statusText, xhr, $form)  { 
                resp = JSON.parse(responseText);
                if (resp.estado==1){
                   alert(\'Archivo subido Con Exito\'); 
                   $("#vwrespaldoi").dialog("close");
                   
                   jQuery("#list-ae").jqGrid(\'setGridParam\',{datatype:\'json\'}).trigger(\'reloadGrid\');
                    
                      
                }  
                
            }         
            $(\'#FormRespaldo\').ajaxForm(optionsrespaldo);

</script>
'; ?>

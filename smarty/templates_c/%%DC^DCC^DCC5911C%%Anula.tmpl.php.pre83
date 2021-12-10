<?php /* Smarty version 2.6.13, created on 2015-10-21 09:22:19
         compiled from Anula.tmpl */ ?>
<script>

   <?php echo '
        $( "#btnmotivoa" ).button({icons: {primary: "ui-icon-arrowthick-1-ne"}});
   '; ?>
      


</script>
<center>
 <form id="FormMotivoa" action="Servicios/setMotivoAnulacion.php" method="post"  onsubmit="return valida_anular_atencion(this);">
 <input type="hidden" name="id_atencion" value="<?php echo $this->_tpl_vars['id_atencion']; ?>
">
  Motivo Anulacion: <input type="text" name="motivo_anulacion" size="50" maxlength="300"><br><br>
  
 <button type="submit" id="btnmotivoa">Grabar Datos</button>    
 </form>
</center>
<?php echo '
<script>
var optionsmotivoa = { 
                success:       showResponseMotivoA
            };   
            function showResponseMotivoA(responseText, statusText, xhr, $form)  { 
                resp = JSON.parse(responseText);
                if (resp.estado==1){
                   alert(\'Admision Anulada\'); 
                   $("#vwanulai").dialog("close");
                   
                   jQuery("#list-ae").jqGrid(\'setGridParam\',{datatype:\'json\'}).trigger(\'reloadGrid\');
                    
                      
                }  
                
            }         
            $(\'#FormMotivoa\').ajaxForm(optionsmotivoa);

</script>
'; ?>

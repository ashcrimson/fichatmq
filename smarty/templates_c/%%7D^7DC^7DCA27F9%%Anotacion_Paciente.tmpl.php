<?php /* Smarty version 2.6.13, created on 2015-10-21 09:55:59
         compiled from Anotacion_Paciente.tmpl */ ?>
<script>

   <?php echo '
        $( "#AgregarAnotacion" ).button({icons: {primary: "ui-icon-arrowthick-1-ne"}});
   '; ?>
      


</script>
<center>
 <form id="FormAnotacion" name="FormAnotacion" action="Servicios/setAnotacion.php" method="post">
 <input type="hidden" name="id_atencion" value="<?php echo $this->_tpl_vars['id_atencion']; ?>
">
 <textarea name="anotacion" cols="50" rows="10"></textarea><br> 
 <button type="submit" id="AgregarAnotacion">Agregar Anotacion</button>    
 </form>
</center>
<?php echo '
<script>
var optionsanotacion= { 
                success:       showResponseAnotacion
            };   
            function showResponseAnotacion(responseText, statusText, xhr, $form)  { 
                resp = JSON.parse(responseText);
                if (resp.estado==1){
                    getAnotaciones();
                     $("#vwanotacion").dialog("close");
                   
                      
                }  
                
            }         
            $(\'#FormAnotacion\').ajaxForm(optionsanotacion);

</script>
'; ?>

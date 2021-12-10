<?php /* Smarty version 2.6.13, created on 2015-10-21 10:05:37
         compiled from Clasificacion_Triage.tmpl */ ?>
<script>

   <?php echo '
        $( "#realizarclasificacion" ).button({icons: {primary: "ui-icon-heart"}});
   
   function valida_triage(f){
    if(f.triage.value ==""){
     alert("Debe ingresar la clasificacion");
     return false;
    }
    return true;
   }
'; ?>
      
</script>
<center>
 <form id="FormClasificacion"  onsubmit="return valida_triage(this);" action="Servicios/setClasificacion.php" method="post">
 <input type="hidden" name="id_atencion" value="<?php echo $this->_tpl_vars['id_atencion']; ?>
">
 <select name="triage">
    <option value="">Ninguno</option>
    <option value="C1">C1</option>
    <option value="C2">C2</option>
    <option value="C3">C3</option>
    <option value="C4">C4</option>
    <option value="C5">C5</option>
 </select><br>
<?php if (( $this->_tpl_vars['ind_triage'] == 1 )): ?>
  Ubicacion de Espera
 <select name="ubicacion" >
    <?php $_from = $this->_tpl_vars['ubicaciones']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['fila']):
?>
    <option value="<?php echo $this->_tpl_vars['fila']['k']; ?>
"><?php echo $this->_tpl_vars['fila']['v']; ?>
</option>
    <?php endforeach; endif; unset($_from); ?>
 </select><br> 
<?php endif; ?>
 <button type="submit" id="realizarclasificacion" >Realizar Clasificacion</button>    
 </form>
</center>
<?php echo '
<script>
var optionsclasificacion = { 
                success:       showResponseClasificacion
            };   
            function showResponseClasificacion(responseText, statusText, xhr, $form)  { 
                resp = JSON.parse(responseText);
                if (resp.estado==1){
                   alert(\'Paciente Clasificado\');
                   $("#clasificaciontriage").dialog("close");
                   $(\'#vwficha\').load(\'ficha.php?id_atencion=';  echo $this->_tpl_vars['id_atencion'];  echo '\');
                      
                }  
                
            }         
            $(\'#FormClasificacion\').ajaxForm(optionsclasificacion);

</script>
'; ?>

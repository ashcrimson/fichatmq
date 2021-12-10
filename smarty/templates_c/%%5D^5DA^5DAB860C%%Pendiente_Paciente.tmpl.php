<?php /* Smarty version 2.6.13, created on 2015-10-21 09:46:40
         compiled from Pendiente_Paciente.tmpl */ ?>
<center>
 <form name="FormPendiente" id="FormPendiente" action="Servicios/setPendiente.php" method="post">
 <input type="hidden" name="id_atencion" value="<?php echo $this->_tpl_vars['id_atencion']; ?>
">
 <input type="hidden" name="estado_box" value="lf">
 Motivo : <input type="text" name="motivo" size="30" maxlength="100"> <br>
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

 <button type="submit" id="seleccionarsalap">Pendiente</button>    
 </form>
</center>
<?php echo '
<script>
$( "#seleccionarsalap" ).button({icons: {primary: "ui-icon-info"}});

var optionspendiente = { 
                success:       showResponsePendiente
            };   
            function showResponsePendiente(responseText, statusText, xhr, $form)  { 
                resp = JSON.parse(responseText);
                if (resp.estado==1){
                   $("#vwpendientepaciente").dialog("close");
                   $(\'#vwficha\').dialog("close");
                      
                }  
                
            }         
            $(\'#FormPendiente\').ajaxForm(optionspendiente);

</script>
'; ?>

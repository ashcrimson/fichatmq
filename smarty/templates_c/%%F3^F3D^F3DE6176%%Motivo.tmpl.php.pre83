<?php /* Smarty version 2.6.13, created on 2015-10-20 22:04:39
         compiled from Motivo.tmpl */ ?>
<script>

   <?php echo '
        $( "#btnmotivo" ).button({icons: {primary: "ui-icon-arrowthick-1-ne"}});
   '; ?>
      


</script>
<center>
 <form id="FormMotivo" action="Servicios/setMotivo.php" method="post">
 <input type="hidden" name="id_atencion" value="<?php echo $this->_tpl_vars['id_atencion']; ?>
">
  Motivo: <input type="text" name="motivo" value="<?php echo $this->_tpl_vars['datos']['motivo']; ?>
" size="50" maxlength="300"><br><br>
  Derivacion <select name="derivacion"><?php $_from = $this->_tpl_vars['ders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?><option value=<?php echo $this->_tpl_vars['k']; ?>
 <?php if (( $this->_tpl_vars['k'] == $this->_tpl_vars['datos']['derivacion'] )): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['v']; ?>
</option><?php endforeach; endif; unset($_from); ?></select><br><br>
 <button type="submit" id="btnmotivo">Grabar Datos</button>    
 </form>
</center>
<?php echo '
<script>
var optionsmotivo = { 
                success:       showResponseMotivo
            };   
            function showResponseMotivo(responseText, statusText, xhr, $form)  { 
                resp = JSON.parse(responseText);
                if (resp.estado==1){
                   alert(\'Datos Cambiados\'); 
                   $("#vwmotivo").dialog("close");
                   
                      
                }  
                
            }         
            $(\'#FormMotivo\').ajaxForm(optionsmotivo);

</script>
'; ?>

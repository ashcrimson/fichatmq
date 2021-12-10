<?php /* Smarty version 2.6.13, created on 2015-10-21 08:18:47
         compiled from VistaInstituciones.tmpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'VistaInstituciones.tmpl', 44, false),)), $this); ?>
<script>
<?php echo '
function selecciona_inst(f){
  var encontrado=0;
  var inst=null;
  var sn_credito=null;
if(f.institucion.length >0){
  for (var i = 0; i < f.institucion.length; i++) {       
    if (f.institucion[i].checked) {
        var res=f.institucion[i].value.split("_");
        inst=res[0];
        sn_credito=res[1]; 
        encontrado = 1;
        break;
    }
  }
}
else{
  if (f.institucion.checked) {
        var res=f.institucion.value.split("_");
        inst=res[0];
        sn_credito=res[1]; 
        encontrado = 1;
       
  } 
}
   if(encontrado == 0)
   {
     alert("Debe seleccionar Institucion");
   }
   else{
      document.myForm_adm.inst.value=inst;
      document.myForm_adm.sn_credito.value=sn_credito;
     // $("#admitir").prop("disabled",false);
     // $("#admitir").removeClass(\'ui-state-disabled\');
      $("#admitir").button({ disabled: false });       
      $("#vwinstituciones").dialog("close");     
   } 
  
}
$( "#seleccionar_inst" ).button({icons: {primary: "ui-icon-plus"}});
'; ?>

</script>
<?php if (( count($this->_tpl_vars['datos']) > 0 )): ?>
<form name="form_inst">
<table width="100%">
<tr>
  <th>Seleccionar</th>
  <th>Codigo</th>
  <th>Descripcion</th>
  <th>¿Con Credito (S/N) ?</th>
</tr>
<?php $_from = $this->_tpl_vars['datos']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['fila']):
?>
<tr>
  <td><center><input type="radio" name="institucion" value="<?php echo $this->_tpl_vars['fila']['cod']; ?>
_<?php echo $this->_tpl_vars['fila']['credito']; ?>
"></center></td>
  <td><center><?php echo $this->_tpl_vars['fila']['cod']; ?>
</center></td>
  <td><center><?php echo $this->_tpl_vars['fila']['desc']; ?>
</center></td>
  <td><center><?php echo $this->_tpl_vars['fila']['credito']; ?>
</center></td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>
<center><button id="seleccionar_inst" onclick="selecciona_inst(document.form_inst);" type="button">Seleccionar</button></center>
</form>
<?php else: ?>
<center>
<h2> No se encontraron Datos</h2>
</center>
<?php endif; ?>
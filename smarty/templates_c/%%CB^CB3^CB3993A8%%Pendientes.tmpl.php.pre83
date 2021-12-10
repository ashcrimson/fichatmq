<?php /* Smarty version 2.6.13, created on 2015-10-20 21:50:53
         compiled from Pendientes.tmpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'Pendientes.tmpl', 2, false),)), $this); ?>
<center>
<?php if (( count($this->_tpl_vars['lista']) > 0 )): ?>
<table border="1">
<tr><th>Id Atencion</th><th>Nombre</th><th>Ubicacion</th><th>Motivo Pendiente</th><th>Hora Asignacion Estado Pendiente</th>
</tr>
<?php $_from = $this->_tpl_vars['lista']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['fila']):
?>
<tr><td><?php echo $this->_tpl_vars['fila']['id_atencion']; ?>
</td><td><?php echo $this->_tpl_vars['fila']['nombre']; ?>
</td><td><?php echo $this->_tpl_vars['fila']['ubicacion']; ?>
</td><td><?php echo $this->_tpl_vars['fila']['motivo']; ?>
</td><td><?php echo $this->_tpl_vars['fila']['hora']; ?>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>
<?php else: ?>
<b>No hay pacientes pendientes</b>
<?php endif; ?>
</center>
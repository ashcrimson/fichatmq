<?php /* Smarty version 2.6.13, created on 2015-10-22 11:28:06
         compiled from LabExamen/getHeader.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'LabExamen/getHeader.tpl', 14, false),array('modifier', 'round', 'LabExamen/getHeader.tpl', 18, false),)), $this); ?>
<table border= "1" width="90%" cellspadding="0" cellspacing="0">
    <tr><td>
            <table border='0' width="100%">   
                <tr>        
                    <td width="9%">Nombre</td>
                    <td width="45%">: <b><?php echo $this->_tpl_vars['antecedente']['h_apellido1']; ?>
 <?php echo $this->_tpl_vars['antecedente']['h_apellido2']; ?>
, <?php echo $this->_tpl_vars['antecedente']['h_nombres']; ?>
</b></td>
                    <td width="15%">Nro de Orden</td>
                    <td width="26%">: <b><?php echo $this->_tpl_vars['antecedente']['o_numero']; ?>
</b></td>
                </tr>
                <tr>
                    <td>RUT</td>
                    <td>: <?php echo $this->_tpl_vars['antecedente']['h_numero']; ?>
</td>
                    <td>Fecha de Ingreso</td>
                    <td>: <?php echo ((is_array($_tmp=@$this->_tpl_vars['antecedente']['o_fecha_toma'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
</td>
                </tr>
                <tr>
                    <td>Edad</td>
                    <td>: <?php echo ((is_array($_tmp=$this->_tpl_vars['antecedente']['o_edad'])) ? $this->_run_mod_handler('round', true, $_tmp, 0) : round($_tmp, 0)); ?>
 A&ntilde;os</td>
                    <td>Fecha de Recepci&oacute;n</td>
                    <td>: <?php echo ((is_array($_tmp=@$this->_tpl_vars['antecedente']['l_fecha_recepcion'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
</td>
                </tr>
                <tr>
                    <td>Procedencia</td>
                    <td>: <?php echo $this->_tpl_vars['antecedente']['s_nombre']; ?>
</td>
                    <td>M&eacute;dico</td>
                    <td>: <?php echo $this->_tpl_vars['antecedente']['m_nombre']; ?>
</td>
                </tr>
            </table>
        </td></tr>
</table>
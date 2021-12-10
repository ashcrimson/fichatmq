<?php /* Smarty version 2.6.13, created on 2015-10-22 11:28:06
         compiled from LabExamen/getFirma.tpl */ ?>
<table width="100%" border="0">
    <tr>
        <td width="50%">&nbsp;</td>
        <td width="40%" align="center" >
            <?php if (( $this->_tpl_vars['img'] != "" )): ?> 
               <img src="getFirma.php?nro_ord=<?php echo $this->_tpl_vars['nro_ord']; ?>
" width="132" height="40"><br>
            <?php endif; ?> 
            <?php if ($this->_tpl_vars['validado'] != null): ?>
           Validado Por : <?php echo $this->_tpl_vars['validado']; ?>
<br>
           <?php echo $this->_tpl_vars['fecha_val']; ?>

           <?php endif; ?>
        </td>
        <td width="10%">&nbsp;</td>  
    </tr>
</table>
<?php /* Smarty version 2.6.13, created on 2017-07-17 13:17:55
         compiled from LabExamen/getInforme.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'string_format', 'LabExamen/getInforme.tpl', 27, false),)), $this); ?>
<table border="0" width="100%">
<?php if (( $this->_tpl_vars['doc'] == 1 )): ?>
<tr>
<th><b>EXAMEN</b></th>
<th><b>RESULTADO</b></th>
<th><b>UM</b></th>
<th><b>VALOR DE REFERENCIA</b></th>
</tr>
<?php endif; ?>
    <?php $_from = $this->_tpl_vars['examen']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ky'] => $this->_tpl_vars['detalle']):
?>
        <?php if ($this->_tpl_vars['detalle']['mostrar_titulo'] == '1'): ?>
            <tr>
                <td colspan="4"><b><?php echo $this->_tpl_vars['detalle']['titulo']; ?>
</b></td>
            </tr>
            <tr>
                <td colspan="4">&nbsp;</td>
            </tr>

        <?php endif; ?>
        <?php $_from = $this->_tpl_vars['detalle']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ky'] => $this->_tpl_vars['com']):
?>
            <tr style="background-color: #ededed;">
                <td  width="60%"><?php echo $this->_tpl_vars['com']['examen']; ?>
 <?php echo $this->_tpl_vars['com']['e_nombre']; ?>
 - <?php echo $this->_tpl_vars['com']['p_nombre']; ?>
</td>
                <td  width="10%" align="right">
                    <?php if (is_numeric ( $this->_tpl_vars['com']['l_resultado'] )): ?>
                      <?php if (( ( ( $this->_tpl_vars['com']['l_ref_inf'] != '0' ) && ( $this->_tpl_vars['com']['l_ref_sup'] != '0' ) ) && ( ( $this->_tpl_vars['com']['l_resultado'] < $this->_tpl_vars['com']['l_ref_inf'] ) || ( $this->_tpl_vars['com']['l_resultado'] > $this->_tpl_vars['com']['l_ref_sup'] ) ) )): ?>
                    
                        <span style="color:#ff0000"><?php echo ((is_array($_tmp=$this->_tpl_vars['com']['l_resultado'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</span>
                      <?php else: ?>
                        <?php echo ((is_array($_tmp=$this->_tpl_vars['com']['l_resultado'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>

                      
                      <?php endif; ?><span><a href='#' onclick="muestra_tendencia('<?php echo $this->_tpl_vars['com']['h_numero']; ?>
','<?php echo $this->_tpl_vars['com']['e_codigo']; ?>
','<?php echo $this->_tpl_vars['com']['p_id']; ?>
') ">Ver</a></span>  
                    <?php elseif ($this->_tpl_vars['com']['l_resultado'] != ''): ?>
                        <?php echo $this->_tpl_vars['com']['l_resultado']; ?>

                    <?php endif; ?>
                </td>                 
                <td  width="10%">&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['com']['p_unidades']; ?>
</td>            
                <td  width="15%" align="left">
                    <?php if (( ( $this->_tpl_vars['com']['l_ref_inf'] != '0' ) && ( $this->_tpl_vars['com']['l_ref_sup'] != '0' ) )): ?>
                        <?php echo ((is_array($_tmp=$this->_tpl_vars['com']['l_ref_inf'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
 - <?php echo ((is_array($_tmp=$this->_tpl_vars['com']['l_ref_sup'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>

                    <?php else: ?>
                        <?php echo $this->_tpl_vars['com']['valreferencia']; ?>

                                          <?php endif; ?>
                </td>
            </tr>
            <?php if ($this->_tpl_vars['com']['observacion'] != null): ?>
                <tr>
                    <td colspan="4">&nbsp;</td>
                </tr>

                <tr>
                    <td colspan="4">
                        <table>
                            <tr>
                                <td width="10%">&nbsp;</td>
                                <td><?php echo $this->_tpl_vars['com']['observacion']; ?>
</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            <?php endif; ?>

            <?php if ($this->_tpl_vars['com']['nota'] != null): ?>
                <tr>
                    <td colspan="4">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="4">
                        <table width="100%">
                            <tr>
                                <td width="10%">&nbsp;</td>
                                <td><?php echo $this->_tpl_vars['com']['nota']; ?>
</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            <?php endif; ?>  
            <tr>
                <td colspan="4">&nbsp;</td>
            </tr>

        <?php endforeach; endif; unset($_from); ?>
        <tr>
            <td colspan="4"  style="color: #333; font-size: 7pt;">&nbsp;&nbsp;&nbsp;<i><?php echo $this->_tpl_vars['detalle']['metodo']; ?>
</i><br></td>
        </tr>        
    <?php endforeach; endif; unset($_from); ?>
</table>
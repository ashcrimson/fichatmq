<?php /* Smarty version 2.6.13, created on 2015-11-27 16:14:58
         compiled from Parametros.tmpl */ ?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My First Grid</title>
 

<link rel="stylesheet" type="text/css" media="screen" href="jquery/css/ui.jqgrid.css" />
 <?php echo '
<style type="text/css">
html, body {
    margin: 0;
    padding: 0;
    font-size: 75%;
}
</style>
 <script>

        $( "#insparam" ).button({
         icons: {primary: "ui-icon-disk\'"}
                                         });

</script>
    <script src="jquery/js/jquery.form.js"></script> 
 
    <script> 
        // wait for the DOM to be loaded 
        $(document).ready(function() { 
            // bind \'myForm\' and provide a simple callback function 
            $(\'#myForm\').ajaxForm(function() { 
                alert("Parametros Guardados"); 
            }); 
        }); 
    /*
// prepare the form when the DOM is ready 
$(document).ready(function() { 
    var options = { 
        target:        \'#output1\',   // target element(s) to be updated with server response 
        beforeSubmit:  showRequest,  // pre-submit callback 
        success:       showResponse  // post-submit callback 
 
        // other available options: 
        //url:       url         // override for form\'s \'action\' attribute 
        //type:      type        // \'get\' or \'post\', override for form\'s \'method\' attribute 
        //dataType:  null        // \'xml\', \'script\', or \'json\' (expected server response type) 
        //clearForm: true        // clear all form fields after successful submit 
        //resetForm: true        // reset the form after successful submit 
 
        // $.ajax options can be used here too, for example: 
        //timeout:   3000 
    }; 
 
    // bind form using \'ajaxForm\' 
    $(\'#myForm1\').ajaxForm(options); 
}); 
 
// pre-submit callback 
function showRequest(formData, jqForm, options) { 
    // formData is an array; here we use $.param to convert it to a string to display it 
    // but the form plugin does this for you automatically when it submits the data 
    var queryString = $.param(formData); 
 
    // jqForm is a jQuery object encapsulating the form element.  To access the 
    // DOM element for the form do this: 
    // var formElement = jqForm[0]; 
 
    alert(\'About to submit: \\n\\n\' + queryString); 
 
    // here we could return false to prevent the form from being submitted; 
    // returning anything other than false will allow the form submit to continue 
    return true; 
} 
 
// post-submit callback 
function showResponse(responseText, statusText, xhr, $form)  { 
    // for normal html responses, the first argument to the success callback 
    // is the XMLHttpRequest object\'s responseText property 
 
    // if the ajaxForm method was passed an Options Object with the dataType 
    // property set to \'xml\' then the first argument to the success callback 
    // is the XMLHttpRequest object\'s responseXML property 
 
    // if the ajaxForm method was passed an Options Object with the dataType 
    // property set to \'json\' then the first argument to the success callback 
    // is the json data object returned by the server 
 
    alert(\'status: \' + statusText + \'\\n\\nresponseText: \\n\' + responseText + 
        \'\\n\\nThe output div should have already been updated with the responseText.\'); 
} 
*/
    </script> 
'; ?>


</head>
<body>
<form id="myForm" action="Servicios/setParametros.php" method="post"> 
<table>
  <tr><td><span class="name">Tiempo habilitado para escribir en ficha paciente egresado</span> </td><td><select name="tficha" >

                        <option value="" >Elegir</option>
                        <?php $_from = $this->_tpl_vars['combo_ficha']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?><option value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if (( $this->_tpl_vars['params']['tiempo_ficha'] == $this->_tpl_vars['k'] )): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['k']; ?>
</option><?php endforeach; endif; unset($_from); ?>
                    </select> h</td></tr>
                    <tr><td><span class="name">Tiempo en que caduca sesion tras inactividad</span></td><td><select name="tsesion">
                       <option value="" >Elegir</option>
                        <?php $_from = $this->_tpl_vars['combo_sesion']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?><option value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if (( $this->_tpl_vars['params']['tiempo_sesion'] == $this->_tpl_vars['k'] )): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['k']; ?>
</option><?php endforeach; endif; unset($_from); ?>
                    </select> min </td></tr>

</table>
    <button type="submit" id="insparam"> Grabar Parametros </button> 
</form>
</html>
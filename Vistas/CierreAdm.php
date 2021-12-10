<?php
include("../funciones.global.inc.php");
include("../funciones.inc.php");
verifica_sesion(false);

?>
<script src="jquery/js/jquery.form.js"></script>
<script>

$("#btngrabarcierre").button({icons: {primary: "ui-icon-locked"}});
var optionsCierre = {

  success:       showResponseCierre
};
function showResponseCierre(responseText, statusText, xhr, $form) {
  resp = JSON.parse(responseText);
  if (resp.estado == 1){
    alert("Cierre Administrativo Registrado Correctamente");
    $('#list-fichas').trigger( 'reloadGrid' );
    $("#vwficha").dialog('close');
  }
  else{
        alert(resp.error);
        $('#btngrabarcierre').button('enable');
  }
}
function valida_cierre(f) {
    $('#btngrabarcierre').button('disable');
     if(f.pin.value ==""){
    alert('El pin no puede ser nulo');
    $('#btngrabarcierre').button('enable');
    return false;
   }
    if(f.motivo.value ==""){
    alert('El motivo no puede ser nulo');
    $('#btngrabarcierre').button('enable');
    return false;
   }
   return true;
}
$('#myFormCierre').ajaxForm(optionsCierre);
</script>
<?php
$db=genera_adodb();
	$ficha=retorna_ficha($db,$_REQUEST["id_ficha"]);
    $db->disconnect();  
print("<form id=\"myFormCierre\" method=\"post\" onsubmit=\"return valida_cierre(this);\" action=\"Servicios/setCierreAdm.php\">");
print("<input type=\"hidden\" name=\"id_ficha\" value=\"".$_REQUEST["id_ficha"]."\">");
print("<center><table width=\"100%\">");
print("<tr><td>PIN : <input type='password' name='pin' size='4' maxlength='4'></td></tr>");
print("<tr><td>Motivo <br><textarea name='motivo' rows='20' cols='200' maxlength='300'></textarea></td></tr>");
print("<tr><td ><center><button type=\"submit\" id=\"btngrabarcierre\">Cierre Administrativo</button></center></td></tr>");
print("</table></center>");
print("</form>");
?>
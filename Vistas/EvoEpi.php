<?php
include("../funciones.global.inc.php");
include("../funciones.inc.php");
verifica_sesion(false);

?>
<script src="jquery/js/jquery.form.js"></script>
<script>

$("#btngrabarevo").button({icons: {primary: "ui-icon-plus"}});
var optionsEpi = {

  success:       showResponseEpi
};
function showResponseEpi(responseText, statusText, xhr, $form) {
  resp = JSON.parse(responseText);
  if (resp.estado == 1){
    alert("Evolucion Epidemiologica Registrada Correctamente");
    $('#list-fichas').trigger( 'reloadGrid' );
    $("#vwficha").dialog('close');
  }
  else{
        alert(resp.msg);
  }
}
$('#myFormEpi').ajaxForm(optionsEpi);
</script>
<?php
$db=genera_adodb();
	$ficha=retorna_ficha($db,$_REQUEST["id_ficha"]);
    $db->disconnect();  
print("<form id=\"myFormEpi\" method=\"post\" onsubmit=\"$('#btngrabarevo').button('disable');\" action=\"Servicios/setEvoEpi.php\">");
print("<input type=\"hidden\" name=\"id_ficha\" value=\"".$_REQUEST["id_ficha"]."\">");
print("<center><table width=\"100%\">");
print("<tr><td>Evolucion Epidemiologica <br><textarea name='evo' rows='20' cols='200'></textarea></td></tr>");
print("<tr><td ><center><button type=\"submit\" id=\"btngrabarevo\">Guardar Evolucion Epidemiologica</button></center></td></tr>");
print("</table></center>");
print("</form>");
?>
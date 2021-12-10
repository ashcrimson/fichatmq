<?php
include("../funciones.global.inc.php");
include("../funciones.inc.php");
$db=genera_adodb();
$valores=array();
$valores[]=$_REQUEST["id_ficha"];
$valores[]=$_REQUEST["sec_evo"];

$valores[]=$_REQUEST["sec"];

$sql="select adjunto,nombre_adjunto,tipo_adjunto from anexo where id_ficha=? and sec_evo=? and sec=?";
$recordset = $db->Execute($sql,$valores);
if (!$recordset) die("hhh".$db->ErrorMsg());
while ($arr = $recordset->FetchRow()) {
  $res=$arr;
 }
header('Content-Type: '.$res["tipo_adjunto"]);
header('Content-Disposition: attachment; filename='.$res["nombre_adjunto"]);
$db->disconnect();
print($res["adjunto"]);
?>



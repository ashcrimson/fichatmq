<?php
include("funciones.global.inc.php");
include("funciones.inc.php");
ini_set('display_errors','1');
$db=genera_adodb();
$sql="select id_ficha,sec_evo,evolucion from evolucion";

$recordset = $db->Execute($sql);
if (!$recordset) die("hhh".$db->ErrorMsg());
while ($arr = $recordset->FetchRow()) {
  print("Hola");
  $evolucion=gzdeflate($arr["evolucion"]);
  $sql1="update evolucion set evolucion=? where id_ficha=? and sec_evo=?";
  $recordset1 = $db->Execute($sql1,array($evolucion,$arr["id_ficha"],$arr["sec_evo"]));
}

$db->disconnect();
?>
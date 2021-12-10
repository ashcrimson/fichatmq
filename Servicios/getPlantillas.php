<?php


$datos = array();
	include("../funciones.global.inc.php");
	include("../funciones.inc.php");
	$db=genera_adodb();
	$valores=array();
verifica_sesion(false);
        $valores[]=$_SESSION["fichatmq"]["usuario"] ;
        $sql= " select
                  id as id_aux,nombre,texto,texto1,texto2,CASE tipo
    WHEN 'H' THEN 'Resumen Hospitalizacion'
    WHEN 'M' THEN 'Medicamentos'

  END tipo 
                 from plantilla where usuario=?
                 ";

        $sql.=" order by id asc ";
        $recordset = $db->Execute($sql,$valores);
  if (!$recordset) die("hhh".$db->ErrorMsg());  
 
while ($arr = $recordset->FetchRow()) {
  $arr["texto"].=$arr["texto1"].$arr["texto2"];
  $datos[]=array_map('utf8_encode', $arr);
  } 
$db->disconnect();  

$result = array();
$result["records"] = count($datos);
$result["rows"] = $datos;

echo json_encode($result);
?>

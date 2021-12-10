<?php

include_once '../libs/core.php';

if ($useDB) {
        $ficha = array();
	include("../funciones.global.inc.php");
	include("../funciones.inc.php");
	$db=genera_adodb();
	$valores=array();
	$valores[]=$_REQUEST["id_ficha_padre"];
	$valores[]=$_REQUEST["id_ficha_padre"];
	
	$sql="select a.id_ficha from ficha a where a.id_ficha_padre=? and a.estado='C' and a.fecha_modif=(select max(b.fecha_modif) from ficha b where b.id_ficha_padre=? and b.estado='C')";
      $recordset = $db->Execute($sql,$valores);
      if (!$recordset) die("hhh".$db->ErrorMsg());  
      $id_ficha="";
      while ($arr = $recordset->FetchRow()) {
       $id_ficha=$arr["id_ficha"];
      }  
	$ficha=retorna_ficha($db,$id_ficha);
        $db->disconnect();  
}


echo json_encode( $ficha);
?>

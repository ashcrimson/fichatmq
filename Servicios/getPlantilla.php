<?php
	include("../funciones.global.inc.php");
	include("../funciones.inc.php");
        verifica_sesion(false);  
	$db=genera_adodb();
        $valores=array();
        $valores[]=$_REQUEST["id_plantilla"];
        $valores[]=$_SESSION["fichatmq"]["usuario"]  ;
             
        $sql= " select
                  texto,texto1,texto2
                 from plantilla
                 where id=? and usuario=?";
        $recordset = $db->Execute($sql,$valores);
        if (!$recordset) die("hhh".$db->ErrorMsg());  
        $texto="";
        while ($arr = $recordset->FetchRow()) {
	  $arr["texto"].=$arr["texto1"].$arr["texto2"];
	  
	  $texto=utf8_encode($arr["texto"]);
         
        } 
        $results["texto"] = $texto;
         
        $db->disconnect();  
echo json_encode($results);
?>

<?php
  /*
   Funcion Script : Inicio del Sistema 
   Ultima Modificacion: 12/09/2011  
  */
include("../funciones.global.inc.php");
include("../funciones.inc.php");
include("../funciones.inc.firma.php");
$db=genera_adodb();
 verifica_sesion(false);
    if(isset($_REQUEST["pin"]) ){
	
 
    $id_us=$_SESSION["fichatmq"]["usuario"];
    $pin=$_REQUEST["pin"];
    $retorno=retorna_id_documento($id_us,$pin);
    if(isset($retorno["error"])){
     $results["estado"]=0;
     $results["error"]="Pin Invalido";
     $db->disconnect();
     echo json_encode($results);
     exit(0);
    }
   }
        $valores = array();
       $sql="update ficha set estado='C',sn_cierre_adm='S',motivo_cierre_adm=?,usuario_cierre_adm=? where id_ficha=?";
      $valores[]=$_REQUEST["motivo"];
      $valores[]=$_SESSION["fichatmq"]["usuario"];
      $valores[]=$_REQUEST["id_ficha"];
      
      $recordset = $db->Execute($sql,$valores);
   
if (!$recordset) {
  $results["estado"] = "0";
  $results["msg"] =$db->ErrorMsg();
}  
else{
  $results["estado"] = "1";
} 

$db->disconnect();
echo json_encode($results);

?>
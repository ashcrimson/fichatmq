<?php
  /*
   Funcion Script : Inicio del Sistema 
   Ultima Modificacion: 12/09/2011  
  */
include("../funciones.global.inc.php");
include("../funciones.inc.php");
$db=genera_adodb();
 verifica_sesion(false);
$sql="select (nvl(max(sec_evo),0)+1) as sec_evo from evolucion where id_ficha=?";
$recordset = $db->Execute($sql,array($_REQUEST["id_ficha"]));
       if (!$recordset) die("hhh".$db->ErrorMsg());  
       $sec_evo="";
       while ($arr = $recordset->FetchRow()) {
         $sec_evo=$arr["sec_evo"];
       }   
        $valores = array();
      $sql="insert into evolucion values (?,?,sysdate,?,?,?,?,?,?)";
      $valores[]=$_REQUEST["id_ficha"];
      $valores[]=$sec_evo;
      $str=str_replace("\n","<br>",$_REQUEST["evo"]);
      $valores[]=gzdeflate($str);
      $valores[]=$_SESSION["fichatmq"]["usuario"];
      $valores[]="D" ;
      $valores[]="";
      $valores[]="N";
      $valores[]="";
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
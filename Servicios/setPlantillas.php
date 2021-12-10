<?php
   include("../funciones.global.inc.php");
   include("../funciones.inc.php");
   $db=genera_adodb();
   verifica_sesion(false);
      if($_REQUEST["oper"] =="add"){ 

   $valores=array();
   $sql="insert into plantilla values ((select (nvl(max(id),0)+1) from plantilla where usuario=?),?,upper(?),?,?,?,?) ";
   $texto=str_split(utf8_decode($_REQUEST["texto"]), 4000);
   $valores[]=$_SESSION["fichatmq"]["usuario"]  ;
   $valores[]=$_SESSION["fichatmq"]["usuario"]  ;
   $valores[]=$_REQUEST["nombre"] ;
   $valores[]=$texto[0] ;
   $valores[]=$_REQUEST["tipo"] ;
   $valores[]=$texto[1] ;  
   $valores[]=$texto[2] ;
   $recordset = $db->Execute($sql,$valores);
  if (!$recordset) {
   $results["estado"] = "0";
   $results["error"] =$db->ErrorMsg();
  }  
  else{
   $results["estado"] = "1";
  }
  
}
elseif($_REQUEST["oper"] =="edit"){

   $valores=array();
   $campos=array();
   $sql="update plantilla set nombre=upper(?),texto=?,texto1=?,texto2=?,tipo=?
";
$sql.= " where id=? and usuario=?";
   $texto=str_split(utf8_decode($_REQUEST["texto"]), 4000);
   $valores[]=$_REQUEST["nombre"] ;
   $valores[]=$texto[0]; 
   $valores[]=$texto[1] ;
   $valores[]=$texto[2] ; 
   $valores[]=$_REQUEST["tipo"] ; 
   $valores[]=$_REQUEST["id"] ;
  
      $valores[]=$_SESSION["fichatmq"]["usuario"]  ;
   $recordset = $db->Execute($sql,$valores);
  if (!$recordset) {
   $results["estado"] = "0";
   $results["error"] =count($campos)." ".$sql." ".$db->ErrorMsg();
  }  
  else{
   $results["estado"] = "1";
  }
} 
elseif($_REQUEST["oper"] =="del"){

   $valores=array();
   $campos=array();
   $sql="delete from plantilla";
$sql.= " where id=? and usuario=? ";
   $valores[]=$_REQUEST["id"] ;
   $valores[]=$_SESSION["fichatmq"]["usuario"]  ;
   $recordset = $db->Execute($sql,$valores);
  if (!$recordset) {
   $results["estado"] = "0";
   $results["error"] =count($campos)." ".$sql." ".$db->ErrorMsg();
  }  
  else{
   $results["estado"] = "1";
  }
} 
  
  $db->disconnect();
    echo json_encode($results);
?>

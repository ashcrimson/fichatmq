<?php
require_once('../libs/nusoap/lib/nusoap.php');

include("../funciones.global.inc.php");
	include("../funciones.inc.php");
	 verifica_sesion(false);
	$db=genera_adodb();
	$valores=array();
        $valores[]=$_REQUEST["id_ficha"];
        $sql= "select 
a.inghosp
from 
ficha a 
where

a.ID_ficha=?";
        $recordset = $db->Execute($sql,$valores);
  if (!$recordset) die("hhh".$db->ErrorMsg());  
  $res="";
  $resultt=array();
  $client = new soapclient(BUS);
while ($arr = $recordset->FetchRow()) {
  $res = $client->call('GetSNHosp', array('inghosp' =>$arr["inghosp"]));
  $result=array("sn_hosp" =>$res);
} 
     $db->disconnect();
     echo json_encode($result);
?>
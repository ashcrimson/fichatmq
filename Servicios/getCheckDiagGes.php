<?php
require_once('../libs/nusoap/lib/nusoap.php');

include("../funciones.global.inc.php");
	include("../funciones.inc.php");
	 verifica_sesion(false);
	$db=genera_adodb();
	$valores=array();
        $valores[]=$_REQUEST["id_ficha"];
        $sql= "select 
a.run,
a.dv_run,
to_char(a.fec_nac,'DD/MM/YYYY') as fecha_nac,
trim(upper(trim(a.nombre))) as nombres,
trim(upper(trim(a.apellido))) as apellidos,
a.ind_sexo as sexo,
trim(upper(' ')) as direccion ,
trim(' ') as telefono,
b.cod_diag as coddiag
from 
ficha a ,diagnostico_pos b
where
a.ID_ficha=b.ID_ficha and 
a.ID_ficha=?";
        $recordset = $db->Execute($sql,$valores);
  if (!$recordset) die("hhh".$db->ErrorMsg());  
  $res=array();
  $client = new soapclient(BUS);
while ($arr = $recordset->FetchRow()) {
  $result=array();

     $usuario=$_SESSION["fichatmq"]["usuario"];
$result = $client->call('getevaluacionges', array('run' =>$arr["run"],'dv_run'=>$arr["dv_run"],'nombres'=>$arr["nombres"],"apellidos"=>$arr["apellidos"],"coddiag"=>$arr["coddiag"],"sexo"=>$arr["sexo"],"fecha_nac"=>$arr["fecha_nac"],"direccion"=>$arr["direccion"],
                                                  "telefono"=>$arr["telefono"],
												  "id"=>$_REQUEST["id_ficha"],
												  'cod_sistema' => "FT",
                 'usuario' => $usuario
                 ));
$salida=json_decode($result);
     if($salida->res =="S"){
        $res[]=array("res" =>$salida->res,"coddiag" =>$arr["coddiag"],"pdf" =>$salida->pdf);
     }
  } 
     $db->disconnect();
     echo json_encode($res);
?>
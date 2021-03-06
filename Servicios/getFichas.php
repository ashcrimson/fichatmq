<?php

include_once '../libs/core.php';

if ($useDB) {
$medicamento = array();
	include("../funciones.global.inc.php");
	include("../funciones.inc.php"); $serv=retorna_referencias("S");
	$db=genera_adodb();
	$valores=array();

         verifica_sesion(false);
       // $valores[]=$_SESSION["ficha"]["usuario"];         
         $sql= "select 
a.id_ficha,
a.run,
a.dv_run,
a.nombre,
a.apellido,
a.sn_iden,
to_char(a.fec_nac,'DD/MM/YYYY')  as fec_nac,
a.fec_ing_hosp,
to_char(a.fec_ing_hosp,'DD/MM/YYYY')  as fec_ing,
'N' as tipo_ficha,
decode(a.estado,'D','En Edicion','C','Cerrada','I','Ingresada por Interno','X','Creada Modo Abreviado') as estado,a.id_firma_doc,
a.estado as cod_estado,a.servicio_actual,a.sn_epi
from ficha a where  ((a.estado not in ('C','A')) or((a.estado in ('C')) and (trunc( (sysdate - a.fec_alta)*24 ) <=48)))";
if($_REQUEST["estado"] !=""){
	 $sql.=" and a.estado=?";
	 $valores[]=$_REQUEST["estado"];
}
if($_REQUEST["serv"] !=""){
	 $sql.=" and a.servicio_actual=?";
	 $valores[]=$_REQUEST["serv"];
}
if($_REQUEST["busq"] !=""){
	 $sql.=" and ((to_char(a.run) like '%'||?||'%') or(upper(a.nombre) like '%'||?||'%') or(upper(a.apellido) like '%'||?||'%'))";
	 $valores[]=$_REQUEST["busq"];
	 $valores[]=strtoupper($_REQUEST["busq"]);
	 $valores[]=strtoupper($_REQUEST["busq"]);
	 
	 
}

if($_REQUEST["sidx"] == "run")
$sql.=" order by 2 ".$_REQUEST["sord"];
elseif($_REQUEST["sidx"] == "nombre")
$sql.=" order by 4 ".$_REQUEST["sord"];
elseif($_REQUEST["sidx"] == "fec_ing")
$sql.=" order by 8 ".$_REQUEST["sord"];
elseif($_REQUEST["sidx"] == "apellido")
$sql.=" order by 5 ".$_REQUEST["sord"];
elseif($_REQUEST["sidx"] == "desc_serv")
$sql.=" order by 14 ".$_REQUEST["sord"];
elseif($_REQUEST["sidx"] == "estado")
$sql.=" order by 11 ".$_REQUEST["sord"];


 //and a.usuario=? 
        $recordset = $db->Execute($sql,$valores);
  if (!$recordset) die("hhh".$db->ErrorMsg());  
  $ficha=array();
while ($arr = $recordset->FetchRow()) {
     $arr["tipo_usuario"]=$_SESSION["fichatmq"]["tipo_usuario"];
	 $arr["desc_serv"]=$serv[$arr["servicio_actual"]];
     $ficha[]=$arr;
  } 
	
       
        $db->disconnect();  
} else {
	
	$medicamento = array();
	
	$valores = array();
	$valores['medicamento'] = 'Sed ut perspiciatis unde omnis iste natus error';
	$valores['dosis'] = '200mg';
	$valores['cuandoEjecutar'] = 'ASAP';
	$valores['ejecutado'] = 'S??';
	
	$medicamento[] = $valores;
	
	$valores = array();
	$valores['medicamento'] = 'Lorem ipsum dolor sit amet, consectetur';
	$valores['dosis'] = '100mg';
	$valores['cuandoEjecutar'] = '10/03/2013 08:00';
	$valores['ejecutado'] = 'No';
		
	$medicamento[] = $valores;
	
}

$result = array();
$result["records"] = count($ficha);
$result["rows"] = $ficha;

echo json_encode($result);
?>

<?php

include_once '../libs/core.php';
$filter = getParameter('term');
if ($useDB) {
$diagnostico = array();
	include("../funciones.global.inc.php");
	include("../funciones.inc.php");
	$db=genera_adodb();
	$valores=array();
        $valores[]=$filter;
        $valores[]=$filter;
        $sql= "select cod_diag||' - ' || desc_diag  as value,cod_diag||' - '||desc_diag as label from diagnostico where ((upper(desc_diag) like '%'||upper(?)||'%')or(upper(cod_diag) like '%'||upper(?)||'%'))";
        $recordset = $db->Execute($sql,$valores);
  if (!$recordset) die("hhh".$db->ErrorMsg());  
  $diagnostico=array();
while ($arr = $recordset->FetchRow()) {
     $diagnostico[]=$arr;
  } 
	
       
        $db->disconnect();  
} else {
	
	$diagnostico = array();
	
	$valores = array();
	$valores['id'] = '0';
	$valores['value'] = "Diagnóstico que contiene $filter";
	
	$diagnostico[] = $valores;

	$valores = array();
	$valores['id'] = '1';
	$valores['value'] = "Otro Diagnóstico que contiene $filter";
	
	$diagnostico[] = $valores;

	$valores = array();
	$valores['id'] = '2';
	$valores['value'] = "Demo de Diagnóstico que contiene $filter";
	
	$diagnostico[] = $valores;
	
}

echo json_encode($diagnostico);

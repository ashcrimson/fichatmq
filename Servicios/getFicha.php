<?php

include_once '../libs/core.php';

if ($useDB) {
        $ficha = array();
	include("../funciones.global.inc.php");
	include("../funciones.inc.php");
	require_once('../libs/nusoap/lib/nusoap.php');
	$client = new soapclient('http://172.25.16.18/bus/webservice/ws.php?wsdl');

	$db=genera_adodb();
	$ficha=retorna_ficha($db,$_REQUEST["id_ficha"]);
	if(count($ficha) >0){
		if($ficha[0]["servicio_egreso"] !=""){
		$servicios = $client->call('retorna_servicios_clinicos', array());
        if(count($servicios)>0)
         foreach($servicios as $kk => $vv)
		   if($vv["cod"] ==$ficha[0]["servicio_egreso"])
		    $ficha[0]["desc_servicio_egreso"] =$vv["descrip"];
	    }
		if($ficha[0]["servicio_ingreso"] !=""){
		$serv=retorna_referencias("S",$ficha[0]["servicio_ingreso"]);
        $ficha[0]["descserv"]=$serv["descrip"];

		 
	    }
		if($ficha[0]["servicio_actual"] !=""){
		$serv=retorna_referencias("S",$ficha[0]["servicio_actual"]);
        $ficha[0]["descservactual"]=$serv["descrip"];

		 
	    }
		$lab=json_decode($client->call('lista_examenes', array('run' =>$ficha[0]["run"]."-".$ficha[0]["dv_run"])),true);
		
		$fecha_comp=$ficha[0]["fec_ing_hosp_comp"];
		$lab_aux=array();
		foreach($lab as $ii => $ex){
		   	$lab_aux[$ex["o_numero"]]=$ex;	
		}
		krsort($lab_aux);
		foreach($lab_aux as $ii => $ex){
         $fecha_ex=substr($ex["fecha_toma"],6,4).substr($ex["fecha_toma"],3,2).substr($ex["fecha_toma"],0,2);
         if($fecha_ex >= $fecha_comp)
          $ficha[0]["lab"][]=$ex;  
         }
		 
	}
        $db->disconnect();  
} else {
	
	$medicamento = array();
	
	$valores = array();
	$valores['medicamento'] = 'Sed ut perspiciatis unde omnis iste natus error';
	$valores['dosis'] = '200mg';
	$valores['cuandoEjecutar'] = 'ASAP';
	$valores['ejecutado'] = 'Sí';
	
	$medicamento[] = $valores;
	
	$valores = array();
	$valores['medicamento'] = 'Lorem ipsum dolor sit amet, consectetur';
	$valores['dosis'] = '100mg';
	$valores['cuandoEjecutar'] = '10/03/2013 08:00';
	$valores['ejecutado'] = 'No';
		
	$medicamento[] = $valores;
	
}



echo json_encode( $ficha);
?>

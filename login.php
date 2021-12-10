<?php
$salida=array();
require_once 'funciones.global.inc.php';
require_once 'funciones.inc.php';
verifica_sesion(false);
session_destroy();
unset($_SESSION["protocolo"]);
verifica_sesion(false);
$cod_u = null;
$salida=array();
$clave = '';
$correcta = -1;


if (isset($_REQUEST['email'])) {
  if(count(explode('@',$_REQUEST['email']))>1){
    $arr_login=explode('@',$_REQUEST['email']);
    $cod_u   =$_REQUEST['email'];
    $dominio=$arr_login[1];
  } 
  else{
    $cod_u   = $_REQUEST['email']."@sanidadnaval.cl";
    $dominio ="sanidadnaval.cl";
  }
  $clave = $_REQUEST['clave'];
} 


if($dominio !="sanidadnaval.cl"){
  $result["resp"]=0;
  $result["mensaje"]="Dominio Incorrecto. Debe ser sanidadnaval.cl"; 
  unset($cod_u);
}


if (isset($cod_u)) {
  if(isset($clave)){
   require_once('libs/nusoap/lib/nusoap.php');
   $usuario=explode('@',$cod_u);
   $client = new soapclient('http://172.25.16.18/bus/webservice/ws.php?wsdl');
   $result = $client->call('autentifica_ldap', array('id' =>$usuario[0],'clave'=>$clave));
   $result["resp"]= 1; 
  if($result["resp"]== 1){
    $correcta=1;
    $_SESSION["protocolo"]["usuario"]=strtolower(trim($cod_u));
    $_SESSION["protocolo"]["nombre_usuario"]=$result["nombre"];
    
   }
  }

  
}

if ( isset( $_SESSION["protocolo"]['usuario'] ) && $correcta == 1 ) {  
     
    
    $salida['estado'] = $result["resp"];
}
else {
  $_SESSION["protocolo"] = array();
  $salida['estado'] = $result["resp"];
  $salida['mensaje'] = $result["mensaje"];

  
}
echo json_encode($salida);
  
?>

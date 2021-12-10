<?php
header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
/*
   Funcion Script : Libreria de Funciones Globales del Sistema 
   Ultima Modificacion: 05/01/2013  
*/
define('ADODB_ASSOC_CASE',0);
define("BUS",'http://172.25.16.18/bus/webservice/ws.php?wsdl');
require_once 'libs/Smarty/libs/Smarty.class.php';
include "libs/adodb5/adodb.inc.php";
function genera_smarty() {
  $smarty = new Smarty;
  $smarty->template_dir = '../smarty/templates';
  $smarty->compile_dir  = '../smarty/templates_c';
  $smarty->config_dir   = '../smarty/configs';
  $smarty->cache_dir    = '../smarty/cache';
  $smarty->caching = false;
  $smarty->compile_check = true;
  $smarty->debugging = false;
  return $smarty;
}
function genera_adodb($tipo=null){
  if($tipo =="portal")
  $db=NewADOConnection("oci8po://portal:portal@172.25.23.84:1521/orcl");
  else
  $db=NewADOConnection("oci8po://fichatmq:fichatmq@172.25.23.84:1521/orcl");
  if(!$db){
    $db->ErrorMsg();
  }
  $db->SetFetchMode(ADODB_FETCH_ASSOC);
  
  return $db;
}

function verifica_sesion($redir = true) {
 

  if (!isset($_SESSION["fichatmq"]) || count($_SESSION["fichatmq"]) < 1) {
    ini_set("session.cookie_domain", ".hospitalnaval.cl");
    session_start();
  }
  if (!isset($_SESSION["fichatmq"]['cod_u']) && $redir) {
    header('Location: index.php');
    exit(0);
  }
  if (!isset($_SESSION["portal"]['email'])) {
   
    header('Location: http://registrosclinicos.hospitalnaval.cl');
    exit(0);
  }
}
function datos_usuario($db, &$arreglo, $run) {
  
  $res=array();
  $valores=array();
  $valores[]=$run;
  $recordset = $db->Execute("select * from usuario where cod_u=? and ind_hab='Si'",$valores);
    if (!$recordset) die($db->ErrorMsg());  
  $encontrado=0;

  while ($arr = $recordset->FetchRow()) {

    foreach($arr as $c => $v)
      $arreglo[$c]=utf8_encode($v);
    $encontrado=1;
  }
  if ($encontrado==0){
    return;
  }
  return;
}
?>

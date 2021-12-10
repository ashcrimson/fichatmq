<?php
require_once('../libs/nusoap/lib/nusoap.php');
include("../funciones.global.inc.php");
include("../funciones.inc.php");

$client = new soapclient("http://172.25.16.18/bus/webservice/ws.php?wsdl");
$smarty=genera_smarty() ;
verifica_sesion(false);
$result = $client->call('retorna_resultados_examenes', array('nro_ord'=>$_REQUEST["nro_orden"],'rut' =>$_REQUEST["run"]));
/*
print("<pre>");
print_r($_REQUEST);
print_r($result);
print("</pre>");
exit(0);
*/
$xres=formatea_salida_LabExamen($result);
/*
print("<pre>");
print_r($xres);
print("</pre>");
exit(0);
*/
       $smarty->assign('run',$_REQUEST["run"]);

$html="";
$html.=$smarty->fetch('LabExamen/getCabecera.tpl');
$ind=1;
 foreach ($xres['datos'] as $ky => $res) {
   
        $smarty->assign('examen', $res);
        $smarty->assign('antecedente', $xres['header']['antecedente'][$ky]);
        $smarty->assign('firma', '');
        $smarty->assign('validado', $xres['header']['antecedente'][$ky]['usr_name']);
        $smarty->assign('fecha_val', $xres['header']['antecedente'][$ky]['fecha_val']);
        if($ind ==1){
         $html.=$smarty->fetch('LabExamen/getHeader.tpl');
         $html.="<br><br><br>";
         $smarty->assign('doc', '1');
         $ind++;
        }
        $html .= $smarty->fetch('LabExamen/getInforme.tpl');
        }



        
       $smarty->assign('run',$_REQUEST["run"]);
   
       $smarty->assign('nro_ord',$_REQUEST["nro_orden"]);
  
if(count($xres['datos']) > 0)
$html .= $smarty->fetch('LabExamen/getFirma.tpl');
 else{
$smarty->assign('error','Error. No se encuentra informaci&oacute;n con los datos ingresados.');

 }
$html.=$smarty->fetch('LabExamen/getPie.tpl');
echo $html;

?>
<script>
   function Muestra_Grafico(){


<?php
/*
[h_apellido1] => FREDES
            [h_apellido2] => CHAPA
            [h_nombres] => HERNAN OSVALDO
            [m_nombre] => 
            [o_fecha_toma] => 07072013 07072013                    
            [h_numero] => 11519881-5
            [l_fecha_recepcion] => 07072013
            [fecha_val] => 07072013 013518                      
            [s_nombre] => URGENCIA GENERAL 
            [o_edad] => 43
            [usr_name] => TM Trinidad Mandic Burgos
            [e_nombre] => AMILASA EN SANGRE
            [p_nombre] => AMILASA EN SANGRE
            [l_resultado] => 44
            [l_ref_inf] => 25
            [l_ref_sup] => 125
            [p_unidades] => UL
            [o_numero] => 2328672
            [o_id] => 1184027
            [g_id] => 1
            [e_id] => 4
            [e_codigo] => 302008
            [l_orden_imp] => 66561
            [e_orden_imp] => 4
            [p_id] => 4
            [l_resultnum] => 44
            [l_estado] => 4
            [e_label] => 0
            [p_confidencial] => 0
            [p_tipo_resultado] => N
            [e_metodo] => Mtodo Enzimtico.
            [ra_texto] => 
            [observacion] => 
            [nota] => 
            [valreferencia] => 25 / 125
*/
require_once('../libs/nusoap/lib/nusoap.php');
include("../funciones.global.inc.php");
include("../funciones.inc.fichaupc.php");


$client = new soapclient("http://172.25.16.18/bus/webservice/ws.php?wsdl");
$smarty=genera_smarty() ;
verifica_sesion(false);
$result = $client->call('retorna_resultados_examenes_codigo', array('rut' =>$_REQUEST["run"],'codigo'=>$_REQUEST["codigo"],'p_id'=>$_REQUEST["p_id"]));
$graf=array();
if(count($result)>0)
foreach($result as $ke => $exas){
       //print($exas["o_fecha_toma"]);
       $fecha=substr($exas["o_fecha_toma"],4,4).substr($exas["o_fecha_toma"],2,2).substr($exas["o_fecha_toma"],0,2).substr($exas["o_fecha_toma"],9,2).substr($exas["o_fecha_toma"],11,2).substr($exas["o_fecha_toma"],13,2);
       $exas["fecha_toma_g"]=substr($exas["o_fecha_toma"],0,2)."/".substr($exas["o_fecha_toma"],2,2)."/".substr($exas["o_fecha_toma"],4,4) ." ".substr($exas["o_fecha_toma"],9,2).":".substr($exas["o_fecha_toma"],11,2).":".substr($exas["o_fecha_toma"],13,2);
       
       $datos[$fecha][]=$exas;
       $cabecera["titulo"]=$exas["e_nombre"]. ' - '.$exas["p_nombre"];
}
ksort($datos);
$cont=0;
if(count($datos)>0)
foreach($datos as $k => $exas){
foreach($exas as $kr => $res){
if($cont==0){
   
//$min=date('Y-m-d', strtotime('-1 day', strtotime($res["fecha_toma_g"])));
$min=0;
}
//$max=date('Y-m-d', strtotime('+2 day', strtotime($res["fecha_toma_g"])));   
$cont++;
$max=$cont +1;
$graf[]="['".$res["fecha_toma_g"]."',".$res["l_resultado"]."]" ;
//$graf[]="[".$cont.",".$res["l_resultado"]."]" ;
}
}
	print("var line1=[".implode(",",$graf)."];\n");

print("var plot1 = $.jqplot('chart1', [line1], {\n");
print("    title:'".$cabecera["titulo"]."',\n");
?>
height: 400,
    axes:{
        xaxis:{
            //renderer:$.jqplot.DateAxisRenderer,
			renderer: $.jqplot.CategoryAxisRenderer,
		 tickRenderer: $.jqplot.CanvasAxisTickRenderer ,
        tickOptions: {
            angle: 70
            
        }
            //tickInterval:'30 day',
			//numberTicks: '<?php echo $max; ?>',
			//min:'<?php echo $min; ?>',
			//max:'<?php echo $max; ?>'
			
        },
			yaxis: {
                tickOptions:{
                  formatString: "%#.2f"
                }
              }
    },
    series:[{lineWidth:4,pointLabels: { show:true }  }],
	highlighter: {
        show: false,
        sizeAdjust: 7.5
      }
  });

     }; 
</script>
<div id='chart1' ></div>
<style type="text/css">
#chart1 .jqplot-point-label {
  border: 1.5px solid #aaaaaa;
  padding: 1px 3px;
  background-color: #eeccdd;
}
</style>


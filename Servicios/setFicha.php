<?php
/*
   Funcion Script : Inicio del Sistema 
   Ultima Modificacion: 12/09/2011  
*/ date_default_timezone_set('America/Santiago');
   include_once("../libs/core.php");
   include("../funciones.global.inc.php");
   include ('../libs/phppdf/class.ezpdf.php');
   include("../funciones.inc.php");
   include("../funciones.inc.firma.php");
   require_once('../libs/nusoap/lib/nusoap.php');
   $client = new soapclient(BUS);
   verifica_sesion(false);
   $db=genera_adodb();
   $results=array();
   if(isset($_REQUEST["pin"]) ){
	
   if(($_REQUEST["trans"] =="cierre")&&($_REQUEST["estado"] =="C")){
    $id_us=$_SESSION["fichatmq"]["usuario"];
    $pin=$_REQUEST["pin"];
    $retorno=retorna_id_documento($id_us,$pin);
    if(isset($retorno["error"])){
     $results["estado"]=0;
     $results["error"]="Error al firmar : ".$retorno["error"];
     $db->disconnect();
     echo json_encode($results);
     exit(0);
    }
    else{
    $id_doc=$retorno["id"];
    }
   }
   }
   if($_REQUEST["trans"] =="val"){
	
     $valores=array();
  $sql="
  update ficha
  set
  estado=?,
  usuario =?, 
	fecha_modif=sysdate where id_ficha=?
  ";
   
	 $valores[]="D";
     $valores[]=$_SESSION["fichatmq"]["usuario"] ;
     $valores[]=$_REQUEST["id_ficha"] ;

   $recordset = $db->Execute($sql,$valores);
   if (!$recordset) {
   $results["estado"] = "0";
   
   $results["error"] ="Error al validar.".$db->ErrorMsg();
  }  
  else{
   $valores = array();
    $sql="delete from datos_ficha where id_ficha=?";
    $valores[]=$_REQUEST["id_ficha"];
    $recordset = $db->Execute($sql,$valores);
    if (!$recordset) die("hhh".$db->ErrorMsg());   
    foreach($_REQUEST as $k => $v){
      if(substr($k,0,6)=="datos_"){
        $cod=substr($k,6);
        $valores = array();
        $sql="insert into datos_ficha values (?,?,?,?)";
        $valores[]=$_REQUEST["id_ficha"];
        $valores[]=$cod;
        $valores[]=gzdeflate($v);
        $valores[]=gzdeflate($_REQUEST["obs_datos_".$cod]);
        
        $recordset = $db->Execute($sql,$valores);
        if (!$recordset) die("hhh".$db->ErrorMsg());   
        
      }
    }
 
       
   
   $results["estado"] = "3";
  }
     $db->disconnect();
     echo json_encode($results);
     exit(0);
   }
      if($_REQUEST["trans"] =="valevo"){
     $valores=array();
  $sql="
  update evolucion
  set
  evolucion=?,
  estado=?,
  usuario =? where id_ficha=? and sec_evo=?
  ";
     $valores[]=gzdeflate($_REQUEST["evolucion"]) ;
	 
	 $valores[]="D";
     $valores[]=$_SESSION["fichatmq"]["usuario"] ;
     $valores[]=$_REQUEST["id_ficha"] ;
	 $valores[]=$_REQUEST["sec_evo"] ;
	 

   $recordset = $db->Execute($sql,$valores);
   if (!$recordset) {
   $results["estado"] = "0";
   
   $results["error"] ="Error al validar.".$db->ErrorMsg();
  }  
  else{
   $results["estado"] = "5";
  }
     $db->disconnect();
     echo json_encode($results);
     exit(0);
   }
   if($_REQUEST["sn_ci"] =="S"){
	 $valores = array();
    $sql="delete from datos_ficha where id_ficha=?";
    $valores[]=$_REQUEST["id_ficha"];
    $recordset = $db->Execute($sql,$valores);
    if (!$recordset) die("hhh".$db->ErrorMsg());   
    foreach($_REQUEST as $k => $v){
      if(substr($k,0,6)=="datos_"){
        $cod=substr($k,6);
        $valores = array();
        $sql="insert into datos_ficha values (?,?,?,?)";
        $valores[]=$_REQUEST["id_ficha"];
        $valores[]=$cod;
        $valores[]=gzdeflate($v);
                $valores[]=gzdeflate($_REQUEST["obs_datos_".$cod]);

        $recordset = $db->Execute($sql,$valores);
        if (!$recordset) die("hhh".$db->ErrorMsg());   
        
      }
    }
    $valores = array();
	$valores[]=$_SESSION["fichatmq"]["usuario"] ;
      $valores[]=$_REQUEST["id_ficha"];
	  
      
      $sql="update ficha set estado='D',usuario=?,fecha_creacion=sysdate where id_ficha=?";
      $recordset = $db->Execute($sql,$valores);
  

   $results["estado"] = "2";
	
   }
   if($_REQUEST["trans"] =="add"){
     $valores=array();
     $sql="select (nvl(max(id_ficha),0)+1) as id_ficha from ficha";
     $recordset = $db->Execute($sql,$valores);
  if (!$recordset) die("hhhfff".$db->ErrorMsg());  
  $id_ficha="";
while ($arr = $recordset->FetchRow()) {
     $id_ficha=$arr["id_ficha"];
  }  
   $valores=array();
   $sql="insert into ficha values(
   ?,
   ?,
   ?,
   ?,
   ?,
   ?,
   to_date(?,'DD/MM/YYYY'),
   ?,
   ?,
   ?,
   to_date(?,'DD/MM/YYYY'),
   ?,
   ?,
   ?,
   ?,
   sysdate,
   null,
   null,
   null,
   null,
   null,
   null,
   null,
   null,
   null,
   null,
   null,
   null,
   ?,
   null,?,null,?,?,?,?,?,'N',null,null,null";
   
   $valores[]=$id_ficha;
   $valores[]=$_REQUEST["run"] ;
   $valores[]=$_REQUEST["dv_run"] ;
   $valores[]=$_REQUEST["nombre"] ;
   $valores[]=$_REQUEST["apellido"] ;
   $valores[]=$_REQUEST["sn_iden"] ;
   $valores[]=$_REQUEST["fec_nac"] ;
   $valores[]=$_REQUEST["grado"] ;
   $valores[]=$_REQUEST["edad"] ;
   $valores[]=$_REQUEST["ind_sexo"] ;
   $valores[]=$_REQUEST["fec_ing"] ;
   $valores[]=$_REQUEST["hora_ini"] ;
   $valores[]=$_REQUEST["minuto_ini"] ;
   if($_SESSION["fichatmq"]["tipo_usuario"] ==3){
   $valores[]="I" ;
  // elseif($_REQUEST["tipo_ficha"] ==3)
  // $valores[]="C" ;
   }
   else{
   if($_REQUEST["sn_abr"] =="N")	
   $valores[]="D" ;
   else
   $valores[]="X" ;
   
   }
   $valores[]=$_SESSION["fichatmq"]["usuario"] ;
   
   $valores[]=$_REQUEST["serv_ingreso"] ;
   if($_SESSION["fichatmq"]["tipo_usuario"] ==3)
   $valores[]=$_SESSION["fichatmq"]["usuario"];
   else
   $valores[]="";
   $valores[]=$_REQUEST["inghosp"] ;
   $valores[]=$_REQUEST["serv_actual"] ;
    $valores[]=$_REQUEST["edad_m"] ;
	 $valores[]=$_REQUEST["edad_d"] ;
	 $valores[]=$_REQUEST["codinst"] ;
	    if($_REQUEST["sn_abr"] =="S"){
	    $sql.=",?,?,sysdate ";
		$valores[]=trim($_REQUEST["abreviado"]);
		 $valores[]=$_SESSION["fichatmq"]["usuario"];
		 }
		else{
		$sql.=",null,null,null ";	 
		 
		 } 
    $sql.=")";
   $recordset = $db->Execute($sql,$valores);
  if (!$recordset) {
   $results["estado"] = "0";
   /*print($sql);
    print_r($valores);*/
  
   $results["error"] =$db->ErrorMsg();
  }  
  else{
    
    $valores = array();
    $sql="delete from datos_ficha where id_ficha=?";
    $valores[]=$id_ficha;
    $recordset = $db->Execute($sql,$valores);
    if (!$recordset) die("hhh".$db->ErrorMsg());   
    foreach($_REQUEST as $k => $v){
      if(substr($k,0,6)=="datos_"){
        $cod=substr($k,6);
        $valores = array();
        $sql="insert into datos_ficha values (?,?,?,?)";
        $valores[]=$id_ficha;
        $valores[]=$cod;
        $valores[]=gzdeflate($v);
                $valores[]=gzdeflate($_REQUEST["obs_datos_".$cod]);

        $recordset = $db->Execute($sql,$valores);
        if (!$recordset) die("hhh".$db->ErrorMsg());   
        
      }
    }
    
  

   $results["estado"] = "1";
  }
  
}
elseif($_REQUEST["trans"] =="reabre"){
 $valores=array();
  $sql="
  update ficha
  set
  estado='D',id_firma_doc=null,USUARIO_EGR=null,fecha_modif=sysdate where id_ficha=?
  ";
     
	 
     $valores[]=$_REQUEST["id_ficha"] ;

   $recordset = $db->Execute($sql,$valores);
  if (!$recordset) {
   $results["estado"] = "0";
   $results["error"] =$db->ErrorMsg();
  }  
  else{
   $results["estado"] = "6";
   
  }
}
 elseif($_REQUEST["trans"] =="cierre"){
  $valores=array();
  $sql="
  update ficha
  set
  estado=?,
  IND_DIAG_POS =?, 
	OBS_DIAG_POS =?, 
	
	FEC_ALTA =to_date(?,'DD/MM/YYYY')  ,
    HORA_ALTA =?,
	MINUTO_ALTA=?,
    servicio_egreso=?,
	RESUMEN_alta=?,
	INDICACIONES_ALTA=?,
    MEDICAMENTOS_ALTA=?,
    

	USUARIO_EGR=?,fecha_modif=sysdate,sn_epi=?,destino_egreso=?,sn_covid=? where id_ficha=?
  ";
     $valores[]=$_REQUEST["estado"] ;
     $valores[]=$_REQUEST["ind_diag_pos"] ;
     $valores[]=gzdeflate($_REQUEST["obs_diag_pos"]) ;
     $valores[]=$_REQUEST["fec_egr"] ;
     $valores[]=$_REQUEST["hora_ter"] ;
     $valores[]=$_REQUEST["minuto_ter"] ;
	
	 
     $valores[]=$_REQUEST["servicio_egreso"] ;
     
     $valores[]=gzdeflate($_REQUEST["resumen_alta"]) ;
     $valores[]=gzdeflate($_REQUEST["indicaciones_alta"]) ;
     $valores[]=gzdeflate($_REQUEST["medicamentos_alta"]) ;
     

     $valores[]=$_SESSION["fichatmq"]["usuario"] ;
	 $valores[]=$_REQUEST["sn_epi"]  ;
	 $valores[]=$_REQUEST["destino_egreso"]  ;
	 $valores[]=$_REQUEST["sn_covid"]  ;
	 
     $valores[]=$_REQUEST["id_ficha"] ;

   $recordset = $db->Execute($sql,$valores);
  if (!$recordset) {
   $results["estado"] = "0";
   $results["error"] =$db->ErrorMsg();
  }  
  else{
  
  if((isset($_REQUEST["diag_pos"])) &&($_REQUEST["diag_pos"] != "")){
    $datos=array();
    $datos=split(",",$_REQUEST["diag_pos"]);
    if(count($datos) >0){
      $valores = array();
      $sql="delete from diagnostico_pos where id_ficha=?";
      $valores[]=$_REQUEST["id_ficha"];
      $recordset = $db->Execute($sql,$valores);
      if (!$recordset) die("hhh".$db->ErrorMsg());   
      foreach($datos as $k => $v){
        $valores = array();
      $sql="insert into diagnostico_pos values (?,?)";
      $valores[]=$_REQUEST["id_ficha"];
      $valores[]=$v;  
      $recordset = $db->Execute($sql,$valores);
      if (!$recordset) die("hhh".$db->ErrorMsg());   
      
      }     
    }
   }
  
        if($_REQUEST["estado"] =="D")
        $results["estado"] = "3";
        else{
		   if(isset($_REQUEST["pin"]) ){
         $doc=getpdfEpicrisis($db,$_REQUEST["id_ficha"],$id_doc,$retorno);
         $ok=firmar_documento($id_doc,$id_us,$pin,$doc);
         if ($ok == "OK"){
		  $res_rec = $client->call('cierra_recetas', array('id' =>$_REQUEST["id_ficha"],'tipo'=>"Q"));
		  
         $results["estado"]=4;
		  $results["id_firma_doc"]=$id_doc;
      $valores = array();
      $valores[]=$id_doc;
      $valores[]=$_REQUEST["id_ficha"];
      
      $sql="update ficha set id_firma_doc=? where id_ficha=?";
      $recordset = $db->Execute($sql,$valores);
      if (!$recordset) die("hhhfff".$db->ErrorMsg());   
     }
    else{
       $valores = array();
      $valores[]=$_REQUEST["id_ficha"];
      
      $sql="update ficha set estado='D' where id_ficha=?";
      $recordset = $db->Execute($sql,$valores);
      if (!$recordset) die("hhhfff".$db->ErrorMsg());   
     
     $results["estado"]=0;
     $results["error"]="Error al firmar";
     
    }
        
        }
		else{
		 $res_rec = $client->call('cierra_recetas', array('id' =>$_REQUEST["id_ficha"],'tipo'=>"Q"));
		  
		 $results["estado"]=4;
		 
		}
		}
  }
  //$results["estado"]=0;
//		    $results["error"]="Error al cerrar la ficha";
		 
 } 
 else{

   $valores=array();
   $campos=array();
   if($_REQUEST["usuario"] == $_SESSION["fichatmq"]["usuario"] ){
   if($_REQUEST["sn_enmienda"] =="S"){
   $valores[]=$_REQUEST["id_ficha"] ; 
   $sql="insert into datos_ficha_enmienda (select a.id_ficha,(select nvl(b.fecha_modif,b.fecha_creacion) from ficha b where a.id_ficha=b.id_ficha) as fecha,a.cod,a.valor,a.obs from datos_ficha a where a.id_ficha=?)";
   $recordset = $db->Execute($sql,$valores);
   
   $sql="update ficha set fecha_modif=sysdate where id_ficha=?";
   $recordset = $db->Execute($sql,$valores);
   $id_ficha=$_REQUEST["id_ficha"];
   $valores = array();
    $sql="delete from datos_ficha where id_ficha=?";
    $valores[]=$id_ficha;
    $recordset = $db->Execute($sql,$valores);
    if (!$recordset) die("hhh".$db->ErrorMsg());   
    foreach($_REQUEST as $k => $v){
      if(substr($k,0,9)=="enmdatos_"){
        $cod=substr($k,9);
        $valores = array();
        $sql="insert into datos_ficha values (?,?,?,?)";
        $valores[]=$id_ficha;
        $valores[]=$cod;
        $valores[]=gzdeflate($v);
                $valores[]=gzdeflate($_REQUEST["obs_enmdatos_".$cod]);

        $recordset = $db->Execute($sql,$valores);
        if (!$recordset) die("hhh".$db->ErrorMsg());   
        
      }
    }
      

	
   }
   
 
   if(trim($_REQUEST["evolucion"]) !=""){
     $sql="select (nvl(max(sec_evo),0)+1) as sec_evo from evolucion where id_ficha=?";
       $recordset = $db->Execute($sql,array($_REQUEST["id_ficha"]));
       if (!$recordset) die("hhh".$db->ErrorMsg());  
       $sec_evo="";
       while ($arr = $recordset->FetchRow()) {
         $sec_evo=$arr["sec_evo"];
       }
	   $sql="select estado from ficha where id_ficha=?";
       $recordset = $db->Execute($sql,array($_REQUEST["id_ficha"]));
       if (!$recordset) die("hhh".$db->ErrorMsg());  
       $estado="";
       while ($arr = $recordset->FetchRow()) {
         $estado=$arr["estado"];
       }
	   if($estado=="X")
	     $sn_abreviado='S';
	   else
	     $sn_abreviado='N';
        $valores = array();
      $sql="insert into evolucion values (?,?,sysdate,?,?,?,?,?,?,?)";
      $valores[]=$_REQUEST["id_ficha"];
      $valores[]=$sec_evo;
	  $str=$_REQUEST["evolucion"];
      $str=str_replace('<form','<formresp',$str);
$str=str_replace('</form','</formresp',$str);
      $valores[]=gzdeflate($str);
      $valores[]=$_SESSION["fichatmq"]["usuario"];
      if($_SESSION["fichatmq"]["tipo_usuario"] ==3)
   $valores[]="I" ;
   else
   $valores[]="D" ;
   if($_SESSION["fichatmq"]["tipo_usuario"] ==3)
   $valores[]=$_SESSION["fichatmq"]["usuario"];
   else
   $valores[]="";
   $valores[]=($_REQUEST["interconsulta"] =="S") ? "S" : "N";
   $valores[]=$_REQUEST["especialidad"];
   $valores[]=$sn_abreviado;
   
   
      $recordset = $db->Execute($sql,$valores);
	   // Inicio Interconsulta
	  if($_REQUEST["interconsulta"] =="S"){
	   $ficha=retorna_ficha($db,$_REQUEST["id_ficha"]);
	   if($ficha[0]["codinst"] !=""){
	  $valores=array();
 
   $valores["run"]=$ficha[0]["run"] ;
   $valores["dv_run"]=$ficha[0]["dv_run"] ;
   $valores["nombre"]=$ficha[0]["nombre"] ;
   $valores["apellido"]=$ficha[0]["apellido"] ;
   $valores["sn_iden"]=$ficha[0]["sn_iden"] ;
   $valores["fec_nac"]=$ficha[0]["fec_nac"] ;
   $valores["ind_sexo"]=$ficha[0]["ind_sexo"] ;
   $valores["grado"]=$ficha[0]["grado"] ;
   $valores["inghosp"]=$ficha[0]["inghosp"] ;
   $valores["fec"]=date('d/m/Y');
   $valores["hora"]=date('H');
   $valores["minuto"]=date('i') ;
   $valores["codinst"]=$ficha[0]["codinst"] ;
   $valores["codprest"]="101009";
   $valores["dvprest"]="9";
   $valores["codbod"]="0";
   $valores["cantidad"]="1";
   $valores["tipo_atencion"]="2";
   $valores["tipo_pago"]="1";
   $valores["forma_pago"]="1";
   $valores["medico"]=$_SESSION["fichatmq"]["usuario"]; 
   $valores["usuario"]=$_SESSION["fichatmq"]["usuario"];
   $respuesta= $client->call('setInterconsulta', array("input"=>json_encode($valores)));
	   }
	  }
	  // Termino Interconsulta
       if(isset($_FILES["adjunto"])){
	  
      $sql="select (nvl(max(sec),0)+1) as sec from anexo where id_ficha=? and sec_evo=?";
       $recordset = $db->Execute($sql,array($_REQUEST["id_ficha"],$sec_evo));
       if (!$recordset) die("hhh".$db->ErrorMsg());  
       $sec="";
       while ($arr = $recordset->FetchRow()) {
         $sec=$arr["sec"];
       }   
      $valores=array();
      $valores[]=$_REQUEST["id_ficha"];
      $valores[]=$sec_evo;
      
      $valores[]=$sec;
      
      $valores[]=$_FILES["adjunto"]["type"];

      $valores[]=$_FILES["adjunto"]["name"];
      $sql="insert into anexo values (?,?,?,empty_blob(),?,?)";
      $recordset = $db->Execute($sql,$valores);
//         if (!$recordset) die("hhh".$db->ErrorMsg()); 
      $db->UpdateBlobFile("anexo","adjunto",$_FILES["adjunto"]["tmp_name"],"id_ficha=".$_REQUEST["id_ficha"] ." and sec=".$sec." and sec_evo=".$sec_evo,"BLOB");
    }
     
    }  
   
   $results["estado"] = "2";
  //}
   }
  
   elseif(trim($_REQUEST["evolucion"]) !=""){
       $sql="select (nvl(max(sec_evo),0)+1) as sec_evo from evolucion where id_ficha=?";
       $recordset = $db->Execute($sql,array($_REQUEST["id_ficha"]));
       if (!$recordset) die("hhh".$db->ErrorMsg());  
       $sec_evo="";
       while ($arr = $recordset->FetchRow()) {
         $sec_evo=$arr["sec_evo"];
       }
	   $sql="select estado from ficha where id_ficha=?";
       $recordset = $db->Execute($sql,array($_REQUEST["id_ficha"]));
       if (!$recordset) die("hhh".$db->ErrorMsg());  
       $estado="";
       while ($arr = $recordset->FetchRow()) {
         $estado=$arr["estado"];
       }
	   if($estado=="X")
	     $sn_abreviado='S';
	   else
	     $sn_abreviado='N';
        $valores = array();
      $sql="insert into evolucion values (?,?,sysdate,?,?,?,?,?,?,?)";
      $valores[]=$_REQUEST["id_ficha"];
      $valores[]=$sec_evo;
        $str=$_REQUEST["evolucion"];
      $str=str_replace('<form','<formresp',$str);
$str=str_replace('</form','</formresp',$str);
      $valores[]=gzdeflate($str);
      $valores[]=$_SESSION["fichatmq"]["usuario"];
	  if($_SESSION["fichatmq"]["tipo_usuario"] ==3)
   $valores[]="I" ;
   else
   $valores[]="D" ;
   if($_SESSION["fichatmq"]["tipo_usuario"] ==3)
   $valores[]=$_SESSION["fichatmq"]["usuario"];
   else
   $valores[]="";
    $valores[]=($_REQUEST["interconsulta"] =="S") ? "S" : "N";
   $valores[]=$_REQUEST["especialidad"];
   $valores[]=$sn_abreviado;
      $recordset = $db->Execute($sql,$valores);
	  // Inicio Interconsulta
	  if($_REQUEST["interconsulta"] =="S"){
	   $ficha=retorna_ficha($db,$_REQUEST["id_ficha"]);
	   if($ficha[0]["codinst"] !=""){
	  $valores=array();
 
   $valores["run"]=$ficha[0]["run"] ;
   $valores["dv_run"]=$ficha[0]["dv_run"] ;
   $valores["nombre"]=$ficha[0]["nombre"] ;
   $valores["apellido"]=$ficha[0]["apellido"] ;
   $valores["sn_iden"]=$ficha[0]["sn_iden"] ;
   $valores["fec_nac"]=$ficha[0]["fec_nac"] ;
   $valores["ind_sexo"]=$ficha[0]["ind_sexo"] ;
   $valores["grado"]=$ficha[0]["grado"] ;
   $valores["inghosp"]=$ficha[0]["inghosp"] ;
   $valores["fec"]=date('d/m/Y');
   $valores["hora"]=date('H');
   $valores["minuto"]=date('i') ;
   $valores["codinst"]=$ficha[0]["codinst"] ;
   $valores["codprest"]="101009";
   $valores["dvprest"]="9";
   $valores["codbod"]="0";
   $valores["cantidad"]="1";
   $valores["tipo_atencion"]="2";
   $valores["tipo_pago"]="1";
   $valores["forma_pago"]="1";
   $valores["medico"]=$_SESSION["fichatmq"]["usuario"]; 
   $valores["usuario"]=$_SESSION["fichatmq"]["usuario"];
   $respuesta= $client->call('setInterconsulta', array("input"=>json_encode($valores)));
	   }
	  }
	  // Termino Interconsulta
	  
       if(isset($_FILES["adjunto"])){
	  
      $sql="select (nvl(max(sec),0)+1) as sec from anexo where id_ficha=? and sec_evo=?";
       $recordset = $db->Execute($sql,array($_REQUEST["id_ficha"],$sec_evo));
       if (!$recordset) die("hhh".$db->ErrorMsg());  
       $sec="";
       while ($arr = $recordset->FetchRow()) {
         $sec=$arr["sec"];
       }   
      $valores=array();
      $valores[]=$_REQUEST["id_ficha"];
      $valores[]=$sec_evo;
      
      $valores[]=$sec;
      
      $valores[]=$_FILES["adjunto"]["type"];

      $valores[]=$_FILES["adjunto"]["name"];
      $sql="insert into anexo values (?,?,?,empty_blob(),?,?)";
      $recordset = $db->Execute($sql,$valores);
//         if (!$recordset) die("hhh".$db->ErrorMsg()); 
      $db->UpdateBlobFile("anexo","adjunto",$_FILES["adjunto"]["tmp_name"],"id_ficha=".$_REQUEST["id_ficha"] ." and sec=".$sec." and sec_evo=".$sec_evo,"BLOB");
    }
      if (!$recordset){
         $results["estado"] = "0";
      }
      else{
        $results["estado"] = "2";
      }
   }
   else{
    
    $results["estado"] = "2";
   }
   foreach($_REQUEST as $k => $v){
      if(substr($k,0,10)=="evolucion_"){
        $valores = array();
        $sql="update evolucion set evolucion=? where id_ficha=? and sec_evo=?";
		  $str=$v;
      $str=str_replace('<form','<formresp',$str);
$str=str_replace('</form','</formresp',$str);
      $valores[]=gzdeflate($str);
        $valores[]=$_REQUEST["id_ficha"];
        $valores[]=substr($k,10);
        $recordset = $db->Execute($sql,$valores);
      }
    }
    foreach($_REQUEST as $k => $v){
      if(substr($k,0,12)=="elimina_adj_"){
        $arr_k=explode("_",$k);
        $valores = array();
        $valores[]=$arr_k[2];
        $valores[]=$arr_k[3];
        $valores[]=$arr_k[4];
        
        
        $sql="delete from anexo where id_ficha=? and sec_evo=? and sec=?";
        $recordset = $db->Execute($sql,$valores);
      }
    }
    foreach($_FILES as $k => $v){
      if(substr($k,0,8)=="adjunto_"){
        $arr_k=explode("_",$k);
        $id_ficha=$arr_k[1];
        $sec_evo=$arr_k[2];
        $sql="select (nvl(max(sec),0)+1) as sec from anexo where id_ficha=? and sec_evo=?";
        $recordset = $db->Execute($sql,array($id_ficha,$sec_evo));
        if (!$recordset) die("hhh".$db->ErrorMsg());  
        $sec="";
        while ($arr = $recordset->FetchRow()) {
         $sec=$arr["sec"];
        }   
        $valores=array();
        $valores[]=$id_ficha;
        $valores[]=$sec_evo;
        $valores[]=$sec;
        $valores[]=$_FILES[$k]["type"];
        $valores[]=$_FILES[$k]["name"];
        $sql="insert into anexo values (?,?,?,empty_blob(),?,?)";
        $recordset = $db->Execute($sql,$valores);
        $db->UpdateBlobFile("anexo","adjunto",$_FILES[$k]["tmp_name"],"id_ficha=".$id_ficha ." and sec=".$sec." and sec_evo=".$sec_evo,"BLOB");
      }
    }
    foreach($_REQUEST as $k => $v){
      if((substr($k,0,9)=="enmienda_")&&(trim($v) != "")){
        $arr_k=explode("_",$k);
        $id_ficha=$arr_k[1];
        $sec_evo=$arr_k[2];
        $sql="select (nvl(max(sec),0)+1) as sec from enmienda where id_ficha=? and sec_evo=?";
        $recordset = $db->Execute($sql,array($id_ficha,$sec_evo));
        if (!$recordset) die("hhh".$db->ErrorMsg());  
        $sec="";
        while ($arr = $recordset->FetchRow()) {
         $sec=$arr["sec"];
        }   
        $valores=array();
        $sql="insert into enmienda values (?,?,?,sysdate,?,?)";
        $valores[]=$id_ficha;
        $valores[]=$sec_evo;
        $valores[]=$sec;
		  $str=$v;
      $str=str_replace('<form','<formresp',$str);
$str=str_replace('</form','</formresp',$str);
      $valores[]=gzdeflate($str);
        $valores[]=$_SESSION["fichatmq"]["usuario"];
        $recordset = $db->Execute($sql,$valores);
       }
    }
} 
  
  $db->disconnect();
    echo json_encode($results);
?>

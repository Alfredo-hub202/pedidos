<?php 
setlocale(LC_ALL,''); // establecemos el locale, para que la fecha aparezca en espa�ol.
if(!isset($_SESSION)) 
{ 
	session_start();  //iniciamos la sesion.
} 

error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_WARNING & ~E_NOTICE);
$array = $slashrootreal = $backslashrootreal = $doublebackslashrootreal = array();

$server = "http://192.168.157.25/cgi-vel/PHERGAL-PRUEBAS/";


if ($_POST["BORRAR_PEDIDO"] == 1 || $_GET["BORRAR_PEDIDO"] == 1){//si en algun momento nos piden borrar el pedido activo, lo borramos.
// if(isset($_POST['BORRAR_PEDIDO'] == 1) && isset($_GET['BORRAR_PEDIDO'] == 1)):
	 unset($_SESSION['PEDIDO_ACTIVO']);

	
}

if ($_POST['BORRAR_ACTIVIDAD'] == 1|| $_GET['BORRAR_ACTIVIDAD'] == 1){//si en algun momento nos piden borrar la solicitud Dermo-Consejera activa, lo borramos.
	unset($_SESSION['ACTIVIDAD_ACTIVO']);
}

if ($_SESSION['id'] != session_id()){ //comprobamos si el usuario ha accedido al sistema y que la sesion de variable no ha cambiado. 

	if($_POST['W_USUARIO'] && $_POST['W_PASSWORD']) {	//si nos mandan informacion del login, verificamos que sea correcta. 
		
        $file = $server . 'w-login-log.bus';

		// var_dump($file);
		// return 0;
        $file .= '?W_USUARIO=' . $_POST['W_USUARIO'];
        $file .= '&W_PASSWORD=' . $_POST['W_PASSWORD'];
						
		$login = simplexml_load_file($file) or die("Hay problemas conectando al servidor. Por favor intentelo mas tarde.");
		
		if (!$login->codigo) { // comprobamos que el usuario es valido, si no lo es lo echamos y si lo asignamos la variable para no volver a entrar en esta seccion de login.
	        error('Acceso denegado. Intentelo de nuevo.','index.php'); 
    	    exit;
        }else{
		 	$_SESSION['id'] = session_id();
			$_SESSION['nombre'] = strval($login->nombre);
			$_SESSION['W_COMERCIAL'] = strval($login->codigo);
			$_SESSION['W_EMPRESA'] = strval($login->empresa);
			$_SESSION['W_EMPRESA_FICH'] = strval($login->empresa_fich);
			$_SESSION['W_DIVISION'] = strval($login->division);
			$_SESSION['W_FINI'] = date("d-m-Y",strtotime("-1 month"));
			$_SESSION['W_FFIN'] = date("d-m-Y");
						
		}
	
	}else{ //si no ha accedido al sistema y no nos manda informacion del login, lo mandamos a la pagina login.php.
		header("Location: index.php");
	}
}
	

function error($msg,$page) { // funcion para mostrar un error e ir a una pagina.
	echo '<html><head><script language="JavaScript">alert("' . $msg . '");';
	echo 'location.href="' . $page . '"</script></head>';
}

function proceso($proceso,$GET){ // funcion para la conexion con velazquez.

	$file = $GLOBALS['server'] . $proceso . '?_e=50000';
	
	foreach ($GET as $key=>$value){
		if (substr($key,0,1) == "W" && $value) $file .= "&" . $key . "=" . $value;		 //si la variable empieza con W, la incluimos en la busqueda.
	}

//echo $file;
	
	/*$texto = fopen(	$file,'r');
	$data = stream_get_contents($texto);
	fclose($texto);
	
	return simplexml_load_string(trim($data));
	*/
	//echo $file;
return simplexml_load_file(urlencode($file));

}	


function fecha($mes){

	if (substr($mes,0,1) != "0" && substr($mes,1,1) == "-"){ $mes = "0" . $mes;}
	
	$mes = str_ireplace(
		array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"),
		array("01",	"02","03","04","05","06","07","08","09","10",	"11","12"	),
		$mes);
		
	return $mes;
}

function selectbox($busqueda,$nombre,$libre,$selected,$submit,$vars){

	$xml = proceso($busqueda,$vars);
	// 	var_dump($xml);
	// 	return 0;
	// //echo  debug($busqueda,$vars);
	
	echo '<select name="' . $nombre .'" id="' . $nombre .'"';
	if ($submit) echo 'onchange="this.form.submit();"';
	echo '>';
	if ($libre) echo '<option> </option>';
		foreach ($xml->note as $note){
			echo '<option value="' . $note->codigo . '" ';
				if ($note->codigo == strval($selected)) echo 'selected="selected" ' ; 
			echo ' >' . utf8_decode($note->nombre) . '</option>';
		}
	echo '</select>';
	/*echo '<script>';
	echo 'for (i=0;i<document.getElementById("' . $nombre .'").options.length;i++){';
	echo 'if (document.getElementById("'. $nombre . '").options[i].value == "'. $GET[$nombre] .'"){';
	echo 'document.getElementById("' . $nombre .'").options[i].selected = true;';
	echo ' }	}	</script>';*/

}
?>
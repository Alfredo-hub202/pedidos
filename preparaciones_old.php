<?php include 'functions/functions.php';
$ventas = TRUE;

if ($_POST['BORRAR_CLIENTE'] == 1) {
	unset($_SESSION['CLIENTE_BUSQUEDA']);
	unset($_SESSION['CLIENTE_NOMBRE']);
	unset($_SESSION['CENTRO_BUSQUEDA']);
	unset($_SESSION['CENTRO_NOMBRE']);
}
if ($_POST['BORRAR_CENTRO'] == 1) {
	unset($_SESSION['CENTRO_BUSQUEDA']);
	unset($_SESSION['CENTRO_NOMBRE']);
}

$_SESSION['W_FINI'] = $_POST['W_FINI'] ? $_POST['W_FINI'] : $_SESSION['W_FINI'];
$_SESSION['W_FFIN'] = $_POST['W_FFIN'] ? $_POST['W_FFIN'] : $_SESSION['W_FFIN'];

$VARS = $_POST;
$VARS['W_CLIENTE'] = $_SESSION['CLIENTE_BUSQUEDA'];
$VARS['W_CENTRO'] = $_SESSION['CENTRO_BUSQUEDA'];
$VARS['W_EMPRESA'] = $_SESSION['W_EMPRESA'];
$VARS['W_COMERCIAL'] = $_SESSION['W_COMERCIAL'];
$VARS['W_EMPRESA_FICH'] = $_SESSION['W_EMPRESA_FICH'];
$VARS['W_FINI'] = $_SESSION['W_FINI'];
$VARS['W_FFIN'] = $_SESSION['W_FFIN'];
$VARS['W_DIVISION'] = $_POST['W_DIVISION'];
$VARS['W_NUMERO'] = $_POST['W_NUMERO'];

$fecha1 = new DateTime($_SESSION['W_FINI']);
$fecha2 = new DateTime($_SESSION['W_FFIN']);
$cliente = $_SESSION['CLIENTE_BUSQUEDA'];
$fecha = $fecha1->diff($fecha2);


if	($fecha->m > 3 or $fecha->y > 0)
{
	if	( empty ($cliente))
	{
	$VARS['W_ERROR'] = 1;;
	}
}

$xml = proceso('w-prep-pte.pro',$VARS);
// var_dump($xml);
if($xml->error){
 	$error = strval($xml->error);
	//printf("      Tengo Error ");
	//print $error;
}
		

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><!-- InstanceBegin template="/Templates/plantilla.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="Cache-Control" content ="no-cache">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Laboratorios Phergal</title>
<!-- InstanceEndEditable -->
<link href="css/style.css" rel="stylesheet" type="text/css">
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
</head>

<body> 
   <div id="container">
        <div id="header">
            <div style="text-align:right; margin-top:1px;"><?php echo $_SESSION['nombre']?>.  <a href="functions/logout.php"><img src="images/salir.png" alt="Cerrar Sessi&oacute;n" title="Cerrar Sesi&oacute;n" align="middle"/></a></div>
            <div id="menu"> <?php include 'functions/menu.php'; ?></div>
		</div>
        
       
	 <!-- InstanceBeginEditable name="EditRegion3" -->
      
     <script language="JavaScript" src="functions/calendar.js"></script>
	<link rel="stylesheet" href="css/calendar.css">
        
		<div id="content">
          <ul id="tabnav">
			<li class="selectedtab"><a href="preparaciones.php">Preparaci�n Pedidos</a></li>
          </ul>
		 
                	
          <form name="busqueda" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
              
           	<table width="100%" style="vertical-align:bottom" cellpadding="3px;">
            <tr>
            	<td width="26%" style="background-color:#EAEAEA"><label for="CLIENTE_BUSQUEDA" style="display:block;"><strong>Cliente:</strong></label>
                <?php 
					if($_SESSION['CLIENTE_BUSQUEDA']){ 
						echo $_SESSION['CLIENTE_NOMBRE']; 
						echo "&nbsp;<input type=\"hidden\" name=\"BORRAR_CLIENTE\" value=\"0\"><a href=\"#\"  onclick='document.busqueda.BORRAR_CLIENTE.value=1; document.busqueda.submit();'><img src=\"images/borrar.png\" alt=\"Borrar\" title=\"Borrar\"></a>";
					}else{
						echo "Todos. &nbsp;<a href=\"#\"  onclick='window.open(\"ventas_buscar_cliente.php\",\"Clientes\",\"width=600,height=300, scrollbars=yes\")'><img src=\"images/buscar.png\" alt=\"Buscar\" title=\"Buscar\"></a>";
					}?>
                    
        
           
                </td>
                <td colspan=2width="19%" style="background-color:#EAEAEA">
                	<label for="W_FINI" style="display:block"><strong>Fechas:</strong></label>
                    <input type="text" name="W_FINI" size="10" value="<?php echo $_SESSION['W_FINI'];?>"> 
						<script language="JavaScript">
							new tcal ({
							// form name
							'formname': 'busqueda',
							// input name
							'controlname': 'W_FINI'
							});
                        
                        </script>
     			- <input type="text" name="W_FFIN" size="10" value="<?php echo $_SESSION['W_FFIN'];?>">
                 	<script language="JavaScript">
                        new tcal ({
                        // form name
                        'formname': 'busqueda',
                        // input name
                        'controlname': 'W_FFIN'
                        });
                        
                        </script>
                <input type="image" src="images/reload.png" alt="Actualizar" title="Actualizar" style="border:0; padding:0 ; margin:0" align="middle">
                </td>
              
              <tr>
                <td width="32%" style="background-color:#EAEAEA"><label for="CENTRO_BUSQUEDA" style="display:block"><strong>Centro:</strong></label>
                <?php 
					if($_SESSION['CENTRO_BUSQUEDA']){ 
						echo $_SESSION['CENTRO_NOMBRE']; 
						echo "&nbsp;<input type=\"hidden\" name=\"BORRAR_CENTRO\" value=\"0\"><a href=\"#\"  onclick='document.busqueda.BORRAR_CENTRO.value=1; document.busqueda.submit();'><img src=\"images/borrar.png\" alt=\"Borrar\" title=\"Borrar\"></a>";
					}else{
						echo "Todos. &nbsp;<a href=\"#\"   onclick='window.open(\"ventas_buscar_centro.php\",\"Clientes\",\"width=600,height=300, scrollbars=yes\")'><img src=\"images/buscar.png\" alt=\"Buscar\" title=\"Buscar\"></a>";
					}?>
                </td>
                  <td width="11%" style="background-color:#EAEAEA"><label for="W_DIVISION" style="display:block"><strong>Divisi&oacute;n Venta</strong></label>
                	<?php 
					$VARS = NULL;
					selectbox('w-divventa.pro','W_DIVISION',1,strval($_POST['W_DIVISION']),1,$VARS);?></td>
                
                <td width="12%" style="background-color:#EAEAEA"><label for="W_NUMERO"><strong>N� Preparaci&oacute;n<br>
                </strong></label>
                <input name="W_NUMERO" type="text"></td>
              </tr>


                 
              
                    
            </tr>
            </table>
</form>
                           <?php   if($error){
					
					echo '<font color="red">' . utf8_decode($error) . '</font>';
									
				}
				
			?> 
                <table width="100%" class="tabla_datos">
                	<th>Nº Preparación</th>
                    <th>Cliente</th>
                    <th>Centro</th>
                    <th>Fecha</th>
                
                <?php foreach ($xml->note as $note){?>
                
               	    <tr>
                    	<td rowspan="2" align="center" class="celda_datos"><a href="#" onclick='location.href="preparacion_detalle.php?W_CODIGO=<?php echo $note->codigo?>";'><?php echo $note->numero?></a></td>

                        <td class="celda_datos_detallecentro"><strong><?php echo utf8_decode($note->centro_fiscal)?></strong> </td>
                      <td class="celda_datos_detallecentro"><?php echo utf8_decode($note->centro_comercial)?></td>
                        <td class="celda_datos_detalleder" align="center"><?php echo fecha($note->fecha)?></td>
                   </tr>
                  <tr>
                	   <td class="celda_datos_direccion" colspan="3"><?php echo utf8_decode($note->direccion)?></td>

              	   </tr>
                  <?php } ?>
                  </table>
                  
                  
         </div>
		<!-- InstanceEndEditable -->
		<div id="footer" >
        	<p>2009 &copy; Laboratorios Phergal S.A. Todos los derechos reservados</p>
        </div>
    </div>
</body>
<!-- InstanceEnd --></html>

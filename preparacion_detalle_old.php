<?php include 'functions/functions.php';

if ($_POST['PROCESAR_LECTURA']){

 	$VARS = $_POST;
	$VARS['W_COMERCIAL'] = $_SESSION['W_COMERCIAL'];
	$VARS['W_REGISTRO'] = $_POST['W_CODIGO'];
	$VARS['W_EMPRESA'] = $_SESSION['W_EMPRESA'];
	$VARS['W_EAN'] = $_POST['W_EAN'];
	$VARS['W_PREPARACION'] = $_POST['W_PREPARACION'];
	$VARS['W_PREPARACION_LIN'] = $_POST['W_PREPARACION_LIN'];
	$VARS['W_PREPARACION_LOTE'] = $_POST['W_PREPARACION_LOTE'];
	$VARS['W_CNT'] = $_POST['W_CNT'];


	$xml = proceso('w-preparacion-detalle.pro',$VARS);
	// print_r($xml);
}

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="css/informes.css">
<title>Detalle</title>
<style>
table {
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
    border: 1px solid #ddd;
}

th, td {
    border: 1px solid #ddd;
	/*border: none;*/
    /*text-align: left;*/
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}
</style>
</head>

<body>
<div id="content">
<?php 
	$VARS['W_COMERCIAL'] = $_SESSION['W_COMERCIAL'];
	$VARS['W_REGISTRO'] = $_GET['W_CODIGO'];
	$VARS['W_REGISTRO_LIN'] = $_GET['W_CODIGO_LIN'];
	$VARS['W_EMPRESA'] = $_SESSION['W_EMPRESA'];
	$VARS['W_EAN'] = $_POST['W_EAN'];
	$VARS['W_LOTE'] = $_POST['W_LOTE'];
	$VARS['W_REGISTRO_LIN'] = $_POST['W_REGISTRO_LIN'];	
	$VARS['W_PREPARACION'] = $_POST['W_PREPARACION'];
	$VARS['W_PREPARACION_LIN'] = $_POST['W_PREPARACION_LIN'];
	$VARS['W_PREPARACION_LOTE'] = $_POST['W_PREPARACION_LOTE'];
	$VARS['W_CNT'] = $_POST['W_CNT'];
	
	$xml = proceso('w-preparacion-detalle.pro',$VARS);
	
// print_r($xml);
// echo debug('w-preparacion-detalle.pro',$VARS);
	
	?>
    <div style="overflow-x:auto;">
    </table>
<table width="100%">
	<tr>
		<td width="79%" align="left"><input type="button" onclick='location.href="preparaciones.php"' value="VOLVER"></td>
		<td width="21%" colspan="2" align="right"><img align="right" src="images/logophergal.jpg" /></td>
	</tr>
</table>

	<table width="43%">
       <tr>
       	<th width="173">Preparaci&oacute;n N&ordm;</th>
      	<th width="137">Pedido N&ordm;</th>
      	<th width="134">Su Pedido:</th>
       	<th width="814">Datos Cliente</th>
       </tr>
       
       <tr>
	   <td><?php echo $xml->numero?></td>
       <td><?php echo utf8_decode($xml->pedido);?></td>
       <td><?php echo utf8_decode($xml->su_pedido);?></td>
       <td><?php echo utf8_decode($xml->centro_fiscal);?></td>
       </tr>
	  <tr>    
          <th colspan="3">Almacen</th>
          <td><?php echo utf8_decode($xml->centro_comercial);?></td>
      </tr>
    <tr>
    <td colspan="3"><?php echo strtoupper($xml->almacen)?></td>
    <td><?php echo utf8_decode($xml->direccion);?></td>
    </tr> 
    <tr>
        <td align="right"><strong>Fecha Preparacion:</strong></td>
        <td align="right"><strong>Fecha Entrega:</strong></td>
        <td align="right"><strong>Total Lineas:</strong></td>
        <td align="right"><strong>Observaciones:</strong></td>
    </tr>
    <tr>
        <td><?php echo fecha($xml->fecha);?></td>
        <td><?php echo fecha($xml->fecha_entrega);?></td>
        <td><?php echo fecha($xml->total_lin);?></td>
        <td><?php echo fecha($xml->obser);?></td>
     </tr>
     
  </table>
<br />
    
  
   	<?php foreach($xml->error as $error){?>
     <tr>
     	<td ><?php echo '<font color="red" size="5pt">'. $error->descripcion . '</font>'?></td>
     </tr>
     <?php } ?>
     <table style="border-collapse:collapse" width="100%"> 
      <th width="100px" style="border-bottom:1px solid #000000">Art&iacute;culo</th>
      
      <th align="left" style="border-bottom:1px solid #000000">EAN</th>
     <th align="left" style="border-bottom:1px solid #000000">Lote</th>
     <th style="border-bottom:1px solid #000000">Uds. <br />a Preparar</th>
     <th style="border-bottom:1px solid #000000">Uds.<br />Preparadas</th>
     <th style="border-bottom:1px solid #000000">Uds. <br /> Ptes</th>
     <th style="border-bottom:1px solid #000000"></th>
        
       
     <?php foreach($xml->lineas as $linea){?>
     <tr> 
         <form action="<?php $_SERVER['PHP_SELF']?>" method="post" autocomplete="off">

        <td><strong><?php echo '<font color=" '.$linea->color .'">'. $linea->cod_art.'</font>'?> </strong> <br /> <?php echo '<font color=" '.$linea->color .'">'. $linea->nombre.'</font>'?> </td>
        
        <td><?php echo '<font color=" '.$linea->color .'">'. $linea->ean.'</font>'?></td>
        <td><?php echo '<font color=" '.$linea->color .'">'. $linea->cod_lote.'</font>'?></td>
        <td align="right"><?php echo '<font color=" '.$linea->color .'">' . number_format(strval($linea->total_a_prep),0,",",".").'</font>'?></td>
        <td align="right"><?php echo '<font color=" '.$linea->color .'">' . number_format(strval($linea->total_prep_pistola),0,",",".").'</font>'?></td>
        <td align="right"><?php echo '<font color=" '.$linea->color .'">' . number_format(strval($linea->total_pte_pistola),0,",",".").'</font>'?>
    	<td align="right"> 
            <?php	if (strval($linea->total_pte_pistola) <> 0){
               
                ?>
							
			<input type="text" name="W_EAN"  id="W_EAN" autofocus />
    		<input type="submit" name="Enviar"  onClick="procesar_lectura()" value="Leer Referencia">
            <?php }?>
            <input type="hidden" name="W_LOTE"  id="W_LOTE" value="<?php echo $linea->lote;?>"/>
    		<input type="hidden" name="W_CODIGO"   id="W_CODIGO" value="$codigo" />
            <input type="hidden" name="W_PREPARACION" id="W_PREPARACION" value="<?php echo $linea->preparacion;?>" />
            <input type="hidden" name="W_PREPARACION_LIN" id="W_PREPARACION_LIN" value="<?php echo $linea->preparacion_lin;?>"/>
            <input type="hidden" name="W_PREPARACION_LOTE" id="W_PREPARACION_LOTE" value="<?php echo $linea->preparacion_lote;?>"/>
            <input type="hidden" name="W_CNT" id="W_CNT" value="1" /><br /><br />
            <?php	if (strval($linea->total_prep_pistola) <> 0){ ?>
            <input type="image" style="border:0" title="Borrar" onclick='
            if (confirm("�Borrar Linea?")){
              W_CNT.value = 0;
            }' src="images/borrar.png" alt="Borrar" align="bottom">
			<?php }?>
		</td>

</td>

    
      
      </form>
   	</tr>
       
     <?php } ?>


    </table>
     
</div>
</div>

</body>
</html>

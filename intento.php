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
	
//print_r($xml);
//echo debug('w-preparacion-detalle.pro',$VARS);
	
	?>
    <?php include("./Templates/header.php");?>
    <link rel="stylesheet" type="text/css" href="css/informes.css">

<html>
<head>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>

<div class="navbar">
                            	<div class="navbar-inner">
	                                <ul class="breadcrumb">
	                                    <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <li class="breadcrumb-item"><a href="preparaciones.php">Preparación Pedidos</a></li>
    <li class="breadcrumb-item">/ Detalle Preparación</li>
	                                </ul>
                            	</div>
                        	</div>


    <div class="container py-4">
    <nav aria-label="breadcrumb border">
  <ol class="breadcrumb">
   
  </ol>
</nav>
</div>
<div class="container-fluid py-5">

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col-2">Preparación Nº</th>
      <th scope="col-2">Pedido Nº</th>
      <th scope="col-2">Su Pedido:</th>
      <th scope="col-2">Datos Cliente</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="col-6"><?php echo $xml->numero?></th>
      <td><?php echo utf8_decode($xml->pedido);?></td>
      <td><?php echo utf8_decode($xml->su_pedido);?></td>
      <td><?php echo utf8_decode($xml->centro_fiscal);?></td>
    </tr>
    <tr>
      <th colspan="2">Almacen:</th>
      <td colspan="2"><?php echo utf8_decode($xml->centro_fiscal);?></td>
      
     
    </tr>
    <tr>
      <th colspan="2"><?php echo strtoupper($xml->almacen)?></th>
      <td colspan="2"><?php echo utf8_decode($xml->direccion);?></td>
    </tr>

    <tr>

    <th scope="col-2">Fecha Preparacion:</th>
      <th scope="col-2">Fecha Entrega:</th>
      <th scope="col-2">Total Lineas:</th>
      <th scope="col-2">Observaciones:</th>
    </tr>
    <td><?php echo fecha($xml->fecha);?></td>
        <td><?php echo fecha($xml->fecha_entrega);?></td>
        <td><?php echo fecha($xml->total_lin);?></td>
        <td><?php echo fecha($xml->obser);?></td>
    </tr>
  </tbody>
</table>

</div>
<table id="search">

 <tr>
  <td>Centro</td>
  <td id="search6"></td>
 <tr>
 
</table>




<table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
      	<th>Art&iacute;culo</th>
		<th>EAN</th>
		<th>Lote</th>
		<th>Uds. <br />a Preparar</th>
        <th>Uds.Preparadas</th>
		<th>Uds. <br /> Ptes</th>
		<th>Centro</th>
        <th>Referencia</th>  
      
            </tr>
        </thead>
        
        <tbody>
										
                                            <?php foreach($xml->lineas as $linea){?>
                                               
     <tr> 
         <form action="<?php $_SERVER['PHP_SELF']?>" method="post" autocomplete="off">

        <td><strong><?php echo '<font color=" '.$linea->color .'">'. $linea->cod_art.'</font>'?> </strong> <br /> <?php echo '<font color=" '.$linea->color .'">'. $linea->nombre.'</font>'?> </td>
      
        <td><?php echo '<font color=" '.$linea->color .'">'. $linea->ean.'</font>'?></td>

        <td><?php echo '<font color=" '.$linea->color .'">'. $linea->cod_lote.'</font>'?></td>
        <td><?php echo '<font color=" '.$linea->color .'">' . number_format(strval($linea->total_a_prep),0,",",".").'</font>'?></td>
        <td><?php echo '<font color=" '.$linea->color .'">' . number_format(strval($linea->total_prep_pistola),0,",",".").'</font>'?></td>
        <td><?php echo '<font color=" '.$linea->color .'">' . number_format(strval($linea->total_pte_pistola),0,",",".").'</font>'?>
        
        <td><?php echo '<font color=" '.$linea->color .'">'. $linea->pto_operacional_nombre.'</font>'?></td>


    	<td> 
            <?php	if (strval($linea->total_pte_pistola) <> 0){ ?>
							
			<input type="text" name="W_EAN"  id="W_EAN" autofocus /><br><br>
    		<input type="submit" name="Enviar"  onClick="procesar_lectura()" value="Leer Referencia">
            <?php }?>
            <input  type="hidden" name="W_LOTE"  id="W_LOTE" value="<?php echo $linea->lote;?>"/>
    		<input type="hidden" name="W_CODIGO"   id="W_CODIGO" value="$codigo" />
            <input type="hidden" name="W_PREPARACION" id="W_PREPARACION" value="<?php echo $linea->preparacion;?>" />
            <input type="hidden" name="W_PREPARACION_LIN" id="W_PREPARACION_LIN" value="<?php echo $linea->preparacion_lin;?>"/>
            <input type="hidden" name="W_PREPARACION_LOTE" id="W_PREPARACION_LOTE" value="<?php echo $linea->preparacion_lote;?>"/>
            <input type="hidden" name="W_CNT" id="W_CNT" value="1" /><br /><br />
            <?php	if (strval($linea->total_prep_pistola) <> 0){ ?>
            <input type="image" style="border:0" title="Borrar" onclick='
            if (confirm("Borrar Linea?")){
              W_CNT.value = 0;
            }' src="images/borrar.png" alt="Borrar" align="bottom">
			<?php }?>
                    </td>

            </td>

                </form>
                </tr>
                
                <?php } ?>
											
										</tbody>
									</table>
</html>
<script>
$(document).ready(function(){
 $('#example').DataTable({
  initComplete: function(){
   this.api().columns([5,6,7]).every(function(i){
    var column = this,
    select = $('<select style="width:200px"><option value=""></option></select>')
    .appendTo( $('#search'+i))
    .on( 'change', function(){
      var val = $.fn.dataTable.util.escapeRegex($(this).val());
      column.search( val ? '^'+val+'$' : '', true, false ).draw();
    });
    column.data().unique().sort().each( function ( d, j ) {
     select.append('<option>'+d+'</option>');
    });
   });
  }
 });
});
</script>
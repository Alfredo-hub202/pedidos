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

<?php include("./Templates/header.php");?>
<div class="navbar">
                            	<div class="navbar-inner">
	                                <ul class="breadcrumb">
	                                  
	                    				<li class="breadcrumb-item">Preparación Pedidos</li>
	                                </ul>
                            	</div>
                        	</div>
    <div class="container py-4">
    <nav aria-label="breadcrumb border">
  <ol class="breadcrumb">
   
  </ol>
</nav>
</div>

  <main role="main" class="mt-3 mb-5 pl-md-5 pr-md-5 container-fluid">
        <div class="col-12 text-center mt-5 mb-4">
            <?php 
            
            //variable que almacenara los valores en cada ciclo
$contador=1;
foreach($xml->note as $note){

    echo '<tr>
  <td>'.$contador.'</td>';

  //se incrementa el valor para que el proximo ciclo valga uno mas
  $contador++; 
            
 } ?>
            
            <h1>Preparación Pedidos</h1>
        </div>
			<!-- block -->
			<div class="block">
				
                            <div class="navbar navbar-inner block-header text-center">
								
                                <div class="muted pull-center">


                            <a href="#"><span class="badge badge-info pull-right">Pedidos
							</span></a>
                        
								</div>
                            </div>
							
                            <div class="center-content collapse in text-center">
                                <div>
                                <br><br>
  									<table cellpadding="0" cellspacing="0" border="0" py-5 class="table table-striped table-bordered text-center" id="example">
										<thead>
											<tr>
												<th>Nº Preparación	</th>
												<th>Cliente</th>
												<th>Centro</th>
												<th>Fecha</th>                                                                                               
											</tr>
										</thead>										
										<tbody>											
										<?php foreach ($xml->note as $note) { ?>
                    <tr>
						
                          
							<td ><a href="#" onclick='location.href="preparacion_detalle.php?W_CODIGO=<?php echo $note->codigo?>";'><?php echo $note->numero?></a></td>
                       
                        <td class="celda_datos_detallecentro">
                            <strong><?php echo utf8_decode($note->centro_fiscal) ?></strong></td>
                        <td>
                            <?php echo $note->centro_comercial ?>
                            <br/>
                            <strong>Dirección: </strong><?php echo utf8_decode($note->direccion) ?>
                        </td>
                        <td><?php echo fecha($note->fecha) ?></td>
						
                    </tr>
                <?php } ?>

										</tbody>
									</table>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->    
    </main>
	<?php include("./Templates/footer.php");?>

  
<script src="vendors/jquery-1.9.1.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="vendors/datatables/js/jquery.dataTables.min.js"></script>


        <script src="assets/scripts.js"></script>
        <script src="assets/DT_bootstrap.js"></script>
        <script>
        $(function() {
            
        });
        </script>



<a href="noticias.php" <?php  if( $noticias) echo 'style="text-decoration:underline;color:#FFC20B;"';?>>NOTICIAS</a>  | 
<a href="centros_buscar.php" <?php  if($clientes) echo 'style="text-decoration:underline;color:#FFC20B;"';?>>CLIENTES</a>  | 
<a href="pedido_nuevo_cli.php" <?php  if($pedido) echo 'style="text-decoration:underline;color:#FFC20B;"';?>>GENERAR PEDIDO</a>  | 
<a href="visita_nueva_cli.php" <?php  if($visita) echo 'style="text-decoration:underline;color:#FFC20B;"';?>>REPORTAR VISITA</a>  |
<a href="actividad_nuevo_cli.php?" <?php  if($actividad) echo 'style="text-decoration:underline;color:#FFC20B;"';?>>GENERAR SOL.DERMO-CONSEJERA</a>  | 
<a href="propuestas.php?tipo=S" <?php  if($ventas) echo 'style="text-decoration:underline;color:#FFC20B;"';?>>VENTAS</a> |  
<a href="visitas.php?" <?php  if($visitas) echo 'style="text-decoration:underline;color:#FFC20B;"';?>>VISITAS</a>  |
<a href="actividades.php?" <?php  if($actividades) echo 'style="text-decoration:underline;color:#FFC20B;"';?>>SOL.DERMO-CONSEJERA</a>  |
<a href="acuerdos.php?" <?php  if($acuerdos) echo 'style="text-decoration:underline;color:#FFC20B;"';?>>ACUERDOS</a>  |
<?php if ($_SESSION['PEDIDO_ACTIVO']){?>| <a href="pedido_nuevo.php">PEDIDO ACTIVO</a><?php  } ?>
<?php if ($_SESSION['ACTIVIDAD_ACTIVO']){?>| <a href="actividad_nuevo.php">SOL.DERMO-CONSEJERA ACTIVA</a><?php  } ?>

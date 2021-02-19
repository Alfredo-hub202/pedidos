<?php include 'functions/functions.php'?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="Cache-Control" content ="no-cache">
<!-- TemplateBeginEditable name="doctitle" -->
<title>Laboratorios Phergal</title>
<!-- TemplateEndEditable -->
<link href="../css/style.css" rel="stylesheet" type="text/css">
<!-- TemplateBeginEditable name="head" --><!-- TemplateEndEditable -->
</head>

<body> 
   <div id="container">
        <div id="header">
            <div style="text-align:right; margin-top:1px;"><?php echo $_SESSION['nombre']?>.  <a href="functions/logout.php"><img src="images/salir.png" alt="Cerrar Sessi&oacute;n" title="Cerrar Sesi&oacute;n" align="middle"/></a></div>
            <div id="menu"> <?php include 'functions/menu.php'; ?></div>
		</div>
        
       
		<!-- TemplateBeginEditable name="EditRegion3" -->
		<h1 style="margin:0 3px 5px 0">Título</h1>
		<div id="content">
        Contenido Texto
        </div>
		<!-- TemplateEndEditable -->
		<div id="footer" >
        	<p>2009 &copy; Laboratorios Phergal S.A. Todos los derechos reservados</p>
        </div>
    </div>
</body>
</html>

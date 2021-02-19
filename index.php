<!DOCTYPE html>
<html>

<head>
  <title>Laboratorios Phergal</title>
  <!-- Bootstrap -->
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
  <link href="assets/styles.css" rel="stylesheet" media="screen">
  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
</head>

<body id="login">
  <!-- Image and text -->
  <div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
      <div class="container-fluid">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
        <BR></BR>
        <div class="nav-collapse collapse">
          <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand container" href="#">
              <img src="images/logophergal.jpg" />
            </a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">


            </div>

          </nav>

        </div>
        <!--/.nav-collapse -->
      </div>
    </div>
  </div>

  <div class="well">

    <div class="container">
      <div class="container"><br><br><br><br><br>
        <form action="preparaciones.php" class="form-signin" method="post" name="login">
          <h3 class="form-signin-heading">Inicio de Sesión - PMW</h3><br>
          <input for="uid" type="text" class="input-block-level" placeholder="Usuario" name="W_USUARIO">
          <input for="pwd" type="password" class="input-block-level" placeholder="Contraseña" name="W_PASSWORD">

          <button class="btn btn-large btn-primary" type="submit">Acceder</button>
        </form>

      </div>
    </div> <!-- /container -->
    <script src="vendors/jquery-1.9.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
<?php include("./Templates/footer.php");?>

</html>
<script>
  document.login.W_USUARIO.focus();

</script>
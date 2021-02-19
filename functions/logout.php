<?php
  session_start();

    include "functions.php";
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_WARNING & ~E_NOTICE);
    $array = $slashrootreal = $backslashrootreal = $doublebackslashrootreal = array();
    
  $file = $server .'w-borra-carro.pro';
  $file .= '?W_COMERCIAL=' . $_SESSION['W_COMERCIAL'];

	//$foo = fopen($file,'r');

  if (isset($_COOKIE[session_name()])) {
     setcookie(session_name(), '', time()-42000, '/');
  }

  $_SESSION = array();
  session_destroy();
  
  // echo '<font style="font-family:Tahoma; font-size:8pt;">Cerrando sesión...</font>';

?>

<meta http-equiv="refresh" content="1; URL=../index.php">

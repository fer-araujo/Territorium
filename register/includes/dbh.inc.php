<?php
//Se establecen las variables para establecer la conexion ala base de datos.
$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "festival_register";

//Se establece la conexion con la base de datos
$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

//Si la conexion no es procesada se levanta un mensaje de error.
if(!$conn){
  die("Connection FAILED: " .mysqli_connect_error());
}

<?php
  // Seccion para cerrar todas las sesiones y/o variables de las mismas, redireccionando todo a index.
session_start();
session_unset();
session_destroy();
header("Location: ../index.php");

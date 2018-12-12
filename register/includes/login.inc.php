<?php
//Se verifica que el usuario entro a la pagina de registro de forma correcta y no utilizando atajos no deseados.
if (isset($_POST['login-submit'])) {
  //Se manda a llamar la conexion con la base de datos
  require 'dbh.inc.php';
  //Se asigna a cada variable el valor que se obtienen de las formas de acceso.
  $email = $_POST['userMail'];
  $pwd = $_POST['userPwd'];
  //Se verifica que ninguno de los campos este vacio.
  if (empty($email) || empty($pwd)) {
    header("Location: ../index.php?error=emptyfields");
    exit();
  }
//Se verifica la conexion y los datos a evniar con la base de datos
  else {
    $sql = "SELECT * FROM usuarios WHERE userEmail=?;";
    $stmt = mysqli_stmt_init($conn);
    //Si existe un error, se envia el aviso de error de conexion y se regresa al usuario a la pagina inicial.
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../index.php?error=sqlerror");
      exit();
    }
    //En dado caso de no existir error alguno se mandan a comparar los datos de la base con los datos ingresados.
    else {
      mysqli_stmt_bind_param($stmt, "s", $email);
      mysqli_stmt_execute($stmt);
      $results = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($results)) {
        $pwdCheck = password_verify($pwd, $row['userPwd']);
        //Si la contraseña asignada es erronea, se levanta un mensaje de error y se mantiene al usuario en la pagina inicial
        if($pwdCheck == false){
          header("Location: ../index.php?error=wrongpwd");
          exit();
        }
        //En caso de ser verdadera, se levanta un mensaje de conseguido y se obtienen los datos de isUser y el Mail del usuario.
        else if ($pwdCheck == true){
          session_start();
          $_SESSION['userId'] = $row['idUsers'];
          $_SESSION['userMail'] = $row['userEmail'];

          header("Location: ../index.php?login=success");
          exit();
        }
        //en caso de que ocurriera algun otro tipo de error, se manda un mensaje de error y se deja al usuario en la pagina inicial
        else {
          header("Location: ../index.php?error=wrongpwd");
          exit();
        }
      }
      //En caso de que no se detecte al usuario y/o el usuario escrito no exista en la base, se levanta un error y se deja al usuario en la pagina inicial.
      else {
        header("Location: ../index.php?error=nouser");
        exit();
      }
    }
  }

}

else {
  // En dado caso que el usuario trate de accesar a esta pagina mediante metodos atajos no deseados, sera redirigido a la pagina inicial.
  header("Location: ../index.php");
  exit();
}

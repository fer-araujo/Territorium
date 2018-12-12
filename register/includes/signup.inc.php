<?php

//Se verifica que el usuario entro a la pagina de registro de forma correcta y no utilizando atajos no deseados.
if (isset($_POST['signup-submit'])) {

//Se manda a llamar la conexion con la base de datos
  require 'dbh.inc.php';
//Se asigna a cada variable el valor que se obtienen de las formas de registro.
  $username= $_POST['userName'];
  $last= $_POST['userLast'];
  $email= $_POST['userMail'];
  $gender= $_POST['userGender'];
  $age= $_POST['userAge'];
  $genre= $_POST['userGenre'];
  $band= $_POST['userBand'];
  $pwd= $_POST['userPwd'];
  $pwdrepeat= $_POST['userPwd-repeat'];

  // Se verifican errores
  //Se verifica qeu no haya inputs vacios.
    if (empty($username) || empty($email) || empty($pwd) || empty($pwdrepeat)) {
    header("Location: ../signup.php?error=emptyfields&userName=".$username."&userMail=".$email);
    exit();
  }
  // Se verifica que el nombre y el correo sean validos
   if (!preg_match("/^[a-zA-Z0-9]*$/", $username) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../signup.php?error=invaliduserNameuserMail");
    exit();
  }
  //Se verifica por un nombre invalido
  else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    header("Location: ../signup.php?error=invaliduserName&userMail=".$email);
    exit();
  }
  // Se verifica si el correo es valido
  else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../signup.php?error=invaliduserMail&userName=".$username);
    exit();
  }
  // Se verifica que ambas contraseñas sean correctas
  else if ($pwd !== $pwdrepeat) {
    header("Location: ../signup.php?error=passwordcheck&userName=".$username."&userMail=".$email);
    exit();
  }
  else {

    // Para verificar que el correo que se registrara no haya sido previamente registrado se realizan las siguientes acciones.

    //Primero se crea un statement para verificar qeu el email ingresado no exista en la base de datos
    $sql = "SELECT userEmail FROM usuarios WHERE userEmail=?;";

    $stmt = mysqli_stmt_init($conn);
    // Se verifica qeu no haya errores entre el statement y el llamado a la base
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      // En caso de error, el usuario sera regresado a la pagina de registro.
      header("Location: ../signup.php?error=sqlerror");
      exit();
    }
    else {
      //Se envian los parametros que deseamos.
      mysqli_stmt_bind_param($stmt, "s", $email);
      //Se ejecuta el statement y finalmente se envia a la base de datos
      mysqli_stmt_execute($stmt);
      //Se guarda el resultado
      mysqli_stmt_store_result($stmt);

      $resultCount = mysqli_stmt_num_rows($stmt);

      mysqli_stmt_close($stmt);
      // Al guardar el resultado obtenido, utilizando un condicional vereficamos si dicho correo existia previamente o no.
      if ($resultCount > 0) {
        header("Location: ../signup.php?error=usertaken&userMail=".$email);
        exit();
      }
      else {

      //Mediante un estado se preparan los datos que deseamos enviar a la base de datos.
        $sql = "INSERT INTO usuarios(userName, userLast, userEmail, userGender, userAge, userFav, userBand, userPwd) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";

        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
          //En caso de existir algun error en el estado SQL, se levanta un error y el usuario es redirigido a la seccion de registro
          header("Location: ../signup.php?error=sqlerror2");
          exit();
        }
        else {

          // En caso de no existir error alguno, primero se HASHEA la contraseña para encriptarla, utilizando el metodo por default ya que se actualiza constantemte junto con php.
          $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

          //Posteriormente la informacion del usuario es enviada.
          mysqli_stmt_bind_param($stmt, "ssssisss", $username, $last, $email, $gender, $age, $genre, $band, $hashedPwd);

          mysqli_stmt_execute($stmt);
          //Finalmente al quedar registrado, se redirige al usuario a la pagina inicial.
          header("Location: ../index.php");
          exit();
        }
      }
    }
  }
  //Se cierran todos los estados y la conexion, hasta que se vuelva hacer algun llamado.
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
else {
  // En dado caso que el usuario trate de accesar a esta pagina mediante metodos atajos no deseados, sera redirigido a la pagina inicial.
  header("Location: ../index.php");
  exit();
}

  <?php
  session_start();
  $nombre=$_POST['nombre'];
  $telefono=$_POST['telefono'];
  $correo=$_POST['correo'];
  $T_usuario=$_POST['T_usuario'];
  $contrasena=$_POST['contrasena'];
  $contrasena2=$_POST['contrasena2'];

  if ($contrasena == $contrasena2) {

    include 'Conexion.php';

    $passwordhash=password_hash($contrasena, PASSWORD_DEFAULT);
    $query = "INSERT INTO trabajador(Nombre, Telefono, Correo, Usuario, Contrasena)
    VALUES('$nombre', '$telefono', '$correo', '$T_usuario',  '$passwordhash')";

    
    if ($con->query($query) === TRUE){

      $_SESSION['loggedin'] = true;
      $_SESSION['Correo'] = $correo;
      $_SESSION['Usuario'] = $T_usuario;
      $_SESSION['start'] = time();
      $_SESSION['expire'] = $_SESSION['start']; 
      header('Location: http://localhost/Nueva/Panel_control2.php');

    }else {
      echo "Error al crear el usuario." . $query . "<br>" . $con->error; 
      echo "<a href='R_trabajador.php'>Pruebe Nuevamente</a>";
    }
  }else{
 echo "Contraseñas  no coinciden";
 echo "<a href='R_trabajador.php'>Pruebe Nuevamente</a>";
}
?>